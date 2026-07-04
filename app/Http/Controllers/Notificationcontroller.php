<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Notifications page
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
                            ->latest()
                            ->get();

        $unreadNotifications = $notifications->where('is_read', false)->count();

        // Sab read mark karo jab page khule
        Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->update(['is_read' => true]);

        return view('Notification', compact('notifications', 'unreadNotifications'));
    }

    // Clear all notifications
    public function clearAll()
    {
        Notification::where('user_id', Auth::id())->delete();
        return redirect()->route('notifications')->with('success', 'All notifications cleared!');
    }

    // Delete single notification
    public function destroy($id)
    {
        Notification::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('notifications');
    }
}
