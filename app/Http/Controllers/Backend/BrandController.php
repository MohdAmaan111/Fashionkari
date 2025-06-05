<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all(); // fetch all categories
        return view('backend.brands', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        Brand::create($request->all());

        return redirect()->back()->with('success', 'Category added successfully!');
    }
}
