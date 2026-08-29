<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Arial,sans-serif; }
body { background:#f4f6f9; }
a { text-decoration:none; color:inherit; }

/* NAVBAR */
.navbar { background:#2d2926; padding:16px 5%; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:100; }
.nav-logo { color:#fff; font-size:18px; font-weight:700; display:flex; align-items:center; gap:8px; }
.nav-right { display:flex; align-items:center; gap:12px; }
.nav-back { color:rgba(255,255,255,0.7); font-size:13px; display:flex; align-items:center; gap:6px; background:rgba(255,255,255,0.1); padding:7px 16px; border-radius:20px; border:1px solid rgba(255,255,255,0.15); transition:0.2s; }
.nav-back:hover { background:rgba(255,255,255,0.18); color:#fff; }
.nav-user { display:flex; align-items:center; gap:8px; color:#fff; font-size:13px; }
.nav-avatar { width:32px; height:32px; border-radius:50%; background:#c8a882; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#2d2926; overflow:hidden; }
.nav-avatar img { width:100%; height:100%; object-fit:cover; }

/* PAGE */
.page-wrap { max-width:1100px; margin:32px auto; padding:0 20px 60px; display:grid; grid-template-columns:1fr 360px; gap:28px; align-items:start; }

/* LEFT SIDE */
.prop-image { width:100%; height:380px; border-radius:16px; overflow:hidden; background:#f0ebe4; display:flex; align-items:center; justify-content:center; margin-bottom:20px; position:relative; }
.prop-image img { width:100%; height:100%; object-fit:cover; }
.prop-image .no-img { font-size:60px; color:#c8a882; }
.prop-image .type-badge { position:absolute; top:16px; left:16px; background:#2d2926; color:#fff; padding:6px 16px; border-radius:20px; font-size:12px; font-weight:600; text-transform:capitalize; }
.prop-image .status-badge { position:absolute; top:16px; right:16px; background:#e8f5e9; color:#2e7d32; padding:6px 16px; border-radius:20px; font-size:12px; font-weight:600; }

.info-card { background:#fff; border-radius:16px; padding:24px; border:1px solid #eee; margin-bottom:16px; }
.prop-title { font-size:24px; font-weight:700; color:#1a1a2e; margin-bottom:8px; }
.prop-location { font-size:14px; color:#888; display:flex; align-items:center; gap:6px; margin-bottom:16px; }
.prop-location i { color:#2d2926; }

/* ===== Rating summary (under title) ===== */
.rating-summary { display:flex; align-items:center; gap:8px; margin-bottom:16px; font-size:14px; }
.rating-summary .stars-static { color:#f5a623; letter-spacing:1px; }
.rating-summary .stars-static .empty { color:#ddd; }
.rating-summary .count-text { color:#777; }
.no-reviews-text { color:#999; font-style:italic; font-size:14px; margin-bottom:16px; }

.features-row { display:flex; gap:20px; flex-wrap:wrap; padding:16px 0; border-top:1px solid #f5f5f5; border-bottom:1px solid #f5f5f5; margin-bottom:16px; }
.feature { display:flex; align-items:center; gap:8px; font-size:13px; color:#555; }
.feature i { color:#8a7060; font-size:16px; }

.section-title { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:10px; }
.prop-desc { font-size:14px; color:#666; line-height:1.8; }

/* OWNER CARD */
.owner-card { background:#fff; border-radius:16px; padding:20px; border:1px solid #eee; margin-bottom:16px; display:flex; align-items:center; gap:14px; }
.owner-avatar { width:50px; height:50px; border-radius:50%; background:linear-gradient(135deg,#2d2926,#8a6040); display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700; color:#fff; flex-shrink:0; overflow:hidden; }
.owner-avatar img { width:100%; height:100%; object-fit:cover; }
.owner-info h4 { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:3px; }
.owner-info p  { font-size:12px; color:#888; margin:0; }
.owner-info span { font-size:12px; color:#2d2926; font-weight:600; }

/* ===== Rating form card ===== */
.rating-form-card { background:#fff; border-radius:16px; padding:24px; border:1px solid #eee; margin-bottom:16px; }
.star-rating-input { display:inline-flex; flex-direction:row-reverse; font-size:32px; }
.star-rating-input input { display:none; }
.star-rating-input label { color:#ddd; cursor:pointer; padding:0 3px; transition:.15s; }
.star-rating-input input:checked ~ label,
.star-rating-input label:hover,
.star-rating-input label:hover ~ label { color:#f5a623; }
.rating-form-card textarea {
    width:100%; margin-top:14px; padding:10px 12px; border-radius:10px;
    border:1.5px solid #e0e0e0; font-family:inherit; font-size:14px; resize:vertical; background:#fafafa;
}
.rating-form-card textarea:focus { border-color:#2d2926; background:#fff; outline:none; }
.rating-submit-btn {
    margin-top:14px; background:#2d2926; color:#fff; padding:11px 28px;
    border:none; border-radius:24px; font-size:14px; font-weight:700; cursor:pointer; transition:0.2s;
}
.rating-submit-btn:hover { background:#1a1a1a; }
.rating-success-msg { color:#2e7d32; margin-top:10px; font-size:13px; }
.rating-login-prompt { color:#888; font-size:13px; }
.rating-login-prompt a { color:#2d2926; font-weight:700; }

/* ===== Reviews list ===== */
.reviews-list { display:flex; flex-direction:column; gap:16px; }
.review-item { border-bottom:1px solid #f5f5f5; padding-bottom:16px; }
.review-item:last-child { border-bottom:none; padding-bottom:0; }
.review-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:6px; }
.reviewer-name { font-weight:700; font-size:14px; color:#1a1a2e; }
.review-date { font-size:12px; color:#999; }
.review-stars { color:#f5a623; font-size:13px; margin-bottom:6px; }
.review-stars .empty { color:#ddd; }
.review-comment { color:#666; font-size:14px; line-height:1.6; }

/* RIGHT SIDE — BOOKING FORM */
.booking-card { background:#fff; border-radius:16px; padding:24px; border:1px solid #eee; position:sticky; top:84px; }
.booking-price { font-size:28px; font-weight:800; color:#1a1a2e; margin-bottom:4px; }
.booking-price span { font-size:14px; color:#888; font-weight:400; }
.booking-divider { height:1px; background:#f0f0f0; margin:16px 0; }

.fgroup { margin-bottom:14px; }
.fgroup label { display:block; font-size:12px; font-weight:700; color:#555; margin-bottom:5px; text-transform:uppercase; letter-spacing:0.4px; }
.fgroup input, .fgroup select, .fgroup textarea {
    width:100%; padding:11px 14px;
    border:1.5px solid #e0e0e0; border-radius:10px;
    font-size:14px; color:#333; outline:none;
    transition:0.2s; background:#fafafa;
    font-family:'Segoe UI',Arial,sans-serif;
}
.fgroup input:focus, .fgroup select:focus, .fgroup textarea:focus {
    border-color:#2d2926; background:#fff;
    box-shadow:0 0 0 3px rgba(45,41,38,0.08);
}
.fgroup textarea { min-height:80px; resize:vertical; }
.dates-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
.error-msg { color:#dc3545; font-size:12px; margin-top:4px; display:block; }

.book-btn {
    width:100%; padding:14px; border:none;
    border-radius:12px; background:#2d2926;
    color:#fff; font-size:16px; font-weight:700;
    cursor:pointer; transition:0.2s;
    display:flex; align-items:center; justify-content:center; gap:8px;
}
.book-btn:hover { background:#1a1a1a; transform:translateY(-1px); }

.login-prompt {
    text-align:center; padding:20px;
    background:#f8f4f0; border-radius:12px;
    border:1px dashed #d4b896;
}
.login-prompt p { font-size:13px; color:#888; margin-bottom:12px; }
.login-prompt a {
    display:inline-flex; align-items:center; gap:6px;
    background:#2d2926; color:#fff;
    padding:10px 24px; border-radius:20px;
    font-size:13px; font-weight:600; transition:0.2s;
}
.login-prompt a:hover { background:#1a1a1a; }

/* ALERTS */
.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:16px; font-size:13px; display:flex; align-items:center; gap:8px; }
.alert-error   { background:#fff0f0; border:1px solid #ffcdd2; color:#c0392b; border-radius:10px; padding:12px 18px; margin-bottom:16px; font-size:13px; display:flex; align-items:center; gap:8px; }

/* SUMMARY */
.summary-box { background:#f8f4f0; border-radius:10px; padding:14px; margin:14px 0; }
.summary-row { display:flex; justify-content:space-between; font-size:13px; color:#555; padding:4px 0; }
.summary-row.total { font-weight:700; color:#1a1a2e; border-top:1px solid #e0d8d0; margin-top:6px; padding-top:10px; font-size:14px; }

@media(max-width:768px) {
    .page-wrap { grid-template-columns:1fr; }
    .booking-card { position:static; }
}

/* ===== Carousel ===== */
.carousel-arrow {
    position:absolute; top:50%; transform:translateY(-50%);
    width:42px; height:42px; background:rgba(255,255,255,0.9);
    border-radius:50%; display:flex; align-items:center; justify-content:center;
    cursor:pointer; font-size:15px; color:#2d2926;
    box-shadow:0 2px 10px rgba(0,0,0,0.2); transition:0.2s; z-index:5;
}
.carousel-arrow:hover { background:#fff; transform:translateY(-50%) scale(1.08); }
.carousel-prev { left:16px; }
.carousel-next { right:16px; }

.carousel-counter {
    position:absolute; bottom:16px; right:16px;
    background:rgba(0,0,0,0.6); color:#fff; font-size:12px;
    padding:4px 12px; border-radius:20px; z-index:5;
}

.carousel-slide {
    position:absolute; top:0; left:0; width:100%; height:100%;
    object-fit:cover; opacity:0; transition:opacity 0.4s ease; pointer-events:none;
}
.carousel-slide.active { opacity:1; pointer-events:auto; }

.carousel-thumbs {
    display:flex; gap:8px; margin-bottom:20px;
    overflow-x:auto; padding-bottom:4px;
}
.carousel-thumbs img {
    width:76px; height:56px; object-fit:cover; border-radius:8px;
    cursor:pointer; opacity:0.55; border:2px solid transparent;
    transition:0.2s; flex-shrink:0;
}
.carousel-thumbs img:hover { opacity:0.85; }
.carousel-thumbs img.active { opacity:1; border-color:#2d2926; }
</style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <a href="{{ route('home') }}" class="nav-logo">
        <i class="fa-solid fa-house-chimney"></i> Smart Rent
    </a>
    <div class="nav-right">
        <a href="{{ route('home') }}" class="nav-back">
            <i class="fa-solid fa-arrow-left"></i> Back to Listings
        </a>
        @auth
        <div class="nav-user">
            <div class="nav-avatar">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                @endif
            </div>
            <span>{{ Auth::user()->name }}</span>
        </div>
        @endauth
    </div>
</div>

<!-- PAGE -->
<div class="page-wrap">

    <!-- LEFT SIDE -->
    <div>

       {{-- ===== Image Carousel ===== --}}
@php
    $allImages = collect();
    if ($property->image) {
        $allImages->push($property->image);
    }
    foreach ($property->images as $img) {
        $allImages->push($img->image_path);
    }
@endphp

<div class="prop-image">
    @if($allImages->count() > 0)
        @foreach($allImages as $index => $imgPath)
            <img src="{{ asset('storage/'.$imgPath) }}"
                 class="carousel-slide {{ $index == 0 ? 'active' : '' }}"
                 alt="{{ $property->title }}">
        @endforeach

        @if($allImages->count() > 1)
        <div class="carousel-arrow carousel-prev" onclick="changeSlide(-1)">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="carousel-arrow carousel-next" onclick="changeSlide(1)">
            <i class="fa-solid fa-chevron-right"></i>
        </div>
        <div class="carousel-counter">
            <span id="current-slide">1</span> / {{ $allImages->count() }}
        </div>
        @endif
    @else
        <i class="fa-solid fa-building no-img"></i>
    @endif

    <span class="type-badge">{{ ucfirst($property->type) }}</span>
    <span class="status-badge"><i class="fa-solid fa-circle-check"></i> Available</span>
</div>

@if($allImages->count() > 1)
<div class="carousel-thumbs">
    @foreach($allImages as $index => $imgPath)
        <img src="{{ asset('storage/'.$imgPath) }}"
             class="thumb {{ $index == 0 ? 'active' : '' }}"
             onclick="goToSlide({{ $index }})">
    @endforeach
</div>
@endif

        <!-- MAIN INFO -->
        <div class="info-card">
            <h1 class="prop-title">{{ $property->title }}</h1>
            <p class="prop-location">
                <i class="fa-solid fa-location-dot"></i>
                {{ $property->address }}, {{ $property->location }}, {{ $property->city }}
            </p>

            {{-- ===== NAYA CODE: Average rating summary ===== --}}
            @if(($property->ratings_count ?? 0) > 0)
                @php $avgRounded = round($property->ratings_avg_stars); @endphp
                <div class="rating-summary">
                    <span class="stars-static">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i > $avgRounded ? 'empty' : '' }}"></i>
                        @endfor
                    </span>
                    <span class="count-text">
                        {{ number_format($property->ratings_avg_stars, 1) }} ({{ $property->ratings_count }} {{ $property->ratings_count == 1 ? 'review' : 'reviews' }})
                    </span>
                </div>
            @else
                <p class="no-reviews-text">No reviews yet</p>
            @endif
            {{-- =============================================== --}}

            <div class="features-row">
                <div class="feature"><i class="fa-solid fa-bed"></i> {{ $property->bedrooms }} Bedrooms</div>
                <div class="feature"><i class="fa-solid fa-bath"></i> {{ $property->bathrooms }} Bathrooms</div>
                @if($property->area_sqft)
                <div class="feature"><i class="fa-solid fa-vector-square"></i> {{ number_format($property->area_sqft) }} sqft</div>
                @endif
                <div class="feature"><i class="fa-solid fa-tag"></i> For Rent</div>
            </div>

            <div class="section-title">About this property</div>
            <p class="prop-desc">{{ $property->description }}</p>
        </div>

        <!-- OWNER INFO -->
        <div class="owner-card">
            <div class="owner-avatar">
                @if($property->user->profile_picture)
                    <img src="{{ asset('storage/'.$property->user->profile_picture) }}" alt="">
                @else
                    {{ strtoupper(substr($property->user->name, 0, 2)) }}
                @endif
            </div>
            <div class="owner-info">
                <h4>{{ $property->user->name }}</h4>
                <p>Property Owner</p>
                @if($property->user->phone)
                <span><i class="fa-solid fa-phone" style="font-size:11px;"></i> {{ $property->user->phone }}</span>
                @endif
            </div>
        </div>

        {{-- ===== NAYA CODE: Rating Form ===== --}}
        <div class="rating-form-card">
            <div class="section-title">Rate this Property</div>

            @auth
                <form action="{{ route('property.rate', $property->id) }}" method="POST">
                    @csrf

                    <div class="star-rating-input">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="stars" value="{{ $i }}"
                                {{ old('stars', ($userRating?->stars ?? 0)) == $i ? 'checked' : '' }} required>
                            <label for="star{{ $i }}">&#9733;</label>
                        @endfor
                    </div>

                    <textarea name="comment" rows="3" placeholder="Apna feedback likhein (optional)">{{ old('comment', $userRating?->comment ?? '') }}</textarea>

                    <br>
                    <button type="submit" class="rating-submit-btn">
                        {{ (isset($userRating) && $userRating) ? 'Update Rating' : 'Submit Rating' }}
                    </button>
                </form>

                @if(session('success'))
                    <p class="rating-success-msg">{{ session('success') }}</p>
                @endif
            @else
                <p class="rating-login-prompt">Rating dene ke liye pehle <a href="{{ route('home') }}">login</a> karein.</p>
            @endauth
        </div>
        {{-- =================================== --}}

        {{-- ===== NAYA CODE: Reviews List ===== --}}
        @if($property->ratings->count() > 0)
        <div class="info-card">
            <div class="section-title">Reviews ({{ $property->ratings->count() }})</div>
            <div class="reviews-list">
                @foreach($property->ratings as $review)
                    <div class="review-item">
                        <div class="review-top">
                            <span class="reviewer-name">{{ $review->user->name ?? 'Anonymous' }}</span>
                            <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i > $review->stars ? 'empty' : '' }}"></i>
                            @endfor
                        </div>
                        @if($review->comment)
                            <p class="review-comment">{{ $review->comment }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        {{-- ================================== --}}

    </div>

    <!-- RIGHT SIDE — BOOKING -->
    <div>
        <div class="booking-card">
            <div class="booking-price">
                ₨ {{ number_format($property->price) }}
                <span>/ month</span>
            </div>
            <p style="font-size:12px; color:#888; margin-top:2px;">{{ $property->city }}, Pakistan</p>

            <div class="booking-divider"></div>

            @if(session('success'))
            <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
            @endif

            @auth
                {{-- Apni property book nahi kar sakte --}}
                @if(Auth::id() == $property->user_id)
                <div class="login-prompt">
                    <p>This is your own property listing.</p>
                    <a href="{{ route('property.edit', $property->id) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Listing
                    </a>
                </div>
                @else
                <form action="{{ route('booking.store', $property->id) }}" method="POST">
                    @csrf

                    <div class="dates-grid">
                        <div class="fgroup">
                            <label>Check In</label>
                            <input type="date" name="check_in"
                                   value="{{ old('check_in') }}"
                                   min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="fgroup">
                            <label>Check Out</label>
                            <input type="date" name="check_out"
                                   value="{{ old('check_out') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>
                    </div>
                    @error('check_in')  <span class="error-msg">{{ $message }}</span> @enderror
                    @error('check_out') <span class="error-msg">{{ $message }}</span> @enderror

                    <div class="fgroup">
                        <label>Guests</label>
                        <select name="guests">
                            @for($i=1; $i<=10; $i++)
                                <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="fgroup">
                        <label>Message to Owner <span style="font-weight:400;color:#aaa;">(Optional)</span></label>
                        <textarea name="message" placeholder="Introduce yourself or ask about the property...">{{ old('message') }}</textarea>
                    </div>

                    <div class="summary-box" id="summaryBox" style="display:none;">
                        <div class="summary-row"><span>Check In</span><span id="sumIn">—</span></div>
                        <div class="summary-row"><span>Check Out</span><span id="sumOut">—</span></div>
                        <div class="summary-row"><span>Duration</span><span id="sumDays">—</span></div>
                        <div class="summary-row total"><span>Est. Total</span><span id="sumTotal">—</span></div>
                    </div>

                    <button type="submit" class="book-btn">
                        <i class="fa-solid fa-calendar-check"></i> Request Booking
                    </button>

                    <p style="text-align:center; font-size:11px; color:#aaa; margin-top:10px;">
                        <i class="fa-solid fa-shield-halved"></i>
                        Owner will confirm your request within 24 hours
                    </p>
                </form>
                @endif

            @else
                {{-- Guest user --}}
                <div class="login-prompt">
                    <p><i class="fa-solid fa-lock"></i> Please login to book this property</p>
                    <a href="javascript:void(0);" onclick="window.location.href='{{ route('home') }}'">
                        <i class="fa-solid fa-right-to-bracket"></i> Login to Book
                    </a>
                </div>
            @endauth

        </div>
    </div>

</div>

<script>
// Auto calculate duration + total
const checkIn  = document.querySelector('input[name="check_in"]');
const checkOut = document.querySelector('input[name="check_out"]');
const price    = {{ $property->price }};

function updateSummary() {
    if (!checkIn || !checkOut) return;
    const inDate  = new Date(checkIn.value);

    const outDate = new Date(checkOut.value);
    if (!checkIn.value || !checkOut.value || outDate <= inDate) {
        document.getElementById('summaryBox').style.display = 'none';
        return;
    }
    const days  = Math.ceil((outDate - inDate) / (1000 * 60 * 60 * 24));
    const total = Math.ceil((days / 30) * price);
    document.getElementById('summaryBox').style.display = 'block';
    document.getElementById('sumIn').textContent    = checkIn.value;
    document.getElementById('sumOut').textContent   = checkOut.value;
    document.getElementById('sumDays').textContent  = days + (days == 1 ? ' day' : ' days');
    document.getElementById('sumTotal').textContent = '₨ ' + total.toLocaleString();

    // Set min check out
    checkOut.min = checkIn.value;
}

if (checkIn)  checkIn.addEventListener('change', updateSummary);
if (checkOut) checkOut.addEventListener('change', updateSummary);
// ===== Carousel Logic =====
let currentSlide = 0;
const totalSlides = {{ $allImages->count() }};

function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-slide');
    const thumbs = document.querySelectorAll('.carousel-thumbs img');

    slides.forEach(s => s.classList.remove('active'));
    thumbs.forEach(t => t.classList.remove('active'));

    slides[index].classList.add('active');
    if (thumbs[index]) thumbs[index].classList.add('active');

    const counterEl = document.getElementById('current-slide');
    if (counterEl) counterEl.innerText = index + 1;

    currentSlide = index;
}

function changeSlide(direction) {
    let newIndex = (currentSlide + direction + totalSlides) % totalSlides;
    showSlide(newIndex);
}

function goToSlide(index) {
    showSlide(index);
}

document.addEventListener('keydown', function(e) {
    if (totalSlides <= 1) return;
    if (e.key === 'ArrowRight') changeSlide(1);
    if (e.key === 'ArrowLeft') changeSlide(-1);
});
</script>

</body>
</html>