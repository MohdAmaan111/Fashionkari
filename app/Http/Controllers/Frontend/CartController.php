<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CartItem;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        //
    }

    public function addcart(Request $request)
    {
        // dd($request->all());

        // Ensure user is logged in
        if (!Auth::guard('customer')->check()) {
            // dd("Customer not logged in");
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to continue.'
            ], 401); // 401 = Unauthorized
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart!'
        ]);
    }

    public function addcarttt(Request $request)
    {
        // dd($request->all());

        // Ensure user is logged in
        // if (!Auth::guard('customer')->check()) {
        //     // dd("Customer not logged in");
        //     return redirect()->route('customer.login')->with('error', 'Please login to add products to your cart.');
        // }

        // Get customer ID
        $customerId = Auth::guard('customer')->id();

        // Get data from request
        $variantId = $request->input('selected_variant_id');
        $quantityRequested = (int) $request->input('quantity');

        // Fetch variant from DB
        $variant = ProductVariant::find($variantId);

        if (!$variant) {
            return back()->with('error', 'Selected product variant not found.');
        }

        if ($quantityRequested > $variant->stock) {
            return back()->with('error', 'Only ' . $variant->stock . ' item(s) left in stock.');
        }

        // Check if item already in cart
        $existingCart = CartItem::where('customer_id', $customerId)
            ->where('variant_id', $variantId)
            ->first();

        // if ($existingCart) {
        //     // Already in cart 
        //     return back()->with('error', 'This product is already in your cart. You can update the quantity from your cart.');
        // } else {
        //     // Create new cart item
        //     CartItem::create([
        //         'customer_id' => $customerId,
        //         'product_id' => $variant->product_id,
        //         'variant_id' => $variantId,
        //         'quantity' => $quantityRequested
        //     ]);
        // }
        return back()->with('success', 'Product added to cart!');
    }
}
