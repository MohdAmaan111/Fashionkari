<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Foundation\MaintenanceModeManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Category;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Correct lazy binding without resolving the driver too early
        $this->app->singleton(MaintenanceMode::class, function ($app) {
            return new class($app) implements MaintenanceMode {
                protected $manager;

                public function __construct($app)
                {
                    $this->manager = new MaintenanceModeManager($app);
                }

                public function active(): bool
                {
                    return $this->manager->driver()->active();
                }

                public function data(): array
                {
                    return $this->manager->driver()->data();
                }

                public function activate(array $payload): void
                {
                    $this->manager->driver()->activate($payload);
                }

                public function deactivate(): void
                {
                    $this->manager->driver()->deactivate();
                }
            };
        });

        // ✅ Bind the missing files service
        $this->app->singleton('files', function () {
            return new Filesystem();
        });
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
