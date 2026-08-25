<div class="modal-overlay" id="otpModal" onclick="handleOtpOverlayClick(event)">
    <div class="login-card">
        <button class="modal-close" onclick="closeOtpModal()" aria-label="Close">&times;</button>
        <div class="modal-left">
            <img src="{{ asset('images/login.png') }}" alt="Smart Rent">
        </div>
        <div class="modal-right">
            @if(session('success'))
                <p style="color:green; font-size:13px; margin-bottom:10px;">{{ session('success') }}</p>
            @endif
            @if($errors->any() && session('show_otp'))
                <div class="error-alert">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                </div>
            @endif
            <h2>Verify Email</h2>
            <p class="modal-subtitle">Enter the 6-digit code sent to your email</p>
            <form method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <div class="m-input-group">
                    <span class="m-input-group-icon"><i class="fa-solid fa-shield-halved"></i></span>
                    <input type="text" name="otp" maxlength="6" placeholder="Enter OTP" required autofocus>
                </div>
                <button type="submit" class="m-login-btn">Verify</button>
            </form>
            <form method="POST" action="{{ route('otp.resend') }}" style="margin-top:10px; text-align:center;">
                @csrf
                <button type="submit" style="background:none; border:none; color:#6c63ff; cursor:pointer; font-size:13px;">
                    Didn't get the code? Resend OTP
                </button>
            </form>
        </div>
    </div>
</div>