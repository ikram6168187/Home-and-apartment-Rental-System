<div class="modal-overlay" id="resetModal" onclick="handleResetOverlayClick(event)">
    <div class="login-card">
        <button class="modal-close" onclick="closeResetModal()" aria-label="Close">&times;</button>
        <div class="modal-left">
            <img src="{{ asset('images/login.png') }}" alt="Smart Rent">
        </div>
        <div class="modal-right">
            @if(session('success'))
                <p style="color:green; font-size:13px; margin-bottom:10px;">{{ session('success') }}</p>
            @endif
            @if($errors->any() && session('show_reset'))
                <div class="error-alert">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif
            <h2>Reset Password</h2>
            <p class="modal-subtitle">Enter the OTP and your new password</p>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa-solid fa-shield-halved"></i></span>
                    <input type="text" name="otp" maxlength="6" placeholder="Enter OTP" required>
                </div>
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" id="reset_password" name="password" placeholder="New Password" required>
                    <button type="button" class="eye-toggle" onclick="toggleSigPass('reset_password','reset_eye1')">
                        <i class="fa-regular fa-eye" id="reset_eye1"></i>
                    </button>
                </div>
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" id="reset_password2" name="password_confirmation" placeholder="Confirm New Password" required>
                    <button type="button" class="eye-toggle" onclick="toggleSigPass('reset_password2','reset_eye2')">
                        <i class="fa-regular fa-eye" id="reset_eye2"></i>
                    </button>
                </div>
                <button type="submit" class="m-login-btn">Reset Password</button>
            </form>
            <form method="POST" action="{{ route('password.resend') }}" style="margin-top:10px; text-align:center;">
                @csrf
                <button type="submit" style="background:none; border:none; color:#6c63ff; cursor:pointer; font-size:13px;">
                    Didn't get the code? Resend OTP
                </button>
            </form>
        </div>
    </div>
</div>