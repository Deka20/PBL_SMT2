<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fc;
      display: flex;
    }

    /* --- SIDEBAR STYLING --- */
    .sidebar {
      width: 250px;
      background: #ffeaf3;
      height: 100vh;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      color: #cc5480;
      border-right: 2px solid #f9d4e4;
    }
    .sidebar img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
      display: block;
      margin: 0 auto;
    }
    .sidebar h2 {
      text-align: center;
      font-size: 24px;
      color: #d94c82;
      font-weight: bold;
      margin-top: 10px;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 16px;
      text-decoration: none;
      color: black;
      font-size: 16px;
      font-weight: 500;
      border-radius: 8px;
      transition: 0.3s;
      margin-bottom: 10px;
    }
    .sidebar a:hover {
      background-color: #ffd6e7;
      color: #7d2c4e;
      transform: translateX(5px);
    }

    /* --- CONTENT --- */
    .content {
      margin-left: 270px;
      padding: 20px;
      width: 100%;
    }
    .cards {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    .card {
      width: 220px;
      text-align: center;
      padding: 20px;
      border-radius: 20px;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .card-icon {
      font-size: 30px;
      color: hotpink;
      margin-bottom: 10px;
    }

    /* --- TABEL --- */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background: #fff0f5;
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      padding: 15px;
      text-align: center;
    }
    th {
      background: #ffd6e7;
    }
    .status-lunas {
      background-color: #d4edda;
      color: #155724;
      padding: 5px 10px;
      border-radius: 8px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
  <img src="images/logo.png">
  <h2>Potrétine</h2>
  <nav>
    <a href="dashboardadmin1.html">🏠 Dashboard</a>
    <a href="studionew.html">📷 Studio</a>
    <a href="datapelanggan1.html">👥 Pelanggan</a>
    <a href="pengaturan.html">⚙️ Pengaturan</a>
    <a href="ulasan.html">⭐ Rating & Review</a>
    <a href="#">📈 Statistik Pendapatan</a>
  </nav>
</aside>

<!-- Content -->
<div class="content">
  <div class="cards">
    <div class="card">
      <div class="card-icon">📷</div>
      <h3>Total Studio</h3>
      <h2>4</h2>
    </div>
    <div class="card">
      <div class="card-icon">📅</div>
      <h3>Total Pemesanan</h3>
      <h2>12</h2>
    </div>
    <div class="card">
      <div class="card-icon">👥</div>
      <h3>Total Pelanggan</h3>
      <h2>70</h2>
    </div>
    <div class="card">
      <div class="card-icon">💵</div>
      <h3>Total Penghasilan</h3>
      <h2>Rp 600.000</h2>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nama Pemesan</th>
        <th>Studio</th>
        <th>Tanggal</th>
        <th>No Handphone</th>
        <th>Bukti Pembayaran</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Khai</td>
        <td>Self Photo</td>
        <td>7 Apr 2025</td>
        <td>081234567890</td>
        <td><a href="#">👁️ Lihat Bukti</a></td>
        <td><span class="status-lunas">Lunas</span></td>
      </tr>
      <tr>
        <td>Chewyea</td>
        <td>Graduation</td>
        <td>7 Jul 2025</td>
        <td>081398765432</td>
        <td><a href="#">👁️ Lihat Bukti</a></td>
        <td><span class="status-lunas">Lunas</span></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
