<script>
// ── LOGIN MODAL ──
function openLoginModal() {
    document.getElementById('loginModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLoginModal() {
    document.getElementById('loginModal').classList.remove('active');
    document.body.style.overflow = '';
}
function handleOverlayClick(e) {
    if (e.target === document.getElementById('loginModal')) closeLoginModal();
}
function toggleModalPassword() {
    var p = document.getElementById('modal_password');
    var eye = document.getElementById('modal_eye');
    if (p.type === 'password') { p.type='text'; eye.classList.replace('fa-eye','fa-eye-slash'); }
    else { p.type='password'; eye.classList.replace('fa-eye-slash','fa-eye'); }
}

// ── SIGNUP MODAL ──
function openSignupModal() {
    document.getElementById('signupModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeSignupModal() {
    document.getElementById('signupModal').classList.remove('active');
    document.body.style.overflow = '';
}
function handleSignupOverlayClick(e) {
    if (e.target === document.getElementById('signupModal')) closeSignupModal();
}
function toggleSigPass(fieldId, eyeId) {
    var p = document.getElementById(fieldId);
    var eye = document.getElementById(eyeId);
    if (p.type === 'password') { p.type='text'; eye.classList.replace('fa-eye','fa-eye-slash'); }
    else { p.type='password'; eye.classList.replace('fa-eye-slash','fa-eye'); }
}

// ── LOGOUT MODAL ──
function openLogoutConfirm() {
    document.getElementById('logoutConfirm').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeLogoutConfirm() {
    document.getElementById('logoutConfirm').classList.remove('active');
    document.body.style.overflow = '';
}

// ── DROPDOWN ──
function toggleMenu() {
    var menu = document.getElementById("dropdownMenu");
    menu.style.display = (menu.style.display === "none") ? "block" : "none";
}
window.onclick = function(event) {
    if (!event.target.matches('.fa-bars-staggered') && !event.target.closest('.circle')) {
        var dropdown = document.getElementById("dropdownMenu");
        if (dropdown && dropdown.style.display === "block") dropdown.style.display = "none";
    }
}

// ── ESC KEY ──
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeLoginModal(); closeSignupModal(); closeLogoutConfirm(); }
});

// ── AUTO OPEN ──
@if(session('show_login'))
    openLoginModal();
@endif
@if(session('show_signup') || ($errors->any() && !session('show_login')))
    openSignupModal();
@endif
</script>