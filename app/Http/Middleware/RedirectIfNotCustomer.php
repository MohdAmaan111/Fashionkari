<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotCustomer
{
    public function handle(Request $request, Closure $next)
    {
        dd('CUSTOMER MIDDLEWARE HIT');

        // Assuming 'customer' is your auth guard
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.account'); // 👈 your frontend login route
        }

        return $next($request);
    }
}
