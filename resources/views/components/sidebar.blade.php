<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- Sidebar -->
    <aside class="w-64 h-screen fixed top-0 left-0 bg-pink-50 text-pink-700 p-5 border-r-2 border-pink-200">
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/logo.png') }}" class="w-16 h-16 rounded-full object-cover">
            <h2 class="text-2xl font-bold text-primary mt-3">Potrétine</h2>
        </div>
        <nav class="mt-8">
            <ul class="menu bg-pink-50 rounded-box">
                <li><a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-2 hover:bg-secondary hover:text-pink-800 hover:translate-x-1 transition-all duration-300"><span>🏠</span>
                        Dashboard</a></li>
                <li><a href="{{ route('studio') }}"
                        class="flex items-center gap-2 hover:bg-secondary hover:text-pink-800 hover:translate-x-1 transition-all duration-300"><span>📷</span>
                        Studio</a></li>
                <li><a href="{{ route('pelanggan') }}"
                        class="flex items-center gap-2 hover:bg-secondary hover:text-pink-800 hover:translate-x-1 transition-all duration-300"><span>👥</span>
                        Pelanggan</a></li>
                <li><a href="{{ route('pengaturan') }}"
                        class="flex items-center gap-2 hover:bg-secondary hover:text-pink-800 hover:translate-x-1 transition-all duration-300"><span>⚙</span>
                        Pengaturan</a></li>
                <li><a href="{{ route('ulasan') }}"
                        class="flex items-center gap-2 hover:bg-secondary hover:text-pink-800 hover:translate-x-1 transition-all duration-300"><span>⭐</span>
                        Rating & Review</a></li>
                <li><a href="{{ route('statistikpendapatan') }}"
                        class="flex items-center gap-2 hover:bg-secondary hover:text-pink-800 hover:translate-x-1 transition-all duration-300"><span>📈</span>
                        Statistik Pendapatan</a></li>
            </ul>
        </nav>
    </aside>
</body>

</html>
