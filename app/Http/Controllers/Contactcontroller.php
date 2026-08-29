<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to send a message.');
        }

        $user = Auth::user();

        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        $firstName = $user->first_name ?? $user->name;
        $lastName  = $user->last_name ?? '';
        $email     = $user->email;

        // 1. Database mein save karo
        ContactMessage::create([
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'email'      => $email,
            'subject'    => $request->subject,
            'message'    => $request->message,
        ]);

        // 2. Admin (Apni Gmail) par email bhejo
        try {
            $adminEmail = config('mail.from.address');

            $emailBody = "New Message Received from Registered User:\n\n"
                       . "Name: {$firstName} {$lastName}\n"
                       . "User Email: {$email}\n"
                       . "Subject: {$request->subject}\n\n"
                       . "Message:\n{$request->message}";

            Mail::raw($emailBody, function ($mail) use ($adminEmail, $request, $email) {
                $mail->to($adminEmail)
                     ->replyTo($email)
                     ->subject('New Contact Message: ' . $request->subject);
            });
        } catch (\Exception $e) {
            // Email Na bhi jaye tab bhi DB mein record save rahega
        }

        return redirect()->route('contact')
            ->with('contact_success', true);
    }
}