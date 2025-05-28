<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        //
    }
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:3|confirmed',
        ]);

        Customer::create([
            'cus_name' => $request->customer_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Account created successfully!']);
    }
}
