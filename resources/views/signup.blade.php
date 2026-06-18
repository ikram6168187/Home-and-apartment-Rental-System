<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

<style>

body{
    background:linear-gradient(120deg,#f57e07,#6dd5fa);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial;
}

/* ✅ CHANGED: smaller + compact card */
.card-box{
    width:700px;
    height:480px;   /* 👈 reduced from 520px */
    display:flex;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

/* Left Image */
.left{
    width:50%;
}
.left img{
    width:350px;
    height:100%;
    object-fit:cover;
}

/* Right Form */
.right{
    width:50%;
    padding:20px;   /* 👈 slightly reduced from 25px */
    background:#fff;
    display:flex;
    flex-direction:column;
}

/* TEXT */
.right h4{
    margin-bottom:4px;
    font-size:18px;   /* 👈 slightly compact */
}

.right p{
    font-size:12px;
    color:#666;
    margin-bottom:8px; /* 👈 reduced spacing */
}

/* INPUT */
.input-group{
    margin-top:8px; /* 👈 reduced spacing */
}

.form-control{
    font-size:14px;
    padding:8px; /* 👈 compact input */
}

/* BUTTON */
.btn-custom{
    width:100%;
    padding:10px; /* 👈 slightly reduced */
    border:none;
    border-radius:30px;
    background:linear-gradient(to right,#74c69d,#4ea8de);
    color:#fff;
    font-size:15px;
    font-weight:bold;
    transition:0.3s;
}

.btn-custom:hover{
    background:#1c5980;
}

/* LOGIN TEXT */
.login{
    text-align:center;
    margin-top:8px; /* 👈 reduced */
    font-size:13px;
}

/* CONTINUE TEXT */
.continue-text{
    text-align:center;
    font-size:12px;
    color:#999;
    margin-top:8px; /* 👈 reduced */
    position:relative;
}

.continue-text::before,
.continue-text::after{
    content:"";
    position:absolute;
    width:30%;
    height:1px;
    background:#ddd;
    top:50%;
}

.continue-text::before{ left:0; }
.continue-text::after{ right:0; }

/* SOCIAL */
.social-accounts{
    display:flex;
    justify-content:center;
    gap:10px;
    flex-wrap:wrap;
    margin-top:8px; /* 👈 reduced */
}

.social-accounts button{
    padding:6px 16px; /* 👈 compact */
    border-radius:40px;
    border:1px solid #ddd;
    background-color:white;
    transition:0.3s;
}

.social-accounts button:hover{
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.social-accounts button a{
    text-decoration:none;
    color:black;
    font-size:13px;
    font-weight:500;
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
    font-size:16px;
    margin-right:5px;
}

/* FACEBOOK ICON */
.facebook-icon{
    color:#1877F2;
    margin-right:5px;
}

/* FOOTER */
.footer{
    text-align:center;
    margin-top:10px; /* 👈 reduced */
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

<div class="card-box">

    <!-- LEFT -->
    <div class="left">
        <img src="{{ asset('images/register.png') }}" alt="">
    </div>

    <!-- RIGHT -->
    <div class="right">

        <h4 class="d-flex align-items-center gap-2 mb-1">
            <i class="fa-solid fa-house-lock text-primary"></i>
            Create Account
        </h4>

        <p>Sign up to continue</p>

        <form method="POST" action="/signup">
            @csrf

            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="name" placeholder="Name"value="{{ old('name') }}">
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                <span class="input-group-text toggle-eye" onclick="togglePassword('password', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                <span class="input-group-text toggle-eye" onclick="togglePassword('confirm_password', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
          @error('password')
    <div style="color:red; font-size:12px;">
        {{ $message }}
    </div>
@enderror
           <div class="form-check mt-2 d-flex align-items-center" style="gap:8px;">
    
    <input class="form-check-input mt-0" type="checkbox" name="terms">

    <label class="form-check-label small mb-0">

        I agree to 
        <a href="#" style="text-decoration:none;">
            Terms
        </a>
        &
        <a href="#" style="text-decoration:none;">
            Privacy Policy
        </a>

    </label>

</div>
       @error('terms')
    <div style="color:red; font-size:12px; margin-top:4px;">
        {{ $message }}
    </div>
@enderror

            <button class="btn btn-custom w-100 mt-2">Sign Up</button>

        </form>

        <div class="login">
            Already have account? <a href="/login">Login</a>
        </div>

        <!-- CONTINUE WITH -->
        <div class="continue-text">
            or continue with
        </div>

        <!-- SOCIAL -->
        <div class="social-accounts">

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

        <!-- FOOTER -->
        <div class="footer">
            <a href="#">Privacy</a> | 
            <a href="#">Terms</a> | 
            © 2026 Smart Rent
        </div>

    </div>

</div>

<script>
function togglePassword(fieldId, icon){
    let input = document.getElementById(fieldId);
    let iconTag = icon.querySelector("i");

    if(input.type === "password"){
        input.type = "text";
        iconTag.classList.remove("fa-eye");
        iconTag.classList.add("fa-eye-slash");
    }else{
        input.type = "password";
        iconTag.classList.remove("fa-eye-slash");
        iconTag.classList.add("fa-eye");
    }
}
</script>

</body>
</html>