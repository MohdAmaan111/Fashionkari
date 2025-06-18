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
            // Validate input
            $request->validate([
                'login' => 'required|string', // could be username or email
                'password' => 'required|string',
            ]);

            // Attempt to find user by username OR email
            $user = User::where('username', $request->login)
                ->orWhere('email', $request->login)
                ->first();

            if (!$user) {
                // If no user found, show only login error
                return back()->withErrors([
                    'login' => 'Invalid username or email.',
                ])->withInput();
            }

            // Check credentials
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::loginUsingId($user->id);

                $request->session()->regenerate();

                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            } else {
                // Display if password is correct
                return back()->withErrors([
                    'password' => 'Invalid password.',
                ])->withInput();
            }

            // If login fails
            // return back()->withErrors([
            //     'login' => 'Invalid username or email.',
            //     'password' => 'Invalid password.',
            // ])->withInput();
        }

        // Redirect to dashboard if already logged in
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
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:users,username',
                    'regex:/^[a-zA-Z0-9_]+$/'
                ],
                'email' => 'required|email|unique:users,email',
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
