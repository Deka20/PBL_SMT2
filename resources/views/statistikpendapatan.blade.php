<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Statistik Pendapatan</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            inter: ['Inter', 'sans-serif'],
          },
          colors: {
            primary: '#e08b9c',
            secondary: '#fce3e8',
          }
        }
      }
    }
  </script>
</head>
<body class="font-inter bg-[#fefbfa] flex">
  <!-- Sidebar -->
  <div class="w-52 bg-[#fbeeee] h-screen p-6">
    <div class="flex justify-center mb-8">
      <img src="logo.jpeg" alt="Potretku" title="Potretku" class="w-12 h-12 rounded-full object-cover">
    </div>
    
    <div class="menu-item flex items-center gap-2.5 p-2.5 text-sm cursor-pointer text-gray-800 hover:bg-secondary rounded-lg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4.5 h-4.5 fill-primary">
        <path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zM3 21h8v-6H3v6zM13 3v6h8V3h-8z"/>
      </svg>
      Dashboard
    </div>
    
    <div class="menu-item flex items-center gap-2.5 p-2.5 text-sm cursor-pointer text-gray-800 hover:bg-secondary rounded-lg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4.5 h-4.5 fill-primary">
        <path d="M4 10v10h16V10l-8-6-8 6zm2 2h12v6H6v-6z"/>
      </svg>
      Studio
    </div>
    
    <div class="menu-item flex items-center gap-2.5 p-2.5 text-sm cursor-pointer text-gray-800 hover:bg-secondary rounded-lg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4.5 h-4.5 fill-primary">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
      </svg>
      Pelanggan
    </div>
    
    <div class="menu-item flex items-center gap-2.5 p-2.5 text-sm cursor-pointer text-gray-800 hover:bg-secondary rounded-lg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4.5 h-4.5 fill-primary">
        <path d="M19.14,12.94A7.43,7.43,0,0,0,19.14,11l2.11-1.65a.5.5,0,0,0,.12-.65l-2-3.46a.5.5,0,0,0-.61-.22l-2.49,1a7.3,7.3,0,0,0-1.73-1L14,2.5a.5.5,0,0,0-.5-.5h-4a.5.5,0,0,0-.5.5L9,5a7.3,7.3,0,0,0-1.73,1l-2.49-1a.5.5,0,0,0-.61.22l-2,3.46a.5.5,0,0,0,.12.65L4.86,11a7.43,7.43,0,0,0,0,1L2.75,13.65a.5.5,0,0,0-.12.65l2,3.46a.5.5,0,0,0,.61.22l2.49-1a7.3,7.3,0,0,0,1.73,1L10,21.5a.5.5,0,0,0,.5.5h4a.5.5,0,0,0,.5-.5L15,19a7.3,7.3,0,0,0,1.73-1l2.49,1a.5.5,0,0,0,.61-.22l2-3.46a.5.5,0,0,0-.12-.65Zm-7.14,2.56A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
      </svg>
      Pengaturan
    </div>
    
    <div class="menu-item flex items-center gap-2.5 p-2.5 text-sm cursor-pointer text-gray-800 hover:bg-secondary rounded-lg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4.5 h-4.5 fill-primary">
        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
      </svg>
      Rating & Review
    </div>
    
    <div class="menu-item flex items-center gap-2.5 p-2.5 text-sm cursor-pointer text-gray-800 hover:bg-secondary rounded-lg">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4.5 h-4.5 fill-primary">
        <path d="M3 17h18v2H3zm0-6h18v2H3zm0-6h18v2H3z"/>
      </svg>
      Statistik
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex-grow p-8 relative">
    <div class="avatar placeholder absolute top-4 right-4">
      <div class="bg-neutral-focus text-neutral-content rounded-full w-9 h-9 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-gray-600">
          <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
        </svg>
      </div>
    </div>

    <h1 class="text-base font-bold">Statistik Pendapatan</h1>
    <div class="text-sm mb-4">April 2025</div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="card bg-white p-4 rounded-xl shadow-sm">
        <h3 class="text-sm mb-2 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 fill-primary">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3S13 5.42 13 8.5c0 2.5-1.66 4.82-4.5 7.54l-.5.46.5.54 1.5 1.35z"/>
          </svg>
          Total Pendapatan
        </h3>
        <p class="text-lg font-semibold">Rp 45.750.000</p>
      </div>
      
      <div class="card bg-white p-4 rounded-xl shadow-sm">
        <h3 class="text-sm mb-2 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 fill-primary">
            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v15c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 17H5V8h14v12z"/>
          </svg>
          Jumlah Reservasi
        </h3>
        <p class="text-lg font-semibold">183</p>
      </div>
      
      <div class="card bg-white p-4 rounded-xl shadow-sm">
        <h3 class="text-sm mb-2 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 fill-primary">
            <path d="M4 22h16v-2H4v2zM13 13h5v5h-5v-5zM4 13h5v5H4v-5zm9-9h5v5h-5V4zM4 4h5v5H4V4z"/>
          </svg>
          Rata-rata per Reservasi
        </h3>
        <p class="text-lg font-semibold">Rp 250.000</p>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
      <div class="card bg-white p-4 rounded-xl shadow-sm">
        <h3 class="text-sm mb-2">Tren Pendapatan Bulanan</h3>
        <canvas id="chartTren" class="w-full h-[150px]"></canvas>
      </div>
      
      <div class="card bg-white p-4 rounded-xl shadow-sm">
        <h3 class="text-sm mb-2">Pendapatan per Paket</h3>
        <canvas id="chartPaket" class="w-full h-[150px]"></canvas>
      </div>
      
      <div class="card bg-white p-4 rounded-xl shadow-sm">
        <h3 class="text-sm mb-2">Distribusi Pendapatan</h3>
        <canvas id="chartDonut" class="w-full h-[150px]"></canvas>
        <div class="text-xs mt-2">
          <div class="mb-1">🟣 Selfphoto</div>
          <div class="mb-1">🔷 Group Photo</div>
          <div class="mb-1">🟥 Graduation</div>
          <div class="mb-1">🟠 Family</div>
        </div>
      </div>
      
      <div class="card bg-white p-4 rounded-xl shadow-sm">
        <h3 class="text-sm mb-2">Pencapaian Target</h3>
        <canvas id="chartProgress" class="w-full h-[150px]"></canvas>
        <div class="text-xs mt-2">
          <div class="mb-1">Pendapatan (91,5%)</div>
          <div class="mb-1">Jumlah Reservasi (91,5%)</div>
        </div>
      </div>
    </div>
  </div>

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