<?php
$nama = "Khai";
$no_hp = "081234567890";
$studio = "Selfphoto";
$tanggal = "07 Apr 2025";
$jam = "13.00–14.00";
$jumlah_orang = "3 orang";
$total_pembayaran = "Rp. 100.000";
$status_pembayaran = "Lunas";
$booking_id = "#BK-20250423-WCS-EA17W";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Bukti Reservasi</title>
  <style>
    body {
      background-color: #fff6f6;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 24px;
      width: 400px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo-text {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo {
      background-color: #ddd;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
    }

    .success-icon {
      font-size: 28px;
      color: green;
    }

    .thanks-text {
      margin: 16px 0;
      font-weight: bold;
    }

    .booking-id {
      background-color: #fddcdc;
      padding: 8px;
      border-radius: 6px;
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-size: 14px;
    }

    .details {
      margin-top: 16px;
      font-size: 14px;
      line-height: 1.6;
    }

    .divider {
      border-top: 1px solid #ddd;
      margin: 16px 0;
    }

    .payment {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
    }

    .status {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 8px;
    }

    .status span {
      background-color: #42db58;
      color: white;
      font-weight: bold;
      padding: 4px 12px;
      border-radius: 6px;
      font-size: 13px;
    }

    .btn {
      margin-top: 16px;
      width: 100%;
      background-color: black;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      margin-top: 24px;
      color: #555;
    }

    .footer b {
      display: block;
      margin-bottom: 4px;
    }
  </style>
</head>
<body>

<div class="card">
  <div class="header">
    <div class="logo-text">
      <div class="logo"><img src="logo.jpeg" alt="Logo Studio" style="width: 100%; height: 100%; border-radius: 50%;"></div>
      <strong>Potretine</strong>
    </div>
    <div class="success-icon">✅</div>
  </div>

  <p class="thanks-text">Terimakasih sudah melakukan reservasi di studio kami!</p>

  <div class="booking-id">
    <div>Booking ID:</div>
    <div><?php echo $booking_id; ?></div>
  </div>

  <div class="details">
    Nama : <?php echo $nama; ?><br>
    No. Handphone : <?php echo $no_hp; ?><br>
    Pilih Studio : <?php echo $studio; ?><br>
    Tanggal : <?php echo $tanggal; ?><br>
    Jam : <?php echo $jam; ?><br>
    Jumlah Orang : <?php echo $jumlah_orang; ?>
  </div>

  <div class="divider"></div>

  <div class="payment">
    <div>Total Pembayaran :</div>
    <div><?php echo $total_pembayaran; ?></div>
  </div>

  <div class="status">
    <div>Status Pembayaran:</div>
    <span><?php echo $status_pembayaran; ?></span>
  </div>

  <button class="btn" onclick="window.print()">Cetak Resi</button>

  <div class="footer">
    <b>Informasi Kontak</b>
    Jl. Photo Studio<br>
    Telp: +62 81234567890 | Email: ShutterSpace@gmail.com
  </div>
</div>

</body>
</html>