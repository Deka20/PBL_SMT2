<!DOCTYPE html>
<html data-theme="light" lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Pendapatan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#d94c82',
                        secondary: '#ffd6e7',
                    }
                }
            }
        }
    </script>

    <style>
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>

<body class="bg-[#fefbfa] font-['Inter']">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="ml-64 p-8 max-w-screen-xl mx-auto">
        <!-- Profile Icon -->
        <div class="flex justify-end mb-4">
            <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-600" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                </svg>
            </div>
        </div>

        <h1 class="text-xl font-bold mb-1">Statistik Pendapatan</h1>
        <div class="text-sm mb-6 text-gray-600">{{ $monthName }} {{ $currentYear }}</div>

        <!-- Filter Section -->
        <div class="bg-white p-4 rounded-xl shadow-sm mb-6">
            <form method="GET" action="{{ route('statistikpendapatan') }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Month Selector -->
                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                    <select id="bulan" name="bulan"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary
           appearance-none bg-[url('data:image/svg+xml,%3Csvg fill=\'none\' stroke=\'%23666\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'/%3E%3C/svg%3E')] bg-no-repeat bg-[right_0.75rem_center] pr-8">

                        @foreach ($months as $key => $month)
                            <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Year Selector -->
                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <select id="tahun" name="tahun"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary
           appearance-none bg-[url('data:image/svg+xml,%3Csvg fill=\'none\' stroke=\'%23666\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M19 9l-7 7-7-7\'/%3E%3C/svg%3E')] bg-no-repeat bg-[right_0.75rem_center] pr-8">

                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full md:w-auto px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 flex items-center gap-2 text-gray-700 font-semibold">
                    ❤️ Total Pendapatan
                </h3>
                <p class="text-lg font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 flex items-center gap-2 text-gray-700 font-semibold">
                    🗓️ Jumlah Transaksi
                </h3>
                <p class="text-lg font-bold">{{ $jumlahTransaksi }}</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 flex items-center gap-2 text-gray-700 font-semibold">
                    💵 Rata-rata per Transaksi
                </h3>
                <p class="text-lg font-bold">Rp {{ number_format($rataTransaksi, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">📊 Tren Pendapatan Bulanan</h3>
                <canvas id="chartTren" class="w-full h-40"></canvas>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">📦 Pendapatan per Studio</h3>
                <canvas id="chartStudio" class="w-full h-40"></canvas>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">📍 Distribusi Pendapatan</h3>
                <canvas id="chartDonut" class="w-full h-40"></canvas>
                <div class="text-xs mt-2 space-y-1">
                    @foreach ($pendapatanPerStudio as $item)
                        <div>Studio {{ $item->id_studio }} (Rp {{ number_format($item->total, 0, ',', '.') }})</div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">🎯 Pencapaian Target</h3>
                <canvas id="chartProgress" class="w-full h-40"></canvas>
                <div class="text-xs mt-2 space-y-1">
                    <div>Pendapatan ({{ round(($totalPendapatan / 50000000) * 100, 2) }}%)</div>
                    <div>Jumlah Transaksi ({{ round(($jumlahTransaksi / 100) * 100, 2) }}%)</div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js Scripts -->
    <script>
        // Tren Pendapatan Bulanan
        new Chart(document.getElementById('chartTren'), {
            type: 'line',
            data: {
                labels: @json($trenBulanan->pluck('bulan')),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($trenBulanan->pluck('total')),
                    borderColor: '#e08b9c',
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Pendapatan per Studio
        new Chart(document.getElementById('chartStudio'), {
            type: 'bar',
            data: {
                labels: @json(
                    $pendapatanPerStudio->pluck('id_studio')->map(function ($id) {
                        return 'Studio ' . $id;
                    })),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($pendapatanPerStudio->pluck('total')),
                    backgroundColor: ['#a78bfa', '#60a5fa', '#f87171', '#fbbf24']
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Distribusi Pendapatan
        new Chart(document.getElementById('chartDonut'), {
            type: 'doughnut',
            data: {
                labels: @json(
                    $pendapatanPerStudio->pluck('id_studio')->map(function ($id) {
                        return 'Studio ' . $id;
                    })),
                datasets: [{
                    data: @json($pendapatanPerStudio->pluck('total')),
                    backgroundColor: ['#a78bfa', '#60a5fa', '#f87171', '#fbbf24']
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Pencapaian Target
        new Chart(document.getElementById('chartProgress'), {
            type: 'bar',
            data: {
                labels: ['Pendapatan', 'Transaksi'],
                datasets: [{
                    label: 'Progress',
                    data: [
                        {{ ($totalPendapatan / 50000000) * 100 }},
                        {{ ($jumlahTransaksi / 100) * 100 }}
                    ],
                    backgroundColor: '#4ade80'
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 100,
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
