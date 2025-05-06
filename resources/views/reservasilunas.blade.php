<?php
// Dummy data
$booking_id = "#BK-20250423-WCS-EA17W";
$kategori = "Family";
$tanggal = "25 Apr 2025";
$jam = "15:00";
$durasi = "1 jam";
$jumlah_orang = "6 orang";
$total_harga = "Rp 150.000";
$status_pembayaran = "Lunas"; // Change to "Belum Lunas" for different status
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Reservasi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-[#fff6f6]">
  <!-- Header -->
  <div class="navbar fixed top-0 left-0 right-0 bg-transparent z-10 shadow-none justify-between px-6 py-4">
    <a href="#" class="flex items-center gap-1.5 font-bold text-black no-underline text-sm">
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="w-3.5 h-3.5">
        <path fill-rule="evenodd" d="M15 8a.75.75 0 0 1-.75.75H3.56l4.22 4.22a.75.75 0 0 1-1.06 1.06l-5.5-5.5a.75.75 0 0 1 0-1.06l5.5-5.5a.75.75 0 0 1 1.06 1.06L3.56 7.25H14.25A.75.75 0 0 1 15 8z"/>
      </svg>
      <span>Kembali</span>
    </a>
    <div class="avatar">
      <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-gray-600">
          <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
        </svg>
      </div>
    </div>
  </div>

  <!-- Main Container -->
  <div class="card max-w-2xl mx-auto mt-24 mb-10 bg-white rounded-box shadow-sm p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-5">
      <h2 class="text-xl font-bold">Detail Reservasi <?php echo $booking_id; ?></h2>
      <?php
        $status_class = $status_pembayaran === "Lunas" ? 
          "badge bg-[#d4fadd] text-[#227a41] border-none" : 
          "badge bg-[#fddcdc] text-[#a33] border-none";
      ?>
      <div class="<?php echo $status_class; ?> font-bold px-3 py-1 text-sm">
        <?php echo $status_pembayaran; ?>
      </div>
    </div>

    <div class="flex items-center mt-2.5 mb-5">
      <div class="avatar mr-4">
        <div class="w-16 h-16 rounded-full bg-gray-300">
          <img src="family.jpg" alt="Studio" class="object-cover" />
        </div>
      </div>
      <div>
        <strong class="text-lg"><?php echo $kategori; ?></strong>
      </div>
    </div>

    <div class="flex flex-col sm:flex-row sm:justify-between mb-3 text-sm">
      <div>📅 <strong>Tanggal:</strong> <?php echo $tanggal; ?></div>
      <div>⏳ <strong>Durasi:</strong> <?php echo $durasi; ?></div>
    </div>

    <div class="flex flex-col sm:flex-row sm:justify-between mb-3 text-sm">
      <div>⏰ <strong>Jam:</strong> <?php echo $jam; ?></div>
      <div>👥 <strong>Jumlah Orang:</strong> <?php echo $jumlah_orang; ?></div>
    </div>

    <div class="bg-gray-100 p-2.5 rounded-lg flex justify-between font-bold mt-2.5">
      <div>Total Harga:</div>
      <div><?php echo $total_harga; ?></div>
    </div>

    <div class="divider my-5"></div>

    <div class="flex flex-col sm:flex-row gap-2.5">
      <button class="btn bg-[#fddcdc] text-[#a33] font-bold">✖ Batalkan Reservasi</button>
      <button class="btn bg-gray-200 text-gray-800 font-bold">✎ Ubah Reservasi</button>
    </div>
  </div>
</body>
</html>