<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalUsers      = User::where('role', 'user')->count();
        $totalProperties = Property::count();
        $totalBookings   = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $unreadMessages  = ContactMessage::where('is_read', false)->count();

        $cityBreakdown = Property::selectRaw('city, count(*) as total')
                            ->groupBy('city')
                            ->orderByDesc('total')
                            ->get();

        $recentUsers = User::where('role', 'user')
                            ->withCount('properties')
                            ->latest()->take(5)->get();

        $recentBookings = Booking::with(['property', 'user'])
                            ->latest()->take(5)->get();

        $recentActivity = Notification::with('user')
                            ->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalProperties', 'totalBookings',
            'pendingBookings', 'unreadMessages', 'cityBreakdown',
            'recentUsers', 'recentBookings', 'recentActivity'
        ));
    }

    // Users list
    public function users()
    {
       $users = User::withCount('properties')
                 ->latest()->get();

        return view('admin.users', compact('users'));
    }

    // Delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        foreach ($user->properties as $property) {
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }
            $property->delete();
        }

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('admin.users')
                         ->with('success', 'User deleted successfully!');
    }

    // Properties list
    public function properties()
    {
        $properties = Property::with('user')->latest()->get();
        return view('admin.properties', compact('properties'));
    }

    // Toggle property status
    public function toggleProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->update([
            'status' => $property->status == 'active' ? 'inactive' : 'active'
        ]);

        return redirect()->route('admin.properties')
                         ->with('success', 'Property status updated!');
    }

    // Delete property
    public function deleteProperty($id)
    {
        $property = Property::findOrFail($id);

        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }
        $property->delete();

        return redirect()->route('admin.properties')
                         ->with('success', 'Property deleted successfully!');
    }

    // Bookings list
    public function bookings()
    {
        $bookings  = Booking::with(['property', 'user'])->latest()->get();
        $pending   = $bookings->where('status', 'pending')->count();
        $confirmed = $bookings->where('status', 'confirmed')->count();
        $cancelled = $bookings->where('status', 'cancelled')->count();

        return view('admin.bookings', compact('bookings', 'pending', 'confirmed', 'cancelled'));
    }

    // Messages list
    public function messages()
    {
        // Sab messages read mark karo
        ContactMessage::where('is_read', false)->update(['is_read' => true]);

        $messages = ContactMessage::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    // Delete message
    public function deleteMessage($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect()->route('admin.messages')
                         ->with('success', 'Message deleted!');
    }
}