<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;

// Home page
Route::get('/home', [HomeController::class, 'home'])->name('home');

// About
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Contact
Route::get('/contact',  [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

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

    // My Listings
    Route::get('/my-listings', [PropertyController::class, 'myListings'])->name('my.listings');

    // Add Property
    Route::get('/add-property',  [PropertyController::class, 'create'])->name('property.create');
    Route::post('/add-property', [PropertyController::class, 'store'])->name('property.store');

    // Edit Property
    Route::get('/edit-property/{id}',  [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/edit-property/{id}',  [PropertyController::class, 'update'])->name('property.update');

    // Toggle Status
    Route::patch('/property/{id}/toggle', [PropertyController::class, 'toggle'])->name('property.toggle');

    // Delete Property
    Route::delete('/property/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');

    // Profile
    Route::get('/profile',  [UserController::class, 'profile'])->name('profile');
    Route::put('/profile',  [UserController::class, 'updateProfile'])->name('profile.update');

    // Settings
    Route::get('/settings',  [UserController::class, 'settings'])->name('settings');
    Route::put('/settings/password', [UserController::class, 'changePassword'])->name('settings.password');
    Route::delete('/settings/account', [UserController::class, 'deleteAccount'])->name('settings.delete');

    // Admin Dashboard
    Route::get('/admindashboard', function () {
        return view('admindashboard');
    })->middleware('role:admin')->name('admin.dashboard');

});



// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
Route::delete('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');