<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
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
            // $imageName = time() . '_' . Str::slug($request->prod_name) . '.' . $image->getClientOriginalExtension();
            $imageName = time() . '_' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        // Save product
        Product::create([
            'prod_name' => $request->product_name,
            'cat_id' => $request->category_id,
            'mrp' => $request->mrp,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock,
            'image' => $imageName,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Product added successfully.');
    }
}
