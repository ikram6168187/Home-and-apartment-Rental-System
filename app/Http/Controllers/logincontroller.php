<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show Login Page
    public function showLogin()
    {
        return view('login');
    }

    // Handle Login
    public function login(Request $request)
    {
        // 1. Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        // 2. Attempt Login
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Agar admin hai toh admin dashboard par bhej do
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // CHANGER: Normal user ko ab seedha landing page / home page par bhejega (jo / hai)
            return redirect()->route('home');
        }

        // Agar details galat hain
        return redirect()->route('home')
    ->with('show_login', true)
    ->withErrors(['email' => 'Email or password is incorrect.'])
    ->withInput($request->only('email'));
    }

    // HANDLE LOGOUT (Yeh naya function humne add kiya hai)
    public function logout(Request $request)
    {
        
        Auth::logout();

        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        return redirect()->route('home');
    }
}