<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

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
        $properties = Property::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        $total   = $properties->count();
        $active  = $properties->where('status', 'active')->count();
        $recent  = $properties->take(5);

        return view('dashboard', compact('properties', 'total', 'active', 'recent'));
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
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('properties', 'public');
        }

        Property::create([
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

        return redirect()->route('dashboard')->with('success', 'Property listed successfully!');
    }
}