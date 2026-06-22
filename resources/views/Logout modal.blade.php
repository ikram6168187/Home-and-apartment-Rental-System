<form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">@csrf</form>

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