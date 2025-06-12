<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        // Check if the user is not authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $categories = Category::all(); // Get all categories
        $brands = Brand::all(); // Get all brands

        $products = Product::with(['category', 'variants'])->get();

        return view('backend.products', compact('products', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validate the input
        $request->validate([
            'product_name'       => 'required|string|max:255',
            'fabric_name'        => 'nullable|string|max:255',
            'brand_id'           => 'nullable|exists:brands,brand_id',
            'category_id'        => 'required|exists:categories,cat_id',
            'prod_description'   => 'nullable|string',
            'images'             => 'nullable|array',
            'images.*'           => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title'         => 'nullable|string|max:255',
            'meta_keyword'       => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string|max:500',
        ]);

        $imagePaths = []; // To store array of images
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
                $imageName = $slug . '_' . Str::random(4) . '.' . $image->getClientOriginalExtension();
                $image->move($folderPath, $imageName); // Move the image
                $imagePaths[] = $categorySlug . '/' . $imageName;
            }
        }


        if ($request->filled('product_id')) {
            // dd("Update Product");

            // Update existing product
            $product = Product::findOrFail($request->product_id);

            $product->update([
                'product_name'      => $request->product_name,
                'fabric_name'       => $request->fabric_name,
                'brand_id'          => $request->brand_id,
                'category_id'       => $request->category_id,
                'age_group'         => $request->age_group,
                'neck_type'         => $request->neck_type,
                'length_type'       => $request->length_type,
                'sleeve_type'       => $request->sleeve_type,
                'fit_type'          => $request->fit_type,
                'care_instructions' => $request->care_instructions,
                'prod_description'  => $request->prod_description,
                'color'  => $request->color,
                'images' => json_encode($imagePaths),
                'meta_title'        => $request->meta_title,
                'meta_keyword'      => $request->meta_keyword,
                'meta_description'  => $request->meta_description,
            ]);

            return redirect()->back()->with('success', 'Product updated successfully.');
        } else {
            // dd("Create Product");

            // Create new product
            Product::create([
                'product_name'      => $request->product_name,
                'fabric_name'       => $request->fabric_name,
                'brand_id'          => $request->brand_id,
                'category_id'       => $request->category_id,
                'age_group'         => $request->age_group,
                'neck_type'         => $request->neck_type,
                'length_type'       => $request->length_type,
                'sleeve_type'       => $request->sleeve_type,
                'fit_type'          => $request->fit_type,
                'care_instructions' => $request->care_instructions,
                'prod_description'  => $request->prod_description,
                'color' => $request->color,
                'images' => json_encode($imagePaths),
                'meta_title'        => $request->meta_title,
                'meta_keyword'      => $request->meta_keyword,
                'meta_description'  => $request->meta_description,
            ]);

            return redirect()->back()->with('success', 'Product added successfully.');
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete associated images from storage if needed
        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $image) {
                $imagePath = public_path('uploads/products/' . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
