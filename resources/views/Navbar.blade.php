<style>

*{
    padding:0;
    margin:0;
    box-sizing:border-box;
    font-family:'Times New Roman', Times, serif;
}

a{
    text-decoration:none;
    color:white;
}

body{
    background:#f5f5f5;
}

.a{
    display:flex;
    justify-content:center;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:baseline;
    flex-wrap:wrap;
    background-color:rgb(51,47,46);
    width:95%;
    padding:20px 20px;
    border-bottom-left-radius:20px;
    border-bottom-right-radius:20px;
}

.logo{
    display:flex;
    justify-content:center;
    align-items:center;
}

.logo a{
    text-decoration:none;
    color:white;
}

.navbar ul{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
    list-style:none;
    margin:0;
    padding:0;
}

.navbar ul li{
    border-radius:8px;
    transition:0.3s ease;
}

.navbar ul li a{
    display:block;
    padding:10px 18px;
    text-decoration:none;
    color:white;
    font-weight:600;
    border-radius:8px;
    transition:0.3s ease;
}

.navbar ul li a:hover,
.navbar ul li a.active{
    background:#555;
    box-shadow:0 4px 12px rgba(0,0,0,0.35);
    transform:translateY(-2px);
}

.icons{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:20px;
    color:white;
}

.add-property{
    display:inline-block;
    padding:10px 18px;
    border:1px solid rgb(252,246,246);
    border-radius:25px;
    color:rgb(243,253,245);
    cursor:pointer;
    transition:0.2s;
    background-color:rgb(16,16,17);
}

.add-property:hover{
    cursor:pointer;
    transform:translateY(-3px);
}

.circle{
    display:flex;
    justify-content:center;
    align-items:center;
    height:30px;
    width:30px;
    padding:20px;
    border-radius:50%;
    border:1px solid white;
    color:white;
}

.custom-dropdown{
    position:absolute;
    top:50px;
    right:0;
    background-color:#ffffff;
    min-width:180px;
    box-shadow:0px 8px 16px 0px rgba(0,0,0,0.15);
    border-radius:8px;
    z-index:1000;
    padding:10px 0;
    text-align:left;
}

.custom-dropdown ul{
    list-style:none;
    padding:0;
    margin:0;
}

.custom-dropdown ul li a{
    color:#333;
    padding:10px 15px;
    text-decoration:none;
    display:block;
    font-size:14px;
    transition:background 0.2s;
}

.custom-dropdown ul li a:hover{
    background-color:#f5f5f5;
    color:#007bff;
}

.custom-dropdown ul li a i{
    margin-right:8px;
    width:15px;
}

.text-danger{
    color:#dc3545 !important;
}

/* Responsive Navbar */
@media screen and (max-width:768px){

    .header{
        flex-direction:column;
        align-items:center;
        gap:15px;
    }

    .navbar ul{
        flex-wrap:wrap;
        gap:5px;
    }

    .navbar ul li a{
        padding:8px 12px;
    }

}

@media screen and (max-width:480px){

    .header{
        display:flex;
        flex-direction:column;
    }

    .navbar ul{
        justify-content:center;
    }

}

</style>


<div class="a">

    <div class="header">

        <!-- Logo -->
        <div class="logo">

            <h1>
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-house-chimney"></i>
                    Smart Rent
                </a>
            </h1>

        </div>


        <!-- Navbar -->
        <div class="navbar">

            <ul>

                <!-- Home -->
                <li>
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>


                <!-- Services -->
                <li>
                    <a href="{{ route('services.index') }}"
                       class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                        Services
                    </a>
                </li>


                <!-- Blog -->
                <li>
                    <a href="{{ route('blog.index') }}"
                       class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                        Blog
                    </a>
                </li>


                <!-- About -->
                <li>
                    <a href="{{ route('about') }}"
                       class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        About
                    </a>
                </li>


                <!-- Contact -->
                <li>
                    <a href="{{ route('contact') }}"
                       class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        Contact
                    </a>
                </li>

            </ul>

        </div>


        <!-- Right Side Icons -->
        <div class="icons">

            <!-- Add Property -->
            @if(Auth::check())

                <a href="{{ route('property.create') }}">
                    <p class="add-property">Add Property</p>
                </a>

            @else

                <a href="javascript:void(0);" onclick="openLoginModal()">
                    <p class="add-property">Add Property</p>
                </a>

            @endif


            <!-- Globe -->
            <div class="circle">

                <a href="#">
                    <i class="fa-solid fa-globe"></i>
                </a>

            </div>


            <!-- Menu -->
            <div class="circle" style="position:relative;">

                <a href="javascript:void(0);"
                   onclick="toggleMenu()"
                   style="text-decoration:none; color:inherit;">

                    <i class="fa-solid fa-bars-staggered"></i>

                </a>


                <!-- Dropdown -->
                <div id="dropdownMenu"
                     class="custom-dropdown"
                     style="display:none;">

                    <ul>

                        <!-- Guest -->
                        @guest

                            <li>
                                <a href="javascript:void(0);"
                                   onclick="toggleMenu(); openLoginModal();">

                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    Login

                                </a>
                            </li>


                            <li>
                                <a href="javascript:void(0);"
                                   onclick="toggleMenu(); openSignupModal();">

                                    <i class="fa-solid fa-user-plus"></i>
                                    Signup

                                </a>
                            </li>

                        @endguest


                        <!-- Logged In User -->
                        @auth

    <li>
        <a href="{{ route('dashboard') }}">
            <i class="fa-solid fa-gauge"></i>
            My Account
        </a>
    </li>

    <li>
        <a href="{{ route('services.myRequests') }}">
            <i class="fa-solid fa-clipboard-list"></i>
            My Service Requests
        </a>
    </li>

    <li>

        <form action="{{ route('logout') }}"
              method="POST"
              id="logout-form"
              style="display:none;">

            @csrf

        </form>

        <a href="#"
           onclick="event.preventDefault(); toggleMenu(); openLogoutConfirm();"
           class="text-danger">

            <i class="fa-solid fa-right-from-bracket"></i>
            Logout

        </a>

    </li>

@endauth

                        <hr style="margin:5px 0; border-color:#eee;">


                        <li>
                            <a href="{{ route('contact') }}">
                                <i class="fa-solid fa-headset"></i>
                                Support & Help

                            </a>
                        </li>


                        <li>
                            <a href="{{ route('about.system') }}">

                                <i class="fa-solid fa-circle-info"></i>
                                About System

                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>