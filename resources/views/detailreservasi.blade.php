<?php
// Dummy data
$booking_id = "#BK-20250423-WCS-EA17W";
$kategori = "Family";
$tanggal = "25 Apr 2025";
$jam = "15:00";
$durasi = "1 jam";
$jumlah_orang = "6 orang";
$total_harga = "Rp 150.000";
$status_pembayaran = "Selesai";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Reservasi</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #fff6f6;
    }

    .header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      background-color: transparent;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px 24px;
      z-index: 10;
    }

    .back {
      text-decoration: none;
      color: black;
      font-weight: bold;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .back svg {
      width: 14px;
      height: 14px;
    }

    .profile-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-left: 16px;
    }

    .profile-icon svg {
      width: 20px;
      height: 20px;
      fill: #666;
    }

    .container {
      max-width: 720px;
      margin: 100px auto 40px auto;
      background: white;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .title-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .title {
      font-size: 20px;
      font-weight: bold;
      margin: 0;
    }

    .status {
      font-weight: bold;
      padding: 4px 12px;
      border-radius: 6px;
      font-size: 14px;
    }

    .status-selesai {
      background-color: #eee;
      color: #666;
    }

    .studio-card {
      display: flex;
      align-items: center;
      margin-top: 10px;
      margin-bottom: 20px;
    }

    .studio-logo {
      background-color: #ddd;
      width: 64px;
      height: 64px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      margin-right: 16px;
    }

    .studio-logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      font-size: 14px;
    }

    .highlight-box {
      background-color: #f5f5f5;
      padding: 10px;
      border-radius: 6px;
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      margin-top: 10px;
    }

    .divider {
      border-top: 1px solid #ccc;
      margin: 20px 0;
    }

    .button-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 10px 14px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-cancel {
      background-color: #fddcdc;
      color: #a33;
    }

    .btn-edit {
      background-color: #eee;
      color: #333;
    }

    .rating-section {
      margin-top: 30px;
    }

    .rating-section h3 {
      font-size: 16px;
      margin-bottom: 8px;
    }

    .stars {
      display: flex;
      gap: 6px;
      font-size: 20px;
      color: #ccc;
      cursor: pointer;
    }

    .stars .filled {
      color: gold;
    }

    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      resize: vertical;
      margin-top: 10px;
    }

    .btn-submit {
      background-color: black;
      color: white;
      margin-top: 12px;
      padding: 10px 16px;
    }

    @media (max-width: 480px) {
      .title-bar {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }

      .detail-row {
        flex-direction: column;
        gap: 6px;
      }

      .button-group {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <a href="#" class="back">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.75.75 0 0 1-.75.75H3.56l4.22 4.22a.75.75 0 0 1-1.06 1.06l-5.5-5.5a.75.75 0 0 1 0-1.06l5.5-5.5a.75.75 0 0 1 1.06 1.06L3.56 7.25H14.25A.75.75 0 0 1 15 8z"/>
      </svg>
      <span>Kembali</span>
    </a>
    <div class="profile-icon">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
      </svg>
    </div>
  </div>

  <!-- Kontainer utama -->
  <div class="container">

    <div class="title-bar">
      <h2 class="title">Detail Reservasi <?php echo $booking_id; ?></h2>
      <div class="status status-selesai"><?php echo $status_pembayaran; ?></div>
    </div>

    <div class="studio-card">
      <div class="studio-logo">
        <img src="family.jpg" alt="Studio" />
      </div>
      <div>
        <strong><?php echo $kategori; ?></strong>
      </div>
    </div>

    <div class="detail-row">
      <div>📅 <strong>Tanggal:</strong> <?php echo $tanggal; ?></div>
      <div>⏳ <strong>Durasi:</strong> <?php echo $durasi; ?></div>
    </div>

    <div class="detail-row">
      <div>⏰ <strong>Jam:</strong> <?php echo $jam; ?></div>
      <div>👥 <strong>Jumlah Orang:</strong> <?php echo $jumlah_orang; ?></div>
    </div>

    <div class="highlight-box">
      <div>Total Harga:</div>
      <div><?php echo $total_harga; ?></div>
    </div>

    <div class="divider"></div>

    <!-- Rating dan Ulasan -->
    <div class="rating-section">
      <h3>Berikan Rating dan Ulasan</h3>
      <div class="stars" id="starContainer">
        <span data-value="1">★</span>
        <span data-value="2">★</span>
        <span data-value="3">★</span>
        <span data-value="4">★</span>
        <span data-value="5">★</span>
      </div>
      <textarea placeholder="Tulis ulasan Anda di sini..."></textarea>
      <button class="btn btn-submit">Kirim Ulasan</button>
    </div>

  </div>

  <script>
    const stars = document.querySelectorAll('#starContainer span');
    stars.forEach(star => {
      star.addEventListener('click', () => {
        const value = star.getAttribute('data-value');
        stars.forEach(s => {
          s.classList.remove('filled');
          if (s.getAttribute('data-value') <= value) {
            s.classList.add('filled');
          }
        });
      });
    });
  </script>

</body>
</html>
``