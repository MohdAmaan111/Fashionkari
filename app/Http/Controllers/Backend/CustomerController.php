<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('backend.customer', compact('customers'));
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:3|confirmed',
        ]);

        Customer::create([
            'cus_name' => $request->customer_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Account created successfully!');
    }
}
