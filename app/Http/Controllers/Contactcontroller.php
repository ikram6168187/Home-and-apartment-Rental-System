<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'subject'    => 'required|string',
            'message'    => 'required|string|min:10',
        ]);

        // Database mein save karo
        ContactMessage::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
        ]);

        return redirect()->route('contact')
            ->with('contact_success', true);
    }
}

