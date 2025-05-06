<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ulasan Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-gray-50 pl-64">
    <!-- Sidebar -->
    <aside class="w-64 fixed top-0 left-0 h-screen bg-pink-50 text-pink-600 border-r-2 border-pink-200 p-5">
        <img src="images/logo.png" class="w-16 h-16 rounded-full object-cover block mx-auto">
        <h2 class="text-2xl text-center font-bold text-pink-600 mt-2">Potrétine</h2>
        <nav class="mt-6">
            <a href="dashboardadmin1.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>🏠</span> Dashboard
            </a>
            <a href="studionew.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>📷</span> Studio
            </a>
            <a href="datapelanggan1.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>👥</span> Pelanggan
            </a>
            <a href="pengaturan.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>⚙</span> Pengaturan
            </a>
            <a href="ulasan.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>⭐</span> Rating & Review
            </a>
            <a href="#"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>📈</span> Statistik Pendapatan
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="container mx-auto p-8 w-3/5">
        <!-- Rating Summary -->
        <div class="bg-pink-50 p-6 rounded-box mb-8">
            <h2 class="text-xl font-bold mb-2">Ulasan Pengguna</h2>
            <div class="text-4xl font-bold mb-1">5.0</div>
            <div class="text-yellow-400 text-2xl mb-2">★★★★★</div>
            <div class="text-gray-600 text-sm mb-4">Dari 2 Ulasan</div>

            <!-- Rating Distribution -->
            <div class="flex items-center mb-2 text-sm">
                <span class="text-yellow-400 mr-1">⭐ 5</span>
                <div class="w-36 h-2 bg-gray-200 rounded-full mx-2 relative">
                    <div class="h-full bg-yellow-400 rounded-full" style="width: 100%"></div>
                </div>
                <span>2 Orang</span>
            </div>
            <div class="flex items-center mb-2 text-sm">
                <span class="text-yellow-400 mr-1">⭐ 4</span>
                <div class="w-36 h-2 bg-gray-200 rounded-full mx-2"></div>
                <span>0 Orang</span>
            </div>
            <div class="flex items-center mb-2 text-sm">
                <span class="text-yellow-400 mr-1">⭐ 3</span>
                <div class="w-36 h-2 bg-gray-200 rounded-full mx-2"></div>
                <span>0 Orang</span>
            </div>
            <div class="flex items-center mb-2 text-sm">
                <span class="text-yellow-400 mr-1">⭐ 2</span>
                <div class="w-36 h-2 bg-gray-200 rounded-full mx-2"></div>
                <span>0 Orang</span>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-yellow-400 mr-1">⭐ 1</span>
                <div class="w-36 h-2 bg-gray-200 rounded-full mx-2"></div>
                <span>0 Orang</span>
            </div>
        </div>

        <!-- Reviews -->
        <div class="bg-pink-50 p-4 rounded-box mb-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                <div>
                    <div class="font-bold">JAEHYUN</div>
                    <div class="text-gray-500 text-sm">@jae123</div>
                    <div class="text-sm mt-1">Pelayanan sangat memuaskan dan tempatnya bersih.</div>
                    <div class="text-yellow-400">★★★★★</div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <button class="btn btn-sm btn-ghost bg-gray-200 hover:bg-gray-300">Ubah</button>
                <button class="btn btn-sm btn-ghost bg-gray-300 hover:bg-gray-400">Hapus</button>
            </div>
        </div>

        <div class="bg-pink-50 p-4 rounded-box mb-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div>
                <div>
                    <div class="font-bold">DONTOL</div>
                    <div class="text-gray-500 text-sm">@adittolongindit</div>
                    <div class="text-sm mt-1">Studio nyaman dan alat-alatnya lengkap.</div>
                    <div class="text-yellow-400">★★★★★</div>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <button class="btn btn-sm btn-ghost bg-gray-200 hover:bg-gray-300">Ubah</button>
                <button class="btn btn-sm btn-ghost bg-gray-300 hover:bg-gray-400">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll('.btn-ghost.bg-gray-200');
            const deleteButtons = document.querySelectorAll('.btn-ghost.bg-gray-300');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const reviewText = this.closest('.flex.justify-between').querySelector(
                        'div.text-sm.mt-1');
                    const newText = prompt("Edit review:", reviewText.textContent);
                    if (newText !== null && newText.trim() !== "") {
                        reviewText.textContent = newText.trim();
                    }
                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const confirmed = confirm("Yakin ingin menghapus review ini?");
                    if (confirmed) {
                        this.closest('.bg-pink-50').remove();
                    }
                });
            });
        });
    </script>
</body>

</html>