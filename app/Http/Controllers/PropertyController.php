<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\PropertyImage;
use App\Models\Rating;
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

        $properties = Property::where('user_id', $userId)
            ->withCount('ratings')
            ->withAvg('ratings', 'stars')
            ->latest()
            ->get();

        $total    = $properties->count();
        $active   = $properties->where('status', 'active')->count();
        $inactive = $properties->where('status', 'inactive')->count();
        $recent   = $properties->take(5);

        // Portfolio total value
        $portfolioValue = $properties->where('status', 'active')->sum('price');

        // Highest priced listing
        $highestListing = $properties->sortByDesc('price')->first();

        // Newest listing
        $newestListing = $properties->sortByDesc('created_at')->first();

        // Cities covered
        $citiesCovered = $properties->pluck('city')->unique()->count();

        // City-wise breakdown
        $cityBreakdown = $properties->groupBy('city')->map(function ($group) {
            return $group->count();
        })->sortByDesc(fn($count) => $count);

        // Unread notifications
        $unreadNotifications = Notification::where('user_id', $userId)
                                ->where('is_read', false)->count();

        // Pending booking requests
        $pendingBookings = Booking::whereHas('property', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('status', 'pending')->count();

        return view('dashboard', compact(
            'properties', 'total', 'active', 'inactive',
            'recent', 'portfolioValue', 'highestListing',
            'newestListing', 'citiesCovered', 'cityBreakdown',
            'unreadNotifications', 'pendingBookings'
        ));
    }

    // My Listings page
    public function myListings()
    {
        $userId = Auth::id();
        $properties = Property::where('user_id', $userId)
            ->withCount('ratings')
            ->withAvg('ratings', 'stars')
            ->latest()
            ->get();
        $unreadNotifications = Notification::where('user_id', $userId)
                                ->where('is_read', false)->count();
        $pendingBookings = Booking::whereHas('property', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('status', 'pending')->count();

        return view('My listings', compact('properties', 'unreadNotifications', 'pendingBookings'));
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
        'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'map_link' => 'nullable|url|max:500',
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
        'map_link' => $request->map_link,
    ]);

    // ===== NAYA CODE: Multiple images save karna =====
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('properties', 'public');
            $property->images()->create([
                'image_path' => $path,
            ]);
        }
    }
    // ===================================================

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
    public function edit(int $id)
    {
        $userId = Auth::id();
        $property = Property::where('user_id', $userId)->findOrFail($id);
        $unreadNotifications = Notification::where('user_id', $userId)
                                ->where('is_read', false)->count();
        $pendingBookings = Booking::whereHas('property', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('status', 'pending')->count();

        return view('edit-property', compact('property', 'unreadNotifications', 'pendingBookings'));
    }

    // Update property
    public function update(Request $request, $id)
{
    $userId = Auth::id();
    $property = Property::where('user_id', $userId)->findOrFail($id);

    $request->validate([
        'title'            => 'required|string|max:255',
        'type'             => 'required|in:house,apartment,room,shop,office',
        'price'            => 'required|numeric|min:1',
        'city'             => 'required|string|max:100',
        'location'         => 'required|string|max:255',
        'address'          => 'required|string',
        'description'      => 'required|string',
        'bedrooms'         => 'nullable|integer|min:0',
        'bathrooms'        => 'nullable|integer|min:0',
        'area_sqft'        => 'nullable|integer|min:0',
        'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'images.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status'           => 'required|in:active,inactive',
        'delete_images'    => 'nullable|array',
        'delete_images.*'  => 'exists:property_images,id',
        'map_link' => 'nullable|url|max:500',
    ]);

    // Cover image update
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
        'map_link' => $request->map_link,
    ]);

    // ===== Purani additional images delete karna (agar user ne select ki hon) =====
    if ($request->filled('delete_images')) {
        $imagesToDelete = PropertyImage::where('property_id', $property->id)
            ->whereIn('id', $request->delete_images)
            ->get();

        foreach ($imagesToDelete as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }
    }

    // ===== Nayi additional images add karna =====
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('properties', 'public');
            $property->images()->create([
                'image_path' => $path,
            ]);
        }
    }

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

        Notification::create([
            'user_id' => $userId,
            'title'   => 'Property Deleted',
            'message' => '"' . $title . '" has been permanently removed.',
            'type'    => 'danger',
            'icon'    => 'fa-trash',
        ]);

        return redirect()->route('my.listings')->with('success', 'Property deleted successfully!');
    }

   public function show(Property $property)
{
    // 1. Eager loading aur Aggregates ko ek sath chain karein
    $property->load([
        'images', 
        'user', 
        'ratings.user'
    ])
    ->loadCount('ratings')
    ->loadAvg('ratings', 'stars');

    // 2. Auth check ko compact/clean tariqe se handle karein
    $userRating = Auth::check() 
        ? Rating::where('user_id', Auth::id())
                ->where('property_id', $property->id)
                ->first()
        : null;

    return view('show', compact('property', 'userRating'));
}

    // ===== NAYA CODE: Rating store/update karna =====
    public function storeRating(Request $request, Property $property)
    {
        $request->validate([
            'stars'   => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Rating::updateOrCreate(
            [
                'user_id'     => Auth::id(),
                'property_id' => $property->id,
            ],
            [
                'stars'   => $request->stars,
                'comment' => $request->comment,
            ]
        );

        // Property owner ko notification (khud ko rate karne par notification na bheje)
        if ($property->user_id !== Auth::id()) {
            Notification::create([
                'user_id' => $property->user_id,
                'title'   => 'New Rating Received',
                'message' => '"' . $property->title . '" received a ' . $request->stars . '-star rating.',
                'type'    => 'info',
                'icon'    => 'fa-star',
            ]);
        }

        return back()->with('success', 'Thanks for your feedback!');
    }
    // ===================================================

}