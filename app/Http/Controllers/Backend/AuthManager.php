<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class AuthManager extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.user', compact('users'));
    }
    // Login
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            // Find user by email or username
            $user = User::where('username', $request->username)
                ->orWhere('email', $request->username)
                ->first();

            // Check if user exists and password matches
            if ($user && Hash::check($request->password, $user->password)) {
                // Log in user by ID
                Auth::loginUsingId($user->id);
                $request->session()->regenerate();
                $sessionId = $request->session()->getId();
                // Log login time
                // Userlog::create([
                //     'user_id' => $user->id,
                //     'session_id' => $sessionId,
                //     'login_time' => now(),
                // ]);

                return redirect()->route('admin.dashboard')->with('success', 'Login successfully');
            }

            return back()->with('login_error', 'Invalid email or password')->onlyInput('email');
        }
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.login');
    }

    //Register
    public function register(Request $request)
    {

        if ($request->isMethod('post')) {
            //Validation
            // $validatedData = $request->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|email|unique:users,email',
            //     'mobile' => 'required|string|unique:users,mobile',
            //     'username' => 'required|string|unique:users,username',
            //     'password' => 'required|min:6|confirmed',
            // ]);

            // Check if email or username already exists

            // $exists = User::where('email', $request->email)
            //     ->orWhere('username', $request->username)->exists();

            $errors = [];

            if (User::where('email', $request->email)->exists()) {
                $errors[] = 'Email already exists.';
            }

            if (User::where('username', $request->username)->exists()) {
                $errors[] = 'Username already exists.';
            }

            if (!empty($errors)) {
                return redirect()->route('admin.register')->with('error', implode(' ', $errors));
            }

            // Create User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'username' => $request->username,
                'password' => Hash::make($request->password)
            ]);

            // Log in the user
            Auth::login($user);
            return redirect()->route('admin.dashboard')->with('success', 'Registration successful');
        }

        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.register');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('admin.login'));
    }
}
