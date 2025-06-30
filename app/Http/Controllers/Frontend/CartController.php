<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();

        $customerId = Auth::guard('customer')->id();

        // Ensure user is logged in
        // if (!Auth::guard('customer')->check()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Please login to continue.'
        //     ], 401); // 401 = Unauthorized
        // }

        // Eager load variant and its related product
        $cartItems = CartItem::with(['variant.product'])
            ->where('customer_id', $customerId)
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->variant->selling_price;
        });

        $taxPercent = 10; // Tax 10%

        // Free delivery over given price
        $freeShipping = 2000;

        // Custom delivery charges
        $standardCharge = 100;
        $expressCharge = 500;

        $products = Product::with(['category', 'variants'])->get();  // Get all products

        return view('cart', compact(
            'cartItems',
            'subtotal',
            'freeShipping',
            'standardCharge',
            'expressCharge',
            'taxPercent',
            'products',
            'customer',
        ));
    }

    public function checkout(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $cartItems = CartItem::where('customer_id', $customer->cus_id)->get();

        if ($cartItems->isEmpty()) {
            // return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $orderNumber = 'ORD' . strtoupper(Str::random(8)); // e.g., ORD67J5WF2

        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'email'    => [
                'required',
                'regex:/^[a-zA-Z0-9.]+@gmail\.com$/'
            ],
            'phone' => 'required|digits_between:10,15',
            'pincode' => 'required|numeric',
            'state' => 'required|string',
            'city' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'area' => ['nullable', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'address_line' => 'required|string',
            'payment_method' => 'required|string',
            // 'shipping_method' => 'required|string',
            // 'total_amount' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422); // 422 = Unprocessable Entity
        }

        $customer_area = '';
        if ($request->filled('area')) {
            $customer_area = $request->area;
        }

        // Save the order...
        $order = Order::create([
            'customer_id' => $customer->cus_id,
            'order_number' => $orderNumber,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'order_status' => 'pending',

            // Address fields
            'name' => $request->full_name,
            'phone' => $request->phone,
            'pincode' => $request->pincode,
            'state' => $request->state,
            'city' => $request->city,
            'area' => $customer_area,
            'address_line' => $request->address_line,
        ]);

        $req_area = $request->area;
        $area_check = $request->filled('area');

        return response()->json([
            'status' => 'success',
            'message' => 'Your order has been placed!',
            'order_number' => $orderNumber,
            'customer_id' => $customer->cus_id,
            'customer' => $customer,
            'req_area' => $req_area,
            'area_check' => $area_check,
            'form_data' => $request->all()
        ]);
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

        // Get customer ID
        $customerId = Auth::guard('customer')->id();

        // Get data from request
        $variantId = $request->input('selected_variant_id');
        $quantityRequested = (int) $request->input('quantity');

        // Fetch variant from DB
        $variant = ProductVariant::find($variantId);

        if (!$variant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Selected product variant not found.'
            ], 404); // Not found
        }

        $request->validate([
            'quantity' => ['required', 'integer', function ($attribute, $value, $fail) use ($variant) {
                if ($value > $variant->stock) {
                    $fail("Only {$variant->stock} item(s) left in stock.");
                }
            }]
        ]);

        $existingCart = CartItem::where('customer_id', $customerId)
            ->where('variant_id', $variantId)
            ->first();

        if ($existingCart) {
            // Already in cart 
            return response()->json([
                'status' => 'error',
                'field' => 'cart',
                'message' => 'This product is already in your cart. You can update the quantity from your cart.'
            ], 409); // 409 Conflict is perfect for "already exists"
        } else {
            // Create new cart item
            CartItem::create([
                'customer_id' => $customerId,
                'product_id' => $variant->product_id,
                'variant_id' => $variantId,
                'quantity' => $quantityRequested
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart!'
        ]);
    }

    public function update(Request $request)
    {
        // Log the whole request data to Laravel log file
        // \Log::info('Cart Update Request', $request->all());

        $customerId = Auth::guard('customer')->id();

        if (!$customerId) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to update the cart.',
            ], 401);
        }

        $quantities = $request->input('quantities'); // key = cart_id, value = quantity

        if (empty($quantities)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your cart is empty. Please add items to update.',
            ], 422); // Use 422 Unprocessable Entity for user input error
        }

        $updated = false;

        $errors = [];

        foreach ($quantities as $cartId => $qty) {
            $cartItem = CartItem::find($cartId);

            // Get stock from related variant
            $stock = $cartItem->variant->stock ?? 0;
            // \Log::info('Cart Item stock', ['stock' => $stock]);
            // \Log::info('Customer Item quantity', ['quantity' => $qty]);

            // Prevent setting quantity greater than stock
            if ($qty > $stock) {
                $errors[$cartId] = "Only $stock item(s) available in stock.";
            }

            if ($cartItem) {
                $newQty = max(1, (int)$qty); // Avoid 0 or negative

                if ($cartItem->quantity !== $newQty) {
                    $cartItem->quantity = $newQty;
                    $cartItem->save();
                    $updated = true;
                }
            }
        }

        // If there are errors, return them
        if (!empty($errors)) {
            return response()->json([
                'status' => 'error',
                'messages' => $errors, // send all errors
            ], 409);
        }

        // When Quantity Is Same - Nothing will be updated
        return response()->json([
            'status' => 'success',
            'message' => $updated ? 'Cart updated successfully!' : 'No changes detected.'
        ]);
    }

    public function remove($cartId)
    {
        $cartItem = CartItem::findOrFail($cartId);
        $cartItem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully.'
        ]);
    }

    public function clear(Request $request)
    {
        $customerId = Auth::guard('customer')->id();

        if (!$customerId) {
            return response()->json([
                'status' => 'error',
                'message' => 'You must be logged in to clear the cart.',
            ], 401);
        }

        $cartItems = CartItem::where('customer_id', $customerId);

        if (!$cartItems->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your cart is already empty.',
            ], 422);
        }

        $cartItems->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart cleared successfully.',
        ]);
    }
}
