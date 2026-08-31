<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rent — Find Your Dream Place</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @include('Modal style')

<style>

/* =========================================================
   GLOBAL
========================================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Arial, sans-serif;
}

body {
    background: #f5f5f5;
}

a {
    text-decoration: none;
    color: inherit;
}


/* =========================================================
   HERO
========================================================= */

.b {
    margin-top: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero {
    width: 95%;
    background-image: url('images/hero1.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-radius: 20px;
    overflow: hidden;
}

.content {
    height: 480px;
    border-radius: 20px;
    background: linear-gradient(
        to bottom,
        rgba(20,15,10,0.3),
        rgba(20,15,10,0.65)
    );

    color: white;
    padding: 60px 0;

    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 16px;
}

.content p {
    font-size: 14px;
    opacity: 0.8;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.content h1 {
    font-size: 38px;
    font-weight: 700;
    text-align: center;
    line-height: 1.2;
}


/* =========================================================
   SEARCH BOX
========================================================= */

.box {
    width: 85%;

    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;

    gap: 0;

    background: white;
    color: black;

    border-radius: 14px;
    overflow: hidden;

    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
}

.box1 {
    flex: 1;
    min-width: 140px;

    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;

    gap: 4px;
    padding: 14px 20px;

    border-right: 1px solid #eee;
}

.box1:last-child {
    border-right: none;
}

.box1 p {
    margin: 0 0 4px;

    font-size: 10px;
    font-weight: 700;
    color: #555;

    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.box1 input {
    width: 100%;

    border: none;
    outline: none;

    background: transparent;

    font-size: 14px;
    color: #333;
}

.search-btn {

    height: 66px;
    display: flex;
    align-items: center;

    gap: 6px;

    padding: 0 28px;

    background: rgb(51,47,46);
    color: #fff;

    border: none;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;
    white-space: nowrap;

    transition: 0.2s;
}

.search-btn:hover {
    background: #1a1a1a;
}


/* =========================================================
   CITIES
========================================================= */

.c {
    width: 95%;

    margin: 45px auto 0;
    padding: 30px 25px;

    display: flex;
    justify-content: center;

    background: #fff;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.cities {
    width: 100%;

    display: flex;
    justify-content: center;
    align-items: center;

    flex-wrap: wrap;
    gap: 15px;
}

.city {
    width: 150px;
    height: 150px;

    padding: 20px;

    background: #fff;

    border: 2px solid transparent;
    border-radius: 16px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    text-align: center;

    box-shadow: 0 2px 12px rgba(0,0,0,0.08);

    cursor: pointer;

    transition: 0.3s ease;
}

.city:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}

.city.active-city {
    border-color: rgb(51,47,46);
    box-shadow: 0 8px 24px rgba(51,47,46,0.2);
}

.city img {
    width: 80px;
    height: 80px;

    object-fit: contain;

    margin-bottom: 12px;

    transition: 0.3s;
}

.city:hover img {
    transform: scale(1.1);
}

.city span {
    color: #1a1a2e;
    font-weight: 700;
    font-size: 13px;
}


/* =========================================================
   PROPERTIES SECTION
========================================================= */

.properties-section {
    width: 95%;

    margin: 45px auto 0;
    padding: 40px 35px;

    background: #fff;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    margin-bottom: 28px;
}

.section-header-left h2 {
    margin-bottom: 6px;

    font-size: 28px;
    font-weight: 700;

    color: #1a1a2e;
    letter-spacing: -0.4px;
}

.section-header-left p {
    font-size: 14px;
    color: #888;
}

.view-all-btn {
    display: flex;
    align-items: center;

    gap: 6px;

    padding: 10px 22px;

    background: rgb(51,47,46);
    color: #fff;

    border-radius: 20px;

    font-size: 13px;
    font-weight: 600;

    transition: 0.2s;
}

.view-all-btn:hover {
    background: #1a1a1a;
}


/* =========================================================
   RESULTS BANNER
========================================================= */

.results-banner {
    margin-bottom: 24px;
    padding: 16px 22px;

    display: none;
    align-items: center;
    justify-content: space-between;

    background: linear-gradient(
        135deg,
        #2d2926,
        #5c4a3a
    );

    color: #fff;

    border-radius: 18px;
}

.results-banner h3 {
    margin: 0 0 3px;

    font-size: 15px;
    font-weight: 600;
}

.results-banner p {
    margin: 0;

    font-size: 12px;
    color: rgba(255,255,255,0.65);
}

.close-search {
    padding: 7px 16px;

    background: rgba(255,255,255,0.15);
    color: #fff;

    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;
}


/* =========================================================
   PROPERTY GRID
========================================================= */

.property-grid {
    display: grid;

    grid-template-columns:
        repeat(auto-fill, minmax(250px, 1fr));

    gap: 15px;
}

.property-card {
    overflow: hidden;

    background: #fff;

    border: 1px solid #eee;
    border-radius: 20px;

    box-shadow: 0 4px 18px rgba(0,0,0,0.07);

    transition: 0.3s;
}

.property-card:hover {
    transform: translateY(-6px);

    box-shadow: 0 12px 30px rgba(0,0,0,0.13);
}

.prop-img {
    height: 150px;

    position: relative;

    overflow: hidden;
}

.prop-img img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    transition: 0.4s;
}

.property-card:hover .prop-img img {
    transform: scale(1.05);
}

.no-img {
    width: 100%;
    height: 100%;

    display: flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(
        135deg,
        #2d2926,
        #8a6040
    );
}

.no-img i {
    font-size: 56px;
    color: rgba(255,255,255,0.25);
}

.type-badge {
    position: absolute;

    top: 12px;
    left: 12px;

    padding: 5px 13px;

    background: rgb(51,47,46);
    color: #fff;

    border-radius: 20px;

    font-size: 11px;
    font-weight: 600;

    text-transform: capitalize;
}

.rent-badge {
    position: absolute;

    top: 12px;
    right: 12px;

    padding: 5px 13px;

    background: #e1f5ee;
    color: #0f6e56;

    border-radius: 20px;

    font-size: 11px;
    font-weight: 600;
}

.prop-body {
    padding: 18px 18px 10px;
}

.prop-title {
    margin: 0 0 7px;

    font-size: 16px;
    font-weight: 700;

    color: #1a1a2e;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.prop-loc {
    margin: 0 0 12px;

    display: flex;
    align-items: center;

    gap: 5px;

    font-size: 13px;
    color: #888;
}

.prop-features {
    display: flex;
    gap: 16px;

    margin-bottom: 0;
    padding-bottom: 10px;

    font-size: 12px;
    color: #666;

    border-bottom: 1px solid #f5f5f5;
}

.prop-features span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.prop-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.prop-price {
    font-size: 20px;
    font-weight: 800;

    color: rgb(51,47,46);
}

.prop-price small {
    font-size: 11px;
    color: #888;
    font-weight: 400;
}

.book-btn {
    padding: 9px 20px;

    background: rgb(51,47,46);
    color: #fff;

    border-radius: 20px;

    font-size: 13px;
    font-weight: 600;

    transition: 0.2s;
}

.book-btn:hover {
    background: #1a1a1a;
    transform: translateY(-1px);
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    grid-column: 1 / -1;

    padding: 70px 20px;

    text-align: center;

    color: #888;

    background: #fff;

    border: 1px solid #eee;
    border-radius: 20px;
}

.empty-state i {
    display: block;

    margin-bottom: 16px;

    font-size: 60px;
    color: #ddd;
}

.empty-state h3 {
    margin-bottom: 8px;

    font-size: 20px;
    color: #555;
}

.empty-state p {
    margin-bottom: 20px;

    font-size: 14px;
}

.suggest-cities {
    display: flex;

    gap: 8px;

    justify-content: center;
    flex-wrap: wrap;
}

.suggest-city {
    padding: 7px 18px;

    background: #f5ede0;
    color: #8a5c30;

    border: 1px solid #e8d5b7;
    border-radius: 20px;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    transition: 0.2s;
}

.suggest-city:hover {
    background: #e8d5b7;
}


/* =========================================================
   WHY SMART RENT
========================================================= */

.why-section {
    
    width: 95%;

    margin: 45px auto 0;
    padding: 65px 5%;

    background: #fff;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.why-heading{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
}

.section-label {
    margin-bottom: 12px;

    display: flex;
    align-items: center;

    gap: 8px;

    font-size: 12px;
    font-weight: 700;

    color: #8a5c30;

    text-transform: uppercase;
    letter-spacing: 1px;
}

.section-label::before {
    content: '';

    width: 30px;
    height: 2px;

    display: inline-block;

    background: #c8a882;
}

.why-title {
    margin-bottom: 14px;

    font-size: 32px;
    font-weight: 700;

    color: #1a1a2e;
    letter-spacing: -0.5px;
}

.why-title span {
    color: rgb(51,47,46);
}

.why-sub {
    max-width: 520px;

    margin-bottom: 50px;

    font-size: 15px;
    color: #888;

    line-height: 1.7;
}

.why-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 28px;
}

.why-card {
    padding: 30px 26px;

    background: #fafafa;

    border: 1px solid #eee;
    border-radius: 20px;

    transition: 0.3s;
}

.why-card:hover {
    background: #fff;

    transform: translateY(-4px);

    box-shadow: 0 8px 28px rgba(0,0,0,0.08);
}

.why-icon {
    width: 56px;
    height: 56px;

    margin-bottom: 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f5ede0;

    border-radius: 16px;

    font-size: 24px;
    color: rgb(51,47,46);
}

.why-card h3 {
    margin-bottom: 10px;

    font-size: 17px;
    font-weight: 700;

    color: #1a1a2e;
}

.why-card p {
    font-size: 13px;

    color: #888;

    line-height: 1.7;
}


/* =========================================================
   STATS
========================================================= */

.stats-section {
    width: 95%;

    margin: 45px auto 0;
    padding: 65px 5%;

    background: linear-gradient(
        135deg,
        rgb(51,47,46),
        #5c4a3a
    );

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.10);

    overflow: hidden;
}

.stats-grid {
    max-width: 900px;

    margin: 0 auto;

    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: 20px;

    text-align: center;
}

.stat-item {
    padding: 10px;
}

.stat-item h3 {
    margin-bottom: 6px;

    font-size: 42px;
    font-weight: 800;

    color: #fff;
}

.stat-item p {
    font-size: 14px;

    color: rgba(255,255,255,0.65);

    font-weight: 500;
}


/* =========================================================
   HOW IT WORKS
========================================================= */

.how-section {
    width: 95%;

    margin: 45px auto 0;
    padding: 70px 5%;

    background: #fff;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.how-grid {
    max-width: 960px;

    margin: 50px auto 0;

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 28px;
}

.how-card {
    position: relative;

    padding: 36px 28px;

    background: #fff;

    border: 1px solid #eee;
    border-radius: 20px;

    text-align: center;

    transition: 0.3s;
}

.how-card:hover {
    transform: translateY(-4px);

    box-shadow: 0 8px 28px rgba(0,0,0,0.08);
}

.how-number {
    position: absolute;

    top: -16px;
    left: 50%;

    transform: translateX(-50%);

    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgb(51,47,46);
    color: #fff;

    border-radius: 50%;

    font-size: 14px;
    font-weight: 700;
}

.how-icon {
    width: 68px;
    height: 68px;

    margin: 0 auto 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f5ede0;

    border-radius: 20px;

    font-size: 28px;
    color: rgb(51,47,46);
}

.how-card h3 {
    margin-bottom: 10px;

    font-size: 17px;
    font-weight: 700;

    color: #1a1a2e;
}

.how-card p {
    font-size: 13px;

    color: #888;

    line-height: 1.7;
}


/* =========================================================
   TESTIMONIALS
========================================================= */

.testimonial-section {
    width: 95%;

    margin: 45px auto 0;
    padding: 70px 5%;

    background: #fff;

    border-radius: 28px;

    box-shadow: 0 6px 25px rgba(0,0,0,0.06);
}

.testimonial-section h2 {
    letter-spacing: -0.5px;
}

.test-grid {
    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 24px;

    margin-top: 50px;
}

.test-card {
    padding: 28px;

    background: #f8f4f0;

    border: 1px solid #eee;
    border-radius: 20px;

    transition: 0.3s;
}

.test-card:hover {
    box-shadow: 0 6px 22px rgba(0,0,0,0.07);
}

.test-stars {
    margin-bottom: 14px;

    color: #f59e0b;

    font-size: 14px;
}

.test-text {
    margin-bottom: 18px;

    font-size: 14px;

    color: #555;

    line-height: 1.8;

    font-style: italic;
}

.test-user {
    display: flex;
    align-items: center;

    gap: 12px;
}

.test-avatar {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(
        135deg,
        rgb(51,47,46),
        #8a6040
    );

    border-radius: 50%;

    font-size: 15px;
    font-weight: 700;

    color: #fff;
}

.test-user h4 {
    margin: 0 0 2px;

    font-size: 14px;
    font-weight: 700;

    color: #1a1a2e;
}

.test-user p {
    margin: 0;

    font-size: 12px;
    color: #888;
}


/* =========================================================
   CTA SECTION
   ========================================================= */

.cta-section {
    width: 95%;
    margin: 45px auto 30px !important;

    padding: 75px 5% !important;

    background: linear-gradient(135deg, #1a1209, #2d2926);

    text-align: center;

    /* ALL FOUR CTA CORNERS CURVED */
    border-radius: 28px;

    /* Keeps the curved corners visible */
    overflow: hidden;

    position: relative;
    z-index: 1;
}

.cta-section h2 {
    font-size: 36px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 14px;
}

.cta-section h2 span {
    color: #c8a882;
}

.cta-section p {
    font-size: 16px;
    color: rgba(255,255,255,0.65);
    max-width: 560px;
    margin: 0 auto 36px;
    line-height: 1.7;
}

.cta-btns {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-btn-primary {
    background: #c8a882;
    color: #1a1209;
    padding: 14px 36px;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 700;
    transition: 0.2s;

    display: flex;
    align-items: center;
    gap: 8px;
}

.cta-btn-primary:hover {
    background: #e8d5b7;
    transform: translateY(-2px);
}

.cta-btn-secondary {
    background: rgba(255,255,255,0.1);
    color: #fff;
    padding: 14px 36px;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 600;

    border: 1px solid rgba(255,255,255,0.2);

    transition: 0.2s;

    display: flex;
    align-items: center;
    gap: 8px;
}

.cta-btn-secondary:hover {
    background: rgba(255,255,255,0.18);
    transform: translateY(-2px);
}


/* =========================================================
   FOOTER
   ========================================================= */

.footer {
    /* FULL SCREEN WIDTH */
    width: 100%;

    /* Remove left/right margin */
    margin: 0 !important;

    /* Straight footer - NO CURVES */
    border-radius: 0;

    /* Remove old border gap */
    border-top: none;

    background: #0f0e0d;

    padding: 60px 5% 30px;
}


/* FOOTER GRID */

.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;

    gap: 40px;
    margin-bottom: 50px;
}


/* FOOTER BRAND */

.footer-brand .f-logo {
    font-size: 20px;
    font-weight: 700;
    color: #fff;

    display: flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 14px;
}

.footer-brand p {
    font-size: 13px;
    color: rgba(255,255,255,0.45);

    line-height: 1.8;

    max-width: 260px;
    margin-bottom: 20px;
}


/* SOCIAL LINKS */

.social-links {
    display: flex;
    gap: 10px;
}

.social-link {
    width: 36px;
    height: 36px;

    border-radius: 50%;

    background: rgba(255,255,255,0.08);

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 15px;
    color: rgba(255,255,255,0.5);

    border: 1px solid rgba(255,255,255,0.1);

    transition: 0.2s;
}

.social-link:hover {
    background: rgb(51,47,46);
    color: #fff;
    border-color: rgb(51,47,46);
}


/* FOOTER COLUMNS */

.footer-col h4 {
    font-size: 13px;
    font-weight: 700;
    color: #fff;

    margin-bottom: 16px;

    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-col ul {
    list-style: none;
}

.footer-col ul li {
    margin-bottom: 10px;
}

.footer-col ul li a {
    font-size: 13px;
    color: rgba(255,255,255,0.45);

    transition: 0.2s;
}

.footer-col ul li a:hover {
    color: #c8a882;
}


/* FOOTER CONTACT */

.footer-contact li {
    display: flex;
    align-items: flex-start;

    gap: 8px;

    font-size: 13px;
    color: rgba(255,255,255,0.45);

    margin-bottom: 10px;
}

.footer-contact li i {
    color: #c8a882;

    margin-top: 2px;

    font-size: 12px;
}


/* FOOTER BOTTOM */

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.08);

    padding-top: 24px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    flex-wrap: wrap;

    gap: 12px;
}

.footer-bottom p {
    font-size: 12px;
    color: rgba(255,255,255,0.3);
}

.footer-links {
    display: flex;
    gap: 20px;
}

.footer-links a {
    font-size: 12px;
    color: rgba(255,255,255,0.3);

    transition: 0.2s;
}

.footer-links a:hover {
    color: #c8a882;
}
.prop-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0px 16px 16px;
}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 768px) {

    .cta-section {
        width: 94%;
        margin: 30px auto 20px !important;

        padding: 50px 22px !important;

        /* Bottom corners also curved */
        border-radius: 22px;
    }

    .footer {
        width: 100%;
        margin: 0 !important;
        border-radius: 0;
    }

    .footer-grid {
        grid-template-columns: 1fr 1fr;
    }

    .cta-section h2 {
        font-size: 28px;
    }

}

/* =========================================================
   PROPERTY RATING - COMPACT SPACING
========================================================= */

.rating {
    margin: 10px 16px 8px;
    padding: 0;
    min-height: auto;

    display: flex;
    align-items: center;
    gap: 2px;

    font-size: 15px;
    line-height: 1;
}

.star-filled {
    color: #f5a623;
}

.star-empty {
    color: #d3d3d3;
}

.rating-text {
    color: #6b6b6b;
    font-size: 13px;
    margin-left: 6px;
}

.no-reviews {
    color: #999;
    font-size: 13px;
    font-style: italic;
}
.star-filled { color: #f5a623; }
.star-empty { color: #d3d3d3; }
.rating-text {
    color: #6b6b6b;
    font-size: 13px;
    margin-left: 6px;
}
.no-reviews {
    color: #999;
    font-size: 13px;
    font-style: italic;
}
</style>
</head>
<body>

    @include('navbar')
    @include('login modal')
    @include('signup modal')
    @include('logout modal')
    @include('otp_verify')
    @include('forgot-password')
    @include('reset-password')
   <!-- HERO -->
    <div class="b">
        <div class="hero">
            <div class="content">
                <p>Find Your Dream Place</p>
                <h1>your Next Home Just a Click Away!</h1>

                <form action="{{ route('home') }}" method="GET" style="width:88%;">
                    <div class="box">
                        <div class="box1">
                            <p>Where</p>
                            <input type="text" name="search" placeholder="City or location..."
                                   value="{{ request('search') }}">
                        </div>
                        <div class="box1">
                            <p>Check In</p>
                            <input type="date" name="check_in" value="{{ request('check_in') }}"
                                   min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="box1">
                            <p>Check Out</p>
                            <input type="date" name="check_out" value="{{ request('check_out') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        <div class="box1">
                            <p>Guests</p>
                            <input type="number" name="guests" placeholder="Add Guests"
                                   value="{{ request('guests') }}" min="1">
                        </div>
                        <button type="submit" class="search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CITIES -->
    <div class="c">
        <div class="cities">
            @foreach([
                ['name'=>'Lahore',     'img'=>'lahore.png'],
                ['name'=>'Islamabad',  'img'=>'islamabad.png'],
                ['name'=>'Karachi',    'img'=>'karachi.png'],
                ['name'=>'Gujranwala','img'=>'Gujranwala.png'],
                ['name'=>'Faisalabad','img'=>'faislabad.png'],
                ['name'=>'Peshawar',  'img'=>'peshawar.png'],
            ] as $c)
            <div class="city {{ request('city') == $c['name'] ? 'active-city' : '' }}"
                 onclick="filterByCity('{{ $c['name'] }}', this)">
                <img src="images/{{ $c['img'] }}" alt="{{ $c['name'] }}">
                <span>{{ strtoupper($c['name']) }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- PROPERTIES SECTION -->
    <div class="properties-section" style="margin-bottom:20px;">

        @if(request('search') || request('check_in') || request('city'))
        <div class="results-banner" style="display:flex;">
            <div>
                <h3>
                    @if(request('check_in') && request('check_out'))
                        Available from {{ \Carbon\Carbon::parse(request('check_in'))->format('d M') }}
                        to {{ \Carbon\Carbon::parse(request('check_out'))->format('d M Y') }}
                        @if(request('search')) in "{{ request('search') }}" @endif
                    @elseif(request('city'))
                        Properties in {{ request('city') }}
                    @else
                        Results for "{{ request('search') }}"
                    @endif
                </h3>
                <p>{{ $properties->count() }} {{ $properties->count() == 1 ? 'property' : 'properties' }} found</p>
            </div>
            <a href="{{ route('home') }}" class="close-search">
                <i class="fa-solid fa-xmark"></i> Clear
            </a>
        </div>
        @endif

        <div class="section-header">
            <div class="section-header-left">
                <h2>
                    @if(request('city')) Properties in {{ request('city') }}
                    @elseif(request('search')) Search Results
                    @else Featured Properties
                    @endif
                </h2>
                <p>Find your perfect rental home across Pakistan</p>
            </div>
            @if(!request('search') && !request('city') && !request('check_in'))
            <a href="{{ route('home') }}" class="view-all-btn">
                <i class="fa-solid fa-building"></i> View All
            </a>
            @endif
        </div>

        <div class="property-grid">
            @forelse($properties as $property)
            <div class="property-card"
     data-city="{{ strtolower($property->city) }}"
     data-title="{{ strtolower($property->title) }}">

    <a href="{{ route('property.show', $property->id) }}" style="text-decoration:none; color:inherit; display:block;">
        <div class="prop-img">
            @if($property->image)
                <img src="{{ asset('storage/'.$property->image) }}" alt="{{ $property->title }}">
            @else
                <div class="no-img"><i class="fa-solid fa-building"></i></div>
            @endif
            <span class="type-badge">{{ ucfirst($property->type) }}</span>
            <span class="rent-badge">For Rent</span>
        </div>

        <div class="prop-body">
            <h3 class="prop-title">{{ $property->title }}</h3>
            <p class="prop-loc">
                <i class="fa-solid fa-location-dot" style="color:rgb(51,47,46);"></i>
                {{ $property->location }}, {{ $property->city }}
            </p>
            <div class="prop-features">
                <span><i class="fa-solid fa-bed" style="color:#888;"></i> {{ $property->bedrooms }} Beds</span>
                <span><i class="fa-solid fa-bath" style="color:#888;"></i> {{ $property->bathrooms }} Baths</span>
                @if($property->area_sqft)
                <span><i class="fa-solid fa-vector-square" style="color:#888;"></i> {{ $property->area_sqft }} sqft</span>
                @endif
            </div>
        </div>
    </a>
    {{-- Rating section --}}
    <div class="rating">
        @if($property->ratings_count > 0)
            @php $avg = round($property->ratings_avg_stars); @endphp
            @for ($i = 1; $i <= 5; $i++)
                <span class="{{ $i <= $avg ? 'star-filled' : 'star-empty' }}">★</span>
            @endfor
            <span class="rating-text">
                {{ number_format($property->ratings_avg_stars, 1) }} ({{ $property->ratings_count }} reviews)
            </span>
        @else
            <span class="no-reviews">No reviews yet</span>
        @endif
    </div>
    <div class="prop-footer">
        <div>
            <span class="prop-price">₨ {{ number_format($property->price) }}</span>
            <small>/month</small>
        </div>
        <a href="{{ route('property.show', $property->id) }}" class="book-btn">Book Now</a>
    </div>

</div>
            @empty
            <div class="empty-state">
                <i class="fa-solid fa-building-circle-xmark"></i>
                @if(request('check_in') && request('check_out'))
                    <h3>No properties available for selected dates</h3>
                    <p>Try different dates or explore other cities</p>
                @elseif(request('search') || request('city'))
                    <h3>No properties in "{{ request('search') ?? request('city') }}"</h3>
                    <p>Try searching in other cities</p>
                    <div class="suggest-cities">
                        <span class="suggest-city" onclick="filterByCity('Lahore')">Lahore</span>
                        <span class="suggest-city" onclick="filterByCity('Karachi')">Karachi</span>
                        <span class="suggest-city" onclick="filterByCity('Islamabad')">Islamabad</span>
                        <span class="suggest-city" onclick="filterByCity('Gujranwala')">Gujranwala</span>
                    </div>
                @else
                    <h3>No properties yet</h3>
                    <p>Be the first to list a property!</p>
                    @auth
                    <a href="{{ route('property.create') }}" class="book-btn" style="display:inline-flex; align-items:center; gap:6px; margin-top:10px;">
                        <i class="fa-solid fa-plus"></i> Add Property
                    </a>
                    @endauth
                @endif
            </div>
            @endforelse
        </div>
    </div>

    <!-- WHY SMART RENT -->
    <div class="why-section">

        <div class="why-heading">
            <div class="section-label">Why Choose Us</div>
            <h2 class="why-title">Why <span>Smart Rent</span> is Different</h2>
            <p class="why-sub">We built Smart Rent to make renting in Pakistan simple, safe, and stress-free — for both owners and renters.</p>
        </div>
        
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h3>Verified Listings</h3>
                <p>Every property is reviewed before going live. No fake ads, no scams — just genuine rental properties you can trust.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-bolt"></i></div>
                <h3>Instant Booking</h3>
                <p>Find a property, check availability, and send a booking request in minutes — from the comfort of your home.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <h3>Owner & Renter Friendly</h3>
                <p>Owners get a free listing dashboard. Renters get full property details, photos, and direct owner contact.</p>
            </div>
        </div>
    </div>

    <!-- STATS -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <h3>500+</h3>
                <p>Properties Listed</p>
            </div>
            <div class="stat-item">
                <h3>10+</h3>
                <p>Cities Covered</p>
            </div>
            <div class="stat-item">
                <h3>1,000+</h3>
                <p>Happy Renters</p>
            </div>
            <div class="stat-item">
                <h3>98%</h3>
                <p>Satisfaction Rate</p>
            </div>
        </div>
    </div>

    <!-- HOW IT WORKS -->
    <div class="how-section">
        <div style="text-align:center;">
            <div class="section-label" style="justify-content:center;">How It Works</div>
            <h2 style="font-size:32px; font-weight:700; color:#1a1a2e; margin-bottom:12px;">3 Simple Steps to<br>Find Your Home</h2>
            <p style="font-size:15px; color:#888; max-width:500px; margin:0 auto;">Renting a property has never been this easy. Follow these simple steps and move in quickly.</p>
        </div>
        <div class="how-grid">
            <div class="how-card">
                <div class="how-number">1</div>
                <div class="how-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <h3>Search by City</h3>
                <p>Browse hundreds of verified rental properties across major cities in Pakistan — houses, apartments, rooms and more.</p>
            </div>
            <div class="how-card">
                <div class="how-number">2</div>
                <div class="how-icon"><i class="fa-solid fa-file-lines"></i></div>
                <h3>View & Compare</h3>
                <p>Check property photos, price, location, bedrooms, and contact the owner directly through our platform.</p>
            </div>
            <div class="how-card">
                <div class="how-number">3</div>
                <div class="how-icon"><i class="fa-solid fa-house-circle-check"></i></div>
                <h3>Book Your Place</h3>
                <p>Send a booking request, get confirmed by the owner, and move in — no middlemen, no hidden fees.</p>
            </div>
        </div>
    </div>

    <!-- TESTIMONIALS -->
    <div class="testimonial-section">
        <div style="text-align:center;">
            <div class="section-label" style="justify-content:center;">Testimonials</div>
            <h2 style="font-size:32px; font-weight:700; color:#1a1a2e; margin-bottom:12px;">What Our Users Say</h2>
            <p style="font-size:15px; color:#888;">Real experiences from real people who found their homes on Smart Rent.</p>
        </div>
        <div class="test-grid">
            <div class="test-card">
                <div class="test-stars">★★★★★</div>
                <p class="test-text">"I found my apartment in Lahore within 2 days of joining Smart Rent. The process was smooth and the owner was very cooperative!"</p>
                <div class="test-user">
                    <div class="test-avatar">AK</div>
                    <div>
                        <h4>Ahmed Khan</h4>
                        <p>Renter — Lahore</p>
                    </div>
                </div>
            </div>
            <div class="test-card">
                <div class="test-stars">★★★★★</div>
                <p class="test-text">"As a property owner, Smart Rent gave me full control over my listings. I got my first booking within a week — amazing platform!"</p>
                <div class="test-user">
                    <div class="test-avatar">SM</div>
                    <div>
                        <h4>Sara Malik</h4>
                        <p>Property Owner — Islamabad</p>
                    </div>
                </div>
            </div>
            <div class="test-card">
                <div class="test-stars">★★★★★</div>
                <p class="test-text">"Very professional website. All listings are genuine and the booking system is super easy. Highly recommended for anyone in Pakistan!"</p>
                <div class="test-user">
                    <div class="test-avatar">UR</div>
                    <div>
                        <h4>Usman Raza</h4>
                        <p>Renter — Karachi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="cta-section">
        <h2>Ready to Find Your <span>Dream Home?</span></h2>
        <p>Join thousands of renters and property owners across Pakistan who trust Smart Rent for their housing needs.</p>
        <div class="cta-btns">
            @guest
            <a href="javascript:void(0);" onclick="openSignupModal()" class="cta-btn-primary">
                <i class="fa-solid fa-user-plus"></i> Get Started Free
            </a>
            <a href="javascript:void(0);" onclick="openLoginModal()" class="cta-btn-secondary">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </a>
            @endguest
            @auth
            <a href="{{ route('property.create') }}" class="cta-btn-primary">
                <i class="fa-solid fa-plus"></i> List Your Property
            </a>
            <a href="{{ route('dashboard') }}" class="cta-btn-secondary">
                <i class="fa-solid fa-gauge"></i> My Dashboard
            </a>
            @endauth
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-grid">

            <div class="footer-brand">
                <div class="f-logo">
                    <i class="fa-solid fa-house-chimney"></i> Smart Rent
                </div>
                <p>Pakistan's trusted rental platform connecting property owners with renters across the country.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endauth
                </ul>
            </div>

            <div class="footer-col">
                <h4>Property Types</h4>
                <ul>
                    <li><a href="#">Houses</a></li>
                    <li><a href="#">Apartments</a></li>
                    <li><a href="#">Rooms</a></li>
                    <li><a href="#">Shops</a></li>
                    <li><a href="#">Offices</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul class="footer-contact">
                    <li><i class="fa-solid fa-location-dot"></i>Main Market satellite town, Gujranwala<br>Punjab, Pakistan</li>
                    <li><i class="fa-solid fa-envelope"></i> atudygrw@gmail.com</li>
                    <li><i class="fa-solid fa-phone"></i> +92 3229859984</li>
                    <li><i class="fa-solid fa-clock"></i> Mon–Sat, 9am–6pm</li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 Smart Rent. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="{{ route('contact') }}">Support</a>
            </div>
        </div>
    </footer>

    @include('Modal scripts')

<script>
function filterByCity(city, el) {
    document.querySelectorAll('.city').forEach(c => c.classList.remove('active-city'));
    if (el) el.classList.add('active-city');
    var url = new URL(window.location.href);
    if (url.searchParams.get('city') === city) {
        url.searchParams.delete('city');
    } else {
        url.searchParams.set('city', city);
    }
    window.location.href = url.toString();
}
document.querySelector('input[name="check_in"]').addEventListener('change', function() {
    var checkOut = document.querySelector('input[name="check_out"]');
    checkOut.min = this.value;
    if (checkOut.value && checkOut.value <= this.value) checkOut.value = '';
});
</script>

</body>
</html>
