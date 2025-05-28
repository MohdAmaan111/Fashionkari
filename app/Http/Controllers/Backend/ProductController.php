<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $categories = Category::all(); // Get all categories
        $products = Product::join('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->select('products.*', 'categories.cat_name')
            ->get();   // Get all products

        return view('backend.products', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,cat_id',
            'mrp' => 'required|numeric',
            'selling_price' => 'required|numeric|lte:mrp',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Handle the image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

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
            $slug = Str::slug($request->prod_name) ?: 'product';
            $imageName = $slug . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();

            // Move the image
            $image->move($folderPath, $imageName);

            // Store the relative path to the image in DB
            $imagePathForDB = $categorySlug . '/' . $imageName;
        }

        // Save product
        Product::create([
            'prod_name' => $request->product_name,
            'cat_id' => $request->category_id,
            'mrp' => $request->mrp,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock,
            'image' => $imagePathForDB,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Product added successfully.');
    }
}
