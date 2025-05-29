<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get logged-in user
        return view('backend.dashboard', compact('user'));
    }
    public function profile()
    {
        return view('backend.profile');
    }
}
