<style>
    .logout-overlay {
    display: none;
    position: fixed; 
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
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
    box-shadow: 0 16px 50px rgba(0,0,0,0.2);
}

.logout-icon {
    width: 60px; 
    height: 60px;
    border-radius: 50%;
    background: #fff0f0;
    display: flex; 
    align-items: center; 
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 26px; 
    color: #dc3545;
}

.logout-box h3 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
.logout-box p  { font-size: 13px; color: #888; margin-bottom: 24px; }
.logout-btns   { display: flex; gap: 12px; }

.btn-cancel {
    flex: 1; 
    padding: 11px;
    border: 1px solid #ddd; 
    border-radius: 30px;
    background: #fff; 
    color: #555;
    font-size: 14px; 
    font-weight: 600;
    cursor: pointer;
}

.btn-cancel:hover { background: #f5f5f5; }

.btn-logout-confirm {
    flex: 1; 
    padding: 11px;
    border: none; 
    border-radius: 30px;
    background: #dc3545; 
    color: #fff;
    font-size: 14px; 
    font-weight: 600;
    cursor: pointer;
}

.btn-logout-confirm:hover { background: #b02a37; }
</style>



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