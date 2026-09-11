<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @include('Modal style')

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <style>
        .legal-wrapper {
            max-width: 850px;
            margin: 60px 0 60px 60px; 
            padding: 40px 30px;
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.7;
        }
        .legal-wrapper h1 {
            font-size: 32px;
            font-weight: bold;
            color: #2b2d42;
            margin-bottom: 6px;
        }
        .legal-updated {
            font-size: 13px;
            color: #888;
            margin-bottom: 30px;
        }
        .legal-wrapper h2 {
            font-size: 20px;
            font-weight: bold;
            color: #2b2d42;
            margin-top: 32px;
            margin-bottom: 12px;
        }
        .legal-wrapper p, .legal-wrapper li {
            font-size: 15px;
            color: #444;
        }
        .legal-wrapper ul {
            padding-left: 20px;
            margin-bottom: 16px;
        }
        .legal-wrapper li {
            margin-bottom: 8px;
        }
        .legal-wrapper a {
            color: #4ea8de;
            text-decoration: none;
        }
        .legal-wrapper a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    @include('navbar')
    @include('login modal')
    @include('signup modal')
    @include('logout modal')
    @include('otp_verify')
    @include('forgot-password')
    @include('reset-password')

    <div class="legal-wrapper">

        <h1>Terms of Service</h1>
        <p class="legal-updated">Last updated: {{ date('F d, Y') }}</p>

        <p>
            Welcome to Smart Rent. By accessing or using our platform, you agree to be bound by the
            following Terms of Service. Please read them carefully before using the platform.
        </p>

        <h2>1. Who Can Use Smart Rent</h2>
        <p>
            You must be at least 18 years old to create an account or list a property on Smart Rent.
            By registering, you confirm that the information you provide is accurate and up to date.
        </p>

        <h2>2. Property Listings</h2>
        <ul>
            <li>Property owners are responsible for the accuracy of their listing information</li>
            <li>Fake, misleading, or duplicate listings are strictly prohibited</li>
            <li>Smart Rent may remove any listing that violates these terms without prior notice</li>
            <li>Listing a property does not guarantee it will be rented</li>
        </ul>

        <h2>3. No Commission / Free Platform</h2>
        <p>
            Smart Rent is currently a free platform. We do not charge commission or fees on rental
            transactions. Any rent, deposit, or payment agreement made between a renter and a
            property owner is strictly between those two parties.
        </p>

        <h2>4. User Responsibilities</h2>
        <ul>
            <li>Do not use the platform for fraudulent or illegal purposes</li>
            <li>Do not harass, threaten, or mislead other users</li>
            <li>Do not attempt to hack, scrape, or disrupt the platform</li>
            <li>Keep your account credentials confidential</li>
        </ul>

        <h2>5. Limitation of Liability</h2>
        <p>
            Smart Rent acts only as a platform connecting renters and property owners. We do not
            own, inspect, or guarantee any property listed on the platform. We are not responsible
            for disputes, damages, fraud, or losses arising from agreements made between users.
            Users are encouraged to verify property details and owner identity independently before
            making any payment or agreement.
        </p>

        <h2>6. Account Suspension</h2>
        <p>
            We reserve the right to suspend or terminate any account that violates these Terms,
            posts fraudulent listings, or engages in abusive behavior toward other users.
        </p>

        <h2>7. Changes to These Terms</h2>
        <p>
            Smart Rent may update these Terms of Service from time to time. Continued use of the
            platform after changes are posted means you accept the revised terms.
        </p>

        <h2>8. Contact Us</h2>
        <p>
            For any questions regarding these Terms, contact us at
            <a href="mailto:studygrw@gmail.com">studygrw@gmail.com</a>
            or call +92 3229859984.
        </p>

    </div>

    @include('footer')

    @include('Modal scripts')

</body>
</html>