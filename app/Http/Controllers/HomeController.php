<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;

class HomeController extends Controller
{
    public function home()
    {
         
        $recent = Property::latest()->take(5)->get();
        $properties = Property::latest()->get();

        return view('home', compact('recent', 'properties'));
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