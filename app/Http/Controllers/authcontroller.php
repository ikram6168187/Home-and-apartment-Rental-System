<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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

        if ($validator->fails()) {
            return redirect()->route('home')
                ->with('show_signup', true)
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $otp = rand(100000, 999999);

        $user = User::create([
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'password'       => Hash::make($validated['password']),
            'role'           => 'user',
            'otp'            => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp, 'Verify your Smart Rent account'));

        session(['otp_email' => $user->email]);

        return redirect()->route('home')
            ->with('show_otp', true)
            ->with('success', 'Account created! Please check your email for the verification code.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);

        $email = session('otp_email');
        $user  = User::where('email', $email)->first();

        if (!$user || $user->otp != $request->otp || now()->gt($user->otp_expires_at)) {
            return redirect()->route('home')
                ->with('show_otp', true)
                ->withErrors(['otp' => 'Invalid or expired OTP. Try again or resend.']);
        }

        $user->update([
            'email_verified_at' => now(),
            'otp'               => null,
            'otp_expires_at'    => null,
        ]);

        session()->forget('otp_email');
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Email verified successfully! Welcome to Smart Rent.');
    }

    public function resendOtp(Request $request)
    {
        $email = session('otp_email');
        $user  = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('home')->with('show_signup', true);
        }

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);

        Mail::to($user->email)->send(new OtpMail($otp, 'Your new Smart Rent verification code'));

        return redirect()->route('home')
            ->with('show_otp', true)
            ->with('success', 'A new OTP has been sent to your email.');
    }
}