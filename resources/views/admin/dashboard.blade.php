<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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

<body class="bg-gray-50 font-sans">
    <x-sidebar></x-sidebar>

    <!-- Content -->
    <div class="ml-72 p-5 w-[calc(100%-18rem)]">
        <div class="flex flex-wrap gap-5 mb-5">
            <!-- Card 1 -->
            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500">📷</div>
                <h3 class="text-lg font-medium">Total Studio</h3>
                <h2 class="text-2xl font-bold">4</h2>
            </div>

            <!-- Card 2 -->
            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500">📅</div>
                <h3 class="text-lg font-medium">Total Pemesanan</h3>
                <h2 class="text-2xl font-bold">12</h2>
            </div>

            <!-- Card 3 -->
            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500">👥</div>
                <h3 class="text-lg font-medium">Total Pelanggan</h3>
                <h2 class="text-2xl font-bold">70</h2>
            </div>

            <!-- Card 4 -->
            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500">💵</div>
                <h3 class="text-lg font-medium">Total Penghasilan</h3>
                <h2 class="text-2xl font-bold">Rp 600.000</h2>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto mt-8">
            <table class="table bg-pink-50 rounded-lg overflow-hidden">
                <thead class="bg-pink-200">
                    <tr>
                        <th class="text-center">Nama Pemesan</th>
                        <th class="text-center">Studio</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">No Handphone</th>
                        <th class="text-center">Bukti Pembayaran</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">Khai</td>
                        <td class="text-center">Self Photo</td>
                        <td class="text-center">7 Apr 2025</td>
                        <td class="text-center">081234567890</td>
                        <td class="text-center"><a href="#" class="link link-primary">👁 Lihat Bukti</a></td>
                        <td class="text-center"><span class="badge badge-success text-white">Lunas</span></td>
                    </tr>
                    <tr>
                        <td class="text-center">Chewyea</td>
                        <td class="text-center">Graduation</td>
                        <td class="text-center">7 Jul 2025</td>
                        <td class="text-center">081398765432</td>
                        <td class="text-center"><a href="#" class="link link-primary">👁 Lihat Bukti</a></td>
                        <td class="text-center"><span class="badge badge-success text-white">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
