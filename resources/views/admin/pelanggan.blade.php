<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Pelanggan - Potrétine</title>

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
        body {
            background-color: #f8fafc;
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }

        .loading-overlay.active {
            display: flex;
        }

        /* Compact table styling */
        .custom-table {
            font-size: 0.875rem;
            /* Smaller font size */
        }

        .custom-table th {
            padding: 0.5rem 0.75rem;
            /* Reduced padding */
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            text-align: left;
            font-size: 0.75rem;
            /* Even smaller font for headers */
        }

        .custom-table td {
            padding: 0.5rem 0.75rem;
            /* Reduced padding */
            vertical-align: middle;
        }

        .custom-table tr:not(:last-child) {
            border-bottom: 1px solid #e5e7eb;
        }

        /* Compact action buttons */
        .action-buttons {
            min-width: 160px;
            /* Increased width for horizontal buttons */
        }

        /* Compact date cell */
        .date-cell {
            white-space: nowrap;
            font-size: 0.75rem;
            /* Smaller font for dates */
        }

        /* Horizontal button styling */
        .btn-edit,
        .btn-delete {
            padding: 0.375rem 0.75rem;
            /* More horizontal padding */
            border-radius: 0.375rem;
            font-size: 0.75rem;
            transition: all 0.2s;
            min-width: 60px;
            /* Minimum width for buttons */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-edit {
            background-color: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background-color: #2563eb;
        }

        .btn-delete {
            background-color: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background-color: #dc2626;
        }

        /* Compact avatar */
        .avatar-compact {
            width: 2rem;
            /* 32px */
            height: 2rem;
            /* 32px */
        }

        /* Hide some columns on smaller screens */
        @media (max-width: 768px) {
            .hide-mobile {
                display: none;
            }
        }

        /* Compact row height */
        .custom-table tbody tr {
            height: 3rem;
            /* Fixed row height */
        }
    </style>
</head>

<body class="flex">

    <div id="loadingOverlay" class="loading-overlay">
        <div class="text-white text-2xl flex flex-col items-center">
            <span class="loading loading-spinner loading-lg mb-4 text-primary"></span>
            <span>Memuat Data...</span>
        </div>
    </div>

    <x-sidebar></x-sidebar>

    <main class="flex-1 p-4 lg:ml-64">
        <div class="mx-auto px-4 py-4"> <!-- Reduced padding -->
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Pelanggan</h1> <!-- Smaller heading -->

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center"> <!-- Reduced padding -->
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Pelanggan</h3> <!-- Smaller heading -->
                    <button onclick="openCustomerModal('add')"
                        class="btn btn-sm bg-primary text-white hover:bg-primary/90">
                        <i class="fas fa-plus mr-1"></i> Tambah
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full custom-table">
                        <thead>
                            <tr>
                                <th class="w-12">No</th>
                                <th>Nama</th>
                                <th class="hide-mobile">Username</th>
                                <th class="w-16">Avatar</th>
                                <th class="hide-mobile">Email</th>
                                <th>Telepon</th>
                                <th class="date-cell hide-mobile">Dibuat</th>
                                <th class="action-buttons">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody">
                            @forelse ($customers as $index => $customer)
                                <tr class="hover:bg-gray-50 transition-colors" data-id="{{ $customer->id }}">
                                    <td class="font-medium text-gray-900 text-center">{{ $index + 1 }}</td>
                                    <td class="text-gray-700 font-medium">{{ $customer->nama_lengkap }}</td>
                                    <td class="text-gray-600 hide-mobile">{{ $customer->nama_pengguna }}</td>
                                    <td>
                                        <div
                                            class="avatar-compact rounded-full overflow-hidden bg-gray-200 flex items-center justify-center text-xs font-semibold text-gray-600 mx-auto">
                                            @if ($customer->foto)
                                                <img src="{{ asset('storage/' . $customer->foto) }}" alt="Avatar"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($customer->nama_pengguna, 0, 1)) }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-gray-600 hide-mobile">{{ $customer->email }}</td>
                                    <td class="text-gray-700">{{ $customer->telepon }}</td>
                                    <td class="text-gray-500 date-cell hide-mobile">
                                        {{ $customer->created_at ? $customer->created_at->format('d/m/y') : '-' }}
                                    </td>
                                    <td class="action-buttons">
                                        <div class="flex items-center space-x-2">
                                            <button class="btn bg-gray-300 edit-customer-btn"
                                                data-id="{{ $customer->id }}" title="Edit">
                                                <i class="fas fa-edit mr-1"></i> Ubah
                                            </button>
                                            <button class="btn bg-[#d94c82] text-white delete-customer-btn"
                                                data-id="{{ $customer->id }}" title="Hapus">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-4 text-center text-gray-500">Tidak ada data pelanggan
                                        ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Dialog -->
    <div id="customerModal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl">
            <button class="btn btn-sm btn-circle absolute right-4 top-4" onclick="closeCustomerModal()">✕</button>
            <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">
                <i class="fas fa-user-edit mr-2 text-primary"></i>
                <span id="modalTitleText">Ubah Pelanggan</span>
            </h2>

            <form id="customerForm" method="POST">
                @csrf
                <input type="hidden" id="customer_id" name="customer_id">
                <input type="hidden" name="_method" id="formMethod" value="PUT">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Nama Lengkap</span>
                        </label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="input input-bordered w-full"
                            required>
                        <span id="error-nama_lengkap" class="text-error text-sm mt-1"></span>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Nama Pengguna</span>
                        </label>
                        <input type="text" id="nama_pengguna" name="nama_pengguna"
                            class="input input-bordered w-full" required>
                        <span id="error-nama_pengguna" class="text-error text-sm mt-1"></span>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Email</span>
                        </label>
                        <input type="email" id="email" name="email" class="input input-bordered w-full"
                            required>
                        <span id="error-email" class="text-error text-sm mt-1"></span>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">No. Telepon</span>
                        </label>
                        <input type="text" id="telepon" name="telepon" class="input input-bordered w-full"
                            required>
                        <span id="error-telepon" class="text-error text-sm mt-1"></span>
                    </div>
                </div>

                <div class="modal-action mt-8">
                    <button type="button" class="btn btn-ghost" onclick="closeCustomerModal()">Batal</button>
                    <button type="submit" id="submitBtn" class="btn bg-primary text-white hover:bg-primary/90">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
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
