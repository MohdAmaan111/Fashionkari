<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $customerId = Auth::guard('customer')->id();

            $cartItems = [];
            $itemCount = 0;
            $subtotal = 0;

            if ($customerId) {
                $cartItems = CartItem::with('variant')
                    ->where('customer_id', $customerId)
                    ->get();

                $itemCount = $cartItems->count();

                foreach ($cartItems as $item) {
                    $subtotal += $item->variant->selling_price * $item->quantity;
                }
            }

            $categories = Category::all();

            $view->with('cartItemCount', $itemCount)
                ->with('cartSubtotal', $subtotal)
                ->with('globalCategories', $categories);
        });
    }
}
