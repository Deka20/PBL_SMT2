<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Reservasi - ShutterSpace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print-content,
            .print-content * {
                visibility: visible;
            }

            .print-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }

        .status-badge {
            @apply px-3 py-1 rounded-md text-sm font-bold;
        }

        .status-pending {
            @apply bg-amber-100 text-amber-800;
        }

        .status-menunggu_verifikasi {
            @apply bg-blue-100 text-blue-800;
        }

        .status-diverifikasi,
        .status-lunas {
            @apply bg-green-100 text-green-800;
        }

        .status-ditolak,
        .status-dibatalkan {
            @apply bg-red-100 text-red-800;
        }

        .status-selesai {
            @apply bg-indigo-100 text-indigo-800;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input:checked~label,
        .star-rating input:hover~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc107;
        }

        .display-star-rating {
            font-size: 1.5rem;
            color: #ffc107;
        }

        .display-star-rating .far {
            color: #ccc;
        }

        .detail-icon {
            width: 20px;
            text-align: center;
            margin-right: 8px;
            color: #6b7280;
        }

        .receipt-card {
            @apply bg-gradient-to-br from-pink-50 to-pink-100 border border-pink-200 rounded-lg p-4;
        }

        .action-btn {
            @apply flex items-center justify-center gap-2 px-4 py-2.5 rounded-md text-sm font-medium transition-colors;
        }

        .time-slot {
            @apply bg-gray-100 px-3 py-2 rounded-md text-sm font-medium;
        }
    </style>
</head>

<body class="bg-[#fff6f6] min-h-screen">
    <x-second-nav></x-second-nav>

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden print-content">
            <!-- Header Section -->
            <div class="bg-pink-600 text-white p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold">Detail Reservasi</h1>
                        <p class="opacity-90">ID: #{{ $booking->id_pemesanan ?? 'BK001' }}</p>
                    </div>
                    <div
                        class="status-badge 
                        @php
if ($booking->status === 'menunggu verifikasi') echo 'status-pending';
                            elseif ($booking->status === 'menunggu_verifikasi') echo 'status-menunggu_verifikasi';
                            elseif ($booking->status === 'lunas' || $booking->status === 'diverifikasi') echo 'status-dikonfirmasi';
                            elseif ($booking->status === 'ditolak') echo 'status-ditolak';
                            elseif ($booking->status === 'dibatalkan') echo 'status-dibatalkan';
                            elseif ($booking->status === 'selesai') echo 'status-selesai';
                            else echo 'bg-gray-200 text-gray-800'; @endphp">
                        @php
                            if ($booking->status === 'menunggu verifikasi') {
                                echo 'Menunggu Verifikasi';
                            } elseif ($booking->status === 'menunggu_verifikasi') {
                                echo 'Menunggu Verifikasi';
                            } elseif ($booking->status === 'lunas' || $booking->status === 'diverifikasi') {
                                echo 'Dikonfirmasi';
                            } elseif ($booking->status === 'ditolak') {
                                echo 'Ditolak';
                            } elseif ($booking->status === 'dibatalkan') {
                                echo 'Dibatalkan';
                            } elseif ($booking->status === 'selesai') {
                                echo 'Selesai';
                            } else {
                                echo 'Unknown';
                            }
                        @endphp
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                <!-- Studio Info -->
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-20 h-20 rounded-full bg-gray-200 flex-shrink-0 overflow-hidden">
                        @if ($booking->studio && $booking->studio->gambar)
                            <img src="{{ asset('storage/' . $booking->studio->gambar) }}" alt="Studio"
                                class="w-full h-full object-cover rounded-full">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-camera text-3xl"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">{{ $booking->studio->nama_studio ?? 'N/A' }}</h2>
                        <p class="text-gray-600">{{ $booking->studio->jenis_studio ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Booking Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-3">
                        <h3 class="font-bold text-lg flex items-center text-pink-600">
                            <i class="fas fa-calendar-day mr-2"></i> Detail Jadwal
                        </h3>
                        <div class="flex items-center">
                            <span class="detail-icon"><i class="far fa-calendar-alt"></i></span>
                            <div>
                                <strong>Tanggal:</strong>
                                @php
                                    echo $booking->tanggal
                                        ? \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y')
                                        : 'N/A';
                                @endphp
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="detail-icon"><i class="far fa-clock"></i></span>
                            <div>
                                <strong>Waktu:</strong>
                                {{ $booking->jam }} - {{ $booking->jam_akhir }}
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="detail-icon"><i class="fas fa-hourglass-half"></i></span>
                            <div><strong>Durasi:</strong> {{ $booking->durasi ?? 0 }} menit</div>
                        </div>
                        @if ($booking->slots_detail)
                            <div class="mt-2">
                                <strong class="block mb-1">Slot Waktu:</strong>
                                <div class="flex flex-wrap gap-2">
                                    @php
                                        $slots = explode(',', $booking->slots_detail);
                                        foreach ($slots as $slot) {
                                            echo '<span class="time-slot">' . trim($slot) . '</span>';
                                        }
                                    @endphp
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-3">
                        <h3 class="font-bold text-lg flex items-center text-pink-600">
                            <i class="fas fa-user-friends mr-2"></i> Detail Pesanan
                        </h3>
                        <div class="flex items-center">
                            <span class="detail-icon"><i class="fas fa-users"></i></span>
                            <div><strong>Jumlah Orang:</strong> {{ $booking->jumlah_orang ?? 'N/A' }} orang</div>
                        </div>
                        <div class="flex items-center">
                            <span class="detail-icon"><i class="fas fa-user-tag"></i></span>
                            <div><strong>Atas Nama:</strong> {{ $booking->nama ?? 'N/A' }}</div>
                        </div>
                        <div class="flex items-center">
                            <span class="detail-icon"><i class="fas fa-phone-alt"></i></span>
                            <div><strong>No. HP:</strong> {{ $booking->no_hp ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Payment Receipt Card -->
                <div class="receipt-card mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-bold text-lg flex items-center">
                            <i class="fas fa-receipt mr-2"></i> Ringkasan Pembayaran
                        </h3>
                        <span class="text-sm font-medium">
                            @php
                                echo $booking->pembayaran && $booking->pembayaran->tgl_pembayaran
                                    ? 'Dibayar pada: ' .
                                        \Carbon\Carbon::parse($booking->pembayaran->tgl_pembayaran)->translatedFormat(
                                            'd M Y',
                                        )
                                    : '';
                            @endphp
                        </span>
                    </div>

                    <div class="flex justify-between items-center py-3 border-b border-pink-200">
                    </div>
                    @if ($booking->jumlah_orang > 1)
                        <div class="flex justify-between items-center py-3 border-b border-pink-200">
                            <span>Biaya Tambahan ({{ $booking->jumlah_orang - 1 }} orang × Rp 5.000)</span>
                            <span>Rp {{ number_format(($booking->jumlah_orang - 1) * 5000, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between items-center pt-3 font-bold text-lg">
                        <span>Total Pembayaran</span>
                        <span>Rp {{ number_format($booking->total_amount ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Payment Proof Section -->
                @if ($booking->pembayaran && $booking->pembayaran->bukti_pembayaran)
                    <div class="mb-6">
                        <h3 class="font-bold text-lg flex items-center mb-3">
                            <i class="fas fa-file-invoice-dollar mr-2"></i> Bukti Pembayaran
                        </h3>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <img src="{{ asset('storage/' . $booking->pembayaran->bukti_pembayaran) }}"
                                    alt="Bukti Pembayaran"
                                    class="w-full max-w-md h-48 object-contain rounded-lg border border-gray-200 cursor-pointer hover:shadow-md transition-shadow"
                                    onclick="openModal('{{ asset('storage/' . $booking->pembayaran->bukti_pembayaran) }}')">
                                <p class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i> Klik untuk memperbesar
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($booking->status === 'selesai')
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h3 class="font-bold text-lg flex items-center mb-4">
                            <i class="fas fa-star mr-2"></i> Ulasan Anda
                        </h3>
                        <div id="reviewDisplaySection">
                            @if ($userReview)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <div class="display-star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $userReview->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">({{ $userReview->rating }}/5)</span>
                                    </div>
                                    <p class="text-gray-800 mb-2">{{ $userReview->review }}</p>
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <i class="far fa-calendar mr-1"></i> Diberikan pada:
                                        {{ \Carbon\Carbon::parse($userReview->review_date)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            @else
                                <div id="reviewFormSection" class="bg-gray-50 rounded-lg p-4">
                                    <form id="reviewForm" action="{{ route('review.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="booking_id" value="{{ $booking->id_pemesanan }}">
                                        <input type="hidden" name="studio_id"
                                            value="{{ $booking->studio->id_studio ?? '' }}">

                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                            <div class="star-rating">
                                                <input type="radio" id="star5" name="rating"
                                                    value="5" />
                                                <label for="star5" title="5 stars"><i
                                                        class="fas fa-star"></i></label>
                                                <input type="radio" id="star4" name="rating"
                                                    value="4" />
                                                <label for="star4" title="4 stars"><i
                                                        class="fas fa-star"></i></label>
                                                <input type="radio" id="star3" name="rating"
                                                    value="3" />
                                                <label for="star3" title="3 stars"><i
                                                        class="fas fa-star"></i></label>
                                                <input type="radio" id="star2" name="rating"
                                                    value="2" />
                                                <label for="star2" title="2 stars"><i
                                                        class="fas fa-star"></i></label>
                                                <input type="radio" id="star1" name="rating" value="1"
                                                    required />
                                                <label for="star1" title="1 star"><i
                                                        class="fas fa-star"></i></label>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="review"
                                                class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                                            <textarea id="review" name="review" rows="3"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                                placeholder="Bagaimana pengalaman Anda menggunakan studio ini?"></textarea>
                                        </div>

                                        <button type="submit"
                                            class="action-btn p-2 rounded-md !bg-pink-600 text-white hover:bg-pink-700">
                                            <i class="fas fa-paper-plane"></i> Kirim Ulasan
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 mt-8 no-print">
                    @if ($booking->status === 'pending' && !$booking->pembayaran?->bukti_pembayaran)
                        <a href="{{ route('pembayaran.form', $booking->id_pemesanan) }}"
                            class="action-btn bg-pink-600 text-white hover:bg-pink-700">
                            <i class="fas fa-credit-card"></i> Upload Pembayaran
                        </a>
                    @endif

                    <button onclick="printDetail()"
                        class="action-btn px-3 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300">
                        <i class="fas fa-print"></i> Cetak Detail
                    </button>

                    <a href="/riwayat"
                        class="action-btn p-1 px-3 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 ml-auto">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
        onclick="closeModal()">
        <div class="bg-white p-4 rounded-lg max-w-3xl max-h-[90vh] overflow-auto" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-receipt mr-2"></i> Bukti Pembayaran
                </h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full h-auto rounded-md">
        </div>
    </div>

    <!-- Toast container -->
    <div class="toast toast-end toast-bottom z-50">
    </div>

    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function showToast(message, type = 'success') {
            const toastContainer = document.querySelector('.toast');
            if (!toastContainer) return;

            const toastElement = document.createElement('div');
            toastElement.className = `alert alert-${type} shadow-lg`;
            toastElement.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 
                      type === 'error' ? 'fa-times-circle' : 
                      type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'} 
                     mr-2"></i>
                    <span>${message}</span>
                </div>
            `;

            toastContainer.appendChild(toastElement);
            setTimeout(() => toastElement.remove(), 3000);
        }


        function completeBooking(bookingId) {
            if (confirm('Apakah Anda yakin ingin menandai pesanan ini sebagai selesai?')) {
                fetch(`/pembayaran/${bookingId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            status: 'selesai'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast('Pesanan berhasil ditandai selesai!', 'success');
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showToast(data.message || 'Gagal mengubah status pesanan', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan saat menandai pesanan selesai', 'error');
                    });
            }
        }

        function printDetail() {
            window.print();
        }

        function renderReview(reviewData) {
            const reviewDisplaySection = document.getElementById('reviewDisplaySection');
            if (!reviewDisplaySection) return;

            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                starsHtml += `<i class="${i <= reviewData.rating ? 'fas' : 'far'} fa-star"></i>`;
            }

            const reviewDate = new Date(reviewData.review_date).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            reviewDisplaySection.innerHTML = `
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <div class="display-star-rating">${starsHtml}</div>
                        <span class="text-sm text-gray-600 ml-2">(${reviewData.rating}/5)</span>
                    </div>
                    <p class="text-gray-800 mb-2">${reviewData.review}</p>
                    <p class="text-xs text-gray-500 flex items-center">
                        <i class="far fa-calendar mr-1"></i> Diberikan pada: ${reviewDate}
                    </p>
                </div>
            `;
        }

        document.getElementById('reviewForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: new FormData(form)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Ulasan berhasil dikirim!', 'success');
                        renderReview(data.review);
                    } else {
                        showToast(data.message || 'Gagal mengirim ulasan', 'error');
                        if (data.review) renderReview(data.review);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat mengirim ulasan', 'error');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') closeModal();
        });
    </script>
</body>

</html>
