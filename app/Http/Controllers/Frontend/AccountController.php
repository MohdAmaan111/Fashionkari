<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Order;

use Illuminate\Support\Facades\Hash;
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
        $customer = Auth::guard('customer')->user();

        // Check if the customer is not authenticated
        if (!Auth::guard('customer')->check()) {
            // Customer is NOT logged in
            return redirect()->route('customer.account');
        }

        // dd($customer);
        $customerId = Auth::guard('customer')->id();

        $ordersCount = 0;
        $orders = Order::with('items.product')
            ->where('customer_id', $customerId)
            ->latest()
            ->get();

        // dd($orders);

        // $wishlistCount = 0;
        $wishlistCount = Wishlist::where('customer_id', $customerId)->count();

        return view('profile', compact('customer', 'wishlistCount', 'ordersCount', 'orders'));
    }

    public function orders()
    {
        // $wishlist = Wishlist::with('product')->where('user_id', auth()->id())->get();
        // return view('customer.partials.wishlist', compact('wishlist'));
        return view('customer.partials.orders');
    }

    public function wishlist()
    {
        $customerId = Auth::guard('customer')->id();

        // Check if the customer is not authenticated
        if (!Auth::guard('customer')->check()) {
            // Customer is NOT logged in
            return redirect()->route('customer.account');
        }

        $wishlists = Wishlist::where('customer_id', $customerId)
            ->with(['product', 'variant']) // eager load product + variant
            ->get();
        // dd($wishlists);
        return view('customer.partials.wishlist', compact('wishlists'));
    }

    public function payment()
    {
        // $wishlist = Wishlist::with('product')->where('user_id', auth()->id())->get();
        // return view('customer.partials.wishlist', compact('wishlist'));
        return view('customer.partials.payment');
    }

    public function address()
    {
        $customer = Auth::guard('customer')->user();

        // Check if the customer is not authenticated
        if (!Auth::guard('customer')->check()) {
            // Customer is NOT logged in
            return redirect()->route('customer.account');
        }

        return view('customer.partials.address', compact('customer'));
    }

    public function setting()
    {
        $customer = Auth::guard('customer')->user();

        // Check if the customer is not authenticated
        if (!Auth::guard('customer')->check()) {
            // Customer is NOT logged in
            return redirect()->route('customer.account');
        }

        return view('customer.partials.setting', compact('customer'));
    }

    public function updatePersonalInfo(Request $request)
    {
        $emailUniqueRule = 'unique:customers,email,' . Auth::guard('customer')->id() . ',cus_id';

        $request->validate([
            'fullname' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'email'    => [
                'required',
                'regex:/^[a-zA-Z0-9.]+@gmail\.com$/',
                $emailUniqueRule
            ],
            'phone' => ['nullable', 'regex:/^\d{6,20}$/'],
        ]);

        $customer = Auth::guard('customer')->user();

        $customer->update([
            'cus_name' => $request->fullname,
            'email'    => $request->email,
            'phone'    => $request->phone,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Personal information updated successfully!'
        ]);
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address'     => 'required|string|max:255',
            'city'        => 'required|regex:/^[a-zA-Z\s]+$/|max:100',
            'state'       => 'required|regex:/^[a-zA-Z\s]+$/|max:100',
            'country'     => 'required|regex:/^[a-zA-Z\s]+$/|max:100',
            'postal_code' => 'required|regex:/^\d{4,10}$/',
        ]);

        $customer = Auth::guard('customer')->user();

        $customer->update([
            'address'     => $request->address,
            'city'        => $request->city,
            'state'       => $request->state,
            'country'     => $request->country,
            'postal_code' => $request->postal_code,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Address updated successfully!'
        ]);
    }

    public function updateSecurity(Request $request)
    {
        $request->validate([
            'current_password'     => 'required',
            'new_password'         => 'required|min:3|confirmed',
        ]);

        $customer = Auth::guard('customer')->user();

        if (!Hash::check($request->current_password, $customer->password)) {
            return response()->json([
                'status' => 'error',
                'errors' => ['current_password' => ['The current password is incorrect.']]
            ], 422);
        }

        $customer->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully!',
        ]);
    }

    public function deleteAccount(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if ($customer) {
            Auth::guard('customer')->logout(); // logout before deleting

            $customer->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Your account has been deleted successfully.',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No customer account found.',
        ], 404);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout(); // ✅ logs out the authenticated customer

        $request->session()->invalidate();      // ✅ clears session data securely
        $request->session()->regenerateToken(); // ✅ prevents CSRF token reuse

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully.',
        ]);
    }
}
