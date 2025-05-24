<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // fetch all categories
        return view('backend.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        Category::create($request->all());

        return redirect()->back()->with('success', 'Category added successfully!');
    }
}
