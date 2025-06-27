<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('backend.customer', compact('customers'));
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string',
        ]);

        $cust = Customer::where('email', $request->email)->first();

        if (!Hash::check($request->password, $cust->password)) {
            return response()->json([
                'status' => 'error',
                'errors' => ['password' => ['The password is incorrect.']] 
            ], 422);
        } else {
            Auth::guard('customer')->loginUsingId($cust->cus_id); // use customer guard if you have separate one

            $request->session()->regenerate();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successfully!',
                ]);
            }
        }
    }

    public function registerCustomer(Request $request)
    {
        // dd($request->all());

        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email|exists:customers,email',
                'password' => 'required|string',
            ]);

            $cust = Customer::where('email', $request->email)->first();

            if ($cust && Hash::check($request->password, $cust->password)) {
                Auth::guard('customer')->loginUsingId($cust->cus_id); // use customer guard if you have separate one

                $request->session()->regenerate();

                return redirect()->route('index')->with('success', 'Login successfully!');
            } else {
                return back()->withErrors(['password' => 'Invalid password'])->withInput();
            }

            return back()->with('login_error', 'Invalid email or password')->onlyInput('email');
        }

        return view('my-account');
    }

    //Register
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

        $customer = Customer::create([
            'cus_name' => $request->customer_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('customer')->login($customer);

        return response()->json([
            'message' => 'Account created successfully!',
            'redirect' => route('index') // send redirect URL
        ]);
    }

    //Destroy
    public function destroy($id)
    {
        // dd($id);

        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
