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
        $products = Product::join('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->select('products.*', 'categories.cat_name')
            ->get();   // Get all products
        $categories = Category::all();   // Get all categories
        return view('index', compact('products', 'categories'));
    }
}
