<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Modal CSS --}}
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
    color:white; padding:100px 0px;
    display:flex; justify-content:center;
    align-items:center; flex-direction:column; gap:20px;
}
.box{
    display:flex; justify-content:center;
    align-items:center; flex-wrap:wrap;
    width:80%; gap:20px;
    background-color:white; color:black;
    padding:10px 40px; border-radius:10px;
}
.box1{ display:flex; justify-content:center; align-items:center; gap:10px; flex-direction:column; }
.box1 input{ padding:5px; text-align:center; }
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
}
.city:hover{ transform:translateY(-8px); box-shadow:0px 8px 20px rgba(0,0,0,0.2); }
.city img{ width:80px; height:80px; object-fit:contain; margin-bottom:12px; transition:0.3s; }
.city:hover img{ transform:scale(1.1); }
.city a{ color:black; font-weight:bold; text-decoration:none; font-size:13px; }
</style>
</head>
<body>

    {{-- NAVBAR --}}
    @include('navbar')

    {{-- LOGIN MODAL --}}
    @include('Login modal')

    {{-- SIGNUP MODAL --}}
    @include('Signup modal')

    {{-- LOGOUT MODAL --}}
    @include('Logout modal')

    <!-- HERO -->
    <div class="b">
        <div class="hero">
            <div class="content">
                <p>Find Your Dream Place</p>
                <h1>For Better Experience</h1>
                <div class="box">
                    <div class="box1"><p>Where</p><input type="text" placeholder="Search Destination"></div>
                    <div class="box1"><p>Check in</p><input type="datetime-local"></div>
                    <div class="box1"><p>Check Out</p><input type="datetime-local"></div>
                    <div class="box1"><p>Who</p><input type="number" placeholder="Add Guests"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- CITIES -->
    <div class="c">
        <div class="cities">
            <div class="city"><img src="images/lahore.png" alt=""><a href="#">LAHORE</a></div>
            <div class="city"><img src="images/islamabad.png" alt=""><a href="#">ISLAMABAD</a></div>
            <div class="city"><img src="images/karachi.png" alt=""><a href="#">KARACHI</a></div>
            <div class="city"><img src="images/Gujranwala.png" alt=""><a href="#">GUJRANWALA</a></div>
            <div class="city"><img src="images/faislabad.png" alt=""><a href="#">FAISALABAD</a></div>
            <div class="city"><img src="images/peshawar.png" alt=""><a href="#">PESHAWAR</a></div>
        </div>
    </div>

   

<!-- PROPERTIES SECTION -->
<div style="margin-top:40px; padding:0 2.5%; margin-bottom:40px;">
    <h2 style="text-align:center; font-size:24px; font-weight:700; color:#1a1a2e; margin-bottom:8px;">
        Featured Properties
    </h2>
    <p style="text-align:center; color:#888; font-size:14px; margin-bottom:28px;">
        Find your perfect rental home across Pakistan
    </p>

    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px,1fr)); gap:20px;">

        @forelse($properties as $property)
        <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08); transition:0.3s; border:1px solid #eee;"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)'"
             onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 12px rgba(0,0,0,0.08)'">

            {{-- IMAGE --}}
            <div style="height:200px; overflow:hidden; position:relative;">
                @if($property->image)
                    <img src="{{ asset('storage/'.$property->image) }}"
                         style="width:100%; height:100%; object-fit:cover;">
                @else
                    <div style="width:100%; height:100%; background:linear-gradient(135deg,#2d2926,#8a6040); display:flex; align-items:center; justify-content:center;">
                        <i class="fa-solid fa-building" style="font-size:48px; color:rgba(255,255,255,0.3);"></i>
                    </div>
                @endif

                {{-- TYPE BADGE --}}
                <span style="position:absolute; top:12px; left:12px; background:rgb(51,47,46); color:#fff; padding:4px 12px; border-radius:20px; font-size:11px; font-weight:600; text-transform:capitalize;">
                    {{ $property->type }}
                </span>

                {{-- RENT BADGE --}}
                <span style="position:absolute; top:12px; right:12px; background:#e1f5ee; color:#0f6e56; padding:4px 12px; border-radius:20px; font-size:11px; font-weight:600;">
                    For Rent
                </span>
            </div>

            {{-- CONTENT --}}
            <div style="padding:16px;">
                <h3 style="font-size:15px; font-weight:700; color:#1a1a2e; margin:0 0 6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $property->title }}
                </h3>

                <p style="font-size:13px; color:#888; margin:0 0 12px; display:flex; align-items:center; gap:4px;">
                    <i class="fa-solid fa-location-dot" style="color:rgb(51,47,46);"></i>
                    {{ $property->location }}, {{ $property->city }}
                </p>

                {{-- FEATURES --}}
                <div style="display:flex; gap:14px; margin-bottom:14px; font-size:12px; color:#666;">
                    <span><i class="fa-solid fa-bed" style="color:#888;"></i> {{ $property->bedrooms }} Beds</span>
                    <span><i class="fa-solid fa-bath" style="color:#888;"></i> {{ $property->bathrooms }} Baths</span>
                    @if($property->area_sqft)
                    <span><i class="fa-solid fa-vector-square" style="color:#888;"></i> {{ $property->area_sqft }} sqft</span>
                    @endif
                </div>

                {{-- PRICE + BUTTON --}}
                <div style="display:flex; align-items:center; justify-content:space-between;">
                    <div>
                        <span style="font-size:18px; font-weight:700; color:rgb(51,47,46);">
                            ₨ {{ number_format($property->price) }}
                        </span>
                        <span style="font-size:11px; color:#888;">/month</span>
                    </div>
                    <a href="/booking/{{ $property->id }}"
                       style="background:rgb(51,47,46); color:#fff; padding:8px 18px; border-radius:20px; font-size:12px; font-weight:600; text-decoration:none; transition:0.2s;"
                       onmouseover="this.style.background='#1a1a1a'"
                       onmouseout="this.style.background='rgb(51,47,46)'">
                        Book Now
                    </a>
                </div>
            </div>

        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px 20px; color:#888;">
            <i class="fa-solid fa-building-circle-xmark" style="font-size:48px; color:#ddd; display:block; margin-bottom:16px;"></i>
            <h3 style="font-size:16px; margin-bottom:8px;">No properties yet</h3>
            <p style="font-size:13px;">Be the first to list a property!</p>
        </div>
        @endforelse

    </div>
</div>


    {{-- MODAL SCRIPTS --}}
    @include('Modal scripts')

</body>
</html>