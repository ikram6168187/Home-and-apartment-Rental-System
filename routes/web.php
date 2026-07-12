<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BookingController;

// Home
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/about',   [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact',[ContactController::class, 'send'])->name('contact.send');

// Auth
Route::post('/home/login',    [LoginController::class, 'login'])->name('home.login');
Route::post('/home/register', [AuthController::class, 'register'])->name('home.register');
Route::get('/login',  function () { return redirect()->route('home'); })->name('login');
Route::get('/signup', function () { return redirect()->route('home'); })->name('register');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// Property Detail (public)
Route::get('/property/{id}', [BookingController::class, 'show'])->name('property.show');

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

    // Properties
    Route::get('/add-property',       [PropertyController::class, 'create'])->name('property.create');
    Route::post('/add-property',      [PropertyController::class, 'store'])->name('property.store');
    Route::get('/edit-property/{id}', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/edit-property/{id}', [PropertyController::class, 'update'])->name('property.update');
    Route::patch('/property/{id}/toggle', [PropertyController::class, 'toggle'])->name('property.toggle');
    Route::delete('/property/{id}',   [PropertyController::class, 'destroy'])->name('property.destroy');

    // Bookings
    Route::post('/property/{id}/book', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking-requests',    [BookingController::class, 'requests'])->name('booking.requests');
    Route::patch('/booking/{id}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::patch('/booking/{id}/cancel',  [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');

    // Notifications
    Route::get('/notifications',         [NotificationController::class, 'index'])->name('notifications');
    Route::delete('/notifications/clear',[NotificationController::class, 'clearAll'])->name('notifications.clear');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Profile & Settings
    Route::get('/profile',  [UserController::class, 'profile'])->name('profile');
    Route::put('/profile',  [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::put('/settings/password', [UserController::class, 'changePassword'])->name('settings.password');
    Route::delete('/settings/account', [UserController::class, 'deleteAccount'])->name('settings.delete');

    // Admin
    Route::get('/admindashboard', function () {
        return view('admindashboard');
    })->middleware('role:admin')->name('admin.dashboard');

});
