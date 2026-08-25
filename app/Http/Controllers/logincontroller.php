<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->route('home')
                ->with('show_login', true)
                ->withErrors(['email' => 'Email or password is incorrect.'])
                ->withInput($request->only('email'));
        }

        // Agar email verify nahi hui to OTP bhejo
        if (!$user->email_verified_at) {
            $otp = rand(100000, 999999);
            $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);
            Mail::to($user->email)->send(new OtpMail($otp, 'Verify your Smart Rent account'));
            session(['otp_email' => $user->email]);

            return redirect()->route('home')
                ->with('show_otp', true)
                ->with('success', 'Please verify your email. A new OTP has been sent.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    // ── FORGOT PASSWORD ──
    public function sendResetOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('home')
                ->with('show_forgot', true)
                ->withErrors(['email' => 'No account found with this email.']);
        }

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);
        Mail::to($user->email)->send(new OtpMail($otp, 'Reset your Smart Rent password'));

        session(['reset_email' => $user->email]);

        return redirect()->route('home')
            ->with('show_reset', true)
            ->with('success', 'OTP sent to your email. Enter it below to reset your password.');
    }

    public function resendResetOtp(Request $request)
    {
        $email = session('reset_email');
        $user  = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('home')->with('show_forgot', true);
        }

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);
        Mail::to($user->email)->send(new OtpMail($otp, 'Your new Smart Rent reset code'));

        return redirect()->route('home')
            ->with('show_reset', true)
            ->with('success', 'A new OTP has been sent to your email.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp'      => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session('reset_email');
        $user  = User::where('email', $email)->first();

        if (!$user || $user->otp != $request->otp || now()->gt($user->otp_expires_at)) {
            return redirect()->route('home')
                ->with('show_reset', true)
                ->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $user->update([
            'password'       => Hash::make($request->password),
            'otp'            => null,
            'otp_expires_at' => null,
        ]);

        session()->forget('reset_email');

        return redirect()->route('home')
            ->with('show_login', true)
            ->with('success', 'Password reset successfully! Please login with your new password.');
    }
}