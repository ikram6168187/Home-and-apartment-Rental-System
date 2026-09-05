<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About System - Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f7f7f7; }

       
        /* ===== HERO ===== */
        .as-hero {
            background: linear-gradient(135deg, rgb(91, 72, 68) 0%, #6d5643 100%); 
    padding: 70px 5% 60px; 
    text-align: center; 
    position: relative; 
    overflow: hidden; 
    margin: 35px 2.5% 0; 
    border-radius: 25px; 
        }
        .as-hero h1 {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 2.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            color:rgb(6, 6, 6);
        }
        .as-hero p {
            color: #faf7f1;
            font-size: 1.05rem;
            max-width: 650px;
            margin: 15px auto 0;
        }

        /* ===== SECTIONS ===== */
        .as-section {
            padding: 70px 20px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .as-section h2 {
            font-family: Georgia, serif;
            color: #f4f0f0;
            font-size: 1.8rem;
            margin-bottom: 20px;
            border-left: 4px solid #c9a04d;
            padding-left: 15px;
        }
        .as-section p {
            color: #4a4a4a;
            line-height: 1.8;
            font-size: 1rem;
        }

        .as-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        .as-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 30px 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .as-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        .as-card i {
            font-size: 2rem;
            color: #c9a04d;
            margin-bottom: 15px;
        }
        .as-card h3 {
            font-size: 1.1rem;
            color: #1c1c1c;
            margin-bottom: 10px;
        }
        .as-card p {
            font-size: 0.92rem;
            color: #666;
            line-height: 1.6;
        }

        .as-version-box {
            background: #1c1c1c;
            color: #fff;
            border-radius: 12px;
            padding: 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-top: 50px;
        }
        .as-version-item {
            flex: 1;
            min-width: 150px;
            text-align: center;
        }
        .as-version-item span {
            display: block;
            font-size: 1.6rem;
            color: #c9a04d;
            font-weight: bold;
        }
        .as-version-item small {
            color: #b8b8b8;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #1c1c1c;
            color: #999;
            text-align: center;
            padding: 25px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .navbar { padding: 15px 20px; }
        }
    </style>
</head>
<body>

    @include('Navbar')
    @include('Modal scripts')
   @include('Modal style')
   @include('login modal')
   @include('Signup modal')
    <!-- HERO -->
    <div class="as-hero">
        <h1>About This System</h1>
        <p>A smarter way to discover, list, and manage rental properties — built for speed, trust, and simplicity.</p>
    </div>

    <!-- OVERVIEW -->
    <div class="as-section">
        <h2>What is Smart Rent?</h2>
        <p>
            Smart Rent is a complete online rental management platform that connects property owners
            with tenants looking for their next home. From listing a property to booking a stay,
            every step is designed to be fast, secure, and transparent for both sides.
        </p>
    </div>

    <!-- FEATURES -->
    <div class="as-section" style="padding-top:0;">
        <h2>Key Features</h2>
        <div class="as-features">
            <div class="as-card">
                <i class="fa fa-home"></i>
                <h3>Property Listings</h3>
                <p>Owners can add, edit, and manage their properties with full details and images.</p>
            </div>
            <div class="as-card">
                <i class="fa fa-magnifying-glass"></i>
                <h3>Smart Search</h3>
                <p>Renters can filter properties by location, dates, and number of guests instantly.</p>
            </div>
            <div class="as-card">
                <i class="fa fa-lock"></i>
                <h3>Secure Bookings</h3>
                <p>Every booking and transaction is protected with secure authentication.</p>
            </div>
            <div class="as-card">
                <i class="fa fa-headset"></i>
                <h3>24/7 Support</h3>
                <p>Our support team is available to help with any issue, anytime.</p>
            </div>
        </div>
    </div>

    <!-- SYSTEM INFO -->
    <div class="as-section" style="padding-top:0;">
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

    @include('footer')

</body>
</html>