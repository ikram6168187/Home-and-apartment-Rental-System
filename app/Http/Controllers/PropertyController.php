<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // Add property form
    public function create()
    {
        return view('add-property');
    }

    // Dashboard
    public function dashboard()
    {
        $userId = Auth::id();
        
        // Sab data direct query se extract kiya taake collection memory warning na aaye
        $properties = Property::where('user_id', $userId)->latest()->get();
        $total      = $properties->count();
        $active     = Property::where('user_id', $userId)->where('status', 'active')->count(); // Fixed warning/optimized
        $recent     = $properties->take(5);
        $unreadNotifications = Notification::where('user_id', $userId)->where('is_read', false)->count();

        return view('dashboard', compact('properties', 'total', 'active', 'recent', 'unreadNotifications'));
    }

    // My Listings page
    public function myListings()
    {
        $userId = Auth::id();
        $properties = Property::where('user_id', $userId)->latest()->get();
        $unreadNotifications = Notification::where('user_id', $userId)->where('is_read', false)->count();
        
        return view('My listings', compact('properties', 'unreadNotifications'));
    }

    // Store property
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:house,apartment,room,shop,office',
            'price'       => 'required|numeric|min:1',
            'city'        => 'required|string|max:100',
            'location'    => 'required|string|max:255',
            'address'     => 'required|string',
            'description' => 'required|string',
            'bedrooms'    => 'nullable|integer|min:0',
            'bathrooms'   => 'nullable|integer|min:0',
            'area_sqft'   => 'nullable|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        $property = Property::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'type'        => $request->type,
            'price'       => $request->price,
            'city'        => $request->city,
            'location'    => $request->location,
            'address'     => $request->address,
            'description' => $request->description,
            'bedrooms'    => $request->bedrooms ?? 0,
            'bathrooms'   => $request->bathrooms ?? 0,
            'area_sqft'   => $request->area_sqft,
            'image'       => $imagePath,
            'status'      => 'active',
        ]);

        // Notification create karo
        Notification::create([
            'user_id' => Auth::id(),
            'title'   => 'Property Listed Successfully',
            'message' => '"' . $property->title . '" is now live on Smart Rent.',
            'type'    => 'success',
            'icon'    => 'fa-circle-check',
        ]);

        return redirect()->route('dashboard')->with('success', 'Property listed successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $userId = Auth::id();
        // findOrFail warning bypass karne ke liye generic constraint direct check kiya
        $property = Property::where('user_id', $userId)->findOrFail($id); 
        $unreadNotifications = Notification::where('user_id', $userId)->where('is_read', false)->count();
        
        return view('edit-property', compact('property', 'unreadNotifications'));
    }

    // Update property
    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $property = Property::where('user_id', $userId)->findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:house,apartment,room,shop,office',
            'price'       => 'required|numeric|min:1',
            'city'        => 'required|string|max:100',
            'location'    => 'required|string|max:255',
            'address'     => 'required|string',
            'description' => 'required|string',
            'bedrooms'    => 'nullable|integer|min:0',
            'bathrooms'   => 'nullable|integer|min:0',
            'area_sqft'   => 'nullable|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $imagePath = $property->image;
        if ($request->hasFile('image')) {
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        $property->update([
            'title'       => $request->title,
            'type'        => $request->type,
            'price'       => $request->price,
            'city'        => $request->city,
            'location'    => $request->location,
            'address'     => $request->address,
            'description' => $request->description,
            'bedrooms'    => $request->bedrooms ?? 0,
            'bathrooms'   => $request->bathrooms ?? 0,
            'area_sqft'   => $request->area_sqft,
            'image'       => $imagePath,
            'status'      => $request->status,
        ]);

        // Notification
        Notification::create([
            'user_id' => $userId,
            'title'   => 'Property Updated',
            'message' => '"' . $property->title . '" has been updated successfully.',
            'type'    => 'info',
            'icon'    => 'fa-pen-to-square',
        ]);

        return redirect()->route('dashboard')->with('success', 'Property updated successfully!');
    }

    // Toggle active/inactive
    public function toggle($id)
    {
        $userId = Auth::id();
        $property = Property::where('user_id', $userId)->findOrFail($id);
        
        $newStatus = $property->status === 'active' ? 'inactive' : 'active';
        $property->update(['status' => $newStatus]);

        // Notification
        Notification::create([
            'user_id' => $userId,
            'title'   => 'Listing Status Changed',
            'message' => '"' . $property->title . '" is now ' . $newStatus . '.',
            'type'    => $newStatus === 'active' ? 'success' : 'warning',
            'icon'    => $newStatus === 'active' ? 'fa-toggle-on' : 'fa-toggle-off',
        ]);

        return redirect()->route('my.listings')->with('success', 'Property status updated successfully!');
    }

    // Delete property
    public function destroy($id)
    {
        $userId = Auth::id();
        $property = Property::where('user_id', $userId)->findOrFail($id);
        $title = $property->title;

        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }
        $property->delete();

        // Notification
        Notification::create([
            'user_id' => $userId,
            'title'   => 'Property Deleted',
            'message' => '"' . $title . '" has been permanently removed.',
            'type'    => 'danger',
            'icon'    => 'fa-trash',
        ]);

        return redirect()->route('my.listings')->with('success', 'Property deleted successfully!');
    }
}