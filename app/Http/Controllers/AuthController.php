<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Retrieve the authenticated user
            $user = Auth::user();
    
            // Redirect based on role
            switch ($user->role) {
                case 'Administrator':
                    return redirect()->intended('/admin/dashboard');
                case 'Developer':
                    return redirect()->intended('/developer/dashboard');
                case 'User':
                    return redirect()->intended('/user/dashboard');
                default:
                    return redirect()->intended('/dashboard'); // fallback to a general dashboard
            }
        }
    
        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
    

    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended('/dashboard'); // Redirect to dashboard after registration
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login'); // Redirect to login page
    }
}
