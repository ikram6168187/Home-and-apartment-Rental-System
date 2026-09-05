<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\User; 
use App\Models\notification;
class UserController extends Controller
{
    // Profile page
    public function profile()
    {
        $totalListings  = Property::where('user_id', Auth::id())->count();
        $activeListings = Property::where('user_id', Auth::id())->where('status', 'active')->count();
        $unreadNotifications = Notification::where('user_id', Auth::id())->where('is_read', false)->count(); 
        return view('profile', compact('totalListings', 'activeListings','unreadNotifications'));
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'whatsapp'=> 'nullable|string|max:20',
            'city'    => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
            'bio'     => 'nullable|string|max:300',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /** @var \App\Models\User $user */ 
        $user = Auth::user();

        // Profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Purani pic delete karo
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $picPath = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $picPath;
        }

        $user->name     = $request->name;
        $user->phone    = $request->phone;
        $user->whatsapp = $request->whatsapp;
        $user->city     = $request->city;
        $user->address  = $request->address;
        $user->bio      = $request->bio;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    // Settings page
    public function settings()
{
    $unreadNotifications = Notification::where('user_id', Auth::id())->where('is_read', false)->count();
    
    $totalListings  = Property::where('user_id', Auth::id())->count();
    $activeListings = Property::where('user_id', Auth::id())->where('status', 'active')->count();
    
    $listingSummary = [
        'house'     => Property::where('user_id', Auth::id())->where('type', 'house')->count(),
        'apartment' => Property::where('user_id', Auth::id())->where('type', 'apartment')->count(),
        'room'      => Property::where('user_id', Auth::id())->where('type', 'room')->count(),
        'shop'      => Property::where('user_id', Auth::id())->where('type', 'shop')->count(),
        'office'    => Property::where('user_id', Auth::id())->where('type', 'office')->count(),
    ];

    return view('settings', compact('unreadNotifications', 'totalListings', 'activeListings', 'listingSummary'));
}

    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ], [
            'password.confirmed' => 'New passwords do not match.',
            'password.min'       => 'Password must be at least 6 characters.',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('settings')->with('success', 'Password changed successfully!');
    }

    // Delete account
    public function deleteAccount(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Profile picture delete
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Sari properties delete
        $properties = Property::where('user_id', $user->id)->get();
        foreach ($properties as $property) {
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }
            $property->delete();
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Account deleted successfully.');
    }
   

}