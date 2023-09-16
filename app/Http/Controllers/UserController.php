<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Show Welcome Screen
     */
    public function showwelcome()
    {
        return view('welcome');
    }
    /**
     * Show Registration Page
     */
    public function showregister()
    {
        return view('register');
    }
    /**
     * See the CSV Page
     */
    public function showcsv()
    {
        return view('csv');
    }
    /**
     * Create new user
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|min:3',
            'password' => 'required|min:6' //confirmed caused a bug
        ]);
        //dd($formFields);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/csv')->with('message', 'User created and logged in');
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/csv')->with('message', 'You are now logged in!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }
}
