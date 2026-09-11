<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rent — Find Your Dream Place</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @include('Modal style')

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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

                <form action="{{ route('home') }}" method="GET">
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
<div id="properties" class="properties-section">

    @if(request('search') || request('check_in') || request('city'))
        <div class="results-banner">
            <div>
                <h3>
                    @if(request('check_in') && request('check_out'))
                        Available from {{ \Carbon\Carbon::parse(request('check_in'))->format('d M') }}
                        to {{ \Carbon\Carbon::parse(request('check_out'))->format('d M Y') }}
                        @if(request('search')) 
                            in "{{ request('search') }}" 
                        @endif

                    @elseif(request('city'))
                        Properties in {{ request('city') }}

                    @else
                        Results for "{{ request('search') }}"
                    @endif
                </h3>

                <p>
                    {{ $properties->count() }}
                    {{ $properties->count() == 1 ? 'property' : 'properties' }}
                    found
                </p>
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

            <div class="section-header-right">
                @if(!request('search') && !request('city') && !request('check_in'))
                <a href="{{ route('home') }}" class="view-all-btn">
                    <i class="fa-solid fa-building"></i> View All
                </a>
                @endif

                @if($properties->count() > 0)
                <div class="slider-nav">
                    <button class="slider-btn slider-btn-outline" id="propSliderPrev" aria-label="Scroll left" type="button">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="slider-btn slider-btn-filled" id="propSliderNext" aria-label="Scroll right" type="button">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                @endif
            </div>
        </div>

        @if($properties->count() > 0)
        <!-- ================================================
             PROPERTY SLIDER (pure CSS Grid, no library)
             grid-template-rows: 2 fixed rows + grid-auto-flow:
             column = always 2 rows, columns keep extending
             sideways -> horizontal scroll with arrow buttons.
             ================================================ -->
        <div class="property-slider-wrapper">
            <div class="property-grid" id="propertySliderTrack">
                @foreach($properties as $property)
                <div class="property-card"
                     data-city="{{ strtolower($property->city) }}"
                     data-title="{{ strtolower($property->title) }}">

                    <a href="{{ route('property.show', $property->id) }}" class="prop-link">
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
                                <i class="fa-solid fa-location-dot icon-dark"></i>
                                {{ $property->location }}, {{ $property->city }}
                            </p>
                            <div class="prop-features">
                                <span><i class="fa-solid fa-bed icon-gray"></i> {{ $property->bedrooms }} Beds</span>
                                <span><i class="fa-solid fa-bath icon-gray"></i> {{ $property->bathrooms }} Baths</span>
                                @if($property->area_sqft)
                                <span><i class="fa-solid fa-vector-square icon-gray"></i> {{ $property->area_sqft }} sqft</span>
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
                        <a href="{{ route('property.show', $property->id) }}" class="book-btn1">Book Now</a>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
        <!-- ================================================
             END PROPERTY SLIDER
             ================================================ -->
        @else
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
                <a href="{{ route('property.create') }}" class="book-btn add-property-btn">
                    <i class="fa-solid fa-plus"></i> Add Property
                </a>
                @endauth
            @endif
        </div>
        @endif
    </div>

    <!-- WHY SMART RENT -->
    <div class="why-section">

        <!-- why-Heading -->
        <div class="why-heading">
            <div class="section-label">Why Choose Us</div>
            <h2 class="why-title">Why <span>Smart Rent</span> is Different</h2>
            <p class="why-sub">We built Smart Rent to make renting in Pakistan simple, safe, and stress-free — for both owners and renters.</p>
        </div>
        <!-- end why-Heading -->
        
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
        <div class="section-heading-center">
            <div class="section-label section-label-center">How It Works</div>
            <h2 class="section-title-lg">3 Simple Steps to<br>Find Your Home</h2>
            <p class="section-desc">Renting a property has never been this easy. Follow these simple steps and move in quickly.</p>
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
        <div class="section-heading-center">
            <div class="section-label section-label-center">Testimonials</div>
            <h2 class="section-title-lg">What Our Users Say</h2>
            <p class="section-desc">Real experiences from real people who found their homes on Smart Rent.</p>
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

      @include('footer')

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

/* ============================================================
   PROPERTY SLIDER — pure CSS Grid + button scroll (no library)
   Track shows a 2-row grid; arrows scroll one "page" (the full
   visible width) left/right at a time.
   ============================================================ */
document.addEventListener('DOMContentLoaded', function () {
    var track   = document.getElementById('propertySliderTrack');
    var prevBtn = document.getElementById('propSliderPrev');
    var nextBtn = document.getElementById('propSliderNext');

    if (!track || !prevBtn || !nextBtn) return;

    function updateButtonStates() {
        var maxScrollLeft = track.scrollWidth - track.clientWidth;
        prevBtn.classList.toggle('slider-btn-disabled', track.scrollLeft <= 5);
        nextBtn.classList.toggle('slider-btn-disabled', track.scrollLeft >= maxScrollLeft - 5);
    }

    prevBtn.addEventListener('click', function () {
        track.scrollBy({ left: -track.clientWidth, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', function () {
        track.scrollBy({ left: track.clientWidth, behavior: 'smooth' });
    });

    track.addEventListener('scroll', updateButtonStates);
    window.addEventListener('resize', updateButtonStates);

    updateButtonStates();
});
</script>

</body>
</html>