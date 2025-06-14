<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ulasan Pengguna</title>
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

<body class="bg-gray-50 pl-64">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

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
                    <div class="font-bold">DENIS</div>
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
