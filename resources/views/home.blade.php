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

    @foreach($properties as $property)
    <div class="card">
        <img src="{{ asset('property/'.$property->image) }}">
        <h3>{{ $property->title }}</h3>
        <p>{{ $property->location }}</p>
        <h4>₨{{ $property->price }}</h4>
        <a href="/booking/{{ $property->id }}">Book Now</a>
    </div>
    @endforeach

    {{-- MODAL SCRIPTS --}}
    @include('Modal scripts')

</body>
</html>