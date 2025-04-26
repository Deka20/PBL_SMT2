<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Potretine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    
    <nav class="bg-pink-100 fixed w-full z-20 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo dan bagian kiri navbar -->
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.jpg') }}" class="h-8 w-8 rounded-full object-cover" alt="Potretine Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-800">Potretine</span>
            </a>
            
            <div class="flex md:order-2 space-x-3 md:space-x-4 rtl:space-x-reverse">
                <!-- Search Bar -->
                <div class="relative hidden md:block mr-2">
                    <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-transparent border-b-gray-400 rounded-lg bg-transparent focus:ring-pink-200 focus:border-pink-200" placeholder="Search...">
                    <div class="absolute inset-y-0 end-2 flex items-center ps-3 pointer-events-none">
                        <i class="fas fa-search text-gray-500"></i>
                    </div>
                </div>
                
                <!-- Bagian ini akan berubah berdasarkan status login -->
                @auth
                    <!-- Tampilan setelah login (Avatar) -->
                    <div class="flex items-center space-x-4">
                        <!-- Avatar dengan dropdown -->
                        <div class="relative">
                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300" type="button">
                                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->avatar ?? asset('images/default-avatar.jpg') }}" alt="{{ Auth::user()->name }}">
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute right-0 mt-2">
                                <div class="px-4 py-3 text-sm text-gray-900">
                                    <div class="font-bold">{{ Auth::user()->nama_pengguna }}</div>
                                    <div class="">{{ Auth::user()->email }}</div>
                                </div>
                                <ul class="py-2 text-sm text-gray-700">
                                    <li>
                                        <a href="" class="block px-4 py-2 hover:bg-gray-100">Profil Saya</a>
                                    </li>
                                    <li>
                                        <a href="" class="block px-4 py-2 hover:bg-gray-100">Pengaturan</a>
                                    </li>
                                </ul>
                                <div class="py-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Tampilan sebelum login (Tombol Masuk & Daftar) -->
                    <div class="flex space-x-3">
                        <a href="{{ route('login') }}" class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center transition duration-200">
                            Masuk
                        </a>
                        <a href="{{ route('auth.daftar') }}" class="text-black bg-transparent hover:bg-pink-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center border border-gray-600 transition duration-200">
                            Daftar
                        </a>
                    </div>
                @endauth
                
                <!-- Tombol Mobile Menu -->
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            
            <!-- Menu navigasi utama -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="/" class="block py-2 px-3 text-gray-700 hover:text-black md:hover:bg-transparent md:p-0 {{ request()->is('/') ? 'text-black font-medium border-b-2 border-black' : '' }}">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="/studio" class="block py-2 px-3 text-gray-700 hover:text-black md:hover:bg-transparent md:p-0 {{ request()->is('studio*') ? 'text-black font-medium border-b-2 border-black' : '' }}">
                            Studio
                        </a>
                    </li>
                    <li>
                        <a href="/pemesanan" class="block py-2 px-3 text-gray-700 hover:text-black md:hover:bg-transparent md:p-0 {{ request()->is('pemesanan*') ? 'text-black font-medium border-b-2 border-black' : '' }}">
                            Pemesanan
                        </a>
                    </li>
                    <li>
                        <a href="/kontak" class="block py-2 px-3 text-gray-700 hover:text-black md:hover:bg-transparent md:p-0 {{ request()->is('kontak*') ? 'text-black font-medium border-b-2 border-black' : '' }}">
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- Script untuk active state dan toggle login/logout -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentUrl) {
                link.classList.add('text-black', 'font-medium', 'border-b-2', 'border-black');
            }
        });
        
        // Simulasi status login (dalam implementasi nyata, ini akan diperiksa dari session/cookie)
        const isLoggedIn = false; // Ganti dengan true untuk melihat tampilan setelah login
        
        const guestButtons = document.getElementById('guest-buttons');
        const userMenu = document.getElementById('user-menu');
        
        if (isLoggedIn) {
            guestButtons.classList.add('hidden');
            userMenu.classList.remove('hidden');
        } else {
            guestButtons.classList.remove('hidden');
            userMenu.classList.add('hidden');
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>