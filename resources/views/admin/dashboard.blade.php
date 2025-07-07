<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        completed: '#3b82f6',
                        pending: '#f59e0b',
                        cancelled: '#ef4444'
                    }
                }
            }
        }
    </script>

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }

        .pagination li {
            margin: 0 0.25rem;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background-color: #f3f4f6;
        }

        .pagination .active span {
            background-color: #d94c82;
            color: white;
            border-color: #d94c82;
        }

        .pagination .disabled span {
            color: #9ca3af;
            cursor: not-allowed;
        }

        .badge-completed {
            background-color: #3b82f6;
            color: white;
        }

        .badge-pending {
            background-color: #f59e0b;
            color: white;
        }

        .badge-cancelled {
            background-color: #ef4444;
            color: white;
        }

        .badge-paid {
            background-color: #10b981;
            color: white;
        }

        .dropdown-content {
            z-index: 1000;
        }

        .filter-card {
            transition: all 0.3s ease;
        }

        .filter-card.collapsed {
            height: 60px;
            overflow: hidden;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <x-sidebar></x-sidebar>

    <div class="ml-72 p-5 w-[calc(100%-18rem)]">
        <!-- Alert Section -->
        @if (session('success'))
            <div class="alert alert-success mb-5 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error mb-5 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-5">
            <div class="card bg-white shadow-md rounded-xl hover:shadow-lg transition-shadow">
                <div class="card-body items-center text-center p-5">
                    <div class="text-3xl mb-3 text-pink-600"><i class="fas fa-camera-retro"></i></div>
                    <h3 class="text-lg font-medium">Total Studio</h3>
                    <h2 class="text-2xl font-bold">{{ $totalStudio }}</h2>
                </div>
            </div>

            <div class="card bg-white shadow-md rounded-xl hover:shadow-lg transition-shadow">
                <div class="card-body items-center text-center p-5">
                    <div class="text-3xl mb-3 text-pink-600"><i class="fas fa-calendar-alt"></i></div>
                    <h3 class="text-lg font-medium">Total Pemesanan</h3>
                    <h2 class="text-2xl font-bold">{{ $totalPemesanan }}</h2>
                </div>
            </div>

            <div class="card bg-white shadow-md rounded-xl hover:shadow-lg transition-shadow">
                <div class="card-body items-center text-center p-5">
                    <div class="text-3xl mb-3 text-pink-600"><i class="fas fa-users"></i></div>
                    <h3 class="text-lg font-medium">Total Pelanggan</h3>
                    <h2 class="text-2xl font-bold">{{ $totalPelanggan }}</h2>
                </div>
            </div>

            <div class="card bg-white shadow-md rounded-xl hover:shadow-lg transition-shadow">
                <div class="card-body items-center text-center p-5">
                    <div class="text-3xl mb-3 text-pink-600"><i class="fas fa-money-bill-wave"></i></div>
                    <h3 class="text-lg font-medium">Total Penghasilan</h3>
                    <h2 class="text-2xl font-bold">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card bg-white shadow-md mb-5 filter-card" id="filterCard">
            <div class="card-body p-5">
                <div class="flex justify-between items-center cursor-pointer" onclick="toggleFilterCard()">
                    <h2 class="text-xl font-bold text-gray-700">Filter Data</h2>
                    <i class="fas fa-chevron-down transition-transform duration-300" id="filterToggleIcon"></i>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" id="startDate" name="start_date" class="input input-bordered w-full"
                            value="{{ request('start_date') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                        <input type="date" id="endDate" name="end_date" class="input input-bordered w-full"
                            value="{{ request('end_date') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="statusFilter" name="status" class="select select-bordered w-full">
                            <option value="">Semua Status</option>
                            <option value="menunggu verifikasi"
                                {{ request('status') == 'menunggu verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi
                            </option>
                            <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>
                                Diverifikasi</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" onclick="resetFilters()" class="btn btn-outline btn-sm">
                        <i class="fas fa-sync-alt mr-2"></i> Reset
                    </button>
                    <button type="button" onclick="applyFilters()" class="btn text-white bg-[#d94c82] btn-sm">
                        <i class="fas fa-filter mr-2"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card bg-white shadow-md">
            <div class="card-body p-0">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Pemesan</th>
                                <th class="text-center">Studio</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">No Handphone</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Bukti Pembayaran</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan as $index => $item)
                                <tr data-id="{{ $item->id_pemesanan }}" class="hover:bg-gray-50">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center font-medium">{{ $item->nama }}</td>
                                    <td class="text-center">{{ $item->studio->nama_studio ?? '-' }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td class="text-center">{{ $item->no_hp }}</td>
                                    <td class="text-center">Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->pembayaran && $item->pembayaran->bukti_pembayaran)
                                            <div class="relative inline-block">
                                                <button
                                                    onclick="showPaymentProof('{{ asset('storage/' . $item->pembayaran->bukti_pembayaran) }}')"
                                                    class="group relative">
                                                    <div
                                                        class="w-16 h-16 overflow-hidden rounded-md border border-gray-200 shadow-sm">
                                                        <img src="{{ asset('storage/' . $item->pembayaran->bukti_pembayaran) }}"
                                                            alt="Bukti Pembayaran"
                                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                                    </div>
                                                    <div
                                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                                        <span
                                                            class="text-white text-xs bg-black bg-opacity-50 px-2 py-1 rounded">
                                                            <i class="fas fa-search-plus mr-1"></i> Lihat
                                                        </span>
                                                    </div>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-gray-500"><i class="fas fa-times-circle mr-1"></i> Belum
                                                upload</span>
                                        @endif
                                    </td>
                                    <td class="text-center status-cell">
                                        @if ($item->verifikasiPembayaran)
                                            @php
                                                $status = $item->verifikasiPembayaran->status_pembayaran;
                                                $badgeClass =
                                                    [
                                                        'menunggu verifikasi' => 'badge-pending',
                                                        'diverifikasi' => 'badge-paid',
                                                        'selesai' => 'badge-completed',
                                                        'ditolak' => 'badge-cancelled',
                                                    ][$status] ?? 'badge-secondary';

                                                $iconClass =
                                                    [
                                                        'menunggu verifikasi' => 'fas fa-clock',
                                                        'diverifikasi' => 'fas fa-check-circle',
                                                        'selesai' => 'fas fa-check-double',
                                                        'ditolak' => 'fas fa-times-circle',
                                                    ][$status] ?? 'fas fa-question-circle';
                                            @endphp

                                            <span
                                                class="badge {{ $badgeClass }} text-white py-2 px-3 rounded-full text-xs">
                                                <i class="{{ $iconClass }} mr-1"></i>
                                                {{ ucwords(str_replace('_', ' ', $status)) }}
                                            </span>
                                        @else
                                            <span
                                                class="badge badge-secondary text-white py-2 px-3 rounded-full text-xs">
                                                <i class="fas fa-question-circle mr-1"></i>
                                                Belum diverifikasi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-end">
                                            <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </div>
                                            <ul tabindex="0"
                                                class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-40">
                                                <li>
                                                    <button type="button"
                                                        onclick="updateStatus({{ $item->id_pemesanan }}, 'menunggu verifikasi')"
                                                        class="text-left hover:bg-gray-100 p-2 {{ $item->verifikasiPembayaran && $item->verifikasiPembayaran->status_pembayaran == 'menunggu verifikasi' ? 'bg-yellow-50' : '' }}">
                                                        <i class="fas fa-clock mr-2 text-yellow-500"></i> Menunggu
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button"
                                                        onclick="updateStatus({{ $item->id_pemesanan }}, 'diverifikasi')"
                                                        class="text-left hover:bg-gray-100 p-2 {{ $item->verifikasiPembayaran && $item->verifikasiPembayaran->status_pembayaran == 'diverifikasi' ? 'bg-green-50' : '' }}">
                                                        <i class="fas fa-check-circle mr-2 text-green-500"></i>
                                                        Diverifikasi
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button"
                                                        onclick="updateStatus({{ $item->id_pemesanan }}, 'selesai')"
                                                        class="text-left hover:bg-gray-100 p-2 {{ $item->verifikasiPembayaran && $item->verifikasiPembayaran->status_pembayaran == 'selesai' ? 'bg-blue-50' : '' }}">
                                                        <i class="fas fa-check-double mr-2 text-blue-500"></i> Selesai
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button"
                                                        onclick="updateStatus({{ $item->id_pemesanan }}, 'ditolak')"
                                                        class="text-left hover:bg-gray-100 p-2 {{ $item->verifikasiPembayaran && $item->verifikasiPembayaran->status_pembayaran == 'ditolak' ? 'bg-red-50' : '' }}">
                                                        <i class="fas fa-times-circle mr-2 text-red-500"></i> Ditolak
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center p-4">
                    {{ $pemesanan->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Container for Dynamic Alerts -->
    <div id="alert-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <!-- Payment Proof Modal -->
    <dialog id="paymentProofModal" class="modal">
        <div class="modal-box max-w-4xl">
            <h3 class="font-bold text-lg">Bukti Pembayaran</h3>
            <div class="py-4">
                <img id="paymentProofImage" src="" alt="Bukti Pembayaran" class="w-full h-auto rounded-lg">
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Tutup</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        // Toggle filter card visibility
        function toggleFilterCard() {
            const filterCard = document.getElementById('filterCard');
            const icon = document.getElementById('filterToggleIcon');

            filterCard.classList.toggle('collapsed');
            icon.classList.toggle('rotate-180');
        }

        // Initialize filter card to collapsed state
        document.addEventListener('DOMContentLoaded', function() {
            const filterCard = document.getElementById('filterCard');
            filterCard.classList.add('collapsed');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const filterCard = document.getElementById('filterCard');
            filterCard.classList.add('collapsed');

            // Set nilai filter dari URL jika ada
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('start_date') || urlParams.has('end_date') || urlParams.has('status')) {
                filterCard.classList.remove('collapsed');
                document.getElementById('filterToggleIcon').classList.add('rotate-180');
            }
        });

        // Apply filters
        function applyFilters() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const status = document.getElementById('statusFilter').value;

            let url = new URL(window.location.href);
            let params = new URLSearchParams();

            if (startDate) params.append('start_date', startDate);
            if (endDate) params.append('end_date', endDate);
            if (status) params.append('status', status);

            // Simpan parameter pencarian yang sudah ada
            @if (request()->has('search'))
                params.append('search', '{{ request('search') }}');
            @endif

            window.location.href = url.pathname + '?' + params.toString();
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('startDate').value = '';
            document.getElementById('endDate').value = '';
            document.getElementById('statusFilter').value = '';

            let url = new URL(window.location.href);
            let params = new URLSearchParams();

            // Simpan parameter pencarian yang sudah ada jika diperlukan
            @if (request()->has('search'))
                params.append('search', '{{ request('search') }}');
            @endif

            window.location.href = url.pathname + (params.toString() ? '?' + params.toString() : '');
        }

        // Show payment proof modal
        function showPaymentProof(imageUrl) {
            const modal = document.getElementById('paymentProofModal');
            const img = document.getElementById('paymentProofImage');
            img.src = imageUrl;
            modal.showModal();
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('paymentProofModal');
            if (event.target === modal) {
                modal.close();
            }
        });

        // Show alert notification
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alert-container');
            const alertId = 'alert-' + Date.now();

            const alertHTML = `
                <div id="${alertId}" class="alert alert-${type} shadow-lg transition-all duration-300 transform translate-x-full">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                            ${type === 'success' 
                                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'
                                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />'
                            }
                        </svg>
                        <span>${message}</span>
                    </div>
                    <button onclick="closeAlert('${alertId}')" class="btn btn-sm btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            `;

            alertContainer.insertAdjacentHTML('afterbegin', alertHTML);

            setTimeout(() => {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.classList.remove('translate-x-full');
                }
            }, 100);

            setTimeout(() => {
                closeAlert(alertId);
            }, 5000);
        }

        // Close alert notification
        function closeAlert(alertId) {
            const alertElement = document.getElementById(alertId);
            if (alertElement) {
                alertElement.classList.add('translate-x-full');
                setTimeout(() => {
                    alertElement.remove();
                }, 300);
            }
        }

        // Update status badge appearance
        // Update booking status via AJAX
        function updateStatus(id_pemesanan, newStatus) {
            if (!confirm(`Anda yakin ingin mengubah status menjadi ${newStatus}?`)) {
                return;
            }

            // Using the named route
            fetch("{{ route('admin.pemesanan.update-status', ['id' => ':id_pemesanan']) }}".replace(':id_pemesanan',
                    id_pemesanan), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status_pembayaran: newStatus
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showAlert(data.message, 'success');
                        const row = document.querySelector(`tr[data-id="${id_pemesanan}"]`);
                        updateStatusBadge(row, newStatus);
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const message = error.message || 'Terjadi kesalahan saat memperbarui status';
                    showAlert(message, 'error');
                });
        }

        // Update status badge appearance
        function updateStatusBadge(row, newStatus) {
            const statusCell = row.querySelector('.status-cell');
            if (!statusCell) {
                console.warn('Status cell not found for the given row.');
                return; // Exit if the status cell isn't found
            }

            let badgeClass = '';
            let iconClass = '';
            let statusText = '';

            switch (newStatus) {
                case 'menunggu verifikasi':
                    badgeClass = 'badge-pending';
                    iconClass = 'fas fa-clock';
                    statusText = 'Menunggu Verifikasi';
                    break;
                case 'diverifikasi':
                    badgeClass = 'badge-paid';
                    iconClass = 'fas fa-check-circle';
                    statusText = 'Diverifikasi';
                    break;
                case 'selesai':
                    badgeClass = 'badge-completed';
                    iconClass = 'fas fa-check-double';
                    statusText = 'Selesai';
                    break;
                case 'ditolak':
                    badgeClass = 'badge-cancelled';
                    iconClass = 'fas fa-times-circle';
                    statusText = 'Ditolak';
                    break;
                default:
                    badgeClass = 'badge-secondary';
                    iconClass = 'fas fa-question-circle';
                    statusText = 'Belum diverifikasi';
            }

            statusCell.innerHTML = `
        <span class="badge ${badgeClass} text-white py-2 px-3 rounded-full text-xs">
            <i class="${iconClass} mr-1"></i>
            ${statusText}
        </span>
    `;
        }
    </script>
</body>

</html>
