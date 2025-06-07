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

        $products = Product::join('categories', 'products.category_id', '=', 'categories.cat_id')
            ->select('products.*', 'categories.cat_name')
            ->get();   // Get all products

        return view('backend.products', compact('products', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validate the input
        $request->validate([
            'product_name'       => 'required|string|max:255',
            'fabric_name'        => 'required|string|max:255',
            'brand_id'           => 'required|exists:brands,brand_id',
            'category_id'        => 'required|exists:categories,cat_id',
            'age_group'          => 'nullable|in:Men,Women,Baby,Boy,Girl',
            'neck_type'          => 'nullable|in:Round Neck,V-Neck,Collar,Mandarin Collar,High Neck',
            'length_type'        => 'nullable|in:Crop,Waist Length,Hip Length,Thigh Length,Knee Length,Mid-Calf Length,Ankle Length,Full Length',
            'sleeve_type'        => 'nullable|in:Full,Half,Sleeveless',
            'fit_type'           => 'nullable|in:Slim,Regular,Loose',
            'care_instructions'  => 'nullable|in:Machine Wash,Hand Wash Only,Dry Clean Only,Do Not Bleach,Tumble Dry Low,Line Dry,Iron at Low Temperature',
            'prod_description'   => 'nullable|string',
            'meta_title'         => 'nullable|string|max:255',
            'meta_keyword'       => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string|max:500',
            // 'status' => 'in:0,1', // Default to "Active"
        ]);

        // Save product
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
            'meta_title'        => $request->meta_title,
            'meta_keyword'      => $request->meta_keyword,
            'meta_description'  => $request->meta_description,
            // 'status'            => $request->status,
        ]);


        return redirect()->back()->with('success', 'Product added successfully.');
    }

}
