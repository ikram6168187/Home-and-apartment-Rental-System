<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        // Logged-in user
        $user = Auth::user();

        // Total properties (sirf is user ki)
        $total = Property::where('user_id', $user->id)->count();

        // Active properties (sirf is user ki)
        $active = Property::where('user_id', $user->id)
                          ->where('status', 'active')
                          ->count();

        // Recent properties (sirf is user ki)
        $recent = Property::where('user_id', $user->id)
                          ->latest()
                          ->take(5)
                          ->get();

        // Send data to dashboard view
        return view('dashboard', compact(
            'user',
            'total',
            'active',
            'recent'
        ));
    }
}