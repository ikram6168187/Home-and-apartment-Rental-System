<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Notification;
use App\Models\ContactMessage;
use App\Models\ServiceRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
{
    // Dashboard Counts
    $totalUsers      = User::where('role', 'user')->count();
    $totalProperties = Property::count();
    $totalBookings   = Booking::count();
    $pendingBookings = Booking::where('status', 'pending')->count();
    $unreadMessages  = ContactMessage::where('is_read', false)->count();

    // Service Requests Counts
    $totalServiceRequests   = ServiceRequest::count();
    $pendingServiceRequests = ServiceRequest::where('status', 'pending')->count();

    // Property City Breakdown
    $cityBreakdown = Property::selectRaw('city, count(*) as total')
        ->groupBy('city')
        ->orderByDesc('total')
        ->get();

    // Recent Users
    $recentUsers = User::where('role', 'user')
        ->withCount('properties')
        ->latest()
        ->take(5)
        ->get();

    // Recent Bookings
    $recentBookings = Booking::with(['property', 'user'])
        ->latest()
        ->take(5)
        ->get();

    // Recent Service Requests
    $recentServiceRequests = ServiceRequest::with(['user', 'property'])
        ->latest()
        ->take(5)
        ->get();

    // Recent Activity
    $recentActivity = Notification::with('user')
        ->latest()
        ->take(6)
        ->get();

    return view('admin.dashboard', compact(
        'totalUsers',
        'totalProperties',
        'totalBookings',
        'pendingBookings',
        'unreadMessages',
        'totalServiceRequests',
        'pendingServiceRequests',
        'cityBreakdown',
        'recentUsers',
        'recentBookings',
        'recentServiceRequests',
        'recentActivity'
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

    /*
|--------------------------------------------------------------------------
| Service Requests List
|--------------------------------------------------------------------------
*/

public function serviceRequests()
{
    $serviceRequests = ServiceRequest::with([
            'user',
            'property'
        ])
        ->latest()
        ->get();

    $pending = $serviceRequests
        ->where('status', 'pending')
        ->count();

    $inProgress = $serviceRequests
        ->where('status', 'in_progress')
        ->count();

    $completed = $serviceRequests
        ->where('status', 'completed')
        ->count();

    $cancelled = $serviceRequests
        ->where('status', 'cancelled')
        ->count();

    return view(
        'admin.service-requests',
        compact(
            'serviceRequests',
            'pending',
            'inProgress',
            'completed',
            'cancelled'
        )
    );
}


/*
|--------------------------------------------------------------------------
| Update Service Request Status
|--------------------------------------------------------------------------
*/

public function updateServiceRequest(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,in_progress,completed,cancelled',
    ]);

    $serviceRequest = ServiceRequest::findOrFail($id);

    $serviceRequest->update([
        'status' => $request->status,
    ]);

    return redirect()
        ->route('admin.service-requests')
        ->with(
            'success',
            'Service request status updated successfully!'
        );
}
public function blogs()
{
    $blogs = Blog::with('user')
        ->latest()
        ->get();

    $published = Blog::where('status', 'published')->count();

    $draft = Blog::where('status', 'draft')->count();

    return view(
        'admin.blogs',
        compact(
            'blogs',
            'published',
            'draft'
        )
    );
}
public function createBlog()
{
    return view('admin.create-blog');
}

public function storeBlog(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'excerpt' => 'nullable|string|max:500',
        'content' => 'required|string|min:20',
        'status' => 'required|in:draft,published',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {

        $imagePath = $request
            ->file('image')
            ->store('blogs', 'public');
    }

    Blog::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'category' => $request->category,
        'image' => $imagePath,
        'excerpt' => $request->excerpt,
        'content' => $request->content,
        'status' => $request->status,
        'published_at' => $request->status === 'published'
            ? now()
            : null,
    ]);

    return redirect()
        ->route('admin.blogs')
        ->with('success', 'Blog created successfully!');
}
public function editBlog($id)
{
    $blog = Blog::findOrFail($id);

    return view(
        'admin.edit-blog',
        compact('blog')
    );
}
public function updateBlog(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'excerpt' => 'nullable|string|max:500',
        'content' => 'required|string|min:20',
        'status' => 'required|in:draft,published',
    ]);

    $data = [
        'title' => $request->title,
        'category' => $request->category,
        'excerpt' => $request->excerpt,
        'content' => $request->content,
        'status' => $request->status,
    ];

    if (
        $request->status === 'published' &&
        !$blog->published_at
    ) {
        $data['published_at'] = now();
    }

    if ($request->hasFile('image')) {

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $data['image'] = $request
            ->file('image')
            ->store('blogs', 'public');
    }

    $blog->update($data);

    return redirect()
        ->route('admin.blogs')
        ->with('success', 'Blog updated successfully!');
}

public function deleteBlog($id)
{
    $blog = Blog::findOrFail($id);

    if ($blog->image) {
        Storage::disk('public')->delete($blog->image);
    }

    $blog->delete();

    return redirect()
        ->route('admin.blogs')
        ->with('success', 'Blog deleted successfully!');
}

}