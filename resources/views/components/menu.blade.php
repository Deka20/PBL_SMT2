<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Potretine</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        /* Custom style for active link */
        .menu a.active,
        nav ul li a.active {
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 500;
            background-color: transparent !important;
        }

        /* Remove background from menu items */
        .menu a,
        nav ul li a {
            background-color: transparent !important;
        }

        /* Hover effect for nav links */
        nav ul li a:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        /* Mobile menu transition */
        #mobile-menu {
            transition: all 0.3s ease-in-out;
            max-height: 0;
            overflow: hidden;
            background-color: white;
        }

        #mobile-menu.show {
            max-height: 1000px;
            /* Adjust based on content */
        }

        /* Search bar styling */
        .search-container {
            max-width: 250px;
            margin-left: 15px;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Desktop and Mobile Navbar -->
    <div class="navbar bg-[#fef6f6] shadow-sm">
        <!-- Logo - Left side -->
        <div class="navbar-start">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.jpg') }}" class="h-8 w-8 rounded-full object-cover"
                    alt="Potretine Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-800">Potretine</span>
            </a>
        </div>

        <!-- Desktop Navigation (centered) - Hidden on mobile -->
        <div class="navbar-center hidden lg:flex">
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="/studio" class="{{ request()->is('studio*') ? 'active' : '' }}">Studio</a></li>
                    <li><a href="/pemesanan" class="{{ request()->is('pemesanan*') ? 'active' : '' }}">Pemesanan</a>
                    </li>
                    <li><a href="/kontak" class="{{ request()->is('kontak*') ? 'active' : '' }}">Kontak</a></li>
                </ul>
            </nav>
        </div>

        <!-- Right Side Content -->
        <div class="navbar-end">
            <!-- Authentication buttons and Search - Hidden on mobile -->
            <div class="hidden lg:flex items-center">
                @auth
                    <!-- Search Bar for Logged In Users -->
                    <div class="search-container mr-4">
                        <div class="join w-full">
                            <input type="text" placeholder="Cari studio..."
                                class="input input-bordered w-full join-item focus:outline-none" />
                            <button class="btn join-item !bg-pink-200 hover:bg-pink-300 border-pink-300">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- User Dropdown Menu -->
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-8 rounded-full">
                                <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.jpg') }}"
                                    alt="{{ Auth::user()->name }}" />
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white rounded-box w-52">
                            <div class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-bold">{{ Auth::user()->nama_pengguna }}</div>
                                <div class="text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <li><a href="">Profil</a></li>
                            <li><a href="">Pengaturan</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Auth Buttons for Guests -->
                    <a href="{{ route('login') }}">
                        <button class="btn bg-black text-white hover:bg-gray-800 mr-2">Masuk</button>
                    </a>
                    <a href="{{ route('auth.daftar') }}">
                        <button class="btn border-black hover:bg-gray-100">Daftar</button>
                    </a>

                    <!-- Search Bar for Guests -->
                    <div class="join">
                        <input type="text" placeholder="Cari studio..."
                            class="input input-bordered join-item bg-white focus:outline-none w-40 md:w-52" />
                        <button class="btn join-item bg-pink-500 hover:bg-pink-600 text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button - Only visible on mobile -->
            <div class="flex lg:hidden">
                <button id="mobile-menu-btn" class="btn btn-square btn-ghost">
                    <svg id="menu-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by Default) -->
    <div id="mobile-menu" class="lg:hidden border-t border-gray-200 w-full">
        <div class="p-4 space-y-4">
            <!-- Mobile Navigation Links -->
            <ul class="menu menu-vertical w-full">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="/studio" class="{{ request()->is('studio*') ? 'active' : '' }}">Studio</a></li>
                <li><a href="/pemesanan" class="{{ request()->is('pemesanan*') ? 'active' : '' }}">Pemesanan</a></li>
                <li><a href="/kontak" class="{{ request()->is('kontak*') ? 'active' : '' }}">Kontak</a></li>
            </ul>

            <!-- Mobile Search -->
            <div class="mt-4">
                <div class="join w-full">
                    <input type="text" placeholder="Cari studio..."
                        class="input input-bordered w-full join-item" />
                    <button class="btn join-item bg-pink-200 hover:bg-pink-300 border-pink-300">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Auth Buttons/User Section -->
            @auth
                <div class="divider"></div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="avatar">
                        <div class="w-10 rounded-full">
                            <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.jpg') }}"
                                alt="{{ Auth::user()->nama_pengguna }}">
                        </div>
                    </div>
                    <div>
                        <span class="font-medium">{{ Auth::user()->nama_pengguna }}</span>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <ul class="menu menu-vertical w-full">
                    <li><a href="" class="{{ request()->is('profile*') ? 'active' : '' }}">Profil</a></li>
                    <li><a href="" class="{{ request()->is('settings*') ? 'active' : '' }}">Pengaturan</a></li>
                    <li><a href="" class="{{ request()->is('orders/history*') ? 'active' : '' }}">Riwayat
                            Pemesanan</a></li>
                </ul>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-outline w-full">Keluar</button>
                </form>
            @else
                <div class="divider"></div>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('login') }}">
                        <button class="btn bg-black text-white hover:bg-gray-800 w-full">Masuk</button>
                    </a>
                    <a href="{{ route('auth.daftar') }}">
                        <button class="btn border-black hover:bg-gray-100 w-full">Daftar</button>
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenuBtn = document.getElementById("mobile-menu-btn");
            const mobileMenu = document.getElementById("mobile-menu");
            const menuIcon = document.getElementById("menu-icon");
            const closeIcon = document.getElementById("close-icon");

            mobileMenuBtn.addEventListener("click", function() {
                mobileMenu.classList.toggle("show");
                menuIcon.classList.toggle("hidden");
                closeIcon.classList.toggle("hidden");
            });

            // Close mobile menu when clicking on a link
            const mobileLinks = mobileMenu.querySelectorAll("a");
            mobileLinks.forEach(link => {
                link.addEventListener("click", function() {
                    mobileMenu.classList.remove("show");
                    menuIcon.classList.remove("hidden");
                    closeIcon.classList.add("hidden");
                });
            });

            // Highlight active link based on current URL
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav ul li a, .menu a');

            navLinks.forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath === currentPath ||
                    (linkPath !== '/' && currentPath.startsWith(linkPath))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
