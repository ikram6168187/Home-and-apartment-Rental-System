<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

    @include('Modal style')

<style> 
* { margin:0;
    padding:0; 
    box-sizing:border-box; 
    font-family:'Segoe UI', Arial, sans-serif;
} 
body {
    background:#f4f6f9; 
    color:#1a1a2e; 
} 
a {
    text-decoration:none; 
    color:inherit; 
} 
 
/* HERO */ 
.contact-hero { 
    background: linear-gradient(135deg, rgb(51,47,46) 0%, #5c4a3a 100%); 
    padding: 70px 5% 60px; 
    text-align: center; 
    position: relative; 
    overflow: hidden; 
    margin: 35px 2.5% 0; 
    border-radius: 25px; 
} 
.contact-hero::before { 
    content:''; 
    position:absolute; 
    top:-150px; 
    right:-80px; 
    width:400px; 
    height:400px; 
    border-radius:50%; 
    background:rgba(255,255,255,0.04); 
} 
.contact-hero::after { 
    content:''; 
    position:absolute; 
    width:250px; 
    height:250px; 
    border-radius:50%; 
    background:rgba(255,255,255,0.04); 
    bottom:-80px; 
    left:-40px; 
} 
.hero-badge { 
    display:inline-block; 
    background:rgba(255,255,255,0.12); 
    color:#e8d5b7; padding:5px 16px; 
    border-radius:20px; font-size:12px; 
    font-weight:500; margin-bottom:14px; 
    border:1px solid rgba(255,255,255,0.15); 
} 
.contact-hero h1 { color:#fff; font-size:40px; font-weight:700; margin-bottom:12px; } 
.contact-hero h1 span { color:#e8d5b7; } 
.contact-hero p { color:rgba(255,255,255,0.7); font-size:15px; max-width:500px; margin:0 auto; line-height:1.7; } 
 
/* BODY */ 
.contact-body { 
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20;
    padding: 50px 10px; 
    width: 95%;
    /* max-width: 1100px;  */
    margin: 35px auto; 
    border-radius: 25px; 
} 
 
/* MAIN GRID */ 
.contact-grid { 
    display: grid; 
    grid-template-columns: 1fr 1.5fr; 
    gap: 28px; 
    margin-bottom: 80px; 
    width: 90%;
} 
 
/* INFO CARDS */ 
.info-cards { 
    display: flex; 
    flex-direction: column;
    justify-content: center; 
    gap: 14px; 
} 
.info-card { 
    background: #fff; 
    border-radius: 14px; 
    padding: 18px 20px; 
    border: 1px solid #eee; 
    display: flex; 
    align-items: flex-start; 
    gap: 14px; 
    transition: 0.3s; 
} 
.info-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.07); transform: translateY(-2px); } 
.info-icon { 
    width: 44px; height: 44px; 
    border-radius: 12px; 
    background: #f5ede0; 
    display: flex; align-items: center; justify-content: center; 
    font-size: 18px; color: rgb(51,47,46); flex-shrink: 0; 
} 
.info-card h4 { font-size: 13px; font-weight: 700; color: #1a1a2e; margin: 0 0 4px; } 
.info-card p  { font-size: 13px; color: #888; margin: 0; line-height: 1.6; } 
 
/* MAP */ 
.map-card { 
    background: #fff; 
    border-radius: 14px; 
    overflow: hidden; 
    border: 1px solid #eee; 
    margin-top: 14px; 
} 
.map-card iframe { 
    width: 100%; 
    height: 160px; 
    border: none; 
    display: block; 
} 
.map-footer { 
    padding: 10px 16px; 
    display: flex; align-items: center; gap: 8px; 
    font-size: 12px; color: #666; 
} 
.map-footer i { color: rgb(51,47,46); } 
 
/* FORM CARD */ 
.form-card { 
    background: #fff; 
    border-radius: 14px; 
    padding: 32px 30px; 
    border: 1px solid #eee; 
} 
.form-card h3 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; } 
.form-card .form-sub { font-size: 13px; color: #888; margin-bottom: 22px; } 
 
.fgroup { margin-bottom: 14px; } 
.fgroup label { display: block; font-size: 12px; font-weight: 600; color: #555; margin-bottom: 5px; } 
.fgroup input, 
.fgroup select, 
.fgroup textarea { 
    width: 100%; 
    padding: 10px 14px; 
    border: 1.5px solid #e0e0e0; 
    border-radius: 10px; 
    font-size: 13px; 
    color: #333; 
    outline: none; 
    background: #fafafa; 
    transition: border-color 0.2s; 
    font-family: 'Segoe UI', Arial, sans-serif; 
} 
.fgroup input:focus, 
.fgroup select:focus, 
.fgroup textarea:focus { 
    border-color: rgb(51,47,46); 
    background: #fff; 
} 
.fgroup textarea { min-height: 110px; resize: vertical; } 
.fgrid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; } 
 
.submit-btn { 
    width: 100%; 
    padding: 13px; 
    border: none; 
    border-radius: 30px; 
    background: linear-gradient(to right, rgb(51,47,46), #8a6040); 
    color: #fff; 
    font-size: 15px; 
    font-weight: 600; 
    cursor: pointer; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    gap: 8px; 
    transition: 0.3s; 
    margin-top: 6px; 
    font-family: 'Segoe UI', Arial, sans-serif; 
} 
.submit-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); } 
 
/* SUCCESS ALERT */ 
.alert-success { 
    background: #f0fff4; 
    border: 1px solid #b2dfdb; 
    color: #1b5e20; 
    border-radius: 10px; 
    padding: 14px 18px; 
    margin-bottom: 20px; 
    font-size: 13px; 
    display: flex; 
    align-items: center; 
    gap: 8px; 
} 
 
/* FAQ */ 
.faq-section {
     /* margin-top: 10px; */
     border: 1px solid black;
     background: linear-gradient(135deg, rgb(51, 47, 46), #5c4a3a);
     border-radius: 20px;
     width: 100%;
     padding: 50px;
 } 
.faq-header { text-align: center; margin-bottom: 24px; } 
.faq-header h2 { font-size: 32px; font-weight: 700; color: #ffffff; margin-bottom: 6px; } 
.faq-header p  { 
    font-size: 16px;
    color: rgba(255, 255, 255, 0.75);
} 
.faq-grid { 
    display: grid; 
    grid-template-columns: repeat(2, 1fr); 
    gap: 14px; 
} 
.faq-card { 
    background: #fff; 
    border-radius: 12px; 
    padding: 20px; 
    border: 1px solid #eee; 
    transition: 0.3s; 
} 
.faq-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.06); } 
.faq-card h4 { 
    font-size: 14px; font-weight: 600; 
    color: #1a1a2e; 
    /* margin-bottom: 8px;  */
    display: flex; align-items: center; gap: 8px; 
} 
.faq-card h4 i { color: rgb(51,47,46); font-size: 14px; } 
.faq-card p { font-size: 13px; color: #888; line-height: 1.6; margin: 0; } 
 
/* =========================================================
   FOOTER (UPDATED)
   ========================================================= */

/* .footer {
    width: 100%;
    margin: 50px 0 0 !important;
    border-radius: 0;
    border-top: none;
    background: #0f0e0d;
    padding: 60px 5% 30px;
} */

/* FOOTER GRID */
/* .footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 40px;
    margin-bottom: 50px;
} */

/* FOOTER BRAND */
/* .footer-brand .f-logo {
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
} */

/* SOCIAL LINKS */
/* .social-links {
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
} */


/* =========================================================
   MOBILE RESPONSIVE
   ========================================================= */
 
@media (max-width: 768px) { 
    .contact-grid, .faq-grid { grid-template-columns: 1fr; } 
    .fgrid2 { grid-template-columns: 1fr; } 
    .contact-hero h1 { font-size: 28px; }

    /* Footer Responsive */
    /* .footer {
        width: 100%;
        margin: 20px 0 0 !important;
        border-radius: 0;
    } */

    /* .footer-grid {
        grid-template-columns: 1fr 1fr;
    } */
} 

</style>
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
                    <span>Main Boulevard, Gujranwala, Punjab, Pakistan</span>
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
            // User login hai to form submit kar do
            document.getElementById('contactForm').submit();
        } else {
            // User login nahi hai to aapka login modal open hoga
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