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
        //Validate the request
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        try {
            $user = new User();
            $user->name = $formFields['name'];
            $user->email = $formFields['email'];
            $user->password = Hash::make($formFields['password']);
            $user->save();

            $message = 'User register successfully';
        } catch (\Illuminate\Database\QueryException $ex) {
            $message = $ex->getMessage();
        }

        // Login
        auth()->login($user);

        //return redirect('/csv')->with('message', 'User created and logged in');
        return view('csv');
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
