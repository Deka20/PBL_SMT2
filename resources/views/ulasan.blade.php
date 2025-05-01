<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ulasan Pengguna</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fc;
      display: flex;
      padding-left: 200px;
    }

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

    .container {
      width: 60%;
      margin: 30px auto;
      margin-left: 200px;
    }

    .summary {
      background-color: #f8eaea;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 30px;
    }

    .summary h2 {
      margin: 0 0 10px 0;
    }

    .summary-score {
      font-size: 40px;
      font-weight: bold;
      color: #222;
    }

    .stars {
      color: gold;
      font-size: 20px;
    }

    .rating-bar {
      display: flex;
      align-items: center;
      margin: 5px 0;
      font-size: 14px;
    }

    .bar {
      width: 150px;
      height: 8px;
      background-color: #ddd;
      margin: 0 10px;
      border-radius: 4px;
      position: relative;
    }

    .bar-fill {
      height: 100%;
      background-color: gold;
      border-radius: 4px;
    }

    .review-box {
      background-color: #f8eaea;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .review-left {
      display: flex;
      align-items: center;
    }

    .profile-pic {
      width: 45px;
      height: 45px;
      background-color: #ccc;
      border-radius: 50%;
      margin-right: 15px;
    }

    .user-info {
      font-weight: bold;
    }

    .username {
      font-size: 14px;
      color: #888;
    }

    .review-text {
      margin-top: 5px;
      font-size: 14px;
    }

    .review-buttons {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .btn {
      font-size: 12px;
      padding: 5px 10px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .btn-edit {
      background-color: #ddd;
    }

    .btn-delete {
      background-color: #bbb;
    }
  </style>
</head>
<body>
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

  <div class="container">
    <!-- BAGIAN ATAS: RINGKASAN ULASAN -->
    <div class="summary">
      <h2>Ulasan Pengguna</h2>
      <div class="summary-score">5.0</div>
      <div class="stars">★★★★★</div>
      <div style="font-size: 14px; color: #555;">Dari 2 Ulasan</div>

      <!-- Detail distribusi -->
      <div class="rating-bar">
        ⭐ 5
        <div class="bar">
          <div class="bar-fill" style="width: 100%;"></div>
        </div>
        2 Orang
      </div>
      <div class="rating-bar">⭐ 4 <div class="bar"></div> 0 Orang</div>
      <div class="rating-bar">⭐ 3 <div class="bar"></div> 0 Orang</div>
      <div class="rating-bar">⭐ 2 <div class="bar"></div> 0 Orang</div>
      <div class="rating-bar">⭐ 1 <div class="bar"></div> 0 Orang</div>
    </div>

    <!-- ULASAN PELANGGAN -->
    <div class="review-box">
      <div class="review-left">
        <div class="profile-pic"></div>
        <div>
          <div class="user-info">JAEHYUN</div>
          <div class="username">@jae123</div>
          <div class="review-text">Pelayanan sangat memuaskan dan tempatnya bersih.</div>
          <div class="stars">★★★★★</div>
        </div>
      </div>
      <div class="review-buttons">
        <button class="btn btn-edit">Ubah</button>
        <button class="btn btn-delete">Hapus</button>
      </div>
    </div>

    <div class="review-box">
      <div class="review-left">
        <div class="profile-pic"></div>
        <div>
          <div class="user-info">DONTOL</div>
          <div class="username">@adittolongindit</div>
          <div class="review-text">Studio nyaman dan alat-alatnya lengkap.</div>
          <div class="stars">★★★★★</div>
        </div>
      </div>
      <div class="review-buttons">
        <button class="btn btn-edit">Ubah</button>
        <button class="btn btn-delete">Hapus</button>
      </div>
    </div>
  </div>

  <!-- SCRIPT UNTUK UBAH & HAPUS -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const editButtons = document.querySelectorAll('.btn-edit');
      const deleteButtons = document.querySelectorAll('.btn-delete');

      editButtons.forEach(button => {
        button.addEventListener('click', function () {
          const reviewText = this.closest('.review-box').querySelector('.review-text');
          const newText = prompt("Edit review:", reviewText.textContent);
          if (newText !== null && newText.trim() !== "") {
            reviewText.textContent = newText.trim();
          }
        });
      });

      deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
          const confirmed = confirm("Yakin ingin menghapus review ini?");
          if (confirmed) {
            this.closest('.review-box').remove();
          }
        });
      });
    });
  </script>
</body>
</html>
