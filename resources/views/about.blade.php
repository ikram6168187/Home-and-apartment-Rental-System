<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

    {{-- Modal CSS (navbar ke liye zaroori) --}}
    @include('Modal style')

    <link rel="stylesheet" href="{{ asset('css/about.css') }}">

</head>
<body>

    {{-- HOME WALA NAVBAR --}}
    @include('navbar')

    {{-- LOGIN MODAL --}}
    @include('Login modal')

    {{-- SIGNUP MODAL --}}
    @include('Signup modal')

    {{-- LOGOUT MODAL --}}
    @include('Logout modal')

<!-- HERO -->
<section class="hero">
    <div class="hero-badge"><i class="fa-solid fa-star"></i> Pakistan's Trusted Rental Platform</div>
    <h1>Renting Made <span>Simple,</span><br>Safe & Smart</h1>
    <p>Smart Rent connects property owners with renters across Pakistan — making the rental process transparent, fast, and hassle-free.</p>
</section>

<!-- STATS -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-item"><h3>500+</h3><p>Properties Listed</p></div>
        <div class="stat-item"><h3>10+</h3><p>Cities Covered</p></div>
        <div class="stat-item"><h3>1000+</h3><p>Happy Renters</p></div>
        <div class="stat-item"><h3>98%</h3><p>Satisfaction Rate</p></div>
    </div>
</section>

<!-- STORY -->
<section class="story-section">
    <div class="story-grid">
        <div class="story-text">
            <div class="section-tag">Our Story</div>
            <h2 class="section-title">Why We Built <span>Smart Rent</span></h2>
            <p>Finding a rental property in Pakistan has always been a stressful experience — unverified listings, hidden charges, and no direct way to connect with owners.</p>
            <p>Smart Rent was built to solve exactly that. We created a platform where property owners can list their homes, apartments, and rooms with full transparency, and where renters can browse, compare, and book with complete confidence.</p>
            <p>Our goal is simple — make renting in Pakistan as easy as ordering food online.</p>
        </div>
        <div class="story-image">
            <i class="fa-solid fa-city"></i>
            <div class="img-text">
                <h3>Built for Pakistan</h3>
                <p>Connecting owners & renters nationwide</p>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="how-section">
    <div class="section-tag">How It Works</div>
    <h2 class="section-title">3 Simple Steps to <span>Find Your Home</span></h2>
    <div class="how-grid">
        <div class="how-card">
            <div class="how-number">1</div>
            <div class="how-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <h3>Search by City</h3>
            <p>Browse hundreds of verified rental properties across major cities in Pakistan.</p>
        </div>
        <div class="how-card">
            <div class="how-number">2</div>
            <div class="how-icon"><i class="fa-solid fa-file-lines"></i></div>
            <h3>View Details</h3>
            <p>Check property photos, price, location, bedrooms, and directly contact the owner.</p>
        </div>
        <div class="how-card">
            <div class="how-number">3</div>
            <div class="how-icon"><i class="fa-solid fa-house-circle-check"></i></div>
            <h3>Book Your Place</h3>
            <p>Confirm your booking online — no middlemen, no hidden fees, no stress.</p>
        </div>
    </div>
</section>

<!-- MISSION -->
<section class="mission-section">
    <h2>Our Mission</h2>
    <p>To make rental housing in Pakistan accessible, transparent, and trustworthy — empowering both property owners and renters through technology.</p>
    <a href="{{ route('home') }}" class="mission-btn">
        <i class="fa-solid fa-arrow-right"></i> Explore Properties
    </a>
</section>
<!-- end mission -->

<!-- VALUES -->
<section class="values-section">
    <div class="section-heading-center">
        <div class="section-tag">Our Values</div>
        <h2 class="section-title">What We Stand For</h2>
    </div>
    <div class="values-grid">
        <div class="value-card">
            <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
            <h3>Trust & Safety</h3>
            <p>Every listing is reviewed to ensure authenticity. Renters can browse with full confidence.</p>
        </div>
        <div class="value-card">
            <div class="value-icon"><i class="fa-solid fa-eye"></i></div>
            <h3>Transparency</h3>
            <p>No hidden charges. What you see is what you get — honest pricing, clear details.</p>
        </div>
        <div class="value-card">
            <div class="value-icon"><i class="fa-solid fa-bolt"></i></div>
            <h3>Speed & Ease</h3>
            <p>Find and book a property in minutes — not days. We value your time.</p>
        </div>
    </div>
</section>

 
  @include('footer')
{{-- MODAL SCRIPTS --}}
@include('Modal scripts')

</body>
</html>