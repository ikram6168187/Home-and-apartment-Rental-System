<div class="modal-overlay" id="loginModal" onclick="handleOverlayClick(event)">
    <div class="login-card">
        <button class="modal-close" onclick="closeLoginModal()" aria-label="Close">&times;</button>
        <div class="modal-left">
            <img src="{{ asset('images/login.png') }}" alt="Smart Rent">
        </div>
        <div class="modal-right">
            @if(session('success'))
                <p style="color:green; font-size:13px; margin-bottom:10px;">{{ session('success') }}</p>
            @endif
            @if($errors->any() && session('show_login'))
                <div class="error-alert">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif
            <h2>Login</h2>
            <p class="modal-subtitle">Enter your credentials to continue</p>
            <form method="POST" action="{{ route('home.login') }}">
                @csrf
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email">
                </div>
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" id="modal_password" name="password" placeholder="Enter your password" required>
                    <button type="button" class="eye-toggle" onclick="toggleModalPassword()">
                        <i class="fa-regular fa-eye" id="modal_eye"></i>
                    </button>
                </div>
                <div class="m-forgot"><a href="#">Forgot Password?</a></div>
                <button type="submit" class="m-login-btn">Login</button>
            </form>
            <div class="m-divider">or continue with</div>
            <div class="m-social">
                <button><i class="fa-brands fa-google google-icon"></i> Google</button>
                <button><i class="fa-brands fa-facebook facebook-icon"></i> Facebook</button>
            </div>
            <div class="m-signup">
                Don't have an Account?
                <a href="javascript:void(0);" onclick="closeLoginModal(); openSignupModal();">Sign Up</a>
            </div>
            <div class="m-footer">
                <a href="#">Privacy</a> | <a href="#">Terms</a> | © 2026 Smart Rent
            </div>
        </div>
    </div>
</div>