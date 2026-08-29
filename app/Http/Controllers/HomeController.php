<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $query = Property::where('status', 'active');

        // City filter — city icon click
        if ($request->city) {
            $query->where('city', $request->city);
        }

        // Search bar — city ya location ya title
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('city',     'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('title',    'like', "%{$search}%");
            });
        }

        // Availability check — check in + check out dates
        if ($request->check_in && $request->check_out) {
            $checkIn  = $request->check_in;
            $checkOut = $request->check_out;

            // Jo properties in dates mein booked hain unhe exclude karo
            $bookedPropertyIds = Booking::where('status', '!=', 'cancelled')
                ->where(function ($q) use ($checkIn, $checkOut) {
                    $q->whereBetween('check_in',  [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut])
                      ->orWhere(function ($q2) use ($checkIn, $checkOut) {
                          $q2->where('check_in',  '<=', $checkIn)
                             ->where('check_out', '>=', $checkOut);
                      });
                })->pluck('property_id');

            $query->whereNotIn('id', $bookedPropertyIds);
        }

        // ===== NAYA CODE: rating count + average stars ke sath fetch karo =====
        $properties = $query->withCount('ratings')
            ->withAvg('ratings', 'stars')
            ->latest()
            ->get();
        // ========================================================================

        return view('home', compact('properties'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}