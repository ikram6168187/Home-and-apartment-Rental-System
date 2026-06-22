<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Contact page show karo
    public function index()
    {
        return view('contact');
    }

    // Form submit handle karo
    public function send(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'subject'    => 'required|string',
            'message'    => 'required|string|min:10',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'email.required'      => 'Email address is required.',
            'subject.required'    => 'Please select a subject.',
            'message.required'    => 'Message is required.',
            'message.min'         => 'Message must be at least 10 characters.',
        ]);

        // Baad mein yahan database save ya email bhej sakte hain
        // Contact::create([...]);
        // Mail::to('admin@smartrent.pk')->send(new ContactMail($request->all()));

        return redirect()->route('contact')
            ->with('contact_success', true);
    }
}