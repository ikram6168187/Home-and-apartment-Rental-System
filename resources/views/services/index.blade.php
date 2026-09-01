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

    @include('Modal style')

    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: #f5f5f5;
            color: #1a1a2e;
        }

        a {
            text-decoration: none;
        }


        /* =====================================================
           HERO SECTION
        ===================================================== */

        .services-hero-wrapper {
            width: 95%;
            margin: 40px auto 0;
        }

        .services-hero {
            min-height: 380px;
            border-radius: 22px;
            overflow: hidden;
            position: relative;

            background:
                linear-gradient(
                    135deg,
                    rgba(20, 15, 10, 0.82),
                    rgba(51, 47, 46, 0.78)
                ),
                url('{{ asset("images/hero1.jpg") }}');

            background-size: cover;
            background-position: center;

            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;
            color: white;
        }

        .services-hero-content {
            max-width: 800px;
            padding: 40px 20px;
        }

        .services-hero-content .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 18px;

            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 30px;

            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;

            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(5px);

            margin-bottom: 18px;
        }

        .services-hero h1 {
            font-size: 48px;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .services-hero h1 span {
            color: #f2c078;
        }

        .services-hero p {
            max-width: 650px;
            margin: auto;

            font-size: 17px;
            line-height: 1.7;

            color: rgba(255,255,255,0.85);
        }


        /* =====================================================
           INTRO SECTION
        ===================================================== */

        .services-intro {
            width: 90%;
            max-width: 900px;

            margin: 80px auto 20px;

            text-align: center;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            color: #8b5e3c;

            font-size: 13px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 1px;

            margin-bottom: 14px;
        }

        .section-label::before,
        .section-label::after {
            content: "";
            width: 35px;
            height: 2px;
            background: #8b5e3c;
        }

        .services-intro h2 {
            font-size: 34px;
            margin-bottom: 14px;
        }

        .services-intro h2 span {
            color: #8b5e3c;
        }

        .services-intro p {
            max-width: 700px;
            margin: auto;

            color: #777;
            line-height: 1.7;
            font-size: 15px;
        }


        /* =====================================================
           SERVICES GRID
        ===================================================== */

        .services-section {
            width: 92%;
            margin: 50px auto 90px;
        }

        .services-grid {
            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(280px, 1fr));

            gap: 25px;
        }


        /* =====================================================
           SERVICE CARD
        ===================================================== */

        .service-card {
            position: relative;

            background: white;

            border-radius: 18px;

            padding: 32px 28px;

            border: 1px solid #ececec;

            transition: all 0.35s ease;

            overflow: hidden;
        }

        .service-card::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 4px;

            background: linear-gradient(
                90deg,
                #8b5e3c,
                #d6a46a
            );

            transform: scaleX(0);

            transform-origin: left;

            transition: 0.35s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-8px);

            box-shadow:
                0 18px 40px
                rgba(0,0,0,0.10);
        }


        /* ICON */

        .service-icon {
            width: 68px;
            height: 68px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 18px;

            background:
                linear-gradient(
                    135deg,
                    #f7ede4,
                    #f0d7c0
                );

            color: #8b5e3c;

            font-size: 27px;

            margin-bottom: 22px;
        }


        /* CONTENT */

        .service-card h3 {
            font-size: 21px;

            margin-bottom: 12px;

            color: #252525;
        }

        .service-card p {
            color: #777;

            line-height: 1.7;

            font-size: 14px;

            margin-bottom: 20px;
        }


        /* FEATURES */

        .service-features {
            list-style: none;

            margin-bottom: 25px;
        }

        .service-features li {
            display: flex;

            align-items: center;

            gap: 9px;

            margin-bottom: 10px;

            font-size: 13px;

            color: #555;
        }

        .service-features li i {
            color: #8b5e3c;
            font-size: 12px;
        }


        /* BUTTON */

        .service-btn {
            display: inline-flex;

            justify-content: center;
            align-items: center;

            gap: 8px;

            padding: 11px 20px;

            border-radius: 8px;

            background: #332f2e;

            color: white;

            font-size: 14px;
            font-weight: 600;

            transition: 0.3s ease;
        }

        .service-btn:hover {
            background: #8b5e3c;

            transform: translateX(4px);
        }


        /* =====================================================
           WHY SERVICES SECTION
        ===================================================== */

        .why-services {
            width: 92%;
            margin: 0 auto 90px;

            background: #332f2e;

            border-radius: 22px;

            padding: 65px 45px;

            color: white;
        }

        .why-services-content {
            text-align: center;

            max-width: 750px;

            margin: 0 auto 45px;
        }

        .why-services-content h2 {
            font-size: 34px;

            margin-bottom: 14px;
        }

        .why-services-content p {
            color: #d8d8d8;

            line-height: 1.7;

            font-size: 15px;
        }


        .benefits-grid {
            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(200px, 1fr));

            gap: 25px;
        }

        .benefit-item {
            text-align: center;
        }

        .benefit-icon {
            width: 58px;
            height: 58px;

            margin: 0 auto 15px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 50%;

            background: rgba(255,255,255,0.10);

            border: 1px solid rgba(255,255,255,0.15);

            color: #f2c078;

            font-size: 22px;
        }

        .benefit-item h4 {
            margin-bottom: 8px;
            font-size: 17px;
        }

        .benefit-item p {
            color: #cfcfcf;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =====================================================
           CTA
        ===================================================== */

        .service-cta {
            width: 92%;

            margin: 0 auto 50px;

            text-align: center;

            padding: 65px 25px;

            border-radius: 22px;

            background:
                linear-gradient(
                    135deg,
                    #f4ece5,
                    #ead7c6
                );
        }

        .service-cta h2 {
            font-size: 34px;

            margin-bottom: 12px;

            color: #332f2e;
        }

        .service-cta p {
            max-width: 650px;

            margin: auto;

            color: #666;

            line-height: 1.7;

            margin-bottom: 25px;
        }

        .service-cta-btn {
            display: inline-flex;

            align-items: center;
            gap: 10px;

            padding: 13px 26px;

            background: #332f2e;

            color: white;

            border-radius: 8px;

            font-weight: 600;

            transition: 0.3s ease;
        }

        .service-cta-btn:hover {
            background: #8b5e3c;

            transform: translateY(-3px);
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 768px) {

            .services-hero {
                min-height: 320px;
            }

            .services-hero h1 {
                font-size: 36px;
            }

            .services-intro {
                margin-top: 55px;
            }

            .services-intro h2,
            .why-services-content h2,
            .service-cta h2 {
                font-size: 28px;
            }

            .why-services {
                padding: 50px 25px;
            }

        }


        @media(max-width: 480px) {

            .services-hero-wrapper {
                margin-top: 25px;
            }

            .services-hero h1 {
                font-size: 30px;
            }

            .services-hero p {
                font-size: 14px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .service-card {
                padding: 25px 22px;
            }

            .why-services {
                padding: 45px 20px;
            }

        }

    </style>

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

        <div class="services-hero">

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
    <a href="{{ route('services.request', ['service' => 'home_maintenance']) }}"
       class="service-btn">

        Request Service
        <i class="fa-solid fa-arrow-right"></i>

    </a>
@endauth


@guest
<a href="javascript:void(0);"
   onclick="openServiceLogin('home_maintenance')"
   class="service-btn">

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
    <a href="{{ route('services.request', ['service' => 'property_inspection']) }}"
       class="service-btn">

        Request Service
        <i class="fa-solid fa-arrow-right"></i>

    </a>
@endauth


@guest
<a href="javascript:void(0);"
   onclick="openServiceLogin('property_inspection')"
   class="service-btn">

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
    <a href="{{ route('services.request', ['service' => 'digital_rental_agreement']) }}"
       class="service-btn">

        Request Service
        <i class="fa-solid fa-arrow-right"></i>

    </a>
@endauth


@guest
<a href="javascript:void(0);"
   onclick="openServiceLogin('digital_rental_agreement')"
   class="service-btn">

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
    <a href="{{ route('services.request', ['service' => 'moving_relocation']) }}"
       class="service-btn">

        Request Service
        <i class="fa-solid fa-arrow-right"></i>

    </a>
@endauth


@guest
<a href="javascript:void(0);"
   onclick="openServiceLogin('moving_relocation')"
   class="service-btn">

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
    <a href="{{ route('services.request', ['service' => 'photography_virtual_tour']) }}"
       class="service-btn">

        Request Service
        <i class="fa-solid fa-arrow-right"></i>

    </a>
@endauth


@guest
<a href="javascript:void(0);"
   onclick="openServiceLogin('photography_virtual_tour')"
   class="service-btn">

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

            <h2>
                Why Use Smart Rent Services?
            </h2>

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

                <p>
                    Request services quickly through a simple process.
                </p>

            </div>


            <div class="benefit-item">

                <div class="benefit-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <h4>Save Time</h4>

                <p>
                    Manage important rental-related tasks efficiently.
                </p>

            </div>


            <div class="benefit-item">

                <div class="benefit-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>

                <h4>Reliable Process</h4>

                <p>
                    Keep service requests organized and trackable.
                </p>

            </div>


            <div class="benefit-item">

                <div class="benefit-icon">
                    <i class="fa-solid fa-house"></i>
                </div>

                <h4>All in One Place</h4>

                <p>
                    Access rental-related services from one platform.
                </p>

            </div>


        </div>

    </section>



    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="service-cta">

        <h2>
            Need Help With Your Rental Journey?
        </h2>

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

            const redirectInput =
                document.getElementById('redirectTo');

            if (redirectInput) {

                redirectInput.value =
                    "{{ url('/services/request') }}?service=" + serviceType;

            }

        }, 100);

    }
</script>
  @include('footer')
</body>
</html>