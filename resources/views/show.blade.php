<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - Smart Rent</title>
    
    <!-- External FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- External Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
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

            {{-- Average rating summary --}}
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

    {{-- ===== Rating Form ===== --}}
    <div class="rating-form-box">
        <h2>Rate this Property</h2>

        @auth
            <form action="{{ route('property.rate', $property->id) }}" method="POST">
                @csrf

                <div class="star-rating-input">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="stars" value="{{ $i }}"
                            {{ old('stars', $userRating->stars ?? 0) == $i ? 'checked' : '' }} required>
                        <label for="star{{ $i }}">&#9733;</label>
                    @endfor
                </div>

                <textarea name="comment" rows="3" placeholder="Apna feedback likhein (optional)">{{ old('comment', $userRating->comment ?? '') }}</textarea>

                <br>
                <button type="submit" class="rating-submit-btn">
                    {{ $userRating ? 'Update Rating' : 'Submit Rating' }}
                </button>
            </form>

            @if(session('success'))
                <p class="rating-success-msg">{{ session('success') }}</p>
            @endif
        @else
            <p class="login-prompt">Rating dene ke liye pehle <a href="{{ route('login') }}">login</a> karein.</p>
        @endauth
    </div>

    {{-- ===== Reviews List ===== --}}
    @if($property->ratings->count() > 0)
    <div class="info-block">
        <h2>Reviews ({{ $property->ratings->count() }})</h2>
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

    document.addEventListener('keydown', function(e) {
        if (!document.getElementById('lightbox').classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') changeImage(1);
        if (e.key === 'ArrowLeft') changeImage(-1);
    });
</script>

</body>
</html>