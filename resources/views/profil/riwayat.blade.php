<html lang="en" data-theme="light">

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

        /* Status badges */
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-menunggu_verifikasi {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-lunas {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-diverifikasi {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-selesai {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-dibatalkan {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-default {
            background-color: #e5e7eb;
            color: #4b5563;
        }
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen">
    <x-second-nav></x-second-nav>

    <main class="flex justify-center items-start min-h-[calc(100vh-64px)] p-4">
        <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Mobile Menu -->
            <div class="md:hidden flex overflow-x-auto border-b border-gray-200 bg-gray-50">
                <a href="{{ route('profil') }}"
                    class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-user mr-2 text-lg"></i>Profil
                </a>
                <a href="{{ route('keamanan') }}"
                    class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-lock mr-2 text-lg"></i>Keamanan
                </a>
                <a href="{{ route('riwayat') }}"
                    class="flex-shrink-0 px-4 py-3 text-base font-medium active-menu btn-hover-effect">
                    <i class="fas fa-history mr-2 text-lg"></i>Riwayat
                </a>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex flex-col w-64 border-r border-gray-200 bg-gray-50 p-2">
                <button onclick="window.location.href='{{ route('profil') }}'"
                    class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-user text-lg"></i>Profil
                </button>
                <button onclick="window.location.href='{{ route('keamanan') }}'"
                    class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-gray-600 text-base font-medium btn-hover-effect">
                    <i class="fas fa-lock text-lg"></i>Keamanan & Privasi
                </button>
                <button onclick="window.location.href='{{ route('riwayat') }}'"
                    class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium active-menu text-gray-600 btn-hover-effect">
                    <i class="fas fa-history text-lg"></i>Riwayat Pemesanan
                </button>
                <button onclick="window.location.href=''"
                    class="flex items-center gap-3 px-4 py-4 border-t border-gray-200 text-gray-600 mt-auto font-medium text-sm btn-hover-effect">
                    <i class="fas fa-sign-out-alt"></i>Keluar
                </button>
            </nav>

            <!-- Bagian Content Section yang diperbaiki -->
            <section class="flex-1 p-8 w-full">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Riwayat Pemesanan</h2>
                </div>

                <div class="custom-scrollbar overflow-y-auto max-h-[calc(100vh-220px)] pr-2">
                    @auth
                        @php
                            $user = Auth::user();
                            // Query yang diperbaiki - pastikan menggunakan id_user
                            $bookings = \App\Models\Pemesanan::with(['studio', 'pembayaran'])
                                ->where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->orderBy('jam', 'asc')
                                ->get();
                        @endphp

                        @if ($bookings->count() > 0)
                            @foreach ($bookings as $booking)
                                @php
                                    // Determine status class and text
                                    $statusClass = 'badge-default';
                                    $statusText = 'Pending';

                                    if ($booking->status === 'menunggu verifikasi') {
                                        $statusClass = 'badge-pending';
                                        $statusText = 'Pending';
                                    } elseif ($booking->status === 'diverifikasi') {
                                        $statusClass = 'badge-diverifikasi';
                                        $statusText = 'Dikonfirmasi';
                                    } elseif ($booking->status === 'selesai') {
                                        $statusClass = 'badge-selesai';
                                        $statusText = 'Selesai';
                                    }

                                    // Format date and time
                                    $tanggal = \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y');
                                    $jam = \Carbon\Carbon::parse($booking->jam)->format('H:i');

                                    // Format price
                                    $harga = number_format($booking->harga, 0, ',', '.');
                                @endphp

                                <div
                                    class="flex items-start p-4 border-b border-gray-200 hover:bg-gray-50 rounded-lg transition">
                                    @if ($booking->studio && $booking->studio->gambar)
                                        <img class="w-12 h-12 rounded-full object-cover"
                                            src="{{ asset('storage/' . $booking->studio->gambar) }}"
                                            alt="{{ $booking->studio->nama_studio }}">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-camera text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div class="text-gray-700 text-sm ml-4 flex-grow">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-medium">Booking ID: #{{ $booking->id_pemesanan }}</p>
                                                @if ($booking->studio)
                                                    <p>{{ $booking->studio->jenis_studio ?? '' }} -
                                                        {{ $booking->studio->nama_studio ?? '' }}</p>
                                                @endif
                                            </div>
                                            <span
                                                class="text-xs px-2 py-1 rounded-full {{ $statusClass }}">{{ $statusText }}</span>
                                        </div>
                                        <div class="mt-1">
                                            <p>Tanggal: {{ $tanggal }} • {{ $jam }}</p>
                                            <p>Jumlah Orang: {{ $booking->jumlah_orang }}</p>
                                            @if ($booking->harga > 0)
                                                <p>Total: Rp {{ $harga }}</p>
                                            @endif
                                        </div>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-xs text-gray-500">{{ $booking->no_hp }}</span>
                                            <a href="{{ route('detailreservasi', ['id' => $booking->id_pemesanan]) }}"
                                                class="btn btn-xs bg-[#f9d6d6] text-gray-700 border-none btn-hover-effect">Lihat
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-calendar-times text-4xl mb-2"></i>
                                <p>Belum ada riwayat pemesanan</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-exclamation-circle text-4xl mb-2"></i>
                            <p>Silakan login untuk melihat riwayat pemesanan</p>
                            <a href="{{ route('login') }}" class="btn btn-sm bg-[#f9d6d6] text-gray-700 mt-4">Login</a>
                        </div>
                    @endauth
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
