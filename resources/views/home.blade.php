<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rent</title>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>

/* multiple */
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Times New Roman', Times, serif;
}

a{
    text-decoration: none;
    color: white;
}

body{
    background: #f5f5f5;
}

.a{
    display: flex;
    justify-content: center;
}

/* header */
.header{
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    flex-wrap: wrap;

    background-color: rgb(51, 47, 46);
    width: 95%;
    padding: 20px 20px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

/* logo */
.logo{
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo a{
    text-decoration: none;
    color: white;
}

/* Navbar */

.navbar ul{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
    list-style:none;
    margin:0;
    padding:0;
}

.navbar ul li{
    border-radius:8px;
    transition:0.3s ease;
}

.navbar ul li a{
    display:block;
    padding:10px 18px;
    text-decoration:none;
    color:white;
    font-weight:600;
    border-radius:8px;
    transition:0.3s ease;
}

/* Hover Effect */
.navbar ul li a:hover{
    background:#555;
    box-shadow:0 4px 12px rgba(0,0,0,0.35);
    transform:translateY(-2px);
}

/* Active Page */
.navbar ul li a.active{
    background:#555;
    box-shadow:0 4px 12px rgba(0,0,0,0.35);
}
/* icons */

.icons{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    color: white;
}
.add-property{
    display: inline-block;
    padding: 10px 18px;
    border: 1px solid rgb(252, 246, 246);
    border-radius: 25px;
    color: rgb(243, 253, 245);
    cursor: pointer;
    transition: 0.2s;
     background-color:rgb(16, 16, 17);
}

.add-property:hover{
    cursor: pointer;
    transform: translateY(-3px);
}
.circle{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 30px;
    width: 30px;
    padding: 20px;
    border-radius: 50%;
    border: 1px solid white;
    color: white;
}

@media screen and (max-width: 480px) {
    .header{
        display: block;
        flex-direction: column;
    }
}

/* hero Section */

.b{
    margin-top: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero{
    width: 95%;
    background-image: url('images/hero1.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    object-fit: cover;
    border-radius: 20px;
}

.content{
    border-radius: 20px;
    height: 440px;
    background-color: rgba(40, 40, 40, 0.4);
    color: white;
    padding: 100px 0px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 20px;
}

.box{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    width: 80%;
    gap: 20px;
    background-color: white;
    color: black;
    padding: 10px 40px;
    border-radius: 10px;
}

.box1{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    flex-direction: column;
}

.box1 input{
    padding: 5px;
    text-align: center;
}

/* cities */

.c{
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

.cities{
    width: 95%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.city{
    width: 150px;
    height: 150px;
    background: white;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0px 2px 10px rgba(0,0,0,0.1);
    transition: 0.3s ease-in-out;
    cursor: pointer;
}

.city:hover{
    transform: translateY(-8px);
    box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
}

.city img{
    width: 80px;
    height: 80px;
    object-fit: contain;
    margin-bottom: 12px;
    transition: 0.3s;
}

.city:hover img{
    transform: scale(1.1);
}

.city a{
    color: black;
    font-weight: bold;
    text-decoration: none;
    font-size: 13px;
}

/* dropdown */
.custom-dropdown {
    position: absolute;
    top: 50px;
    right: 0;
    background-color: #ffffff;
    min-width: 180px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.15);
    border-radius: 8px;
    z-index: 1000;
    padding: 10px 0;
    text-align: left;
}

.custom-dropdown ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.custom-dropdown ul li a {
    color: #333;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    font-size: 14px;
    transition: background 0.2s;
}

.custom-dropdown ul li a:hover {
    background-color: #f5f5f5;
    color: #007bff;
}

.custom-dropdown ul li a i {
    margin-right: 8px;
    width: 15px;
}

.text-danger {
    color: #dc3545 !important;
}

/* ===================== */
/* LOGIN MODAL CSS       */
/* ===================== */

.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.60);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.2s ease;
}

.modal-overlay.active {
    display: flex;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(30px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}

/* Aapka wala card design */
.login-card {
    width: 700px;
    max-width: 95vw;
    height: auto;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    box-shadow: 0 20px 60px rgba(0,0,0,0.35);
    animation: slideUp 0.25s ease;
    position: relative;
}

/* Close button */
.modal-close {
    position: absolute;
    top: 14px;
    right: 16px;
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #666;
    z-index: 10;
    line-height: 1;
    transition: color 0.2s;
}
.modal-close:hover { color: #111; }

/* LEFT SIDE — image */
.modal-left {
    width: 50%;
    position: relative;
    min-height: 460px;
}
.modal-left img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* RIGHT SIDE — form */
.modal-right {
    width: 50%;
    padding: 36px 30px 28px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-family: Arial, sans-serif;
}

.modal-right h2 {
    font-size: 26px;
    font-weight: bold;
    color: #2b2d42;
    margin-bottom: 4px;
}

.modal-subtitle {
    font-size: 13px;
    color: #777;
    margin-bottom: 18px;
}

/* Input groups — Bootstrap style */
.m-input-group {
    display: flex;
    align-items: center;
    border: 1px solid #ced4da;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 14px;
}
.m-input-group-icon {
    padding: 0 12px;
    background: #fff;
    color: #888;
    font-size: 15px;
    border-right: 1px solid #ced4da;
    height: 44px;
    display: flex;
    align-items: center;
}
.m-input-group input {
    flex: 1;
    border: none;
    outline: none;
    padding: 10px 12px;
    font-size: 14px;
    color: #333;
    background: #fff;
}
.m-input-group .eye-toggle {
    padding: 0 12px;
    background: #fff;
    border: none;
    cursor: pointer;
    color: #888;
    font-size: 15px;
    height: 44px;
    display: flex;
    align-items: center;
    border-left: 1px solid #ced4da;
}

.m-forgot {
    text-align: right;
    font-size: 13px;
    margin-bottom: 14px;
}
.m-forgot a { color: #6c63ff; text-decoration: none; }

.m-login-btn {
    width: 100%;
    padding: 11px;
    border: none;
    border-radius: 30px;
    background: linear-gradient(to right, #74c69d, #4ea8de);
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    font-family: Arial, sans-serif;
}
.m-login-btn:hover { transform: translateY(-2px); }

.m-divider {
    text-align: center;
    margin: 14px 0;
    font-size: 12px;
    color: #999;
    position: relative;
}
.m-divider::before, .m-divider::after {
    content: "";
    position: absolute;
    width: 35%;
    height: 1px;
    background: #ddd;
    top: 50%;
}
.m-divider::before { left: 0; }
.m-divider::after  { right: 0; }

.m-social {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 12px;
}
.m-social button {
    border: 1px solid #ddd;
    background: #fff;
    padding: 7px 15px;
    border-radius: 30px;
    cursor: pointer;
    transition: 0.3s;
    font-size: 13px;
    color: #333;
}
.m-social button:hover { box-shadow: 0 3px 10px rgba(0,0,0,0.1); }

.google-icon {
    background: conic-gradient(#4285F4 0deg 90deg,#34A853 90deg 180deg,#FBBC05 180deg 270deg,#EA4335 270deg 360deg);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-right: 5px;
}
.facebook-icon { color: #1877F2; margin-right: 5px; }

.m-signup {
    text-align: center;
    font-size: 13px;
    color: #888;
}
.m-signup a { color: #6c63ff; font-weight: bold; text-decoration: none; }

.m-footer {
    text-align: center;
    margin-top: 10px;
    font-size: 11px;
    color: #999;
}
.m-footer a { color: #777; text-decoration: none; margin: 0 4px; }

.error-alert {
    background: #fff0f0;
    border: 1px solid #ffcdd2;
    color: #c0392b;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 13px;
    margin-bottom: 12px;
}
/* LOGOUT CONFIRM MODAL */
.logout-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 99999;
    justify-content: center;
    align-items: center;
}
.logout-overlay.active { display: flex; }
.logout-box {
    background: #fff;
    border-radius: 16px;
    padding: 36px 32px 28px;
    width: 360px;
    text-align: center;
    box-shadow: 0 16px 50px rgba(0,0,0,0.25);
}
.logout-icon {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: #fff0f0;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    font-size: 26px; color: #dc3545;
}
.logout-box h3 { font-size: 20px; font-weight: 700; color: #2b2d42; margin-bottom: 8px; }
.logout-box p  { font-size: 13px; color: #888; margin-bottom: 24px; }
.logout-btns   { display: flex; gap: 12px; }
.btn-cancel {
    flex: 1; padding: 11px;
    border: 1.5px solid #ddd; border-radius: 30px;
    background: #fff; color: #555; font-size: 14px; font-weight: 600; cursor: pointer;
}
.btn-cancel:hover { background: #f5f5f5; }
.btn-logout-confirm {
    flex: 1; padding: 11px;
    border: none; border-radius: 30px;
    background: #dc3545; color: #fff; font-size: 14px; font-weight: 600; cursor: pointer;
}
.btn-logout-confirm:hover { background: #b02a37; }
</style>

</head>

<body>

    <!-- header -->
    <div class="a">
        <div class="header">

            <!-- logo -->
            <div class="logo">
                <h1>
                    <a href="#">
                        <i class="fa-solid fa-house-chimney"></i>
                        Smart Rent
                    </a>
                </h1>
            </div>

            <!-- navbar -->
            <div class="navbar">
                <ul>
                   <li>
    <a href="/home" class="{{ request()->is('home') ? 'active' : '' }}">
        Home
    </a>
</li>

<li>
    <a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">
        About
    </a>
</li>

<li>
    <a href="/contact" class="{{ request()->is('contact') ? 'active' : '' }}">
        Contact
    </a>
</li>
                </ul>
            </div>

            <!-- icons -->
            <div class="icons">

                @if(Auth::check())
                    <a href="{{ route('property.create') }}">
                        <p class="add-property">add property</p>
                    </a>
                @else
                    {{-- Login modal open karo, page change mat karo --}}
                    <a href="javascript:void(0);" onclick="openLoginModal()">
                        <p class="add-property">add property</p>
                    </a>
                @endif

                <div class="circle">
                    <a href="#">
                        <i class="fa-solid fa-globe"></i>
                    </a>
                </div>

                <div class="circle" style="position: relative;">
                    <a href="javascript:void(0);" onclick="toggleMenu()" style="text-decoration: none; color: inherit;">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </a>

                    <div id="dropdownMenu" class="custom-dropdown" style="display: none;">
                        <ul>
                            @guest
                                {{-- Login link — modal kholta hai, page nahi badalta --}}
                                <li>
                                    <a href="javascript:void(0);" onclick="toggleMenu(); openLoginModal();">
                                        <i class="fa-solid fa-right-to-bracket"></i> Login
                                    </a>
                                </li>
                                <li><a href="javascript:void(0);" onclick="toggleMenu(); openSignupModal();"><i class="fa-solid fa-user-plus"></i> Signup</a></li>
                            @endguest

                            @auth
                                <li><a href="{{ route('Dashboard') }}"><i class="fa-solid fa-gauge"></i> My account</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); toggleMenu(); openLogoutConfirm();" class="text-danger">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                       </a>
                                </li>
                            @endauth

                            <hr style="margin: 5px 0; border-color: #eee;">
                            <li><a href="#"><i class="fa-solid fa-headset"></i> Support & Help</a></li>
                            <li><a href="#"><i class="fa-solid fa-circle-info"></i> About System</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- end icons -->

        </div>
    </div>
    <!-- end header -->


    <!-- ======================== -->
    <!-- LOGIN MODAL              -->
    <!-- ======================== -->
    <div class="modal-overlay" id="loginModal" onclick="handleOverlayClick(event)">
        <div class="login-card">

            <button class="modal-close" onclick="closeLoginModal()" aria-label="Close">&times;</button>

            <!-- LEFT SIDE — image -->
            <div class="modal-left">
                <img src="{{ asset('images/login.png') }}" alt="Smart Rent">
            </div>

            <!-- RIGHT SIDE — form -->
            <div class="modal-right">

                @if(session('success'))
                    <p style="color:green; font-size:13px; margin-bottom:10px;">{{ session('success') }}</p>
                @endif

                @if($errors->any())
                    <div class="error-alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <h2>Login</h2>
                <p class="modal-subtitle">Enter your credentials to continue</p>

                <form method="POST" action="{{ route('home.login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="m-input-group">
                        <span class="m-input-group-icon">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" placeholder="Enter your email"
                               value="{{ old('email') }}" required autocomplete="email">
                    </div>

                    <!-- PASSWORD -->
                    <div class="m-input-group">
                        <span class="m-input-group-icon">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="modal_password" name="password"
                               placeholder="Enter your password" required>
                        <button type="button" class="eye-toggle" onclick="toggleModalPassword()">
                            <i class="fa-regular fa-eye" id="modal_eye"></i>
                        </button>
                    </div>

                    <!-- FORGOT -->
                    <div class="m-forgot">
                        <a href="#">Forgot Password?</a>
                    </div>

                    <!-- LOGIN BUTTON -->
                    <button type="submit" class="m-login-btn">Login</button>
                </form>

                <!-- DIVIDER -->
                <div class="m-divider">or continue with</div>

                <!-- SOCIAL -->
                <div class="m-social">
                    <button><i class="fa-brands fa-google google-icon"></i> Google</button>
                    <button><i class="fa-brands fa-facebook facebook-icon"></i> Facebook</button>
                </div>

                <!-- SIGNUP -->
                <div class="m-signup">
                    Don't have an account? <a href="javascript:void(0);" onclick="closeLoginModal(); openSignupModal();">Sign Up</a>
                </div>

                <!-- FOOTER -->
                <div class="m-footer">
                    <a href="#">Privacy</a> |
                    <a href="#">Terms</a> |
                    © 2026 Smart Rent
                </div>

            </div>

        </div>
    </div>
    <!-- end LOGIN MODAL -->


    <!-- ======================== -->
    <!-- SIGNUP MODAL             -->
    <!-- ======================== -->
    <div class="modal-overlay" id="signupModal" onclick="handleSignupOverlayClick(event)">
        <div class="login-card">

            <button class="modal-close" onclick="closeSignupModal()" aria-label="Close">&times;</button>

            <!-- LEFT SIDE — image -->
            <div class="modal-left">
                <img src="{{ asset('images/register.png') }}" alt="Smart Rent">
            </div>

            <!-- RIGHT SIDE — form -->
            <div class="modal-right" style="justify-content: flex-start; padding-top: 24px;">

                @if(session('reg_errors'))
                    <div class="error-alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ session('reg_errors') }}
                    </div>
                @endif

                <h2 style="font-size:20px; display:flex; align-items:center; gap:8px;">
                    <i class="fa-solid fa-house-lock" style="color:#4ea8de;"></i>
                    Create Account
                </h2>
                <p class="modal-subtitle">Sign up to continue</p>

                <form method="POST" action="{{ route('home.register') }}">
                    @csrf

                    <!-- NAME -->
                    <div class="m-input-group">
                        <span class="m-input-group-icon"><i class="fa fa-user"></i></span>
                        <input type="text" name="name" placeholder="Name"
                               value="{{ old('name') }}" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="m-input-group">
                        <span class="m-input-group-icon"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" placeholder="Email"
                               value="{{ old('email') }}" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="m-input-group">
                        <span class="m-input-group-icon"><i class="fa fa-lock"></i></span>
                        <input type="password" id="sig_password" name="password" placeholder="Password" required>
                        <button type="button" class="eye-toggle" onclick="toggleSigPass('sig_password','sig_eye1')">
                            <i class="fa-regular fa-eye" id="sig_eye1"></i>
                        </button>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="m-input-group">
                        <span class="m-input-group-icon"><i class="fa fa-lock"></i></span>
                        <input type="password" id="sig_password2" name="password_confirmation" placeholder="Confirm Password" required>
                        <button type="button" class="eye-toggle" onclick="toggleSigPass('sig_password2','sig_eye2')">
                            <i class="fa-regular fa-eye" id="sig_eye2"></i>
                        </button>
                    </div>

                    @error('password')
                        <div style="color:red; font-size:12px; margin-bottom:6px;">{{ $message }}</div>
                    @enderror

                    <!-- TERMS -->
                    <div style="display:flex; align-items:center; gap:8px; margin:8px 0; font-size:13px;">
                        <input type="checkbox" name="terms" id="terms" style="width:15px; height:15px;">
                        <label for="terms" style="margin:0; color:#555;">
                            I agree to <a href="#" style="color:#6c63ff;">Terms</a> &
                            <a href="#" style="color:#6c63ff;">Privacy Policy</a>
                        </label>
                    </div>

                    @error('terms')
                        <div style="color:red; font-size:12px; margin-bottom:6px;">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="m-login-btn">Sign Up</button>
                </form>

                <div class="m-divider">or continue with</div>

                <div class="m-social">
                    <button><i class="fa-brands fa-google google-icon"></i> Google</button>
                    <button><i class="fa-brands fa-facebook facebook-icon"></i> Facebook</button>
                </div>

                <div class="m-signup" style="margin-top:8px;">
                    Already have account?
                    <a href="javascript:void(0);" onclick="closeSignupModal(); openLoginModal();">Login</a>
                </div>

                <div class="m-footer">
                    <a href="#">Privacy</a> |
                    <a href="#">Terms</a> |
                    © 2026 Smart Rent
                </div>

            </div>
        </div>
    </div>
    <!-- end SIGNUP MODAL -->

    <!-- LOGOUT CONFIRM MODAL -->
<div class="logout-overlay" id="logoutConfirm">
    <div class="logout-box">
        <div class="logout-icon">
            <i class="fa-solid fa-right-from-bracket"></i>
        </div>
        <h3>Logout?</h3>
          <p>Are you sure you want to log out of your Smart Rent account?</p>
        <div class="logout-btns">
            <button class="btn-cancel" onclick="closeLogoutConfirm()">
                <i class="fa-solid fa-xmark"></i> Cancel
            </button>
            <button class="btn-logout-confirm" onclick="document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </div>
</div>

<!-- end logout MODAL -->

    <!-- hero Section -->
    <div class="b">
        <div class="hero">
            <div class="content">
                <p>Find Your Dream Place</p>
                <h1>For Better Experience</h1>
                <div class="box">
                    <div class="box1">
                        <p>Where</p>
                        <input type="text" placeholder="Search Destination">
                    </div>
                    <div class="box1">
                        <p>Check in</p>
                        <input type="datetime-local">
                    </div>
                    <div class="box1">
                        <p>Check Out</p>
                        <input type="datetime-local">
                    </div>
                    <div class="box1">
                        <p>Who</p>
                        <input type="number" placeholder="Add Guests">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero Section -->


    <!-- cities -->
    <div class="c">
        <div class="cities">
            <div class="city">
                <img src="images/lahore.png" alt="">
                <a href="#">LAHORE</a>
            </div>
            <div class="city">
                <img src="images/islamabad.png" alt="">
                <a href="#">ISLAMABAD</a>
            </div>
            <div class="city">
                <img src="images/karachi.png" alt="">
                <a href="#">KARACHI</a>
            </div>
            <div class="city">
                <img src="images/Gujranwala.png" alt="">
                <a href="#">GUJRANWALA</a>
            </div>
            <div class="city">
                <img src="images/faislabad.png" alt="">
                <a href="#">FAISALABAD</a>
            </div>
            <div class="city">
                <img src="images/peshawar.png" alt="">
                <a href="#">PESHAWAR</a>
            </div>
        </div>
    </div>
    <!-- end cities -->


    @foreach($properties as $property)
    <div class="card">
        <img src="{{ asset('property/'.$property->image) }}">
        <h3>{{ $property->title }}</h3>
        <p>{{ $property->location }}</p>
        <h4>${{ $property->price }}</h4>
        <a href="/booking/{{ $property->id }}">Book Now</a>
    </div>
    @endforeach


    <!-- JavaScript -->
    <script>

    // Password show/hide toggle
    function toggleModalPassword() {
        var p = document.getElementById('modal_password');
        var eye = document.getElementById('modal_eye');
        if (p.type === 'password') {
            p.type = 'text';
            eye.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            p.type = 'password';
            eye.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Login Modal open/close
    function openLoginModal() {
        document.getElementById('loginModal').classList.add('active');
        document.body.style.overflow = 'hidden'; // scroll band
    }

    function closeLoginModal() {
        document.getElementById('loginModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Overlay (dark background) click se band ho
    function handleOverlayClick(e) {
        if (e.target === document.getElementById('loginModal')) {
            closeLoginModal();
        }
    }

    // Password toggle — signup modal
    function toggleSigPass(fieldId, eyeId) {
        var p = document.getElementById(fieldId);
        var eye = document.getElementById(eyeId);
        if (p.type === 'password') {
            p.type = 'text';
            eye.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            p.type = 'password';
            eye.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Signup Modal open/close
    function openSignupModal() {
        document.getElementById('signupModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSignupModal() {
        document.getElementById('signupModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function handleSignupOverlayClick(e) {
        if (e.target === document.getElementById('signupModal')) {
            closeSignupModal();
        }
    }

    // ESC key se bhi band ho
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { closeLoginModal(); closeSignupModal(); }
    });

    // Agar login fail hua to auto-open karo
    @if(session('show_login'))
    openLoginModal();
@endif

@if(session('show_signup') || ($errors->any() && !session('show_login')))
    openSignupModal();
@endif


    // Dropdown menu
    function toggleMenu() {
        var menu = document.getElementById("dropdownMenu");
        menu.style.display = (menu.style.display === "none") ? "block" : "none";
    }

    window.onclick = function(event) {
        if (!event.target.matches('.fa-bars-staggered') &&
            !event.target.closest('.circle')) {
            var dropdown = document.getElementById("dropdownMenu");
            if (dropdown && dropdown.style.display === "block") {
                dropdown.style.display = "none";
            }
        }
    }

     </script>
            <script>
            function openLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.add('active');
                document.body.style.overflow = 'hidden';
            }
            function closeLogoutConfirm() {
                document.getElementById('logoutConfirm').classList.remove('active');
                document.body.style.overflow = '';
            }
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeLogoutConfirm();
            });
            </script>

</body>
</html>