<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Penting untuk AJAX --}}
    <title>Manajemen Pelanggan - Potrétine</title>

    <!-- CSS Resources -->
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
        /* Custom styles for colors if not in tailwind.config.js (pastikan di Tailwind config Anda) */
        .text-primary {
            color: #DB2777;
        }

        /* A shade of pink */
        .bg-secondary {
            background-color: #FCE7F3;
        }

        /* A lighter shade of pink for hover */
        .text-pink-800 {
            color: #9D174D;
        }

        /* Darker pink for hover text */

        /* Loading Overlay styles */
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

        /* Styles for sidebar layout */
        body {
            padding-left: 16rem;
            /* Sesuaikan dengan lebar sidebar w-64 */
            background-color: #f8fafc;
            /* Warna latar belakang umum */
        }

        /* Adjust table cell padding for compactness if needed, or use default Tailwind padding */
        .table th,
        .table td {
            padding: 0.75rem 1rem;
            /* Slightly reduced padding */
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="text-white text-2xl flex flex-col items-center">
            <span class="loading loading-spinner loading-lg mb-2"></span>
            <span>Memuat...</span>
        </div>
    </div>

    <!-- Sidebar Component (panggil langsung) -->
    <x-sidebar></x-sidebar>

    <!-- Konten Tabel Pelanggan -->
    <main class="p-8">
        <h1 class="text-4xl font-bold text-pink-600 mb-6">Manajemen Pelanggan</h1>

        <!-- Konten Tabel Pelanggan -->
        <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto"> {{-- overflow-x-auto untuk scroll horizontal pada tabel saja --}}
            <h3 class="text-xl font-semibold text-pink-700 mb-4">Daftar Pelanggan</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                            Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dibuat Pada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="customerTableBody">
                    @forelse ($customers as $index => $customer)
                        <tr class="hover:bg-pink-100" data-id="{{ $customer->id }}"> {{-- Tambahkan data-id untuk JS --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->nama_lengkap }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->nama_pengguna }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->telepon }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $customer->created_at ? $customer->created_at->format('d/m/Y H:i') : '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="btn bg-base-200 btn-xs edit-customer-btn" data-id="{{ $customer->id }}">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                                <button class="btn bg-[#d94c82] text-white btn-xs ml-1 delete-customer-btn"
                                    data-id="{{ $customer->id }}">
                                    <i class="fas fa-trash-alt text-white"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data pelanggan
                                ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- Add/Edit Customer Modal -->
    <div id="customerModal" class="modal">
        <div class="modal-box w-11/12 max-w-md">
            <button class="btn btn-sm btn-circle absolute right-2 top-2" onclick="closeCustomerModal()">✕</button>
            <h2 id="modalTitle" class="text-xl font-bold mb-4 flex items-center">
                <i class="fas fa-user-edit mr-2"></i>
                <span id="modalTitleText">Ubah Pelanggan</span>
            </h2>

            <form id="customerForm" method="POST">
                @csrf
                <input type="hidden" id="customer_id" name="customer_id">
                <input type="hidden" name="_method" id="formMethod" value="PUT"> {{-- Akan selalu PUT untuk update --}}

                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Nama Lengkap</span></label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="input input-bordered w-full"
                        required>
                    <span id="error-nama_lengkap" class="text-error text-sm mt-1"></span>
                </div>
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Nama Pengguna</span></label>
                    <input type="text" id="nama_pengguna" name="nama_pengguna" class="input input-bordered w-full"
                        required>
                    <span id="error-nama_pengguna" class="text-error text-sm mt-1"></span>
                </div>
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Email</span></label>
                    <input type="email" id="email" name="email" class="input input-bordered w-full" required>
                    <span id="error-email" class="text-error text-sm mt-1"></span>
                </div>
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">No. Telepon</span></label>
                    <input type="text" id="telepon" name="telepon" class="input input-bordered w-full" required>
                    <span id="error-telepon" class="text-error text-sm mt-1"></span>
                </div>
                {{-- Anda bisa menambahkan input untuk 'role', 'tgl_lahir' jika diperlukan --}}

                <div class="modal-action mt-6">
                    <button type="button" class="btn btn-ghost" onclick="closeCustomerModal()">Batal</button>
                    <button type="submit" id="submitBtn" class="btn bg-[#d94c82] text-white hover:bg-pink-300">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Error Modal -->
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

    <!-- Confirm Delete Modal -->
    <div id="confirmDeleteModal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">
                <i class="fas fa-exclamation-circle mr-2 text-warning"></i> Konfirmasi Hapus
            </h3>
            <p class="py-4">Apakah Anda yakin ingin menghapus pelanggan ini?</p>
            <div class="modal-action">
                <button class="btn btn-ghost" onclick="closeDeleteModal()">Batal</button>
                <button id="confirmDeleteBtn" class="btn bg-[#d94c82] text-white">
                    <i class="fas fa-trash mr-2 text-white"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Global variables and DOM elements
        let currentCustomerId = null;
        const loadingOverlay = document.getElementById('loadingOverlay');
        const customerModal = document.getElementById('customerModal');
        const errorModal = document.getElementById('errorModal');
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        const customerForm = document.getElementById('customerForm');
        const submitBtn = document.getElementById('submitBtn');

        // --- Utility Functions ---

        function toggleLoading(show) {
            loadingOverlay.classList.toggle('active', show);
        }

        function showError(message, errors = {}) {
            let errorHtml = `<span>${message}</span>`;
            if (Object.keys(errors).length > 0) {
                errorHtml += '<ul class="list-disc list-inside mt-2 text-sm">';
                for (const field in errors) {
                    errors[field].forEach(error => {
                        errorHtml += `<li>${error}</li>`;
                    });
                }
                errorHtml += '</ul>';
            }
            document.getElementById('errorMessage').innerHTML = errorHtml;
            errorModal.classList.add('modal-open');
        }

        function closeErrorModal() {
            errorModal.classList.remove('modal-open');
        }

        function openCustomerModal(mode = 'edit', customerData = null) {
            const modalTitleText = document.getElementById('modalTitleText');
            const formMethod = document.getElementById('formMethod');

            modalTitleText.textContent = 'Ubah Pelanggan'; // Hanya mode edit untuk pelanggan
            formMethod.value = 'PUT'; // Metode HTTP untuk update

            clearValidationErrors(); // Bersihkan error validasi sebelumnya

            if (customerData) {
                customerForm.action = `/admin/pelanggan/${customerData.id}`; // URL untuk update
                document.getElementById('customer_id').value = customerData.id;
                document.getElementById('nama_lengkap').value = customerData.nama_lengkap || '';
                document.getElementById('nama_pengguna').value = customerData.nama_pengguna || '';
                document.getElementById('email').value = customerData.email || '';
                document.getElementById('telepon').value = customerData.telepon || '';
            }

            customerModal.classList.add('modal-open');
        }

        function closeCustomerModal() {
            customerModal.classList.remove('modal-open');
            customerForm.reset();
            clearValidationErrors();
        }

        function openDeleteModal(id) {
            currentCustomerId = id;
            confirmDeleteModal.classList.add('modal-open');
        }

        function closeDeleteModal() {
            confirmDeleteModal.classList.remove('modal-open');
            currentCustomerId = null;
        }

        function showValidationErrors(errors) {
            for (const field in errors) {
                const errorElement = document.getElementById(`error-${field}`);
                const inputElement = document.getElementById(field);
                if (errorElement) {
                    errorElement.textContent = errors[field][0];
                    if (inputElement) {
                        inputElement.classList.add('border-error');
                    }
                }
            }
        }

        function clearValidationErrors() {
            const errorElements = document.querySelectorAll('[id^="error-"]');
            errorElements.forEach(el => el.textContent = '');
            const inputElements = document.querySelectorAll('.input-bordered');
            inputElements.forEach(el => el.classList.remove('border-error'));
        }

        // --- AJAX Functions ---

        async function fetchCustomerData(id) {
            toggleLoading(true);

            try {
                if (!id || isNaN(id) || parseInt(id) <= 0) {
                    throw new Error('ID pelanggan tidak valid atau kosong.');
                }
                const customerId = parseInt(id);

                console.log('Fetching customer with ID:', customerId);

                const response = await fetch(`/admin/pelanggan/${customerId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const responseText = await response.text();
                console.log('Raw response text:', responseText);

                let data;
                try {
                    data = JSON.parse(responseText);
                } catch (e) {
                    throw new Error(
                        `Respons tidak valid JSON. Status: ${response.status}. Isi: ${responseText.substring(0, 200)}...`
                    );
                }

                if (!response.ok) {
                    showError(data.message || `HTTP error! Status: ${response.status}.`, data.errors || {});
                    return;
                }

                if (!data.success) {
                    showError(data.message || 'Gagal memuat data pelanggan dari server.', data.errors || {});
                    return;
                }

                console.log('Data pelanggan berhasil diterima:', data.data);
                openCustomerModal('edit', data.data);

            } catch (error) {
                console.error('Error in fetchCustomerData:', error);
                showError(error.message || 'Terjadi kesalahan saat memuat data pelanggan.');
            } finally {
                toggleLoading(false);
            }
        }

        async function deleteCustomer(id) {
            toggleLoading(true);
            closeDeleteModal();

            try {
                const response = await fetch(`/admin/pelanggan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal menghapus pelanggan');
                }

                if (data.success) {
                    window.location.reload(); // Refresh halaman setelah sukses
                } else {
                    showError(data.message || 'Terjadi kesalahan saat menghapus pelanggan.');
                }

            } catch (error) {
                console.error('Error deleting customer:', error);
                showError(error.message || 'Terjadi kesalahan saat menghapus pelanggan.');
            } finally {
                toggleLoading(false);
            }
        }

        // --- Event Listeners ---
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Customer Buttons (using event delegation)
            document.getElementById('customerTableBody').addEventListener('click', function(e) {
                if (e.target.closest('.edit-customer-btn')) {
                    const customerId = e.target.closest('.edit-customer-btn').dataset.id;
                    fetchCustomerData(customerId);
                }

                if (e.target.closest('.delete-customer-btn')) {
                    const customerId = e.target.closest('.delete-customer-btn').dataset.id;
                    openDeleteModal(customerId);
                }
            });

            // Confirm Delete Button
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                deleteCustomer(currentCustomerId);
            });

            // Customer Form Submission (for Update)
            customerForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const originalBtnText = submitBtn.innerHTML;
                if (submitBtn.disabled) return;

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Menyimpan...';
                toggleLoading(true);
                clearValidationErrors();

                try {
                    const formData = new FormData(this);
                    // Laravel expects _method for PUT/PATCH requests
                    formData.append('_method', document.getElementById('formMethod').value);

                    const response = await fetch(this.action, {
                        method: 'POST', // Always POST for FormData with _method
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Accept': 'application/json'
                        }
                    });

                    const responseText = await response.text();
                    let data;
                    try {
                        data = JSON.parse(responseText);
                    } catch (jsonError) {
                        throw new Error(
                            `Respon server tidak dalam format JSON yang valid. Status: ${response.status}. Isi: ${responseText.substring(0, 200)}...`
                        );
                    }

                    if (!response.ok) {
                        if (response.status === 422 && data.errors) {
                            showValidationErrors(data.errors);
                            showError('Terjadi kesalahan validasi. Mohon periksa kembali input Anda.',
                                data.errors);
                        } else {
                            showError(data.message || `Terjadi kesalahan. Status: ${response.status}.`);
                        }
                        return;
                    }

                    if (data.success) {
                        closeCustomerModal();
                        window.location.reload();
                    } else {
                        showError(data.message || 'Operasi gagal.');
                    }

                } catch (error) {
                    console.error('Error submitting form:', error);
                    showError(error.message || 'Terjadi kesalahan saat menyimpan data.');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                    toggleLoading(false);
                }
            });

            // Close modals when clicking outside
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.remove('modal-open');
                    }
                });
            });

            // Close modals with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal.modal-open').forEach(modal => {
                        modal.classList.remove('modal-open');
                    });
                }
            });
        });
    </script>
</body>

</html>
