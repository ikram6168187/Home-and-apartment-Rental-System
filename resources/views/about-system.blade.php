<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About System - Smart Rent</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Modal Style Include --}}
    @include('Modal style')

    {{-- External Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/about_system.css') }}">
</head>

<body>

    {{-- NAVIGATION & MODALS --}}
    @include('Navbar')
    @include('Modal scripts')
    @include('login modal')
    @include('Signup modal')
    @include('Logout modal')

    <!-- HERO SECTION -->
    <div class="as-hero">
        <h1>About This System</h1>
        <p>A smarter way to discover, list, and manage rental properties — built for speed, trust, and simplicity.</p>
    </div>

    <!-- OVERVIEW SECTION -->
    <div class="as-section">
        <h2>What is Smart Rent?</h2>
        <p>
            Smart Rent is a complete online rental management platform that connects property owners
            with tenants looking for their next home. From listing a property to booking a stay,
            every step is designed to be fast, secure, and transparent for both sides.
        </p>
    </div>

    <!-- FEATURES SECTION -->
    <div class="as-section as-section-no-top">
        <h2>Key Features</h2>
        <div class="as-features">
            <div class="as-card">
                <i class="fa-solid fa-house"></i>
                <h3>Property Listings</h3>
                <p>Owners can add, edit, and manage their properties with full details and images.</p>
            </div>
            <div class="as-card">
                <i class="fa-solid fa-magnifying-glass"></i>
                <h3>Smart Search</h3>
                <p>Renters can filter properties by location, dates, and number of guests instantly.</p>
            </div>
            <div class="as-card">
                <i class="fa-solid fa-lock"></i>
                <h3>Secure Bookings</h3>
                <p>Every booking and transaction is protected with secure authentication.</p>
            </div>
            <div class="as-card">
                <i class="fa-solid fa-headset"></i>
                <h3>24/7 Support</h3>
                <p>Our support team is available to help with any issue, anytime.</p>
            </div>
        </div>
    </div>

    <!-- SYSTEM INFO SECTION -->
    <div class="as-section as-section-no-top">
        <div class="as-version-box">
            <div class="as-version-item">
                <span>v1.0.0</span>
                <small>System Version</small>
            </div>
            <div class="as-version-item">
                <span>Laravel</span>
                <small>Built With</small>
            </div>
            <div class="as-version-item">
                <span>{{ date('Y') }}</span>
                <small>Last Updated</small>
            </div>
            <div class="as-version-item">
                <span>99.9%</span>
                <small>Uptime</small>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    @include('footer')

</body>

</html>