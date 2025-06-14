<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- IMPORTANT for AJAX --}}
    <title>Pengaturan</title>
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
    <style>
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-overlay.active {
            display: flex;
        }

        .alert-toast {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            z-index: 10000;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
        }

        .alert-toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div id="loadingOverlay" class="loading-overlay">
        <div class="text-white text-2xl flex flex-col items-center">
            <span class="loading loading-spinner loading-lg mb-2"></span>
            <span>Memuat...</span>
        </div>
    </div>

    {{-- Assuming x-sidebar is a Blade component --}}
    <x-sidebar></x-sidebar>

    <main class="flex-1 ml-64 p-8 bg-white overflow-y-auto">
        <div class="card bg-pink-50 p-5 rounded-box mb-8 shadow-sm">
            <h2 class="text-xl font-bold mb-4 text-gray-600">Unggah Gambar Portofolio Baru</h2>
            <form id="uploadForm" class="flex flex-col sm:flex-row gap-3 items-end">
                <div class="form-control flex-grow">
                    <label class="label">
                        <span class="label-text">Pilih Gambar</span>
                    </label>
                    <input type="file" id="imageInput" name="image" accept="image/*"
                        class="file-inpu file-input-bordered file-input w-full max-w-xs" required />
                    <p id="imageInputError" class="text-red-500 text-sm mt-1"></p>
                </div>
                <button type="submit" class="btn bg-[#d94c82] hover:bg-pink-300 text-white">
                    <i class="fas fa-upload mr-2"></i> Unggah Gambar
                </button>
            </form>
        </div>

        <div class="card bg-pink-50 p-5 rounded-box mb-8 shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-gray-600">Galeri Portofolio</h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4" id="gallery">
                @forelse ($portfolios as $portfolio)
                    <div class="bg-white rounded-xl shadow-md p-4 text-center portfolio-item"
                        data-id="{{ $portfolio->id }}">
                        <div
                            class="bg-white rounded-lg overflow-hidden flex items-center justify-center w-full aspect-square mb-3">
                            @if ($portfolio->image_path)
                                <img src="{{ Storage::url($portfolio->image_path) }}" alt="Portfolio Image"
                                    class="w-full h-full object-cover rounded-lg">
                            @else
                                {{-- Placeholder if image_path is somehow empty --}}
                                <span class="text-gray-500 text-lg font-semibold">Gambar</span>
                            @endif
                        </div>

                        <div class="text-xs text-gray-600 mb-2">Diunggah pada:
                            {{ $portfolio->created_at->format('M d, Y') }}</div>

                        <button
                            class="btn-delete-portfolio w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center mx-auto transition-colors duration-200 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10">
                        <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500">Belum ada portofolio yang diunggah</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    {{-- Toast Notification --}}
    <div id="toast" class="alert-toast"></div>


    <script>
        const form = document.getElementById("uploadForm");
        const imageInput = document.getElementById("imageInput");
        const imageInputError = document.getElementById("imageInputError");
        const gallery = document.getElementById("gallery");
        const loadingOverlay = document.getElementById('loadingOverlay');
        const toast = document.getElementById('toast');
        const noPortfoliosMessage = document.getElementById('noPortfoliosMessage');


        /**
         * Toggles the loading overlay visibility.
         * @param {boolean} show - True to show, false to hide.
         */
        function toggleLoading(show) {
            loadingOverlay.classList.toggle('active', show);
        }

        /**
         * Shows a toast notification.
         * @param {string} message - The message to display.
         * @param {'success'|'error'|'info'} type - The type of notification.
         */
        function showToast(message, type = 'info') {
            toast.innerHTML = `
                <div class="alert ${type === 'success' ? 'alert-success' : type === 'error' ? 'alert-error' : 'alert-info'} shadow-lg">
                    <div>
                        <i class="${type === 'success' ? 'fas fa-check-circle' : type === 'error' ? 'fas fa-times-circle' : 'fas fa-info-circle'} mr-2"></i>
                        <span>${message}</span>
                    </div>
                </div>
            `;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000); // Hide after 3 seconds
        }

        /**
         * Clears validation error messages for the image input.
         */
        function clearImageInputError() {
            imageInputError.textContent = '';
            imageInput.classList.remove('border-red-500');
        }

        /**
         * Adds a new portfolio item to the gallery.
         * @param {object} item - Portfolio data: { id, image_path, created_at }
         */
        function addPortfolioItemToGallery(item) {
            const galleryItem = document.createElement("div");
            galleryItem.className = "bg-gray-100 p-4 text-center rounded-lg shadow-md relative group portfolio-item";
            galleryItem.dataset.id = item.id; // Store ID for deletion

            galleryItem.innerHTML = `
                <div class="image-preview mb-2 h-32 flex items-center justify-center overflow-hidden rounded-lg">
                    <img src="${item.image_path}" alt="Portfolio Image" class="max-h-full w-auto object-contain mx-auto rounded-lg">
                </div>
                <div class="text-xs text-gray-500 mb-2">Diunggah pada: ${item.created_at}</div>
                <button class="btn btn-error btn-sm btn-delete-portfolio">
                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                </button>
            `;

            gallery.prepend(galleryItem); // Add to the beginning of the gallery
            // Check if 'no portfolios' message exists and remove it
            if (noPortfoliosMessage && noPortfoliosMessage.parentNode) {
                noPortfoliosMessage.remove();
            }
        }

        // --- Event Listeners ---

        // Handle image upload form submission
        form.addEventListener("submit", async function(e) {
            e.preventDefault();
            clearImageInputError(); // Clear previous errors

            const file = imageInput.files[0];
            if (!file) {
                imageInputError.textContent = "Pilih gambar untuk diunggah.";
                imageInput.classList.add('border-red-500');
                return;
            }

            // Basic client-side validation for file size and type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                imageInputError.textContent = "Format gambar tidak didukung. Gunakan JPG, PNG, GIF, atau SVG.";
                imageInput.classList.add('border-red-500');
                return;
            }

            if (file.size > maxSize) {
                imageInputError.textContent = "Ukuran gambar terlalu besar (Maks. 2MB).";
                imageInput.classList.add('border-red-500');
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            toggleLoading(true);

            try {
                // Adjust this URL if your Laravel API route is different (e.g., /api/portfolio)
                const response = await fetch("{{ route('pengaturan.store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json' // Request JSON response
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showToast(data.message, 'success');
                    addPortfolioItemToGallery(data.data); // Add new item to gallery
                    form.reset(); // Clear the form
                    clearImageInputError();
                } else {
                    // Handle validation errors from server
                    if (response.status === 422 && data.errors && data.errors.image) {
                        imageInputError.textContent = data.errors.image[0];
                        imageInput.classList.add('border-red-500');
                    } else {
                        showToast(data.message || "Gagal mengunggah gambar. Silakan coba lagi.", 'error');
                    }
                }
            } catch (error) {
                console.error("Error uploading image:", error);
                showToast("Terjadi kesalahan jaringan atau server.", 'error');
            } finally {
                toggleLoading(false);
            }
        });

        // Handle delete button clicks using event delegation
        gallery.addEventListener("click", async function(e) {
            const deleteBtn = e.target.closest(".btn-delete-portfolio");
            if (deleteBtn) {
                const galleryItem = deleteBtn.closest(".portfolio-item");
                const portfolioId = galleryItem.dataset.id;

                if (confirm("Yakin ingin menghapus portofolio ini?")) {
                    toggleLoading(true);
                    try {
                        // UPDATED URL for delete: from '/admin/portfolio/${portfolioId}' to '/admin/pengaturan/${portfolioId}'
                        const response = await fetch(`/admin/pengaturan/${portfolioId}`, {
                            method: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json'
                            },
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            showToast(data.message, 'success');
                            galleryItem.remove();
                            if (gallery.children.length === 0) {
                                const p = document.createElement('p');
                                p.id = 'noPortfoliosMessage';
                                p.className = 'col-span-full text-center text-gray-500';
                                p.textContent = 'Belum ada portofolio yang diunggah.';
                                gallery.appendChild(p);
                            }
                        } else {
                            showToast(data.message || "Gagal menghapus portofolio. Silakan coba lagi.",
                                'error');
                        }
                    } catch (error) {
                        console.error("Error deleting portfolio:", error);
                        showToast("Terjadi kesalahan jaringan atau server saat menghapus.", 'error');
                    } finally {
                        toggleLoading(false);
                    }
                }
            }
        });
    </script>
</body>

</html>
