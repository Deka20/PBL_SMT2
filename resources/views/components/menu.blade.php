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
        .nav-link.active {
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 500;
        }

        .nav-link:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        #mobile-menu {
            transition: max-height 0.3s ease-in-out;
            max-height: 0;
            overflow: hidden;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 40;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        #mobile-menu.show {
            max-height: 500px;
            overflow-y: auto;
        }

        html {
            scroll-behavior: smooth;
        }

        section {
            min-height: 100vh;
            padding: 2rem;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Desktop dan Mobile Navbar -->
    <div class="navbar sticky top-0 z-50 bg-[#fef6f6] shadow-lg relative">
        <!-- Logo - Left side -->
        <div class="navbar-start">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.jpg') }}" class="h-8 w-8 rounded-full object-cover"
                    alt="Potretine Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-pink-600">Potrétine</span>
            </a>
        </div>

        <!-- Desktop Navbar - Hidden on mobile -->
        <div class="navbar-center hidden lg:flex">
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="/" class="nav-link active" data-section="home">Beranda</a></li>
                    <li><a href="#studio" class="nav-link" data-section="studio">Studio</a></li>
                    <li><a href="#kontak" class="nav-link" data-section="kontak">Kontak</a></li>
                </ul>
            </nav>
        </div>

        <!-- Navbar Bagian Kanan -->
        <div class="navbar-end">
            <div class="hidden lg:flex items-center">
                @auth
                    <!-- Search Bar untuk user sudah login -->
                    <div class="relative w-full max-w-sm mr-4">
                        <input type="text" placeholder="Cari studio..."
                            class="input input-bordered w-full !rounded-3xl pl-4 pr-14 focus:outline-none" />
                        <button
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-pink-200 hover:bg-pink-300 text-pink-700 px-3 py-2 rounded-full shadow-sm transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <!-- User Dropdown Menu -->
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-8 rounded-full">
                                @if (Auth::user()->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                        alt="{{ Auth::user()->nama_pengguna }}" />
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white rounded-box w-52">
                            <div class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-bold">{{ Auth::user()->nama_pengguna }}</div>
                                <div class="text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <li><a href="/profil">Profil</a></li>
                            <li><a href="/keamanan">Pengaturan</a></li>
                            <li><a href="/riwayat">Riwayat Pemesanan</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Tombol Masuk/Daftar untuk guest -->
                    <a href="{{ route('login') }}">
                        <button class="btn !bg-black !text-white hover:bg-gray-800 mr-2">Masuk</button>
                    </a>
                    <a href="{{ route('auth.daftar') }}">
                        <button class="btn border-black hover:bg-gray-100">Daftar</button>
                    </a>

                    <!-- Search Bar untuk guest -->
                    <div class="relative w-full max-w-sm mr-4 ml-4">
                        <input type="text" placeholder="Cari studio..."
                            class="input input-bordered w-full !rounded-3xl pl-4 pr-14 focus:outline-none" />
                        <button
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-pink-200 hover:bg-pink-300 text-pink-700 px-3 py-2 rounded-full shadow-sm transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu -->
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

        <div id="mobile-menu" class="lg:hidden">
            <div class="p-4 space-y-4">
                <!-- Mobile Navigation Links -->
                <ul class="menu menu-vertical w-full">
                    <li><a href="/" class="nav-link active" data-section="home">Beranda</a></li>
                    <li><a href="#studio" class="nav-link" data-section="studio">Studio</a></li>
                    <li><a href="#kontak" class="nav-link" data-section="kontak">Kontak</a></li>
                </ul>

                <!-- Mobile Search Bar -->
                <div class="mt-4">
                    <div class="join w-full">
                        <input type="text" placeholder="Cari studio..."
                            class="input input-bordered w-full join-item" />
                        <button class="btn join-item bg-pink-200 hover:bg-pink-300 border-pink-300">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Tombol Masuk/Daftar -->
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
                        <li><a href="/profil">Profil</a></li>
                        <li><a href="/keamanan">Pengaturan</a></li>
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
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenuBtn = document.getElementById("mobile-menu-btn");
            const mobileMenu = document.getElementById("mobile-menu");
            const menuIcon = document.getElementById("menu-icon");
            const closeIcon = document.getElementById("close-icon");
            const navLinks = document.querySelectorAll(".nav-link");
            const sections = document.querySelectorAll("section");

            let lastClickedLink = document.querySelector(".nav-link.active");

            mobileMenuBtn.addEventListener("click", function() {
                mobileMenu.classList.toggle("show");
                menuIcon.classList.toggle("hidden");
                closeIcon.classList.toggle("hidden");
            });

            document.addEventListener("click", function(event) {
                const isClickInsideMenu = mobileMenu.contains(event.target);
                const isClickOnMenuBtn = mobileMenuBtn.contains(event.target);

                if (mobileMenu.classList.contains("show") && !isClickInsideMenu && !isClickOnMenuBtn) {
                    mobileMenu.classList.remove("show");
                    menuIcon.classList.remove("hidden");
                    closeIcon.classList.add("hidden");
                }
            });

            navLinks.forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute("href");
                    const targetElement = document.querySelector(targetId);

                    const sectionName = this.getAttribute("data-section");

                    navLinks.forEach(navLink => navLink.classList.remove("active"));

                    document.querySelectorAll(`.nav-link[data-section="${sectionName}"]`).forEach(
                        navLink => {
                            navLink.classList.add("active");
                        });

                    lastClickedLink = this;

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop,
                            behavior: "smooth"
                        });
                    }

                    mobileMenu.classList.remove("show");
                    menuIcon.classList.remove("hidden");
                    closeIcon.classList.add("hidden");
                });
            });

            let isScrolling = false;
            let userJustClicked = false;

            window.addEventListener("scroll", function() {
                if (!isScrolling) {
                    isScrolling = true;

                    if (!userJustClicked) {
                        setTimeout(function() {
                            highlightActiveSection();
                            isScrolling = false;
                        }, 100);
                    } else {
                        isScrolling = false;
                    }
                }
            });

            function isInViewport(element, threshold = 0.5) {
                const rect = element.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;

                return (
                    (rect.top <= windowHeight * threshold) &&
                    (rect.bottom >= windowHeight * threshold)
                );
            }

            function highlightActiveSection() {
                let activeSection = null;

                sections.forEach(section => {
                    if (isInViewport(section)) {
                        activeSection = section;
                    }
                });

                if (activeSection) {
                    const sectionId = activeSection.id;

                    navLinks.forEach(link => link.classList.remove("active"));

                    document.querySelectorAll(`.nav-link[data-section="${sectionId}"]`).forEach(link => {
                        link.classList.add("active");
                    });
                }
            }

            highlightActiveSection();

            navLinks.forEach(link => {
                link.addEventListener("click", function() {
                    userJustClicked = true;
                    setTimeout(() => {
                        userJustClicked = false;
                    }, 1000);
                });
            });
        });
    </script>
</body>

</html>
