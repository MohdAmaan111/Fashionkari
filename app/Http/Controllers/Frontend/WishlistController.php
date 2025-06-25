<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Wishlist;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function index()
    {
        $customerId = Auth::guard('customer')->id();

        // Ensure user is logged in
        if (!Auth::guard('customer')->check()) {
            // dd("Customer not logged in");
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to continue.'
            ], 401); // 401 = Unauthorized
        }

        $wishlists = Wishlist::where('customer_id', $customerId)
            ->with(['product', 'variant']) // eager load product + variant
            ->get();

        return view('wishlist', compact('wishlists'));
    }

    public function addwishlist(Request $request)
    {
        $customerId = Auth::guard('customer')->id();

        // Ensure user is logged in
        if (!Auth::guard('customer')->check()) {
            // dd("Customer not logged in");
            return response()->json([
                'status' => 'error',
                'message' => 'Please login to continue.'
            ], 401); // 401 = Unauthorized
        }

        $exists = Wishlist::where('customer_id', $customerId)
            ->where('variant_id', $request->variant_id)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'customer_id' => $customerId,
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
            ]);
        }

        return response()->json(['message' => 'Product added to wishlist!']);
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

    public function remove(Request $request)
    {
        $customerId = Auth::guard('customer')->id();

        Wishlist::where('customer_id', $customerId)
            ->where('variant_id', $request->variant_id)
            ->delete();

        return response()->json(['message' => 'Removed from wishlist']);
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
