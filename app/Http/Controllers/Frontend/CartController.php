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
        $categories = Category::all();   // Get all categories

        $products = Product::with(['category', 'variants'])->get();

        $customerId = Auth::guard('customer')->id();

        // Eager load variant and its related product
        $cartItems = CartItem::with(['variant.product'])
            ->where('customer_id', $customerId)
            ->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->quantity * $item->variant->selling_price;
        }

        return view('cart', compact('cartItems', 'products', 'categories', 'subtotal'));
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

        $quantities = $request->input('quantities'); // key = cart_id, value = quantity

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
}
