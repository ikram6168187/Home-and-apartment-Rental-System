<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Our Services - Smart Rent</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />

    {{-- External CSS Link --}}
    <link rel="stylesheet" href="{{ asset('css/services_index.css') }}">

    @include('Modal style')
</head>

<body>

    {{-- NAVBAR --}}
    @include('navbar')

    {{-- MODALS --}}
    @include('login modal')
    @include('signup modal')
    @include('logout modal')
    @include('otp_verify')
    @include('forgot-password')
    @include('reset-password')

    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="services-hero-wrapper">
        <div class="services-hero" style="background-image: linear-gradient(135deg, rgba(20, 15, 10, 0.82), rgba(51, 47, 46, 0.78)), url('{{ asset('images/hero1.jpg') }}');">
            <div class="services-hero-content">
                <div class="hero-label">
                    <i class="fa-solid fa-handshake"></i>
                    Smart Rent Solutions
                </div>

                <h1>
                    More Than Just
                    <span>Property Rental</span>
                </h1>

                <p>
                    Smart Rent provides additional services designed
                    to make your complete rental journey easier,
                    safer, and more convenient.
                </p>
            </div>
        </div>
    </section>

    <!-- =====================================================
         INTRO
    ====================================================== -->

    <section class="services-intro">
        <div class="section-label">
            What We Offer
        </div>

        <h2>
            Complete Services for a
            <span>Better Rental Experience</span>
        </h2>

        <p>
            From maintaining your home to arranging relocation and
            preparing rental agreements, Smart Rent helps renters
            and property owners manage important services in one
            convenient platform.
        </p>
    </section>

    <!-- =====================================================
         SERVICES
    ====================================================== -->

    <section class="services-section" id="services">
        <div class="services-grid">

            <!-- HOME MAINTENANCE -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>

                <h3>Home Maintenance</h3>

                <p>
                    Request professional maintenance services to keep
                    your rental property safe, functional and comfortable.
                </p>

                <ul class="service-features">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Plumbing Services
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Electrical Repairs
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        AC & Appliance Maintenance
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Painting & Carpentry
                    </li>
                </ul>

                @auth
                    <a href="{{ route('services.request', ['service' => 'home_maintenance']) }}" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endauth

                @guest
                    <a href="javascript:void(0);" onclick="openServiceLogin('home_maintenance')" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endguest
            </div>

            <!-- PROPERTY INSPECTION -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-magnifying-glass-location"></i>
                </div>

                <h3>Property Inspection</h3>

                <p>
                    Schedule an inspection to examine a property
                    carefully before making your final rental decision.
                </p>

                <ul class="service-features">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Schedule Visit
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Property Condition Check
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Facilities Inspection
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Preferred Date & Time
                    </li>
                </ul>

                @auth
                    <a href="{{ route('services.request', ['service' => 'property_inspection']) }}" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endauth

                @guest
                    <a href="javascript:void(0);" onclick="openServiceLogin('property_inspection')" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endguest
            </div>

            <!-- DIGITAL RENTAL AGREEMENT -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-file-signature"></i>
                </div>

                <h3>Digital Rental Agreement</h3>

                <p>
                    Create and manage rental agreements digitally with
                    important property and rental details in one place.
                </p>

                <ul class="service-features">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Digital Agreement
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Owner & Renter Details
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Rental Terms
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Easy Agreement Management
                    </li>
                </ul>

                @auth
                    <a href="{{ route('services.request', ['service' => 'digital_rental_agreement']) }}" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endauth

                @guest
                    <a href="javascript:void(0);" onclick="openServiceLogin('digital_rental_agreement')" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endguest
            </div>

            <!-- MOVING & RELOCATION -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-truck-moving"></i>
                </div>

                <h3>Moving & Relocation</h3>

                <p>
                    Make your move easier by requesting relocation
                    assistance for shifting your belongings safely.
                </p>

                <ul class="service-features">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        House Shifting
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Furniture Moving
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Packing Assistance
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Loading & Unloading
                    </li>
                </ul>

                @auth
                    <a href="{{ route('services.request', ['service' => 'moving_relocation']) }}" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endauth

                @guest
                    <a href="javascript:void(0);" onclick="openServiceLogin('moving_relocation')" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endguest
            </div>

            <!-- PHOTOGRAPHY -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fa-solid fa-camera"></i>
                </div>

                <h3>Photography & Virtual Tour</h3>

                <p>
                    Help property owners showcase their listings with
                    professional photography and virtual property tours.
                </p>

                <ul class="service-features">
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Professional Photography
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Property Video
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        360° Virtual Tour
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-check"></i>
                        Better Property Presentation
                    </li>
                </ul>

                @auth
                    <a href="{{ route('services.request', ['service' => 'photography_virtual_tour']) }}" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endauth

                @guest
                    <a href="javascript:void(0);" onclick="openServiceLogin('photography_virtual_tour')" class="service-btn">
                        Request Service
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                @endguest
            </div>

        </div>
    </section>

    <!-- =====================================================
         WHY CHOOSE SERVICES
    ====================================================== -->

    <section class="why-services">
        <div class="why-services-content">
            <h2>Why Use Smart Rent Services?</h2>

            <p>
                We aim to simplify every stage of the rental journey
                by connecting users with useful services through one
                centralized platform.
            </p>
        </div>

        <div class="benefits-grid">
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h4>Easy Requests</h4>
                <p>Request services quickly through a simple process.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <h4>Save Time</h4>
                <p>Manage important rental-related tasks efficiently.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4>Reliable Process</h4>
                <p>Keep service requests organized and trackable.</p>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fa-solid fa-house"></i>
                </div>
                <h4>All in One Place</h4>
                <p>Access rental-related services from one platform.</p>
            </div>
        </div>
    </section>

    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="service-cta">
        <h2>Need Help With Your Rental Journey?</h2>

        <p>
            Explore Smart Rent services and make your property
            rental experience simpler, smoother and more convenient.
        </p>

        <a href="#services" class="service-cta-btn">
            <i class="fa-solid fa-arrow-up"></i>
            Explore Services
        </a>
    </section>

    {{-- MODAL SCRIPTS --}}
    @include('Modal scripts')

    <script>
        function openServiceLogin(serviceType) {
            // Selected service save karo
            localStorage.setItem('selectedService', serviceType);

            // Login modal open karo
            openLoginModal();

            // Login form mein redirect URL set karo
            setTimeout(function () {
                const redirectInput = document.getElementById('redirectTo');
                if (redirectInput) {
                    redirectInput.value = "{{ url('/services/request') }}?service=" + serviceType;
                }
            }, 100);
        }
    </script>

    @include('footer')
</body>
</html>