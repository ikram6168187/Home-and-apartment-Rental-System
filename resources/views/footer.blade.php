<!-- Footer CSS Link Integration -->
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

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
                <!-- Facebook link:  -->
                <a href="https://www.facebook.com/AapKaProfileYaPage" target="_blank" class="social-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                
                <!-- Instagram link: -->
                <a href="https://www.instagram.com/muhammadsufyan1838?stkn=MWh6YnU0ZGVpeTk5ZA==" target="_blank" class="social-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                
                <!-- Twitter link: -->
                <a href="https://x.com/ikram6168187" target="_blank" class="social-link" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                
                <!-- WhatsApp  -->
                <a href="https://wa.me/923096020900" target="_blank" class="social-link" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('services.index') }}">Services</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
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
                <li>
                    <a href="{{ route('home', ['type' => 'house']) }}#properties">
                        Houses
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['type' => 'apartment']) }}#properties">
                        Apartments
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['type' => 'room']) }}#properties">
                        Rooms
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['type' => 'shop']) }}#properties">
                        Shops
                    </a>
                </li>
                <li>
                    <a href="{{ route('home', ['type' => 'office']) }}#properties">
                        Offices
                    </a>
                </li>
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
                    <a href="mailto:studygrw@gmail.com">
                        <span>studygrw@gmail.com</span>
                    </a>
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <a href="tel:+923229859984">
                        <span>+92 3229859984</span>
                    </a>
                </li>
                <li>
                    <i class="fa-solid fa-clock"></i>
                    <span>Mon–Sat, 9am–6pm</span>
                </li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} Smart Rent. All rights reserved.</p>

        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="{{ route('contact') }}">Support</a>
        </div>
    </div>
</footer>