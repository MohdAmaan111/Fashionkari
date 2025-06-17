<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('my-account', compact('categories'));
    }

    public function profile()
    {
        $categories = Category::all();

        return view('profile', compact('categories'));
    }

    public function wishlist()
    {
        // $wishlist = Wishlist::with('product')->where('user_id', auth()->id())->get();
        // return view('customer.partials.wishlist', compact('wishlist'));
        return view('customer.partials.wishlist');
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('customer')->logout(); // Correct: logout the customer guard

        return redirect(route('index'))->with('success', 'Logged out successfully!');
    }
}
