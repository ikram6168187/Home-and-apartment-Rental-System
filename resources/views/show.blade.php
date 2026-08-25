<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', Arial, sans-serif; }
        body { background:#f7f7f8; color:#222; }

        .container { max-width:1100px; margin:0 auto; padding:30px 20px; }

        .back-link { display:inline-flex; align-items:center; gap:6px; color:#555; text-decoration:none; margin-bottom:20px; font-size:14px; }
        .back-link:hover { color:#000; }

        /* ===== Gallery ===== */
        .gallery { display:grid; grid-template-columns: 2fr 1fr 1fr; grid-template-rows: 1fr 1fr; gap:8px; height:420px; border-radius:16px; overflow:hidden; margin-bottom:30px; }
        .gallery img { width:100%; height:100%; object-fit:cover; cursor:pointer; transition:.2s; }
        .gallery img:hover { opacity:.9; }
        .gallery-main { grid-row: 1 / 3; grid-column: 1 / 2; }
        .no-img-box { width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#eee; color:#bbb; font-size:40px; }

        .more-photos-btn { position:relative; }
        .more-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.55); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:600; font-size:15px; cursor:pointer; }

        /* ===== Header info ===== */
        .prop-header { display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px; margin-bottom:16px; }
        .prop-header h1 { font-size:28px; font-weight:700; color:#1a1a1a; }
        .prop-header .loc { color:#777; margin-top:6px; font-size:15px; }
        .badges span { display:inline-block; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600; margin-left:8px; }
        .type-badge { background:#1a1a1a; color:#fff; }
        .rent-badge { background:#e5f7ec; color:#1c9a4b; }

        /* ===== Features row ===== */
        .features-row { display:flex; gap:28px; padding:18px 0; border-top:1px solid #e5e5e5; border-bottom:1px solid #e5e5e5; margin:20px 0; flex-wrap:wrap; }
        .features-row span { color:#444; font-size:15px; display:flex; align-items:center; gap:8px; }
        .features-row i { color:#888; }

        .price-block { font-size:30px; font-weight:800; color:#1a1a1a; margin:20px 0; }
        .price-block small { font-size:15px; font-weight:400; color:#888; }

        .info-block { margin-bottom:26px; }
        .info-block h2 { font-size:18px; margin-bottom:10px; color:#1a1a1a; }
        .info-block p { color:#555; line-height:1.7; font-size:15px; }

        /* ===== Owner box ===== */
        .owner-box { display:flex; justify-content:space-between; align-items:center; background:#fff; border:1px solid #eee; border-radius:16px; padding:20px 24px; margin-top:30px; }
        .owner-box .label { font-size:13px; color:#999; }
        .owner-box .name { font-size:17px; font-weight:700; margin-top:2px; }
        .book-btn { background:#1a1a1a; color:#fff; padding:13px 32px; border-radius:30px; border:none; font-size:15px; font-weight:600; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:8px; }
        .book-btn:hover { background:#000; }

        /* ===== Lightbox modal ===== */
        .lightbox { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.9); z-index:999; align-items:center; justify-content:center; flex-direction:column; }
        .lightbox.active { display:flex; }
        .lightbox img { max-width:85%; max-height:75vh; border-radius:10px; object-fit:contain; }
        .lightbox-close { position:absolute; top:20px; right:30px; color:#fff; font-size:32px; cursor:pointer; }
        .lightbox-nav { display:flex; justify-content:space-between; width:90%; position:absolute; top:50%; transform:translateY(-50%); }
        .lightbox-nav i { color:#fff; font-size:30px; cursor:pointer; padding:10px; background:rgba(255,255,255,0.1); border-radius:50%; }
        .lightbox-counter { color:#fff; margin-top:14px; font-size:14px; }

        @media (max-width:768px) {
            .gallery { grid-template-columns: 1fr 1fr; grid-template-rows: 200px 200px; height:auto; }
            .gallery-main { grid-column: 1 / 3; grid-row: 1 / 2; }
            .prop-header h1 { font-size:22px; }
            .owner-box { flex-direction:column; align-items:flex-start; gap:14px; }
        }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('home') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back to Properties
    </a>

    {{-- ===== Image Gallery ===== --}}
    @php
        $allImages = collect();
        if ($property->image) {
            $allImages->push($property->image);
        }
        foreach ($property->images as $img) {
            $allImages->push($img->image_path);
        }
    @endphp

    <div class="gallery">
        @if($allImages->count() > 0)
            @foreach($allImages->take(5) as $index => $imgPath)
                @if($index == 0)
                    <img class="gallery-main" src="{{ asset('storage/'.$imgPath) }}"
                         alt="{{ $property->title }}" onclick="openLightbox({{ $index }})">
                @elseif($index == 4 && $allImages->count() > 5)
                    <div class="more-photos-btn" onclick="openLightbox({{ $index }})">
                        <img src="{{ asset('storage/'.$imgPath) }}" alt="photo">
                        <div class="more-overlay">+{{ $allImages->count() - 5 }} more</div>
                    </div>
                @else
                    <img src="{{ asset('storage/'.$imgPath) }}" alt="photo" onclick="openLightbox({{ $index }})">
                @endif
            @endforeach

            {{-- Agar 5 se kam images hain to empty slots fill karein --}}
            @if($allImages->count() < 5)
                @for($i = $allImages->count(); $i < 5; $i++)
                    <div class="no-img-box"><i class="fa-solid fa-image"></i></div>
                @endfor
            @endif
        @else
            <div class="gallery-main no-img-box"><i class="fa-solid fa-building"></i></div>
            <div class="no-img-box"><i class="fa-solid fa-image"></i></div>
            <div class="no-img-box"><i class="fa-solid fa-image"></i></div>
            <div class="no-img-box"><i class="fa-solid fa-image"></i></div>
        @endif
    </div>

    {{-- ===== Title / Location / Badges ===== --}}
    <div class="prop-header">
        <div>
            <h1>{{ $property->title }}</h1>
            <p class="loc"><i class="fa-solid fa-location-dot"></i> {{ $property->location }}, {{ $property->city }}</p>
        </div>
        <div class="badges">
            <span class="type-badge">{{ ucfirst($property->type) }}</span>
            <span class="rent-badge">For {{ ucfirst($property->purpose ?? 'Rent') }}</span>
        </div>
    </div>

    {{-- ===== Features ===== --}}
    <div class="features-row">
        <span><i class="fa-solid fa-bed"></i> {{ $property->bedrooms }} Beds</span>
        <span><i class="fa-solid fa-bath"></i> {{ $property->bathrooms }} Baths</span>
        @if($property->area_sqft)
        <span><i class="fa-solid fa-vector-square"></i> {{ $property->area_sqft }} sqft</span>
        @endif
    </div>

    {{-- ===== Price ===== --}}
    <div class="price-block">
        ₨ {{ number_format($property->price) }} <small>/month</small>
    </div>

    {{-- ===== Address ===== --}}
    <div class="info-block">
        <h2>Address</h2>
        <p>{{ $property->address }}</p>
    </div>

    {{-- ===== Description ===== --}}
    <div class="info-block">
        <h2>Description</h2>
        <p>{{ $property->description }}</p>
    </div>

    {{-- ===== Owner Box ===== --}}
    <div class="owner-box">
        <div>
            <p class="label">Posted by</p>
            <p class="name">{{ $property->user->name ?? 'N/A' }}</p>
        </div>
        <a href="#" class="book-btn">
            <i class="fa-solid fa-calendar-check"></i> Book Now
        </a>
    </div>

</div>

{{-- ===== Lightbox (full-screen image viewer) ===== --}}
<div class="lightbox" id="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img id="lightbox-img" src="" alt="">
    <div class="lightbox-nav">
        <i class="fa-solid fa-chevron-left" onclick="changeImage(-1)"></i>
        <i class="fa-solid fa-chevron-right" onclick="changeImage(1)"></i>
    </div>
    <div class="lightbox-counter" id="lightbox-counter"></div>
</div>

<script>
    const images = @json($allImages->map(fn($img) => asset('storage/'.$img))->values());
    let currentIndex = 0;

    function openLightbox(index) {
        if (images.length === 0) return;
        currentIndex = index;
        document.getElementById('lightbox').classList.add('active');
        updateLightboxImage();
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
    }

    function changeImage(direction) {
        currentIndex = (currentIndex + direction + images.length) % images.length;
        updateLightboxImage();
    }

    function updateLightboxImage() {
        document.getElementById('lightbox-img').src = images[currentIndex];
        document.getElementById('lightbox-counter').innerText = (currentIndex + 1) + ' / ' + images.length;
    }

    // ESC key se close, arrow keys se navigate
    document.addEventListener('keydown', function(e) {
        if (!document.getElementById('lightbox').classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') changeImage(1);
        if (e.key === 'ArrowLeft') changeImage(-1);
    });
</script>

</body>
</html>