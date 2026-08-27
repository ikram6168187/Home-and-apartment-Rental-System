<div class="modal-overlay" id="forgotModal" onclick="handleForgotOverlayClick(event)">
    <div class="login-card">
        <button class="modal-close" onclick="closeForgotModal()" aria-label="Close">&times;</button>
        <div class="modal-left">
            <img src="{{ asset('images/login.png') }}" alt="Smart Rent">
        </div>
        <div class="modal-right">
            @if($errors->any() && session('show_forgot'))
                <div class="error-alert">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif
            <h2>Forgot Password</h2>
            <p class="modal-subtitle">Enter your email to receive a reset code</p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="m-login-btn">Send OTP</button>
            </form>
            <div class="m-signup">
                Remembered your password?
                <a href="javascript:void(0);" onclick="closeForgotModal(); openLoginModal();">Login</a>
            </div>
        </div>
    </div>
</div>