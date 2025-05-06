<?php
// Dummy data
$booking_id = "#BK-20250423-WCS-EA17W";
$kategori = "Family";
$tanggal = "25 Apr 2025";
$jam = "15:00";
$durasi = "1 jam";
$jumlah_orang = "6 orang";
$total_harga = "Rp 150.000";
$status_pembayaran = "Belum Lunas";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Reservasi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.x.x/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-[#fff6f6]">
  <!-- Header -->
  <div class="fixed top-0 left-0 right-0 bg-transparent flex justify-between items-center px-6 py-4 z-10 shadow-none">
    <a href="#" class="text-black font-bold text-sm flex items-center gap-1.5 no-underline">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="w-3.5 h-3.5">
        <path fill-rule="evenodd" d="M15 8a.75.75 0 0 1-.75.75H3.56l4.22 4.22a.75.75 0 0 1-1.06 1.06l-5.5-5.5a.75.75 0 0 1 0-1.06l5.5-5.5a.75.75 0 0 1 1.06 1.06L3.56 7.25H14.25A.75.75 0 0 1 15 8z"/>
      </svg>
      <span class="text-sm">Kembali</span>
    </a>
    <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center ml-4">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-gray-600">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
      </svg>
    </div>
  </div>

  <!-- Kontainer utama -->
  <div class="max-w-2xl mx-auto my-24 bg-white rounded-xl p-6 shadow-sm mt-[100px] mb-10">
    <div class="flex justify-between items-center mb-5 sm:flex-row flex-col sm:items-center items-start gap-2">
      <h2 class="text-xl font-bold m-0">Detail Reservasi <?php echo $booking_id; ?></h2>
      <div class="bg-[#fddcdc] text-[#a33] font-bold px-3 py-1 rounded-md text-sm"><?php echo $status_pembayaran; ?></div>
    </div>

    <div class="flex items-center mt-2.5 mb-5">
      <div class="w-16 h-16 rounded-full bg-gray-300 flex justify-center items-center overflow-hidden mr-4">
        <img src="family.jpg" alt="Studio" class="w-full h-full object-cover" />
      </div>
      <div>
        <strong><?php echo $kategori; ?></strong>
      </div>
    </div>

    <div class="flex justify-between mb-3 text-sm sm:flex-row flex-col sm:gap-0 gap-1.5">
      <div>📅 <strong>Tanggal:</strong> <?php echo $tanggal; ?></div>
      <div>⏳ <strong>Durasi:</strong> <?php echo $durasi; ?></div>
    </div>

    <div class="flex justify-between mb-3 text-sm sm:flex-row flex-col sm:gap-0 gap-1.5">
      <div>⏰ <strong>Jam:</strong> <?php echo $jam; ?></div>
      <div>👥 <strong>Jumlah Orang:</strong> <?php echo $jumlah_orang; ?></div>
    </div>

    <div class="bg-gray-100 p-2.5 rounded-md flex justify-between font-bold mt-2.5">
      <div>Total Harga:</div>
      <div><?php echo $total_harga; ?></div>
    </div>

    <div class="border-t border-gray-300 my-5"></div>

    <div class="flex gap-2.5 flex-wrap sm:flex-row flex-col">
      <button class="btn bg-[#fddcdc] text-[#a33] font-bold px-3.5 py-2.5 rounded-md text-sm">✖ Batalkan Reservasi</button>
      <button class="btn bg-gray-200 text-gray-800 font-bold px-3.5 py-2.5 rounded-md text-sm">✎ Ubah Reservasi</button>
    </div>
  </div>
</body>
</html>