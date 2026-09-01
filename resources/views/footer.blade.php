
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rent - Footer</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .footer {
            width: 100%;
            margin-top: 50px;
            background: #0f0e0d;
            padding: 60px 5% 30px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        .f-logo {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
        }

        .footer-brand p,
        .footer-col li,
        .footer-col a {
            font-size: 13px;
            color: rgba(255,255,255,.45);
        }

        .footer-brand p {
            line-height: 1.8;
            max-width: 260px;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            gap: 10px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.5);
            text-decoration: none;
            transition: .2s;
        }

        .social-link:hover {
            background: #332f2e;
            color: #fff;
        }

        .footer-col h4 {
            font-size: 13px;
            color: #fff;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col li {
            margin-bottom: 10px;
        }

        .footer-col a {
            text-decoration: none;
            transition: .2s;
        }

        .footer-col a:hover,
        .footer-links a:hover {
            color: #c8a882;
        }

        .footer-contact li {
            display: flex;
            gap: 8px;
            align-items: flex-start;
        }

        .footer-contact i {
            color: #c8a882;
            margin-top: 3px;
            min-width: 14px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .footer-bottom p,
        .footer-links a {
            font-size: 12px;
            color: rgba(255,255,255,.3);
            text-decoration: none;
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .footer {
                padding: 45px 6% 25px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 30px 25px;
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 480px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-brand {
                grid-column: auto;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

<footer class="footer">

    <div class="footer-grid">

        <div class="footer-brand">
            <div class="f-logo">
                <i class="fa-solid fa-house-chimney"></i> Smart Rent
            </div>

            <p>
                Pakistan's trusted rental platform connecting
                property owners with renters across the country.
            </p>

            <div class="social-links">
                <a href="#" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>

                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endauth
            </ul>
        </div>

        <div class="footer-col">
            <h4>Property Types</h4>
            <ul>
                <li><a href="#">Houses</a></li>
                <li><a href="#">Apartments</a></li>
                <li><a href="#">Rooms</a></li>
                <li><a href="#">Shops</a></li>
                <li><a href="#">Offices</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Contact Us</h4>
            <ul class="footer-contact">
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Main Market Satellite Town, Gujranwala<br>Punjab, Pakistan</span>
                </li>
                <li>
                    <i class="fa-solid fa-envelope"></i>
                    <span>studygrw@gmail.com</span>
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <span>+92 3229859984</span>
                </li>
                <li>
                    <i class="fa-solid fa-clock"></i>
                    <span>Mon–Sat, 9am–6pm</span>
                </li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2026 Smart Rent. All rights reserved.</p>

        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="{{ route('contact') }}">Support</a>
        </div>
    </div>

</footer>

</body>
</html>
```
