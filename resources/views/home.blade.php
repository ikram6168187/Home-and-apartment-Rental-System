<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @include('Modal style')

<style>
.b{ margin-top:40px; display:flex; justify-content:center; align-items:center; }
.hero{
    width:95%;
    background-image:url('images/hero1.jpg');
    background-repeat:no-repeat;
    background-position:center;
    background-size:cover;
    border-radius:20px;
}
.content{
    border-radius:20px; height:440px;
    background-color:rgba(40,40,40,0.4);
    color:white; padding:80px 0px;
    display:flex; justify-content:center;
    align-items:center; flex-direction:column; gap:16px;
}
.box{
    display:flex; justify-content:center;
    align-items:center; flex-wrap:wrap;
    width:85%; gap:0;
    background-color:white; color:black;
    border-radius:12px; overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,0.15);
}
.box1{
    display:flex; justify-content:center;
    align-items:flex-start; gap:4px;
    flex-direction:column;
    padding:12px 20px;
    border-right:2px solid #eee;
    flex:1; min-width:140px;
}
.box1:last-child{ border-right:none; }
.box1 p{ font-size:11px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:0.5px; margin:0 0 4px; }
.box1 input{width:100%;border:1px solid #111010;border-radius:6px;padding:8px 10px;outline:none;font-size:14px;background:#fff;}

.search-btn{
    background:rgb(15, 13, 6); color:#fff;
    border:none; padding:8px 10px;
    font-size:14px; font-weight:600;
    cursor:pointer; transition:0.2s;
    display:flex; align-items:center; gap:6px;
    height:40px; white-space:nowrap;
    margin-right:15px;
    margin-top:22px;
}
.search-btn:hover{ background:#1a1a1a; }

/* CITIES */
.c{ margin-top:40px; display:flex; justify-content:center; }
.cities{
    width:95%; display:flex; justify-content:center;
    align-items:center; flex-wrap:wrap; gap:15px;
}
.city{
    width:150px; height:150px; background:white;
    padding:20px; border-radius:15px; text-align:center;
    display:flex; flex-direction:column;
    justify-content:center; align-items:center;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
    transition:0.3s ease-in-out; cursor:pointer;
    border:2px solid transparent;
}
.city:hover{ transform:translateY(-8px); box-shadow:0px 8px 20px rgba(0,0,0,0.2); }
.city.active-city{ border-color:rgb(51,47,46); box-shadow:0px 8px 20px rgba(51,47,46,0.2); }
.city img{ width:80px; height:80px; object-fit:contain; margin-bottom:12px; transition:0.3s; }
.city:hover img{ transform:scale(1.1); }
.city span{ color:black; font-weight:bold; font-size:13px; }

/* PROPERTIES SECTION */
.properties-section{ margin-top:40px; padding:0 2.5%; margin-bottom:40px; }
.section-header{
    display:flex; align-items:center;
    justify-content:space-between; margin-bottom:24px;
}
.section-header h2{ font-size:24px; font-weight:700; color:#1a1a2e; margin:0; }
.section-header p{ font-size:14px; color:#888; margin:0; }
.clear-filter-btn{
    display:none; align-items:center; gap:6px;
    background:#f5ede0; color:#8a5c30;
    border:1px solid #e8d5b7; padding:7px 16px;
    border-radius:20px; font-size:13px; font-weight:600;
    cursor:pointer; transition:0.2s;
}
.clear-filter-btn:hover{ background:#e8d5b7; }

/* ACTIVE FILTER INFO */
.filter-info{
    display:none; background:#f8f4f0;
    border:1px solid #e8d5b7; border-radius:10px;
    padding:12px 18px; margin-bottom:20px;
    font-size:13px; color:#8a5c30;
    align-items:center; gap:8px;
}

/* PROPERTY GRID */
.property-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(280px,1fr));
    gap:20px;
}
.property-card{
    background:#fff; border-radius:16px;
    overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08);
    transition:0.3s; border:1px solid #eee;
}
.property-card:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 24px rgba(0,0,0,0.12);
}
.prop-img{
    height:200px; overflow:hidden; position:relative;
}
.prop-img img{ width:100%; height:100%; object-fit:cover; }
.prop-img .no-img{
    width:100%; height:100%;
    background:linear-gradient(135deg,#2d2926,#8a6040);
    display:flex; align-items:center; justify-content:center;
}
.prop-img .no-img i{ font-size:48px; color:rgba(255,255,255,0.3); }
.type-badge{
    position:absolute; top:12px; left:12px;
    background:rgb(51,47,46); color:#fff;
    padding:4px 12px; border-radius:20px;
    font-size:11px; font-weight:600; text-transform:capitalize;
}
.rent-badge{
    position:absolute; top:12px; right:12px;
    background:#e1f5ee; color:#0f6e56;
    padding:4px 12px; border-radius:20px;
    font-size:11px; font-weight:600;
}
.prop-body{ padding:16px; }
.prop-title{
    font-size:15px; font-weight:700; color:#1a1a2e;
    margin:0 0 6px; white-space:nowrap;
    overflow:hidden; text-overflow:ellipsis;
}
.prop-loc{
    font-size:13px; color:#888; margin:0 0 12px;
    display:flex; align-items:center; gap:4px;
}
.prop-features{
    display:flex; gap:14px; margin-bottom:14px;
    font-size:12px; color:#666;
}
.prop-features span{ display:flex; align-items:center; gap:4px; }
.prop-footer{ display:flex; align-items:center; justify-content:space-between; }
.prop-price{ font-size:18px; font-weight:700; color:rgb(51,47,46); }
.prop-price small{ font-size:11px; color:#888; font-weight:400; }
.book-btn{
    background:rgb(51,47,46); color:#fff;
    padding:8px 18px; border-radius:20px;
    font-size:12px; font-weight:600;
    text-decoration:none; transition:0.2s;
}
.book-btn:hover{ background:#1a1a1a; }

/* EMPTY STATE */
.empty-state{
    grid-column:1/-1; text-align:center;
    padding:60px 20px; color:#888;
}
.empty-state i{ font-size:56px; color:#ddd; display:block; margin-bottom:16px; }
.empty-state h3{ font-size:18px; margin-bottom:8px; color:#555; }
.empty-state p{ font-size:14px; }
.empty-state .suggest-cities{
    display:flex; gap:8px; justify-content:center;
    flex-wrap:wrap; margin-top:16px;
}
.suggest-city{
    background:#f5ede0; color:#8a5c30;
    border:1px solid #e8d5b7; padding:6px 16px;
    border-radius:20px; font-size:13px; font-weight:600;
    cursor:pointer; transition:0.2s;
}
.suggest-city:hover{ background:#e8d5b7; }

/* SEARCH RESULTS INFO */
.results-banner{
    background:linear-gradient(135deg,#2d2926,#5c4a3a);
    border-radius:12px; padding:16px 22px;
    margin-bottom:20px; display:none;
    align-items:center; justify-content:space-between; color:#fff;
}
.results-banner h3{ font-size:15px; font-weight:600; margin:0 0 3px; }
.results-banner p{ font-size:12px; color:rgba(255,255,255,0.7); margin:0; }
.results-banner .close-search{
    background:rgba(255,255,255,0.15); color:#fff;
    border:1px solid rgba(255,255,255,0.2);
    padding:6px 14px; border-radius:20px;
    font-size:12px; font-weight:600; cursor:pointer;
}
</style>
</head>
<body>

    @include('navbar')
    @include('Login modal')
    @include('Signup modal')
    @include('Logout modal')

    <!-- HERO -->
    <div class="b">
        <div class="hero">
            <div class="content">
                <p style="font-size:14px; opacity:0.85;">Find Your Dream Place</p>
                <h1 style="font-size:32px; font-weight:700;">For Better Experience</h1>

                <!-- SEARCH FORM -->
                <form action="{{ route('home') }}" method="GET" style="width:85%;">
                    <div class="box">
                        <div class="box1">
                            <p>Where</p>
                            <input type="text" name="search" id="searchInput"
                                   placeholder="City or location..."
                                   value="{{ request('search') }}">
                        </div>
                        <div class="box1">
                            <p>Check In</p>
                            <input type="date" name="check_in" id="checkIn"
                                   value="{{ request('check_in') }}"
                                   min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="box1">
                            <p>Check Out</p>
                            <input type="date" name="check_out" id="checkOut"
                                   value="{{ request('check_out') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>
                        <div class="box1" style="border-right:none;">
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
            <div class="city {{ request('city') == 'Lahore' ? 'active-city' : '' }}" onclick="filterByCity('Lahore', this)">
                <img src="images/lahore.png" alt=""><span>LAHORE</span>
            </div>
            <div class="city {{ request('city') == 'Islamabad' ? 'active-city' : '' }}" onclick="filterByCity('Islamabad', this)">
                <img src="images/islamabad.png" alt=""><span>ISLAMABAD</span>
            </div>
            <div class="city {{ request('city') == 'Karachi' ? 'active-city' : '' }}" onclick="filterByCity('Karachi', this)">
                <img src="images/karachi.png" alt=""><span>KARACHI</span>
            </div>
            <div class="city {{ request('city') == 'Gujranwala' ? 'active-city' : '' }}" onclick="filterByCity('Gujranwala', this)">
                <img src="images/Gujranwala.png" alt=""><span>GUJRANWALA</span>
            </div>
            <div class="city {{ request('city') == 'Faisalabad' ? 'active-city' : '' }}" onclick="filterByCity('Faisalabad', this)">
                <img src="images/faislabad.png" alt=""><span>FAISALABAD</span>
            </div>
            <div class="city {{ request('city') == 'Peshawar' ? 'active-city' : '' }}" onclick="filterByCity('Peshawar', this)">
                <img src="images/peshawar.png" alt=""><span>PESHAWAR</span>
            </div>
        </div>
    </div>

    <!-- PROPERTIES SECTION -->
    <div class="properties-section">

        <!-- SEARCH RESULTS BANNER -->
        @if(request('search') || request('check_in') || request('city'))
        <div class="results-banner" style="display:flex;">
            <div>
                <h3>
                    @if(request('check_in') && request('check_out'))
                        Available properties
                        @if(request('search')) in "{{ request('search') }}" @endif
                        from {{ \Carbon\Carbon::parse(request('check_in'))->format('d M') }}
                        to {{ \Carbon\Carbon::parse(request('check_out'))->format('d M Y') }}
                    @elseif(request('city'))
                        Properties in {{ request('city') }}
                    @else
                        Results for "{{ request('search') }}"
                    @endif
                </h3>
                <p>{{ $properties->count() }} {{ $properties->count() == 1 ? 'property' : 'properties' }} found</p>
            </div>
            <a href="{{ route('home') }}" class="close-search">
                <i class="fa-solid fa-xmark"></i> Clear Search
            </a>
        </div>
        @endif

        <div class="section-header">
            <div>
                <h2>
                    @if(request('city'))
                        Properties in {{ request('city') }}
                    @elseif(request('search'))
                        Search Results
                    @else
                        Featured Properties
                    @endif
                </h2>
                <p>Find your perfect rental home across Pakistan</p>
            </div>
        </div>

        <div class="property-grid">
            @forelse($properties as $property)
            <div class="property-card"
                 data-city="{{ strtolower($property->city) }}"
                 data-title="{{ strtolower($property->title) }}"
                 data-location="{{ strtolower($property->location) }}">

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
                    <div class="prop-footer">
                        <div>
                            <span class="prop-price">₨ {{ number_format($property->price) }}</span>
                            <small>/month</small>
                        </div>
                        <a href="{{ route('property.show', $property->id) }}" class="book-btn">Book Now</a>
                    </div>
                </div>

            </div>
            @empty
            <div class="empty-state">
                <i class="fa-solid fa-building-circle-xmark"></i>
                @if(request('check_in') && request('check_out'))
                    <h3>No available properties for selected dates</h3>
                    <p>Try different dates or explore other cities</p>
                @elseif(request('search') || request('city'))
                    <h3>No properties found in "{{ request('search') ?? request('city') }}"</h3>
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
                @endif
            </div>
            @endforelse
        </div>
    </div>

    @include('Modal scripts')

<script>
// City filter — URL ke saath
function filterByCity(city, el) {
    // Active class update
    document.querySelectorAll('.city').forEach(c => c.classList.remove('active-city'));
    if (el) el.classList.add('active-city');

    // URL update karo
    var url = new URL(window.location.href);

    // Agar same city dobara click karo — clear karo
    if (url.searchParams.get('city') === city) {
        url.searchParams.delete('city');
    } else {
        url.searchParams.set('city', city);
    }

    window.location.href = url.toString();
}

// Check out min date — check in se pehle na ho
document.getElementById('checkIn').addEventListener('change', function() {
    var checkOut = document.getElementById('checkOut');
    checkOut.min = this.value;
    if (checkOut.value && checkOut.value <= this.value) {
        checkOut.value = '';
    }
});
</script>

</body>
</html>
