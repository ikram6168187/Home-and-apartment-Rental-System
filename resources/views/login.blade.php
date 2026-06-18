<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Smart Rent Login</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

/* BACKGROUND */
body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(120deg,#f57e07,#6dd5fa);
}

/* MAIN CARD */
.login-card{
    width:700px;
    height:480px;
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    display:flex;
    box-shadow:0 12px 35px rgba(0,0,0,0.2);
}

/* LEFT SIDE */
.left-side{
    width:45%;
    position:relative;
}

.left-side img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* LOGO */
.logo{
    position:absolute;
    top:15px;
    left:15px;
    background:#fff;
    padding:6px 12px;
    border-radius:10px;
    font-size:18px;
    font-weight:bold;
    color:#0d3b66;
    display:flex;
    gap:6px;
    align-items:center;
}

/* OVERLAY TEXT */
.overlay{
    position:absolute;
    bottom:25px;
    left:20px;
    color:#fff;
}

.overlay h1{
    font-size:26px;
    font-weight:bold;
}

.overlay p{
    font-size:13px;
}

/* RIGHT SIDE */
.right-side{
    width:55%;
    padding:30px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.right-side h2{
    font-size:26px;
    font-weight:bold;
    color:#2b2d42;
}

.subtitle{
    font-size:13px;
    color:#777;
    margin-bottom:18px;
}

/* INPUT */
.input-group{
    margin-bottom:12px;
}

.input-group-text{
    background:#fff;
    border-right:none;
}

.form-control{
    border-left:none;
    font-size:14px;
    padding:10px;
}

.form-control:focus{
    box-shadow:none;
    border-color:#ced4da;
}

/* OPTIONS */
.options{
  display:flex;
    justify-content:flex-end;
    align-items:center;
    font-size:13px;
    margin-bottom:15px;
}

.options a{
    text-decoration:none;
    color:#6c63ff;
}

/* LOGIN BUTTON */
.login-btn{
    width:100%;
    padding:11px;
    border:none;
    border-radius:30px;
    background:linear-gradient(to right,#74c69d,#4ea8de);
    color:#fff;
    font-size:16px;
    font-weight:bold;
    transition:0.3s;
}

.login-btn:hover{
    transform:translateY(-2px);
}

/* DIVIDER */
.divider{
    text-align:center;
    margin:15px 0;
    font-size:12px;
    color:#999;
    position:relative;
}

.divider::before,
.divider::after{
    content:"";
    position:absolute;
    width:35%;
    height:1px;
    background:#ddd;
    top:50%;
}

.divider::before{ left:0; }
.divider::after{ right:0; }

/* SOCIAL */
.social-login{
    display:flex;
    justify-content:center;
    gap:10px;
}

.social-login button{
    border:1px solid #ddd;
    background:#fff;
    padding:7px 15px;
    border-radius:30px;
    transition:0.3s;
}

.social-login button:hover{
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.social-login a{
    text-decoration:none;
    font-size:13px;
    color:#333;
}

/* GOOGLE ICON */
.google-icon{
    background: conic-gradient(
        #4285F4 0deg 90deg,
        #34A853 90deg 180deg,
        #FBBC05 180deg 270deg,
        #EA4335 270deg 360deg
    );
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
    margin-right:5px;
}

/* FACEBOOK ICON */
.facebook-icon{
    color:#1877F2;
    margin-right:5px;
}

/* SIGNUP */
.signup-link{
    text-align:center;
    margin-top:15px;
    font-size:13px;
}

.signup-link a{
    color:#6c63ff;
    font-weight:bold;
    text-decoration:none;
}

/* FOOTER */
.footer{
    text-align:center;
    margin-top:15px;
    font-size:11px;
    color:#999;
}

.footer a{
    color:#777;
    text-decoration:none;
    margin:0 5px;
}

</style>
</head>

<body>

<div class="login-card">

    <!-- LEFT SIDE -->
    <div class="left-side">

        <!--<div class="logo">
            <i class="fa-solid fa-house"></i>
            Smart Rent
        </div>-->

        <img src="{{ asset('images/login.png') }}" alt="login image">

        <!--<div class="overlay">
            <h1>Welcome Back!</h1>
            <p>Log in to your account</p>
        </div>-->

    </div>


    <!-- RIGHT SIDE -->
    <div class="right-side">
@if(session('success'))
    <p style="color:green; font-size:13px; margin-bottom:10px;">
        {{ session('success') }}
    </p>
@endif
        <h2>Login</h2>
        <p class="subtitle">Enter your credentials to continue</p>

        <form method="POST" action="/login">
            @csrf

            <!-- EMAIL -->
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-regular fa-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Enter your email">
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-lock"></i>
                </span>

                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">

                <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                    <i class="fa-regular fa-eye" id="eye"></i>
                </span>
            </div>
@if(session('error'))
    <div style="color:red; font-size:13px; margin-bottom:10px; text-align:center;">
        {{ session('error') }}
    </div>
@endif
            <!-- OPTIONS -->
            <div class="options" style="justify-content:flex-end;">
               <a href="#">Forgot Password?</a>
              </div>
            <!-- BUTTON -->
            <button class="login-btn">Login</button>

        </form>

        <!-- DIVIDER -->
        <div class="divider">or continue with</div>

        <!-- SOCIAL -->
        <div class="social-login">

            <button>
                <a href="#">
                    <i class="fa-brands fa-google google-icon"></i>
                    Google
                </a>
            </button>

            <button>
                <a href="#">
                    <i class="fa-brands fa-facebook facebook-icon"></i>
                    Facebook
                </a>
            </button>

        </div>

        <!-- SIGNUP -->
        <div class="signup-link">
            Don't have an account? <a href="/signup">Sign Up</a>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <a href="#">Privacy</a> | 
            <a href="#">Terms</a> | 
            © 2026 Smart Rent
        </div>

    </div>

</div>

<script>
function togglePassword(){
    let password = document.getElementById("password");
    let eye = document.getElementById("eye");

    if(password.type === "password"){
        password.type = "text";
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
    }else{
        password.type = "password";
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");
    }
}
</script>

</body>
</html>