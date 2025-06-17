<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // dd('Redirect from custom Authenticate middleware'); // Just for testing
            
            return route('admin.login'); // 👈 Redirect to your admin login route
        }
        return null;
    }
}
