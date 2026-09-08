<!-- External CSS Link -->
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

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
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                <!-- Services -->
                <li>
                    <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
                        Services
                    </a>
                </li>

                <!-- Blog -->
                <li>
                    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                        Blog
                    </a>
                </li>

                <!-- About -->
                <li>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                        About
                    </a>
                </li>

                <!-- Contact -->
                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
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
                <a href="javascript:void(0);" onclick="toggleMenu()" style="text-decoration:none; color:inherit;">
                    <i class="fa-solid fa-bars-staggered"></i>
                </a>

                <!-- Dropdown -->
                <div id="dropdownMenu" class="custom-dropdown" style="display:none;">
                    <ul>
                        <!-- Guest -->
                        @guest
                            <li>
                                <a href="javascript:void(0);" onclick="toggleMenu(); openLoginModal();">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    Login
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" onclick="toggleMenu(); openSignupModal();">
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
                                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">
                                    @csrf
                                </form>

                                <a href="#" onclick="event.preventDefault(); toggleMenu(); openLogoutConfirm();" class="text-danger">
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