<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index()
    {
        // $products = Product::join('categories', 'products.cat_id', '=', 'categories.cat_id')
        //     ->select('products.*', 'categories.cat_name')
        //     ->get();   // Get all products
        $categories = Category::all();   // Get all categories

        $products = Product::with(['category', 'variants'])->get();

        return view('index', compact('products', 'categories'));
    }

    public function singleProduct($id)
    {

        $product = Product::join('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->where('products.prod_id', $id)
            ->select('products.*', 'categories.cat_name')
            ->firstOrFail();

        $categories = Category::all();   // Get all categories


        // Fetch similar products (same category, exclude current), with category name
        $similarProducts = Product::join('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->where('products.cat_id', $product->cat_id)  //Filters products that belong to the same category as the current product
            ->where('products.prod_id', '!=', $product->prod_id)  //Excludes the current product from the results (you don’t want the current product to show up as a similar one)
            ->select('products.*', 'categories.cat_name')  //Selects all product fields plus the category name from the categories table.
            ->limit(6)
            ->get();

        // dd($similarProducts->all());

        return view('single-product', compact('product', 'categories', 'similarProducts'));
    }
}
