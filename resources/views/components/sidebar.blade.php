<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sidebar</title>
</head>

<body>
    <!-- Sidebar -->
    <aside
        class="sidebar w-64 h-screen fixed top-0 left-0 bg-gradient-to-br from-pink-100 to-pink-50 text-pink-700 p-6 shadow-lg transform transition-transform duration-300 ease-in-out z-40">
        <div class="flex flex-col items-center border-b pb-4 border-pink-200">
            <img src="{{ asset('images/logo.png') }}"
                class="w-20 h-20 rounded-full object-cover border-2 border-pink-300 shadow-md" alt="Logo Potrétine">
            <h2 class="text-3xl font-extrabold text-primary mt-4 tracking-wide">Potrétine</h2>
            <p class="text-xs text-pink-600 mt-1">Admin</p>
        </div>
        <nav class="mt-8">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-3 rounded-lg text-pink-700 font-medium hover:bg-pink-200 hover:text-pink-800 transition-all duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-fw fa-tachometer-alt text-lg mr-3"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('studio') }}"
                        class="flex items-center p-3 rounded-lg text-pink-700 font-medium hover:bg-pink-200 hover:text-pink-800 transition-all duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-fw fa-camera text-lg mr-3"></i>
                        Studio
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelanggan') }}"
                        class="flex items-center p-3 rounded-lg text-pink-700 font-medium hover:bg-pink-200 hover:text-pink-800 transition-all duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-fw fa-users text-lg mr-3"></i>
                        Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengaturan') }}"
                        class="flex items-center p-3 rounded-lg text-pink-700 font-medium hover:bg-pink-200 hover:text-pink-800 transition-all duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-fw fa-cog text-lg mr-3"></i>
                        Pengaturan
                    </a>
                </li>
                <li>
                    <a href="{{ route('ulasan') }}"
                        class="flex items-center p-3 rounded-lg text-pink-700 font-medium hover:bg-pink-200 hover:text-pink-800 transition-all duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-fw fa-star text-lg mr-3"></i>
                        Rating & Review
                    </a>
                </li>
                <li>
                    <a href="{{ route('statistikpendapatan') }}"
                        class="flex items-center p-3 rounded-lg text-pink-700 font-medium hover:bg-pink-200 hover:text-pink-800 transition-all duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-fw fa-chart-line text-lg mr-3"></i>
                        Statistik Pendapatan
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Logout Section --}}
        <div class="absolute bottom-5 left-0 w-full px-6">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center p-3 rounded-lg text-pink-700 font-medium bg-pink-100 hover:bg-pink-300 hover:text-pink-900 transition-all duration-200 ease-in-out transform hover:scale-105 justify-center">
                <i class="fas fa-fw fa-sign-out-alt text-lg mr-2"></i>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>
</body>

</html>
