<div class="modal-overlay" id="signupModal" onclick="handleSignupOverlayClick(event)">
    <div class="login-card">
        <button class="modal-close" onclick="closeSignupModal()" aria-label="Close">&times;</button>
        <div class="modal-left">
            <img src="{{ asset('images/register.png') }}" alt="Smart Rent">
        </div>
        <div class="modal-right" style="justify-content:flex-start; padding-top:20px;">
            @if($errors->any() && session('show_signup'))
                <div class="error-alert">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif
            <h2 style="font-size:20px; display:flex; align-items:center; gap:8px;">
                <i class="fa-solid fa-house-lock" style="color:#4ea8de;"></i> Create Account
            </h2>
            <p class="modal-subtitle">Sign up to continue</p>
            <form method="POST" action="{{ route('home.register') }}">
                @csrf
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa fa-user"></i></span>
                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                </div>
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="sig_password" name="password" placeholder="Password" required>
                    <button type="button" class="eye-toggle" onclick="toggleSigPass('sig_password','sig_eye1')">
                        <i class="fa-regular fa-eye" id="sig_eye1"></i>
                    </button>
                </div>
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="sig_password2" name="password_confirmation" placeholder="Confirm Password" required>
                    <button type="button" class="eye-toggle" onclick="toggleSigPass('sig_password2','sig_eye2')">
                        <i class="fa-regular fa-eye" id="sig_eye2"></i>
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:8px; margin:8px 0; font-size:13px;">
                    <input type="checkbox" name="terms" id="terms" style="width:15px; height:15px;">
                    <label for="terms" style="margin:0; color:#555;">
                        I agree to <a href="#" style="color:#6c63ff;">Terms</a> & <a href="#" style="color:#6c63ff;">Privacy Policy</a>
                    </label>
                </div>
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
                <a href="#">Privacy</a> | <a href="#">Terms</a> | © 2026 Smart Rent
            </div>
        </div>
    </div>
</div>