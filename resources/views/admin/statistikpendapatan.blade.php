<?php
// statistik_pendapatan.php
?>
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
        <div class="text-sm mb-6 text-gray-600">April 2025</div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 flex items-center gap-2 text-gray-700 font-semibold">
                    ❤️ Total Pendapatan
                </h3>
                <p class="text-lg font-bold">Rp 45.750.000</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 flex items-center gap-2 text-gray-700 font-semibold">
                    🗓️ Jumlah Reservasi
                </h3>
                <p class="text-lg font-bold">183</p>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 flex items-center gap-2 text-gray-700 font-semibold">
                    💵 Rata-rata per Reservasi
                </h3>
                <p class="text-lg font-bold">Rp 250.000</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">📊 Tren Pendapatan Bulanan</h3>
                <canvas id="chartTren" class="w-full h-40"></canvas>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">📦 Pendapatan per Paket</h3>
                <canvas id="chartPaket" class="w-full h-40"></canvas>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">📍 Distribusi Pendapatan</h3>
                <canvas id="chartDonut" class="w-full h-40"></canvas>
                <div class="text-xs mt-2 space-y-1">
                    <div>🟣 Selfphoto</div>
                    <div>🔷 Group Photo</div>
                    <div>🟥 Graduation</div>
                    <div>🟠 Family</div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm">
                <h3 class="text-sm mb-2 font-semibold text-gray-700">🎯 Pencapaian Target</h3>
                <canvas id="chartProgress" class="w-full h-40"></canvas>
                <div class="text-xs mt-2 space-y-1">
                    <div>Pendapatan (91,5%)</div>
                    <div>Jumlah Reservasi (91,5%)</div>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js Scripts -->
    <script>
        new Chart(document.getElementById('chartTren'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [12000000, 18000000, 32000000, 45750000],
                    borderColor: '#e08b9c',
                    fill: false
                }]
            }
        });

        new Chart(document.getElementById('chartPaket'), {
            type: 'bar',
            data: {
                labels: ['Selfphoto', 'Group', 'Graduation', 'Family'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [12000000, 14000000, 10000000, 9750000],
                    backgroundColor: ['#a78bfa', '#60a5fa', '#f87171', '#fbbf24']
                }]
            }
        });

        new Chart(document.getElementById('chartDonut'), {
            type: 'doughnut',
            data: {
                labels: ['Selfphoto', 'Group Photo', 'Graduation', 'Family'],
                datasets: [{
                    data: [26, 31, 22, 21],
                    backgroundColor: ['#a78bfa', '#60a5fa', '#f87171', '#fbbf24']
                }]
            }
        });

        new Chart(document.getElementById('chartProgress'), {
            type: 'bar',
            data: {
                labels: ['Pendapatan', 'Reservasi'],
                datasets: [{
                    label: 'Progress',
                    data: [91.5, 91.5],
                    backgroundColor: '#4ade80'
                }]
            },
            options: {
                scales: {
                    y: {
                        max: 100,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
