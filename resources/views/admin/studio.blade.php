<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Studio Dashboard</title>

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

        /* DaisyUI modal-open class handles fade-in effect */
        .modal.modal-open {
            opacity: 1;
            visibility: visible;
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

    <div class="ml-64 p-5 flex-1">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold text-primary">Manajemen Studio</h1>
            <button id="addStudioBtn" class="btn bg-[#d94c82] hover:bg-pink-300 text-white">
                <i class="fas fa-plus mr-2"></i> Tambah Studio
            </button>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">Jenis Studio</th>
                            <th class="text-center">Nama Studio</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Kapasitas</th>
                            <th class="text-center">Diubah Pada</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($studios as $studio)
                            <tr class="hover:bg-secondary/10">
                                <td class="text-center">{{ $studio->jenis_studio }}</td>
                                <td class="text-center">{{ $studio->nama_studio }}</td>
                                <td class="text-center">Rp {{ number_format($studio->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if ($studio->gambar)
                                        <img src="{{ asset('storage/' . $studio->gambar) }}"
                                            class="w-16 h-16 object-cover mx-auto rounded cursor-pointer hover:opacity-80 transition-opacity"
                                            alt="{{ $studio->nama_studio }}"
                                            onclick="showImageModal('{{ asset('storage/' . $studio->gambar) }}', '{{ $studio->nama_studio }}')"
                                            onerror="this.src='{{ asset('images/no-image.png') }}'; this.onerror=null;"
                                            loading="lazy">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center mx-auto">
                                            <span class="text-gray-500 text-xs">No Image</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $studio->kapasitas }}</td>
                                <td class="text-center">
                                    {{ $studio->diubah_pada ? $studio->diubah_pada->format('d/m/Y H:i') : '-' }}</td>
                                <td class="text-center">
                                    <button class="btn bg-base-200 btn-sm edit-studio-btn"
                                        data-id="{{ $studio->id_studio }}">
                                        <i class="fas fa-edit"></i> Ubah
                                    </button>
                                    <button
                                        class="btn bg-[#d94c82] btn-sm ml-1 delete-studio-btn text-white hover:bg-pink-300"
                                        data-id="{{ $studio->id_studio }}">
                                        <i class="fas fa-trash text-white"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Tidak ada data studio ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Image Preview Modal --}}
    <div id="imageModal" class="modal">
        <div class="modal-box max-w-4xl p-0 relative">
            <button class="btn btn-sm btn-circle absolute right-2 top-2 z-10" onclick="closeImageModal()">✕</button>
            <figure>
                <img id="modalImage" src="" alt="" class="w-full max-h-[80vh] object-contain">
                <figcaption id="modalCaption" class="text-center p-4 bg-base-200 font-semibold"></figcaption>
            </figure>
        </div>
    </div>

    {{-- Add/Edit Studio Modal --}}
    <div id="studioModal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <button class="btn btn-sm btn-circle absolute right-2 top-2" onclick="closeStudioModal()">✕</button>
            <h2 id="modalTitle" class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-camera mr-2 text-pink-600"></i>
                <span id="modalTitleText" class="text-pink-600">Tambah Studio Baru</span>
            </h2>

            <form id="studioForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_studio" name="id_studio">
                {{-- This hidden input is crucial for Laravel to interpret PUT/PATCH requests from a POST form --}}
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="form-control mb-3">
                            <label class="label">
                                <span class="label-text">Jenis Studio</span>
                            </label>
                            <input type="text" id="jenis_studio" name="jenis_studio"
                                class="input input-bordered w-full" required>
                            <span id="error-jenis_studio" class="text-error text-sm mt-1"></span>
                        </div>

                        <div class="form-control mb-3">
                            <label class="label">
                                <span class="label-text">Nama Studio</span>
                            </label>
                            <input type="text" id="nama_studio" name="nama_studio"
                                class="input input-bordered w-full" required>
                            <span id="error-nama_studio" class="text-error text-sm mt-1"></span>
                        </div>

                        <div class="form-control mb-3">
                            <label class="label">
                                <span class="label-text">Harga per Jam</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-3">Rp</span>
                                <input type="number" id="harga" name="harga"
                                    class="input input-bordered w-full pl-10" required min="0">
                            </div>
                            <span id="error-harga" class="text-error text-sm mt-1"></span>
                        </div>

                        <div class="form-control mb-3">
                            <label class="label">
                                <span class="label-text">Kapasitas</span>
                            </label>
                            <input type="number" id="kapasitas" name="kapasitas"
                                class="input input-bordered w-full" required min="1">
                            <span id="error-kapasitas" class="text-error text-sm mt-1"></span>
                        </div>
                    </div>

                    <div>
                        <div class="form-control mb-3">
                            <label class="label">
                                <span class="label-text">Gambar Studio</span>
                                <span class="label-text-alt">(Opsional)</span>
                            </label>
                            <input type="file" id="gambar" name="gambar"
                                class="file-input file-input-bordered file-input w-full" accept="image/*" />
                            <div class="text-xs text-gray-500 mt-1">
                                Format: JPG/PNG/JPEG (Maks. 2MB)
                            </div>
                            <span id="error-gambar" class="text-error text-sm mt-1"></span>
                        </div>

                        <div class="flex justify-center mt-4">
                            <div id="previewContainer" class="relative">
                                <img id="imagePreview"
                                    class="w-40 h-40 object-cover rounded-lg border-2 border-dashed border-gray-300 hidden">
                                <button type="button" id="removeImageBtn"
                                    class="absolute top-0 right-0 btn btn-xs btn-circle btn-error -mt-2 -mr-2 hidden">
                                    <i class="fas fa-times text-white"></i>
                                </button>
                                <div id="noImagePlaceholder"
                                    class="w-40 h-40 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-action mt-6">
                    <button type="button" class="btn btn-ghost" onclick="closeStudioModal()">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" class="btn bg-[#d94c82] text-white hover:bg-pink-300">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Error Modal --}}
    <div id="errorModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg text-error">
                <i class="fas fa-exclamation-triangle mr-2"></i> Terjadi Kesalahan
            </h3>
            <p id="errorMessage" class="py-4"></p>
            <div class="modal-action">
                <button class="btn btn-error" onclick="closeErrorModal()">Tutup</button>
            </div>
        </div>
    </div>

    {{-- Confirmation Delete Modal --}}
    <div id="confirmDeleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">
                <i class="fas fa-exclamation-circle mr-2 text-pink-600"></i> Konfirmasi Hapus
            </h3>
            <p class="py-4">Apakah Anda yakin ingin menghapus studio ini?</p>
            <div class="modal-action">
                <button class="btn btn-ghost" onclick="closeDeleteModal()">Batal</button>
                <button id="confirmDeleteBtn" class="btn bg-[#d94c82] text-white">
                    <i class="fas fa-trash mr-2 text-white"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentStudioId = null;

        const loadingOverlay = document.getElementById('loadingOverlay');
        const studioModal = document.getElementById('studioModal');
        const errorModal = document.getElementById('errorModal');
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        const studioForm = document.getElementById('studioForm');
        const imagePreview = document.getElementById('imagePreview');
        const noImagePlaceholder = document.getElementById('noImagePlaceholder');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const gambarInput = document.getElementById('gambar');

        /**
         * Toggles the visibility of the loading overlay.
         * @param {boolean} show - True to show, false to hide.
         */
        function toggleLoading(show) {
            loadingOverlay.classList.toggle('active', show);
        }

        /**
         * Displays a generic error message in the error modal.
         * @param {string} message - The main error message.
         * @param {object} [errors={}] - Optional object containing field-specific validation errors.
         */
        function showError(message, errors = {}) {
            let errorHtml = `<span>${message}</span>`;
            if (Object.keys(errors).length > 0) {
                errorHtml += '<ul class="list-disc list-inside mt-2">';
                for (const field in errors) {
                    errors[field].forEach(error => {
                        // Display actual field name if possible, or just the error
                        const fieldName = document.querySelector(`label[for="${field}"] .label-text`)
                            ?.textContent ||
                            field;
                        errorHtml += `<li>${fieldName}: ${error}</li>`;
                    });
                }
                errorHtml += '</ul>';
            }
            document.getElementById('errorMessage').innerHTML = errorHtml;
            errorModal.classList.add('modal-open');
        }

        /**
         * Closes the error modal.
         */
        function closeErrorModal() {
            errorModal.classList.remove('modal-open');
        }

        /**
         * Shows the image preview modal.
         * @param {string} src - The image source URL.
         * @param {string} caption - The caption for the image.
         */
        function showImageModal(src, caption) {
            const modal = document.getElementById('imageModal');
            document.getElementById('modalImage').src = src;
            document.getElementById('modalCaption').textContent = caption;
            modal.classList.add('modal-open');
        }

        /**
         * Closes the image preview modal.
         */
        function closeImageModal() {
            document.getElementById('imageModal').classList.remove('modal-open');
        }

        /**
         * Opens the studio creation/edit modal.
         * @param {'add'|'edit'} mode - The mode of the modal ('add' or 'edit').
         * @param {object} [studioData=null] - The studio data object when in 'edit' mode.
         */
        function openStudioModal(mode = 'add', studioData = null) {
            const modalTitleText = document.getElementById('modalTitleText');
            const formMethod = document.getElementById('formMethod'); // Hidden input for _method

            clearValidationErrors(); // Always clear previous errors

            if (mode === 'add') {
                modalTitleText.textContent = 'Tambah Studio Baru';
                studioForm.reset(); // Clear form fields
                studioForm.action = "{{ route('studio.store') }}"; // Set action for store
                formMethod.value = 'POST'; // Set method to POST
                document.getElementById('id_studio').value = ''; // Ensure ID is empty for add
                updateImagePreview(null); // Clear image preview
            } else if (studioData) {
                modalTitleText.textContent = 'Edit Studio';
                studioForm.action = `/admin/studio/${studioData.id_studio}`; // Set action for update
                formMethod.value = 'POST'; // Laravel expects POST with _method for PUT/PATCH
                // Set hidden input for actual PUT/PATCH method, if your backend requires it specifically
                const methodOverride = document.createElement('input');
                methodOverride.type = 'hidden';
                methodOverride.name = '_method';
                methodOverride.value = 'PUT'; // Or 'PATCH'
                studioForm.appendChild(methodOverride);

                document.getElementById('id_studio').value = studioData.id_studio;
                document.getElementById('jenis_studio').value = studioData.jenis_studio || '';
                document.getElementById('nama_studio').value = studioData.nama_studio || '';
                document.getElementById('harga').value = studioData.harga || '';
                document.getElementById('kapasitas').value = studioData.kapasitas || '';
                updateImagePreview(studioData.gambar); // Set image preview
            }

            studioModal.classList.add('modal-open');
        }

        /**
         * Closes the studio creation/edit modal.
         */
        function closeStudioModal() {
            studioModal.classList.remove('modal-open');
            clearValidationErrors();
            studioForm.reset();
            updateImagePreview(null); // Ensure image preview is reset
            // Remove the _method hidden input if it was added for editing
            const methodOverride = studioForm.querySelector('input[name="_method"][value="PUT"]');
            if (methodOverride) {
                methodOverride.remove();
            }
        }

        /**
         * Opens the delete confirmation modal.
         * @param {number} id - The ID of the studio to be deleted.
         */
        function openDeleteModal(id) {
            currentStudioId = id;
            confirmDeleteModal.classList.add('modal-open');
        }

        /**
         * Closes the delete confirmation modal.
         */
        function closeDeleteModal() {
            confirmDeleteModal.classList.remove('modal-open');
            currentStudioId = null;
        }

        /**
         * Updates the image preview display.
         * @param {string|null} imagePath - The path to the image or null to clear.
         */
        function updateImagePreview(imagePath) {
            if (imagePath) {
                // Check if it's a full URL (e.g., from FileReader) or a storage path
                if (imagePath.startsWith('blob:') || imagePath.startsWith('data:')) {
                    imagePreview.src = imagePath;
                } else {
                    imagePreview.src = "{{ asset('storage/') }}/" + imagePath;
                }
                imagePreview.classList.remove('hidden');
                noImagePlaceholder.classList.add('hidden');
                removeImageBtn.classList.remove('hidden');
            } else {
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
                noImagePlaceholder.classList.remove('hidden');
                removeImageBtn.classList.add('hidden');
            }
        }

        /**
         * Displays validation errors received from the server.
         * Adds 'border-error' class to input fields and shows messages.
         * @param {object} errors - An object where keys are field names and values are arrays of error messages.
         */
        function showValidationErrors(errors) {
            clearValidationErrors(); // Clear existing errors first
            for (const field in errors) {
                const errorElement = document.getElementById(`error-${field}`);
                const inputElement = document.getElementById(field);

                if (errorElement) {
                    errorElement.textContent = errors[field][0]; // Display the first error message
                }
                if (inputElement) {
                    inputElement.classList.add('border-error'); // Add error border to input
                }
            }
        }

        /**
         * Clears all displayed validation error messages and removes error borders from inputs.
         */
        function clearValidationErrors() {
            document.querySelectorAll('[id^="error-"]').forEach(el => {
                el.textContent = '';
            });
            document.querySelectorAll('.input-bordered.border-error').forEach(el => {
                el.classList.remove('border-error');
            });
        }

        /**
         * Fetches studio data from the server for editing.
         * @param {number} id - The ID of the studio to fetch.
         */
        async function fetchStudioData(id) {
            toggleLoading(true);

            try {
                if (!id || isNaN(id) || parseInt(id) <= 0) {
                    throw new Error('ID studio tidak valid atau kosong.');
                }
                const studioId = parseInt(id);

                const response = await fetch(`/admin/studio/${studioId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json(); // Always try to parse JSON

                if (!response.ok) {
                    // If not OK, it's an error. Use the message from data if available.
                    showError(data.message || `Terjadi kesalahan saat memuat data studio. Status: ${response.status}.`,
                        data
                        .errors);
                    return;
                }

                if (data.success) {
                    openStudioModal('edit', data.data);
                } else {
                    showError(data.message || 'Gagal memuat data studio dari server.', data.errors);
                }

            } catch (error) {
                console.error('Error in fetchStudioData:', error);
                showError(error.message || 'Terjadi kesalahan jaringan atau server saat memuat data studio.');
            } finally {
                toggleLoading(false);
            }
        }

        /**
         * Sends a request to delete a studio.
         * @param {number} id - The ID of the studio to delete.
         */
        async function deleteStudio(id) {
            toggleLoading(true);
            closeDeleteModal(); // Close confirmation modal immediately

            try {
                const response = await fetch(`/admin/studio/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || `Gagal menghapus studio. Status: ${response.status}`);
                }

                if (data.success) {
                    window.location.reload(); // Reload page on success
                } else {
                    showError(data.message || 'Terjadi kesalahan saat menghapus studio.');
                }

            } catch (error) {
                console.error('Error deleting studio:', error);
                showError(error.message || 'Terjadi kesalahan jaringan atau server saat menghapus studio.');
            } finally {
                toggleLoading(false);
            }
        }

        // --- Event Listeners ---
        document.addEventListener('DOMContentLoaded', function() {
            // Add Studio Button Click
            document.getElementById('addStudioBtn').addEventListener('click', () => {
                openStudioModal('add');
            });

            // Edit and Delete Buttons (Event Delegation)
            document.addEventListener('click', function(e) {
                const editBtn = e.target.closest('.edit-studio-btn');
                const deleteBtn = e.target.closest('.delete-studio-btn');

                if (editBtn) {
                    const studioId = editBtn.dataset.id;
                    fetchStudioData(studioId);
                }

                if (deleteBtn) {
                    const studioId = deleteBtn.dataset.id;
                    openDeleteModal(studioId);
                }
            });

            // Image Input Change (for preview)
            gambarInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        updateImagePreview(e.target.result); // Pass the Data URL for preview
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    updateImagePreview(null); // Clear preview if no file selected
                }
            });

            // Remove Image Button
            removeImageBtn.addEventListener('click', function() {
                gambarInput.value = ''; // Clear the file input
                updateImagePreview(null); // Clear the image preview
            });

            // Confirm Delete Button
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                if (currentStudioId) {
                    deleteStudio(currentStudioId);
                }
            });

            // Studio Form Submission
            studioForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const submitBtn = document.getElementById('submitBtn');
                const originalBtnText = submitBtn.innerHTML;

                if (submitBtn.disabled) return; // Prevent double submission

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Menyimpan...';
                toggleLoading(true);
                clearValidationErrors(); // Clear errors before new submission

                try {
                    const formData = new FormData(this);
                    const response = await fetch(this.action, {
                        method: 'POST', // Always POST for form submission, Laravel handles _method
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json(); // Always parse JSON

                    if (!response.ok) {
                        if (response.status === 422 && data.errors) {
                            showValidationErrors(data.errors);
                            showError('Terjadi kesalahan validasi. Mohon periksa kembali input Anda.',
                                data
                                .errors); // Show summary error
                        } else {
                            showError(data.message ||
                                `Terjadi kesalahan. Status: ${response.status}.`); // Generic error
                        }
                        return; // Stop if there are errors
                    }

                    if (data.success) {
                        closeStudioModal();
                        window.location.reload(); // Reload the page to show updated data
                    } else {
                        showError(data.message || 'Operasi gagal.');
                    }

                } catch (error) {
                    console.error('Error submitting form:', error);
                    showError(error.message ||
                        'Terjadi kesalahan jaringan atau server saat menyimpan data.');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                    toggleLoading(false);
                }
            });

            // Close modals when clicking outside
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target ===
                        this) { // Only close if the click is directly on the modal backdrop
                        this.classList.remove('modal-open');
                        // Specific handling for studioModal to clear form/preview on close
                        if (this.id === 'studioModal') {
                            closeStudioModal();
                        } else if (this.id === 'imageModal') {
                            closeImageModal();
                        } else if (this.id === 'confirmDeleteModal') {
                            closeDeleteModal();
                        } else if (this.id === 'errorModal') {
                            closeErrorModal();
                        }
                    }
                });
            });

            // Close modals with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal.modal-open').forEach(modal => {
                        modal.classList.remove('modal-open');
                        // Specific handling for studioModal to clear form/preview on close
                        if (modal.id === 'studioModal') {
                            closeStudioModal();
                        } else if (modal.id === 'imageModal') {
                            closeImageModal();
                        } else if (modal.id === 'confirmDeleteModal') {
                            closeDeleteModal();
                        } else if (modal.id === 'errorModal') {
                            closeErrorModal();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
