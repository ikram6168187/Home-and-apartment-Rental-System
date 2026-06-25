<style>
/* ===================== */
/* LOGIN MODAL CSS       */
/* ===================== */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.60);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.2s ease;
}
.modal-overlay.active { display: flex; }

@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@keyframes slideUp {
    from { transform: translateY(30px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}

.login-card {
    width: 700px;
    max-width: 95vw;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    box-shadow: 0 20px 60px rgba(0,0,0,0.35);
    animation: slideUp 0.25s ease;
    position: relative;
}
.modal-close {
    position: absolute;
    top: 14px; right: 16px;
    background: none; border: none;
    font-size: 22px; cursor: pointer;
    color: #666; z-index: 10;
    line-height: 1; transition: color 0.2s;
}
.modal-close:hover { color: #111; }

.modal-left {
    width: 50%;
    position: relative;
    min-height: 460px;
    overflow: hidden;
}
.modal-left img {
    position: absolute; top:0; left:0;
    width: 100%; height: 100%;
    object-fit: cover;
}
.modal-right {
    width: 50%;
    padding: 36px 30px 28px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-family: Arial, sans-serif;
    overflow-y: auto;
}
.modal-right h2 { font-size: 24px; font-weight: bold; color: #2b2d42; margin-bottom: 4px; }
.modal-subtitle  { font-size: 13px; color: #777; margin-bottom: 18px; }

.m-input-group {
    display: flex; align-items: center;
    border: 1px solid #ced4da;
    border-radius: 8px; overflow: hidden;
    margin-bottom: 10px;
}
.m-input-group-icon {
    padding: 0 12px; background: #fff;
    color: #888; font-size: 15px;
    border-right: 1px solid #ced4da;
    height: 40px; display: flex; align-items: center;
}
.m-input-group input {
    flex: 1; border: none; outline: none;
    padding: 8px 12px; font-size: 13px;
    color: #333; background: #fff;
}
.m-input-group .eye-toggle {
    padding: 0 12px; background: #fff;
    border: none; cursor: pointer;
    color: #888; font-size: 15px;
    height: 40px; display: flex; align-items: center;
    border-left: 1px solid #ced4da;
}
.m-forgot { text-align: right; font-size: 13px; margin-bottom: 14px; }
.m-forgot a { color: #6c63ff; text-decoration: none; }

.m-login-btn {
    width: 100%; padding: 11px; border: none;
    border-radius: 30px;
    background: linear-gradient(to right, #74c69d, #4ea8de);
    color: #fff; font-size: 15px; font-weight: bold;
    cursor: pointer; transition: 0.3s;
}
.m-login-btn:hover { transform: translateY(-2px); }

.m-divider {
    text-align: center; margin: 12px 0;
    font-size: 12px; color: #999; position: relative;
}
.m-divider::before, .m-divider::after {
    content: ""; position: absolute;
    width: 35%; height: 1px; background: #ddd; top: 50%;
}
.m-divider::before { left: 0; }
.m-divider::after  { right: 0; }

.m-social { display: flex; justify-content: center; gap: 10px; margin-bottom: 10px; }
.m-social button {
    border: 1px solid #ddd; background: #fff;
    padding: 7px 15px; border-radius: 30px;
    cursor: pointer; transition: 0.3s;
    font-size: 13px; color: #333;
}
.m-social button:hover { box-shadow: 0 3px 10px rgba(0,0,0,0.1); }

.google-icon {
    background: conic-gradient(#4285F4 0deg 90deg,#34A853 90deg 180deg,#FBBC05 180deg 270deg,#EA4335 270deg 360deg);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-right: 5px;
}
.facebook-icon { color: #1877F2; margin-right: 5px; }

.m-signup { text-align: center; font-size: 13px; color: #888; }
.m-signup a { color: #6c63ff; font-weight: bold; text-decoration: none; }

.m-footer { text-align: center; margin-top: 8px; font-size: 11px; color: #999; }
.m-footer a { color: #777; text-decoration: none; margin: 0 4px; }

.error-alert {
    background: #fff0f0; border: 1px solid #ffcdd2;
    color: #c0392b; border-radius: 8px;
    padding: 8px 12px; font-size: 13px; margin-bottom: 10px;
}

/* LOGOUT MODAL */
.logout-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 99999; justify-content: center; align-items: center;
}
.logout-overlay.active { display: flex; }
.logout-box {
    background: #fff; border-radius: 16px;
    padding: 36px 32px 28px; width: 360px;
    text-align: center; box-shadow: 0 16px 50px rgba(0,0,0,0.25);
}
.logout-icon {
    width: 60px; height: 60px; border-radius: 50%;
    background: #fff0f0; display: flex;
    align-items: center; justify-content: center;
    margin: 0 auto 16px; font-size: 26px; color: #dc3545;
}
.logout-box h3 { font-size: 20px; font-weight: 700; color: #2b2d42; margin-bottom: 8px; }
.logout-box p  { font-size: 13px; color: #888; margin-bottom: 24px; }
.logout-btns   { display: flex; gap: 12px; }
.btn-cancel {
    flex: 1; padding: 11px;
    border: 1.5px solid #ddd; border-radius: 30px;
    background: #fff; color: #555; font-size: 14px;
    font-weight: 600; cursor: pointer;
}
.btn-cancel:hover { background: #f5f5f5; }
.btn-logout-confirm {
    flex: 1; padding: 11px; border: none;
    border-radius: 30px; background: #dc3545;
    color: #fff; font-size: 14px; font-weight: 600; cursor: pointer;
}
.btn-logout-confirm:hover { background: #b02a37; }


/* Properties Section */

.properties{
    width:95%;
    margin:50px auto;
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
    gap:25px;
}

.property-card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
    transition:0.3s;
}

.property-card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.property-card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.property-content{
    padding:18px;
}

.property-content h3{
    margin:0;
    font-size:22px;
}

.location{
    color:#666;
    margin-top:8px;
}

.price{
    font-size:24px;
    font-weight:bold;
    color:#27ae60;
    margin-top:10px;
}

.book-btn{
    display:block;
    text-align:center;
    margin-top:15px;
    padding:12px;
    background:#2c3e50;
    color:white;
    text-decoration:none;
    border-radius:10px;
    transition:0.3s;
}

.book-btn:hover{
    background:#1a252f;
}   
</style>