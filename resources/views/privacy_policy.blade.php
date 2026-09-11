<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy — Smart Rent</title>
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

        <h1>Privacy Policy</h1>
        <p class="legal-updated">Last updated: {{ date('F d, Y') }}</p>

        <p>
            Smart Rent ("we", "our", "us") values your privacy. This Privacy Policy explains how we
            collect, use, and protect your information when you use our platform to find, list, or
            manage rental properties across Pakistan.
        </p>

        <h2>1. Information We Collect</h2>
        <p>When you create an account or use Smart Rent, we may collect:</p>
        <ul>
            <li>Your full name</li>
            <li>Your email address</li>
            <li>Your phone number</li>
            <li>Property details you list (address, photos, price, description)</li>
            <li>Messages you send through the platform to other users</li>
            <li>Basic usage data (pages visited, device/browser type, IP address)</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <ul>
            <li>To create and manage your Smart Rent account</li>
            <li>To connect renters with property owners</li>
            <li>To display your property listings to other users</li>
            <li>To send important account or platform notifications</li>
            <li>To improve our services and prevent fraud or misuse</li>
        </ul>

        <h2>3. Sharing of Information</h2>
        <p>
            We do not sell your personal information. Your name, phone number, and listing details
            may be visible to other users on the platform (e.g. a renter contacting a property owner)
            since this is necessary for the service to work. We do not share your data with third
            parties for advertising purposes.
        </p>

        <h2>4. Data Storage & Security</h2>
        <p>
            We take reasonable technical and organizational measures to protect your data from
            unauthorized access, loss, or misuse. However, no online platform can guarantee
            100% security.
        </p>

        <h2>5. Your Rights</h2>
        <ul>
            <li>You can update or correct your account information at any time</li>
            <li>You can request deletion of your account and associated data</li>
            <li>You can contact us for any privacy-related concerns</li>
        </ul>

        <h2>6. Cookies</h2>
        <p>
            Smart Rent may use cookies to keep you logged in and improve your browsing experience.
            You can disable cookies in your browser settings, though some features may not work
            properly as a result.
        </p>

        <h2>7. Changes to This Policy</h2>
        <p>
            We may update this Privacy Policy from time to time. Any changes will be posted on this
            page with an updated revision date.
        </p>

        <h2>8. Contact Us</h2>
        <p>
            If you have any questions about this Privacy Policy, contact us at
            <a href="mailto:studygrw@gmail.com">studygrw@gmail.com</a>
            or call +92 3229859984.
        </p>

    </div>

    @include('footer')

    @include('Modal scripts')

</body>
</html>