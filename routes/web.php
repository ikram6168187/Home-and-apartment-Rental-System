<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

// Home page
Route::get('/home', [HomeController::class, 'home'])->name('home');

// Login modal
Route::post('/home/login', [LoginController::class, 'login'])->name('home.login');

// Signup modal
Route::post('/home/register', [AuthController::class, 'register'])->name('home.register');

// Direct URL fallbacks
Route::get('/login',  function () { return redirect()->route('home'); })->name('login');
Route::get('/signup', function () { return redirect()->route('home'); })->name('register');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [PropertyController::class, 'dashboard'])->name('dashboard');

    // Add Property
    Route::get('/add-property',  [PropertyController::class, 'create'])->name('property.create');
    Route::post('/add-property', [PropertyController::class, 'store'])->name('property.store');

    // My Listings (baad mein banayenge)
    Route::get('/my-listings', function () {
        return view('my-listings');
    })->name('my.listings');

    // Profile (baad mein banayenge)
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Settings (baad mein banayenge)
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    // Admin Dashboard
    Route::get('/admindashboard', function () {
        return view('admindashboard');
    })->middleware('role:admin')->name('admin.dashboard');

});
//dashboard
Route::get('/Dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('Dashboard');
    //about
  Route::get('/about', function () {
    return view('about');
})->name('about');
//contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');