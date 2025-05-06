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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-[#fff6f6] flex justify-center items-center p-10">
  <div class="card bg-white rounded-box shadow-sm w-full max-w-md p-6">
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-2.5">
        <div class="avatar">
          <div class="w-12 h-12 rounded-full bg-gray-300">
            <img src="logo.jpeg" alt="Logo Studio" class="rounded-full" />
          </div>
        </div>
        <strong class="text-lg">Potretine</strong>
      </div>
      <div class="text-2xl text-green-500">✅</div>
    </div>

    <p class="font-bold my-4">Terimakasih sudah melakukan reservasi di studio kami!</p>

    <div class="bg-[#fddcdc] p-2 rounded-lg flex justify-between font-bold text-sm">
      <div>Booking ID:</div>
      <div><?php echo $booking_id; ?></div>
    </div>

    <div class="mt-4 text-sm leading-relaxed">
      Nama : <?php echo $nama; ?><br>
      No. Handphone : <?php echo $no_hp; ?><br>
      Pilih Studio : <?php echo $studio; ?><br>
      Tanggal : <?php echo $tanggal; ?><br>
      Jam : <?php echo $jam; ?><br>
      Jumlah Orang : <?php echo $jumlah_orang; ?>
    </div>

    <div class="divider my-4"></div>

    <div class="flex justify-between font-bold">
      <div>Total Pembayaran :</div>
      <div><?php echo $total_pembayaran; ?></div>
    </div>

    <div class="flex justify-between items-center mt-2">
      <div>Status Pembayaran:</div>
      <span class="badge bg-green-500 text-white font-bold px-3 py-1 rounded-lg text-xs">
        <?php echo $status_pembayaran; ?>
      </span>
    </div>

    <button class="btn btn-block bg-black text-white mt-4" onclick="window.print()">Cetak Resi</button>

    <div class="text-center text-xs text-gray-600 mt-6">
      <b class="block mb-1">Informasi Kontak</b>
      Jl. Photo Studio<br>
      Telp: +62 81234567890 | Email: ShutterSpace@gmail.com
    </div>
  </div>
</body>
</html>