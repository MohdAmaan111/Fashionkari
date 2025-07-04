<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();   // Get all categories

        $products = Product::with(['category', 'variants'])
            ->whereHas('variants') // Only include products that have variants
            ->get();

        $wishlistVariantIds = [];

        if (Auth::guard('customer')->check()) {
            $wishlistVariantIds = Wishlist::where('customer_id', Auth::guard('customer')->id())
                ->pluck('variant_id')
                ->toArray();
        }

        return view('index', compact('products', 'categories', 'wishlistVariantIds'));
    }

    public function singleProduct($id)
    {

        $product = Product::join('categories', 'products.category_id', '=', 'categories.cat_id')
            ->where('products.prod_id', $id)
            ->select('products.*', 'categories.cat_name')
            ->firstOrFail();

        $meta = [
            'title' => $product->meta_title ?? $product->prod_name,
            'keywords' => $product->meta_keyword ?? '',
            'description' => $product->meta_description ?? Str::limit($product->description, 150),
        ];

        $categories = Category::all();   // Get all categories

        // Fetch similar products (same category, exclude current), with category name
        $similarProducts = Product::join('categories', 'products.category_id', '=', 'categories.cat_id')
            ->where('products.category_id', $product->cat_id)  // Include category and variants data
            ->where('products.prod_id', '!=', $product->prod_id)  // Exclude current product
            ->whereHas('variants')  // Only include products that have variants
            ->select('products.*', 'categories.cat_name')  //Selects all product fields plus the category name from the categories table.
            ->limit(6)
            ->get();

        // dd($similarProducts->all());

        // Sort variants by size order
        $sizeOrder = ['XXS', 'XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL'];
        $sortedVariants = $product->variants->sortBy(function ($variant) use ($sizeOrder) {
            return array_search($variant->size, $sizeOrder);
        });

        // Sort only if product has variants loaded
        if ($product->relationLoaded('variants')) {
            $sortedVariants = $product->variants->sortBy(function ($variant) use ($sizeOrder) {
                return array_search($variant->size, $sizeOrder);
            });

            // Reassign sorted variants back to the product
            $product->setRelation('variants', $sortedVariants);
        }

        $wishlistVariantIds = [];

        if (Auth::guard('customer')->check()) {
            $wishlistVariantIds = Wishlist::where('customer_id', Auth::guard('customer')->id())
                ->pluck('variant_id')
                ->toArray();
        }

        return view(
            'single-product',
            compact('product', 'categories', 'similarProducts', 'meta', 'wishlistVariantIds')
        );
    }
}
