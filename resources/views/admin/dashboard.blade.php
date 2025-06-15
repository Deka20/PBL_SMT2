<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
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
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <x-sidebar></x-sidebar>

    <div class="ml-72 p-5 w-[calc(100%-18rem)]">
        @if (session('success'))
            <div class="alert alert-success mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex flex-wrap gap-5 mb-5">
            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500"><i class="fas fa-camera-retro"></i></div>
                <h3 class="text-lg font-medium">Total Studio</h3>
                <h2 class="text-2xl font-bold">{{ $totalStudio }}</h2>
            </div>

            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500"><i class="fas fa-calendar-alt"></i></div>
                <h3 class="text-lg font-medium">Total Pemesanan</h3>
                <h2 class="text-2xl font-bold">{{ $totalPemesanan }}</h2>
            </div>

            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500"><i class="fas fa-users"></i></div>
                <h3 class="text-lg font-medium">Total Pelanggan</h3>
                <h2 class="text-2xl font-bold">{{ $totalPelanggan }}</h2>
            </div>

            <div class="card w-56 bg-white shadow-md rounded-2xl text-center p-5">
                <div class="text-3xl mb-3 text-pink-500"><i class="fas fa-money-bill-wave"></i></div>
                <h3 class="text-lg font-medium">Total Penghasilan</h3>
                <h2 class="text-2xl font-bold">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</h2>
            </div>
        </div>

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
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanan as $item)
                        <tr data-id="{{ $item->id_pemesanan }}">
                            <td class="text-center">{{ $item->nama }}</td>
                            <td class="text-center">
                                {{ $item->studio ? $item->studio->nama_studio : 'Studio tidak ditemukan' }}
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                            <td class="text-center">{{ $item->no_hp }}</td>
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
                                @if ($item->status)
                                    <span
                                        class="badge status-badge
                                        @if ($item->status == 'lunas') badge-success
                                        @elseif($item->status == 'pending') badge-warning
                                        @else badge-error @endif
                                        text-white">
                                        @if ($item->status == 'lunas')
                                            <i class="fas fa-check-circle mr-1"></i>
                                        @elseif($item->status == 'pending')
                                            <i class="fas fa-clock mr-1"></i>
                                        @else<i class="fas fa-times-circle mr-1"></i>
                                        @endif
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @else
                                    <span class="badge badge-secondary text-white">
                                        <i class="fas fa-clock mr-1"></i> Status tidak tersedia
                                    </span>
                                @endif
                            </td>
                            <td class="text-center relative">
                                <div class="dropdown dropdown-end dropdown-bottom">
                                    <div tabindex="0" role="button" class="btn btn-xs btn-ghost">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                    <ul tabindex="0"
                                        class="dropdown-content z-[1000] menu p-2 shadow bg-base-100 rounded-box w-40 
                   absolute right-0 top-full max-h-48 overflow-y-auto">
                                        <li>
                                            <button type="button"
                                                onclick="updateStatus({{ $item->id_pemesanan }}, 'pending')"
                                                class="w-full text-left hover:bg-gray-100 p-2 {{ $item->status == 'pending' ? 'bg-blue-50' : '' }}">
                                                <i class="fas fa-clock mr-2"></i> Pending
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                onclick="updateStatus({{ $item->id_pemesanan }}, 'lunas')"
                                                class="w-full text-left hover:bg-gray-100 p-2 {{ $item->status == 'lunas' ? 'bg-blue-50' : '' }}">
                                                <i class="fas fa-check-circle mr-2"></i> Lunas
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                onclick="updateStatus({{ $item->id_pemesanan }}, 'dibatalkan')"
                                                class="w-full text-left hover:bg-gray-100 p-2 {{ $item->status == 'dibatalkan' ? 'bg-blue-50' : '' }}">
                                                <i class="fas fa-times-circle mr-2"></i> Dibatalkan
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
    </div>

    <!-- Alert Container for Dynamic Alerts -->
    <div id="alert-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

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

    <div class="flex justify-center mt-6">
        {{ $pemesanan->links() }}
    </div>

    <script>
        // Show payment proof in modal
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

        // Function to show dynamic alert
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

            // Animate in
            setTimeout(() => {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.classList.remove('translate-x-full');
                }
            }, 100);

            // Auto close after 5 seconds
            setTimeout(() => {
                closeAlert(alertId);
            }, 5000);
        }

        // Function to close alert
        function closeAlert(alertId) {
            const alertElement = document.getElementById(alertId);
            if (alertElement) {
                alertElement.classList.add('translate-x-full');
                setTimeout(() => {
                    alertElement.remove();
                }, 300);
            }
        }

        // Function to update status badge
        function updateStatusBadge(row, newStatus) {
            const statusCell = row.querySelector('.status-cell');
            let badgeClass = '';
            let iconClass = '';

            switch (newStatus) {
                case 'lunas':
                    badgeClass = 'badge-success';
                    iconClass = 'fas fa-check-circle';
                    break;
                case 'pending':
                    badgeClass = 'badge-warning';
                    iconClass = 'fas fa-clock';
                    break;
                case 'dibatalkan':
                    badgeClass = 'badge-error';
                    iconClass = 'fas fa-times-circle';
                    break;
            }

            statusCell.innerHTML = `
                <span class="badge ${badgeClass} text-white status-badge">
                    <i class="${iconClass} mr-1"></i>
                    ${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}
                </span>
            `;
        }

        // Function to update status
        function updateStatus(idPemesanan, newStatus) {
            const row = document.querySelector(`tr[data-id="${idPemesanan}"]`);

            // Show loading state
            const statusCell = row.querySelector('.status-cell');
            const originalContent = statusCell.innerHTML;
            statusCell.innerHTML = '<span class="loading loading-spinner loading-xs"></span>';

            // Use route helper or construct URL properly
            const updateUrl = `{{ route('admin.pemesanan.update-status', ':id') }}`.replace(':id', idPemesanan);

            fetch(updateUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: new URLSearchParams({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the status badge
                        updateStatusBadge(row, newStatus);

                        // Show success message
                        showAlert(data.message, 'success');
                    } else {
                        // Restore original content
                        statusCell.innerHTML = originalContent;

                        // Show error message
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Restore original content
                    statusCell.innerHTML = originalContent;

                    // Show error message
                    showAlert('Terjadi kesalahan saat memperbarui status', 'error');
                });
        }
    </script>
</body>

</html>
