<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class VariantController extends Controller
{

    public function index()
    {
        // Check if the user is not authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // $categories = Category::all(); // Get all categories
        // $brands = Brand::all(); // Get all brands

        // $products = Product::join('categories', 'products.category_id', '=', 'categories.cat_id')
        //     ->select('products.*', 'categories.cat_name')
        //     ->get();   // Get all products

        // return view('backend.products', compact('products', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_id' => 'required|exists:products,prod_id',
            'color' => 'required|string',
            // 'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',  // Each item must be a valid image
            'sizes' => 'required|array',
        ]);


        // Handle the image upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            // Get category name from DB using category_id
            $category = Category::where('cat_id', $request->category_id)->first();

            // Get category name from category model
            $categorySlug = $category ? Str::slug($category->cat_name) : 'uncategorized';

            // Create folder path
            $folderPath = public_path('uploads/products/' . $categorySlug);

            // Create folder if it doesn't exist
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }

            // Create image name using product name + random string
            $slug = Str::slug($request->product_name) ?: 'product';

            foreach ($images as $image) {
                $imageName = $slug . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
                $image->move($folderPath, $imageName); // Move the image
                $imagePaths[] = $categorySlug . '/' . $imageName;
            }
        }

        $productId = $request->input('product_id');
        $color = $request->input('color');
        $sizes = $request->input('sizes');


        foreach ($sizes as $sizeData) {
            if (!isset($sizeData['selected'])) {
                continue; // Skip unchecked rows
            }

            $size = $sizeData['size'];

            // Check if variant already exists for product and size
            $existingVariant = ProductVariant::where('product_id', $productId)
                ->where('size', $size)
                ->first();

            if ($existingVariant) {
                // dd("Update Product");

                $existingVariant->color = $color;
                $existingVariant->stock = $sizeData['stock'];
                $existingVariant->mrp = $sizeData['mrp'];
                $existingVariant->selling_price = $sizeData['selling_price'];
                $existingVariant->save();
            } else {
                // dd("Insert Product");

                // if (isset($sizeData['selected'])) {
                ProductVariant::create([
                    'product_id' => $request->product_id,
                    'color' => $request->color,
                    'images' => json_encode($imagePaths),
                    'size' => $sizeData['size'],
                    'stock' => $sizeData['stock'],
                    'mrp' => $sizeData['mrp'],
                    'selling_price' => $sizeData['selling_price'],
                ]);
                // }
            }
        }

        return back()->with('success', 'Variant added successfully!');
    }
}
