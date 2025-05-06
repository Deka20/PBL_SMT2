<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengaturan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-gray-50">
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
    <main class="flex-1 ml-64 p-8 bg-white overflow-y-auto">
        <!-- Upload Card -->
        <div class="card bg-pink-50 p-5 rounded-box mb-8">
            <h2 class="text-xl font-bold mb-4">Unggah Gambar</h2>
            <form id="uploadForm" class="flex gap-3">
                <input type="file" id="imageInput" accept="image/*"
                    class="file-input file-input-bordered w-full max-w-xs" />
                <button type="submit" class="btn">Unggah Gambar</button>
            </form>
        </div>

        <!-- Gallery Card -->
        <div class="card bg-pink-50 p-5 rounded-box mb-8">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold">Galeri Portofolio</h2>
                <span class="text-2xl">🖼</span>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5" id="gallery"></div>
    </main>

    <!-- User Icon -->
    <div class="fixed top-5 right-5 border border-gray-300 rounded-full p-2">
        <img src="https://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/512/user-icon.png" alt="User Icon"
            class="w-6 h-6">
    </div>

    <script>
        const form = document.getElementById("uploadForm");
        const imageInput = document.getElementById("imageInput");
        const gallery = document.getElementById("gallery");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            const file = imageInput.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function() {
                const galleryItem = document.createElement("div");
                galleryItem.className = "bg-gray-100 p-4 text-center rounded-box relative";

                galleryItem.innerHTML = `
          <div class="image-preview mb-2">
            <img src="${reader.result}" alt="Preview" class="max-h-32 w-auto mx-auto rounded-lg">
          </div>
          <div class="text-xs text-gray-500 mb-2">Diunggah pada: ${new Date().toLocaleDateString()}</div>
          <button class="btn btn-error btn-sm">
            <span>🗑</span> Hapus
          </button>
        `;

                gallery.appendChild(galleryItem);

                const deleteBtn = galleryItem.querySelector("button");
                deleteBtn.addEventListener("click", () => {
                    const confirmDelete = confirm("Yakin ingin menghapus portofolio ini?");
                    if (confirmDelete) {
                        galleryItem.remove();
                    }
                });
            };

            reader.readAsDataURL(file);
            form.reset();
        });
    </script>
</body>

</html>