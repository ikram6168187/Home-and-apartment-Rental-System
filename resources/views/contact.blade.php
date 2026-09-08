<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us — Smart Rent</title>
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    
    <!-- External CSS File -->
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <!-- Standard HTML Path fallback: <link rel="stylesheet" href="styles.css"> -->

    @include('Modal style')
</head>
<body>

    {{-- NAVBAR --}}
    @include('navbar')

    {{-- MODALS --}}
    @include('Login modal')
    @include('Signup modal')
    @include('Logout modal')

    <!-- HERO -->
    <div class="contact-hero">
        <div class="hero-badge"><i class="fa-solid fa-headset"></i> We're Here to Help</div>
        <h1>Get in <span>Touch</span> With Us</h1>
        <p>Have a question or need help? Our team is always ready to assist you.</p>
    </div>

    <!-- BODY -->
    <div class="contact-body">

        <div class="contact-grid">

            <!-- LEFT — INFO + MAP -->
            <div>
                <div class="info-cards">
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <h4>Our Location</h4>
                            <p>Main Market satellite town, Gujranwala<br>Punjab, Pakistan</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <h4>Email Us</h4>
                            <p>studygrw@gmail.com<br></p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <h4>Call Us</h4>
                            <p>+92 3229859984<br>Mon–Sat, 9am–6pm</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-clock"></i></div>
                        <div>
                            <h4>Working Hours</h4>
                            <p>Monday – Saturday<br>9:00 AM – 6:00 PM PKT</p>
                        </div>
                    </div>
                </div>

                <!-- MAP -->
                <div class="map-card">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108857.8282396283!2d74.12426565!3d32.1616818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391f2975a4b1a67b%3A0x29f1f1e7f6c9cf03!2sGujranwala%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                    <div class="map-footer">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Main Market Satellite Town, Gujranwala, Punjab, Pakistan</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT — FORM -->
            <div class="form-card">
                <h3>Send Us a Message</h3>
                <p class="form-sub">Fill out the form and we'll get back to you within 24 hours.</p>

                <!-- Success Message Alert -->
                @if(session('contact_success'))
                    <div class="alert-success">
                        <i class="fa-solid fa-circle-check"></i> Thank you! Your message has been sent successfully.
                    </div>
                @endif

                <form id="contactForm" action="{{ route('contact.send') }}" method="POST">
                    @csrf

                    <div class="fgrid2">
                        <div class="fgroup">
                            <label>First Name *</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required placeholder="Muhammad">
                            @error('first_name') <small style="color:red;">{{ $message }}</small> @enderror
                        </div>
                        <div class="fgroup">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required placeholder="Ikram">
                            @error('last_name') <small style="color:red;">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="fgroup">
                        <label>Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
                        @error('email') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>

                    <div class="fgroup">
                        <label>Subject *</label>
                        <select name="subject" required>
                            <option value="" disabled selected>Select a subject</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Property Listing">Property Listing</option>
                            <option value="Support">Support</option>
                        </select>
                        @error('subject') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>

                    <div class="fgroup">
                        <label>Message *</label>
                        <textarea name="message" required placeholder="Write your message here...">{{ old('message') }}</textarea>
                        @error('message') <small style="color:red;">{{ $message }}</small> @enderror
                    </div>

                    <button type="button" onclick="handleContactSubmit()" class="submit-btn">
                        <i class="fa-solid fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- FAQ -->
        <div class="faq-section">
            <div class="faq-header">
                <h2>Frequently Asked Questions</h2>
                <p>Quick answers to common questions</p>
            </div>
            <div class="faq-grid">
                <div class="faq-card">
                    <h4><i class="fa-solid fa-circle-question"></i> How do I list my property?</h4>
                    <p>Create an account, click "Add Property" and fill in your property details. It's free and takes only a few minutes.</p>
                </div>
                <div class="faq-card">
                    <h4><i class="fa-solid fa-circle-question"></i> Is Smart Rent free to use?</h4>
                    <p>Yes! Browsing and booking properties on Smart Rent is completely free for renters.</p>
                </div>
                <div class="faq-card">
                    <h4><i class="fa-solid fa-circle-question"></i> How do I contact a property owner?</h4>
                    <p>Click on any property to view full details and contact the owner directly through our platform.</p>
                </div>
                <div class="faq-card">
                    <h4><i class="fa-solid fa-circle-question"></i> What cities are covered?</h4>
                    <p>We cover Lahore, Karachi, Islamabad, Gujranwala, Faisalabad, Peshawar and more cities coming soon.</p>
                </div>
            </div>
        </div>

    </div>

    @include('footer')
    {{-- MODAL SCRIPTS --}}
    @include('Modal scripts')

    <script>
        function handleContactSubmit() {
            var isLoggedIn = @json(auth()->check());

            if (isLoggedIn) {
                document.getElementById('contactForm').submit();
            } else {
                if (typeof openLoginModal === 'function') {
                    openLoginModal();
                } else if (typeof openModal === 'function') {
                    openModal('loginModal');
                } else {
                    var loginModal = document.getElementById('loginModal');
                    if (loginModal) {
                        loginModal.style.display = 'flex';
                    } else {
                        alert('Please login first to send a message.');
                    }
                }
            }
        }
    </script>

</body>
</html>