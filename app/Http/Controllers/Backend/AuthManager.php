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
        // Redirect authenticated users
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        if ($request->isMethod('post')) {
            //Validation
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[a-zA-Z\s]+$/'
                ],
                'email' => 'required|email|unique:users,email',
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|min:3|confirmed',
            ]);

            // Create new user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Auto-login
            Auth::login($user);

            // AJAX or normal redirect
            if ($request->ajax()) {
                return response()->json(['message' => 'Registered successful'], 200);
            }
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
