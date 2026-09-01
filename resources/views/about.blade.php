<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

    {{-- Modal CSS (navbar ke liye zaroori) --}}
    @include('Modal style')

<style>

/* =========================================================
   GLOBAL
   ========================================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Arial, sans-serif;
}

body {
    background: #f4f6f9;
    color: #1a1a2e;
}

a {
    text-decoration: none;
    color: inherit;
}


/* =========================================================
   HERO
   ========================================================= */

.hero {
    width: 95%;
    margin: 40px auto 0;

    background: linear-gradient(
        135deg,
        rgb(51,47,46) 0%,
        #5c4a3a 100%
    );

    padding: 90px 5% 80px;

    text-align: center;

    position: relative;
    overflow: hidden;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.12);
}

.hero::before {
    content: '';

    position: absolute;

    width: 500px;
    height: 500px;

    border-radius: 50%;

    background: rgba(255,255,255,0.04);

    top: -150px;
    right: -100px;
}

.hero::after {
    content: '';

    position: absolute;

    width: 300px;
    height: 300px;

    border-radius: 50%;

    background: rgba(255,255,255,0.04);

    bottom: -100px;
    left: -50px;
}

.hero-badge {
    display: inline-block;

    background: rgba(255,255,255,0.12);

    color: #e8d5b7;

    padding: 6px 18px;

    border-radius: 20px;

    font-size: 13px;
    font-weight: 500;

    margin-bottom: 20px;

    border: 1px solid rgba(255,255,255,0.15);
}

.hero h1 {
    color: #fff;

    font-size: 48px;
    font-weight: 700;

    margin-bottom: 16px;

    line-height: 1.2;
}

.hero h1 span {
    color: #e8d5b7;
}

.hero p {
    color: rgba(255,255,255,0.7);

    font-size: 17px;

    max-width: 580px;

    margin: 0 auto;

    line-height: 1.7;
}


/* =========================================================
   STATS
   ========================================================= */

.stats-section {
    width: 95%;
    margin: 30px auto 0;

    background: #fff;

    padding: 50px 5%;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.stats-grid {
    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: 20px;

    max-width: 900px;

    margin: 0 auto;

    text-align: center;
}

.stat-item {
    padding: 10px;
}

.stat-item h3 {
    font-size: 38px;
    font-weight: 700;

    color: rgb(51,47,46);

    margin-bottom: 6px;
}

.stat-item p {
    font-size: 14px;

    color: #888;

    font-weight: 500;
}


/* =========================================================
   STORY SECTION
   ========================================================= */

.story-section {
    width: 95%;
    margin: 30px auto 0;

    padding: 80px 5%;

    background: #fff;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.section-tag {
    display: inline-block;

    background: #f5ede0;

    color: #8a5c30;

    padding: 5px 14px;

    border-radius: 20px;

    font-size: 12px;
    font-weight: 600;

    margin-bottom: 14px;

    text-transform: uppercase;

    letter-spacing: 0.5px;
}

.section-title {
    font-size: 32px;
    font-weight: 700;

    color: #1a1a2e;

    margin-bottom: 16px;

    line-height: 1.3;
}

.section-title span {
    color: rgb(51,47,46);
}

.story-grid {
    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 60px;

    align-items: center;

    max-width: 1100px;

    margin: 0 auto;
}

.story-text p {
    color: #666;

    font-size: 15px;

    line-height: 1.8;

    margin-bottom: 16px;
}

.story-image {
    border-radius: 20px;

    overflow: hidden;

    position: relative;

    height: 380px;

    background: linear-gradient(
        135deg,
        rgb(51,47,46),
        #8a6040
    );

    display: flex;

    align-items: center;
    justify-content: center;
}

.story-image i {
    font-size: 100px;

    color: rgba(255,255,255,0.15);
}

.story-image .img-text {
    position: absolute;

    bottom: 30px;
    left: 30px;

    color: #fff;
}

.story-image .img-text h3 {
    font-size: 22px;

    font-weight: 700;
}

.story-image .img-text p {
    font-size: 13px;

    opacity: 0.7;

    margin: 0;
}


/* =========================================================
   HOW IT WORKS
   ========================================================= */

.how-section {
    width: 95%;
    margin: 30px auto 0;

    background: #fff;

    padding: 80px 5%;

    text-align: center;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.how-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 32px;

    max-width: 900px;

    margin: 50px auto 0;
}

.how-card {
    background: #fff;

    padding: 36px 28px;

    border-radius: 20px;

    border: 1px solid #eee;

    transition: 0.3s;

    position: relative;
}

.how-card:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);

    transform: translateY(-4px);
}

.how-number {
    position: absolute;

    top: -16px;
    left: 50%;

    transform: translateX(-50%);

    background: rgb(51,47,46);

    color: #fff;

    width: 32px;
    height: 32px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 13px;

    font-weight: 700;
}

.how-icon {
    width: 64px;
    height: 64px;

    border-radius: 16px;

    background: #f5ede0;

    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0 auto 18px;

    font-size: 26px;

    color: rgb(51,47,46);
}

.how-card h3 {
    font-size: 16px;

    font-weight: 600;

    color: #1a1a2e;

    margin-bottom: 10px;
}

.how-card p {
    font-size: 13px;

    color: #888;

    line-height: 1.6;
}


/* =========================================================
   MISSION
   ========================================================= */

.mission-section {
    width: 95%;
    margin: 30px auto 0;

    padding: 80px 5%;

    background: linear-gradient(
        135deg,
        rgb(51,47,46),
        #5c4a3a
    );

    text-align: center;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.12);
}

.mission-section h2 {
    font-size: 32px;

    font-weight: 700;

    color: #fff;

    margin-bottom: 16px;
}

.mission-section p {
    font-size: 16px;

    color: rgba(255,255,255,0.75);

    max-width: 640px;

    margin: 0 auto 36px;

    line-height: 1.8;
}

.mission-btn {
    display: inline-flex;

    align-items: center;

    gap: 8px;

    background: #fff;

    color: rgb(51,47,46);

    padding: 14px 32px;

    border-radius: 30px;

    font-size: 15px;

    font-weight: 600;

    transition: 0.2s;
}

.mission-btn:hover {
    transform: translateY(-2px);

    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}


/* =========================================================
   VALUES
   ========================================================= */

.values-section {
    width: 95%;
    margin: 30px auto 0;

    padding: 80px 5%;

    background: #fff;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.values-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 24px;

    max-width: 1000px;

    margin: 50px auto 0;
}

.value-card {
    background: #fff;

    border-radius: 20px;

    padding: 28px;

    border: 1px solid #eee;

    transition: 0.3s;
}

.value-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.07);

    transform: translateY(-3px);
}

.value-icon {
    width: 50px;
    height: 50px;

    border-radius: 12px;

    background: #f5ede0;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 22px;

    color: rgb(51,47,46);

    margin-bottom: 16px;
}

.value-card h3 {
    font-size: 15px;

    font-weight: 600;

    color: #1a1a2e;

    margin-bottom: 8px;
}

.value-card p {
    font-size: 13px;

    color: #888;

    line-height: 1.6;
}


/* =========================================================
   FOOTER (UPDATED)
   ========================================================= */

.footer {
    width: 100%;
    margin: 30px 0 0 !important;
    border-radius: 0;
    border-top: none;
    background: #0f0e0d;
    padding: 60px 5% 30px;
}

/* FOOTER GRID */
.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 40px;
    margin-bottom: 50px;
}

/* FOOTER BRAND */
.footer-brand .f-logo {
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
}

.footer-brand p {
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    line-height: 1.8;
    max-width: 260px;
    margin-bottom: 20px;
}

/* SOCIAL LINKS */
.social-links {
    display: flex;
    gap: 10px;
}

.social-link {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    color: rgba(255,255,255,0.5);
    border: 1px solid rgba(255,255,255,0.1);
    transition: 0.2s;
}

.social-link:hover {
    background: rgb(51,47,46);
    color: #fff;
    border-color: rgb(51,47,46);
}

/* FOOTER COLUMNS */
.footer-col h4 {
    font-size: 13px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-col ul {
    list-style: none;
}

.footer-col ul li {
    margin-bottom: 10px;
}

.footer-col ul li a {
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    transition: 0.2s;
}

.footer-col ul li a:hover {
    color: #c8a882;
}

/* FOOTER CONTACT */
.footer-contact li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    margin-bottom: 10px;
}

.footer-contact li i {
    color: #c8a882;
    margin-top: 2px;
    font-size: 12px;
}

/* FOOTER BOTTOM */
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.08);
    padding-top: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.footer-bottom p {
    font-size: 12px;
    color: rgba(255,255,255,0.3);
}

.footer-links {
    display: flex;
    gap: 20px;
}

.footer-links a {
    font-size: 12px;
    color: rgba(255,255,255,0.3);
    transition: 0.2s;
}

.footer-links a:hover {
    color: #c8a882;
}


/* =========================================================
   MOBILE RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .hero,
    .stats-section,
    .story-section,
    .how-section,
    .mission-section,
    .values-section {
        width: 94%;

        border-radius: 22px;
    }

    .hero {
        margin-top: 25px;
    }

    .hero h1 {
        font-size: 32px;
    }

    .hero {
        padding: 65px 6% 60px;
    }

    .stats-section {
        padding: 40px 5%;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .story-section,
    .how-section,
    .mission-section,
    .values-section {
        padding: 55px 6%;
    }

    .story-grid,
    .how-grid,
    .values-grid {
        grid-template-columns: 1fr;
    }

    .story-grid {
        gap: 35px;
    }

    .how-grid,
    .values-grid {
        margin-top: 40px;
    }

    .story-image {
        height: 300px;
    }

    .section-title {
        font-size: 28px;
    }

    .mission-section h2 {
        font-size: 28px;
    }

    
}

</style>

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

<!-- VALUES -->
<section class="values-section">
    <div style="text-align:center;">
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