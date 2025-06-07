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
            'image' => 'required|image',
            'sizes' => 'required|array',
        ]);

        $path = $request->file('image')->store('variants', 'public');

        foreach ($request->sizes as $sizeData) {
            if (isset($sizeData['selected'])) {
                ProductVariant::create([
                    'product_id' => $request->product_id,
                    'color' => $request->color,
                    'image' => $path,
                    'size' => $sizeData['size'],
                    'stock' => $sizeData['stock'],
                    'mrp' => $sizeData['mrp'],
                    'selling_price' => $sizeData['selling_price'],
                ]);
            }
        }

        return back()->with('success', 'Variant added successfully!');
    }
}
