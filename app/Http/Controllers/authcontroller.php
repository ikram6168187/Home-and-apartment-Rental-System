<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required'
        ], [
            'password.confirmed' => 'Passwords do not match!',
            'terms.required'     => 'You must accept Terms & Conditions'
        ]);

        // Validation fail — signup modal wapas kholo
        if ($validator->fails()) {
            return redirect()->route('home')
                ->with('show_signup', true)
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user'
        ]);

        Auth::login($user);

       return redirect()->route('home')
    ->with('show_login', true)
    ->with('success', 'Account created successfully! Please login to continue.');
    }
}