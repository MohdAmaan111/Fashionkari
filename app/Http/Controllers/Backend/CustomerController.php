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

    // Login
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            // Find user by email or username
            $cust = Customer::where('email', $request->username)
                ->first();

            // Check if user exists and password matches
            if ($cust && Hash::check($request->password, $cust->password)) {
                // Log in user by ID
                Auth::loginUsingId($cust->id);

                $request->session()->regenerate();

                $sessionId = $request->session()->getId();
                // Log login time
                // Userlog::create([
                //     'user_id' => $user->id,
                //     'session_id' => $sessionId,
                //     'login_time' => now(),
                // ]);

                return redirect()->route('index')->with('success', 'Login successfully');
            }

            return back()->with('login_error', 'Invalid email or password')->onlyInput('email');
        }
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('backend.login');
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

        Customer::create([
            'cus_name' => $request->customer_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // return redirect()->back()->with('success', 'Account created successfully!');
        return response()->json(['message' => 'Account created successfully!']);
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
