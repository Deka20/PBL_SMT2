<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Riwayat Pemesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .active-menu {
            background-color: #f9d6d6;
            color: #4b5563;
            font-weight: 500;
        }

        .active-menu:hover {
            background-color: #f5c2c2;
        }

        /* Consistent hover effect for all buttons */
        .btn-hover-effect {
            transition: background-color 0.2s ease;
        }
        
        .btn-hover-effect:hover {
            background-color: #f5c2c2;
        }
        
        /* For ghost buttons */
        .btn-ghost-hover:hover {
            background-color: #f9d6d6;
        }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #f9d6d6;
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #f5c2c2;
        }
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen">
    <header class="flex items-center justify-between px-4 py-3 bg-white shadow-sm">
        <button onclick="window.location.href='/'" class="flex items-center gap-2 text-sm font-medium text-gray-600 btn btn-ghost btn-hover-effect">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="dropdown dropdown-end">
            <button tabindex="0" class="btn btn-ghost btn-circle btn-hover-effect">
                <i class="fas fa-user-circle text-xl text-gray-600"></i>
            </button>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
                <li><button onclick="window.location.href='keluar'" class="text-sm text-gray-600 btn-hover-effect">Keluar</button></li>
            </ul>
        </div>
    </header>

    <main class="flex justify-center items-start min-h-[calc(100vh-64px)] p-4">
        <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Mobile Menu -->
            <div class="md:hidden flex overflow-x-auto border-b border-gray-200 bg-gray-50">
                <button onclick="window.location.href='profil'" class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-user mr-2 text-lg"></i>Profil
                </button>
                <button onclick="window.location.href='/keamanan'" class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-lock mr-2 text-lg"></i>Keamanan
                </button>
                <button onclick="window.location.href='/riwayat'" class="flex-shrink-0 px-4 py-3 text-base font-medium active-menu btn-hover-effect">
                    <i class="fas fa-history mr-2 text-lg"></i>Riwayat
                </button>
                <button onclick="window.location.href=''" class="flex items-center gap-2 px-4 py-3 mt-auto font-normal text-sm btn-hover-effect">
                    <i class="fas fa-sign-out-alt"></i>Keluar
                </button>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex flex-col w-64 border-r border-gray-200 bg-gray-50 p-2">
                <button onclick="window.location.href='{{ route('profil') }}'" class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-user text-lg"></i>Profil
                </button>
                <button onclick="window.location.href='{{ route('keamanan') }}'" class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-lock text-lg"></i>Keamanan & Privasi
                </button>
                <button onclick="window.location.href='{{ route('riwayat') }}'" class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium active-menu btn-hover-effect">
                    <i class="fas fa-history text-lg"></i>Riwayat Pemesanan
                </button>
                <button onclick="window.location.href=''" class="flex items-center gap-2 px-4 py-3 mt-auto font-normal text-sm btn-hover-effect">
                    <i class="fas fa-sign-out-alt"></i>Keluar
                </button>
            </nav>

            <!-- Content Section -->
            <section class="flex-1 p-8 w-full">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Riwayat Pemesanan</h2>
                </div>

                <div class="custom-scrollbar overflow-y-auto max-h-[calc(100vh-220px)] pr-2">
                    <!-- Booking Item 1 -->
                    <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 rounded-lg transition">
                        <img class="w-12 h-12 rounded-full" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" alt="Studio photo" />
                        <div class="text-gray-700 text-sm ml-4 flex-grow">
                            <p class="font-medium">Booking ID: #12345</p>
                            <p>Studio: Studio A</p>
                            <div class="flex items-center justify-between mt-1">
                                <span>Tanggal: 12 Jan 2023</span>
                                <a href="/detail-reservasi" class="btn btn-xs bg-[#f9d6d6] text-gray-700 border-none btn-hover-effect">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Item 2 -->
                    <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 rounded-lg transition">
                        <img class="w-12 h-12 rounded-full" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" alt="Studio photo" />
                        <div class="text-gray-700 text-sm ml-4 flex-grow">
                            <p class="font-medium">Booking ID: #12346</p>
                            <p>Studio: Studio B</p>
                            <div class="flex items-center justify-between mt-1">
                                <span>Tanggal: 15 Jan 2023</span>
                                <a href="/reservasi" class="btn btn-xs bg-[#f9d6d6] text-gray-700 border-none btn-hover-effect">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Item 3 -->
                    <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 rounded-lg transition">
                        <img class="w-12 h-12 rounded-full" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" alt="Studio photo" />
                        <div class="text-gray-700 text-sm ml-4 flex-grow">
                            <p class="font-medium">Booking ID: #12347</p>
                            <p>Studio: Studio C</p>
                            <div class="flex items-center justify-between mt-1">
                                <span>Tanggal: 18 Jan 2023</span>
                                <a href="/reservasi-lunas" class="btn btn-xs bg-[#f9d6d6] text-gray-700 border-none btn-hover-effect">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Item 4 -->
                    <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 rounded-lg transition">
                        <img class="w-12 h-12 rounded-full" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" alt="Studio photo" />
                        <div class="text-gray-700 text-sm ml-4 flex-grow">
                            <p class="font-medium">Booking ID: #12348</p>
                            <p>Studio: Studio D</p>
                            <div class="flex items-center justify-between mt-1">
                                <span>Tanggal: 20 Jan 2023</span>
                                <a href="/reservasi-selesai" class="btn btn-xs bg-[#f9d6d6] text-gray-700 border-none btn-hover-effect">Lihat Detail</a>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Item 5 -->
                    <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 rounded-lg transition">
                        <img class="w-12 h-12 rounded-full" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" alt="Studio photo" />
                        <div class="text-gray-700 text-sm ml-4 flex-grow">
                            <p class="font-medium">Booking ID: #12349</p>
                            <p>Studio: Studio E</p>
                            <div class="flex items-center justify-between mt-1">
                                <span>Tanggal: 22 Jan 2023</span>
                                <button class="btn btn-xs bg-[#f9d6d6] text-gray-700 border-none btn-hover-effect">Lihat Detail</button>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Item 6 -->
                    <div class="flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 rounded-lg transition">
                        <img class="w-12 h-12 rounded-full" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" alt="Studio photo" />
                        <div class="text-gray-700 text-sm ml-4 flex-grow">
                            <p class="font-medium">Booking ID: #12350</p>
                            <p>Studio: Studio F</p>
                            <div class="flex items-center justify-between mt-1">
                                <span>Tanggal: 25 Jan 2023</span>
                                <button class="btn btn-xs bg-[#f9d6d6] text-gray-700 border-none btn-hover-effect">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Handle dropdown menu
        const profileBtn = document.querySelector('.dropdown button');
        const dropdownMenu = document.querySelector('.dropdown-content');

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            dropdownMenu.classList.add('hidden');
        });
    </script>
</body>
</html>