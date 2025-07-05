@extends('layout.app')

@section('title', 'Potretine')

@section('content')
    <section class="bg-center bg-no-repeat bg-[url('/images/hero1.jpg')] bg-cover min-h-[700px] w-full" id="home">
    </section>

    <h1 class="mt-10 text-center text-3xl font-bold">Studio Kami</h1>
    <h2 class="text-center text-2xl">Pilih Studio Sesuai Keinginanmu</h2>

    <div class="container mx-auto px-4 py-8" id="studio">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($studios as $studio)
                <div class="card bg-[#fef6f6] shadow-sm hover:shadow-md cursor-pointer">
                    <figure>
                        <img src="{{ asset('storage/' . $studio->gambar) }}" alt="{{ $studio->nama_studio }}"
                            class="w-full h-48 object-cover" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $studio->nama_studio }}</h2>
                        <p>Jenis: {{ $studio->jenis_studio }}</p>
                        <p>Rp {{ number_format($studio->harga, 0, ',', '.') }}/15 menit</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-neutral w-full show-detail-btn" data-name="{{ $studio->nama_studio }}"
                                data-type="{{ $studio->jenis_studio }}"
                                data-price="Rp {{ number_format($studio->harga, 0, ',', '.') }}/15 menit"
                                data-image="{{ asset('storage/' . $studio->gambar) }}"
                                data-description="{{ $studio->kapasitas }}">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <dialog id="detail-modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg" id="modal-studio-name"></h3>
            <figure class="mt-4 mb-4">
                <img id="modal-studio-image" src="" alt="Studio Image"
                    class="w-full h-auto object-cover rounded-lg" />
            </figure>
            <p class="py-2">Jenis: <span id="modal-studio-type"></span></p>
            <p class="py-2">Harga: <span id="modal-studio-price"></span></p>
            <p class="py-2">Kapasitas: <span id="modal-studio-description"></span></p>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Tutup</button>
                </form>
                <a href="{{ route('pemesanan') }}" class="btn btn-neutral" id="modal-booking-btn">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </dialog>

    <div class="container mx-auto px-4 py-8">
        <h1 class="mt-10 text-center text-3xl font-bold">Portofolio</h1>

        @php
            $rotations = ['-rotate-1', 'rotate-2', '-rotate-2', 'rotate-1', '-rotate-3', 'rotate-3'];
        @endphp

        <div class="relative mt-5 overflow-hidden">
            <div class="flex space-x-6 py-4 animate-auto-scroll whitespace-nowrap"
                style="animation: scroll 30s linear infinite;">
                @foreach (array_merge($portfolios->toArray(), $portfolios->toArray()) as $portfolio)
                    <div
                        class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300
                    {{ $rotations[array_rand($rotations)] }} hover:rotate-0 hover:scale-105
                    flex-shrink-0 w-64 h-80 inline-flex flex-col">
                        <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                            <img src="{{ Storage::url($portfolio['image_path']) }}"
                                alt="Portfolio Image {{ $portfolio['id'] }}"
                                class="w-full h-full object-cover aspect-[4/5]">
                        </div>
                        <div class="text-xs text-gray-500 mt-2 text-center">
                            {{ \Carbon\Carbon::parse($portfolio['created_at'])->format('M d, Y') }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="absolute top-0 bottom-0 left-0 w-20 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="absolute top-0 bottom-0 right-0 w-20 bg-gradient-to-l from-white to-transparent z-10"></div>
        </div>

        @if ($portfolios->isEmpty())
            <div class="col-span-full text-center py-10">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-gray-500">Belum ada portofolio yang diunggah.</p>
            </div>
        @endif
    </div>

    <h1 class="mt-10 text-center text-3xl font-bold">Ratings & Reviews</h1>

    <div class="max-w-3xl mx-auto space-y-4 mt-5">
        <div class="bg-[#fef6f6] rounded-box p-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="text-center md:text-left md:w-1/3">
                    <h2 class="text-4xl font-bold mb-2">{{ number_format($averageRating, 1) }}</h2>
                    <div class="rating rating-md">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" name="average-rating"
                                class="mask mask-star-2 !bg-yellow-400 {{ $i <= round($averageRating) ? 'opacity-100' : 'opacity-40' }} cursor-default"
                                {{ $i <= round($averageRating) ? 'checked' : '' }} disabled />
                        @endfor

                    </div>
                    <p class="text-gray-600 mt-6">Dari {{ $ratingCount }} Ulasan</p>
                </div>

                <div class="md:w-2/3">
                    <div class="space-y-2">
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="flex items-center">
                                <span class="w-8 flex items-center justify-center">
                                    <span class="text-yellow-400">★</span><span
                                        class="text-gray-700">{{ $i }}</span>
                                </span>
                                <progress class="progress progress-warning mx-2 flex-1"
                                    value="{{ $ratingCount > 0 ? ($ratingDistribution[$i] / $ratingCount) * 100 : 0 }}"
                                    max="100"></progress>
                                <span class="text-gray-600 text-sm w-16">{{ $ratingDistribution[$i] }} Orang</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        @forelse($reviews as $review)
            <div class="bg-[#fef6f6] rounded-box p-6" id="review-{{ $review->id }}">
                <div class="flex justify-between items-start" id="review-content-{{ $review->id }}">
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="avatar">
                                <div class="w-10 rounded-full bg-gray-400 flex items-center justify-center">
                                    @if ($review->user && $review->user->foto)
                                        <img src="{{ Storage::url($review->user->foto) }}" alt="User Avatar"
                                            class="w-full h-full rounded-full object-cover">
                                    @elseif ($review->user && $review->user->nama_pengguna)
                                        <span
                                            class="text-white text-lg font-semibold">{{ substr($review->user->nama_pengguna, 0, 1) }}</span>
                                    @else
                                        <span class="text-white text-lg font-semibold">?</span>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-bold">{{ $review->user->nama_pengguna ?? 'Pengguna Tidak Ditemukan' }}
                                </h3>
                                <p class="text-gray-600 text-sm">
                                    @if ($review->studio)
                                        {{ $review->studio->nama_studio }}
                                    @else
                                        Studio Tidak Ditemukan
                                    @endif
                                    - {{ $review->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="rating rating-sm mb-2" id="rating-display-{{ $review->id }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating-{{ $review->id }}"
                                    class="mask mask-star-2 !bg-yellow-400 {{ $i <= $review->rating ? 'opacity-100' : 'opacity-20' }} cursor-default"
                                    {{ $i <= $review->rating ? 'checked' : '' }} disabled />
                            @endfor
                        </div>

                        <p class="text-gray-700" id="review-text-{{ $review->id }}">{{ $review->review }}</p>
                    </div>

                    @if (auth()->check() && auth()->id() === $review->user_id)
                        <div class="flex space-x-2" id="review-actions-{{ $review->id }}">
                            <button class="btn btn-sm edit-review-btn" data-review-id="{{ $review->id }}">
                                <i class="fas fa-edit mr-1"></i> Ubah
                            </button>
                            <button type="button"
                                class="btn btn-sm bg-red-500 text-white hover:bg-red-600 delete-review-btn"
                                data-review-id="{{ $review->id }}" data-review-text="{{ $review->review }}"
                                data-review-rating="{{ $review->rating }}"
                                data-action-url="{{ route('reviews.destroy', $review->id) }}">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Edit Form -->
                <div id="edit-form-{{ $review->id }}" class="hidden mt-4">
                    <form class="update-review-form" data-review-id="{{ $review->id }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <div class="star-rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="edit-star{{ $i }}-{{ $review->id }}"
                                        name="rating" value="{{ $i }}"
                                        {{ $review->rating == $i ? 'checked' : '' }} />
                                    <label for="edit-star{{ $i }}-{{ $review->id }}"
                                        title="{{ $i }} stars">
                                        <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="edit-review-{{ $review->id }}"
                                class="block text-sm font-medium text-gray-700 mb-1">Ulasan</label>
                            <textarea id="edit-review-{{ $review->id }}" name="review" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-secondary focus:border-secondary">{{ $review->review }}</textarea>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" class="btn btn-ghost cancel-edit-btn"
                                data-review-id="{{ $review->id }}">Batal</button>
                            <button type="submit" class="btn !text-white !bg-[#d94c82]"
                                id="update-btn-{{ $review->id }}">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-[#fef6f6] rounded-box p-6 text-center">
                <p class="text-gray-600">Belum ada ulasan untuk studio ini.</p>
            </div>
        @endforelse

        <!-- Delete Review Modal -->
        <div id="deleteReviewModal" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Konfirmasi Hapus Ulasan
                </h3>

                <div class="py-4">
                    <p class="text-gray-700 mb-4">
                        Apakah Anda yakin ingin menghapus ulasan ini? Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <div class="bg-gray-50 rounded-lg p-4 mb-4" id="reviewPreview">
                        <div class="flex items-center mb-2">
                            <div class="rating rating-sm" id="previewRating">
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm" id="previewText">
                        </p>
                    </div>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn btn-ghost" onclick="closeDeleteModal()">
                        <i class="fas fa-times mr-1"></i>
                        Batal
                    </button>
                    <button type="button" class="btn btn-error text-white" id="confirmDeleteBtn">
                        <i class="fas fa-trash mr-1"></i>
                        Ya, Hapus Ulasan
                    </button>
                </div>
            </div>

            <form method="dialog" class="modal-backdrop">
                <button type="button" onclick="closeDeleteModal()">close</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailModal = document.getElementById('detail-modal');
            const showDetailButtons = document.querySelectorAll('.show-detail-btn');

            showDetailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const type = this.getAttribute('data-type');
                    const price = this.getAttribute('data-price');
                    const image = this.getAttribute('data-image');
                    const description = this.getAttribute('data-description');
                    const studioId = this.getAttribute(
                        'data-id'); // Tambahkan atribut data-id di button

                    document.getElementById('modal-studio-name').textContent = name;
                    document.getElementById('modal-studio-type').textContent = type;
                    document.getElementById('modal-studio-price').textContent = price;
                    document.getElementById('modal-studio-image').src = image;
                    document.getElementById('modal-studio-image').alt = name + " image";
                    document.getElementById('modal-studio-description').textContent = description;

                    // Update link pesan sekarang dengan ID studio
                    const bookingBtn = document.getElementById('modal-booking-btn');
                    if (bookingBtn) {
                        bookingBtn.href = `/pemesanan?studio_id=${studioId}`;
                    }

                    detailModal.showModal();
                });
            });

            // Tutup modal ketika klik di luar
            detailModal.addEventListener('click', function(e) {
                if (e.target === detailModal) {
                    detailModal.close();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentDeleteAction = null;
            let currentReviewId = null;

            document.querySelectorAll('.edit-review-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reviewId = this.getAttribute('data-review-id');
                    const editForm = document.getElementById(`edit-form-${reviewId}`);
                    const reviewContent = document.getElementById(`review-content-${reviewId}`);

                    if (editForm && reviewContent) {
                        editForm.classList.remove('hidden');
                        reviewContent.style.display = 'none';
                    }
                });
            });

            document.querySelectorAll('.cancel-edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reviewId = this.getAttribute('data-review-id');
                    const editForm = document.getElementById(`edit-form-${reviewId}`);
                    const reviewContent = document.getElementById(`review-content-${reviewId}`);

                    if (editForm && reviewContent) {
                        editForm.classList.add('hidden');
                        reviewContent.style.display = 'flex';
                    }
                });
            });

            document.querySelectorAll('.delete-review-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reviewId = this.getAttribute('data-review-id');
                    const reviewText = this.getAttribute('data-review-text');
                    const reviewRating = parseInt(this.getAttribute('data-review-rating'));
                    const actionUrl = this.getAttribute('data-action-url');

                    currentDeleteAction = actionUrl;
                    currentReviewId = reviewId;

                    populateModalPreview(reviewText, reviewRating);

                    openDeleteModal();
                });
            });

            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                if (currentDeleteAction && currentReviewId) {
                    performDelete(currentDeleteAction, currentReviewId);
                }
            });

            document.querySelectorAll('.update-review-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const reviewId = this.getAttribute('data-review-id');
                    const formData = new FormData(this);
                    const submitBtn = document.getElementById(`update-btn-${reviewId}`);
                    const originalBtnText = submitBtn.innerHTML;

                    const ratingChecked = formData.get('rating');
                    if (!ratingChecked) {
                        showToast('error', 'Rating harus dipilih!');
                        return;
                    }

                    submitBtn.disabled = true;
                    submitBtn.innerHTML =
                        '<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...';

                    const requestBody = new URLSearchParams();
                    requestBody.append('rating', formData.get('rating'));
                    requestBody.append('review', formData.get('review') || '');
                    requestBody.append('_token', document.querySelector('meta[name="csrf-token"]')
                        .content);
                    requestBody.append('_method', 'PUT');

                    fetch(`/reviews/${reviewId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: requestBody
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                updateDisplayedReview(reviewId, data.review);

                                const editForm = document.getElementById(
                                    `edit-form-${reviewId}`);
                                const reviewContent = document.getElementById(
                                    `review-content-${reviewId}`);

                                if (editForm && reviewContent) {
                                    editForm.classList.add('hidden');
                                    reviewContent.style.display = 'flex';
                                }

                                showToast('success', 'Ulasan berhasil diperbarui!');
                            } else {
                                throw new Error(data.message || 'Gagal memperbarui ulasan');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast('error', 'Terjadi kesalahan: ' + error.message);
                        })
                        .finally(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnText;
                        });
                });
            });

            function openDeleteModal() {
                const modal = document.getElementById('deleteReviewModal');
                modal.classList.add('modal-open');
                document.body.style.overflow = 'hidden';
            }

            function closeDeleteModal() {
                const modal = document.getElementById('deleteReviewModal');
                modal.classList.remove('modal-open');
                document.body.style.overflow = '';

                currentDeleteAction = null;
                currentReviewId = null;
            }

            window.closeDeleteModal = closeDeleteModal;

            function populateModalPreview(reviewText, rating) {
                const previewRating = document.getElementById('previewRating');
                previewRating.innerHTML = '';

                for (let i = 1; i <= 5; i++) {
                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = 'preview-rating';
                    input.className = 'mask mask-star-2 bg-yellow-400';
                    if (i <= rating) input.checked = true;
                    input.disabled = true;
                    previewRating.appendChild(input);
                }

                const previewText = document.getElementById('previewText');
                previewText.textContent = reviewText || 'Tidak ada teks ulasan';
            }

            function performDelete(actionUrl, reviewId) {
                const confirmBtn = document.getElementById('confirmDeleteBtn');
                const originalBtnText = confirmBtn.innerHTML;

                confirmBtn.disabled = true;
                confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Menghapus...';

                const formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                formData.append('_method', 'DELETE');

                fetch(actionUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            closeDeleteModal();

                            const reviewElement = document.getElementById(`review-${reviewId}`);
                            if (reviewElement) {
                                reviewElement.remove();
                            }

                            showToast('success', 'Ulasan berhasil dihapus!');

                            const remainingReviews = document.querySelectorAll('[id^="review-"]');
                            if (remainingReviews.length === 0) {
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                        } else {
                            throw new Error(data.message || 'Gagal menghapus ulasan');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('error', 'Terjadi kesalahan: ' + error.message);
                    })
                    .finally(() => {
                        confirmBtn.disabled = false;
                        confirmBtn.innerHTML = originalBtnText;
                    });
            }

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal-backdrop')) {
                    closeDeleteModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDeleteModal();
                }
            });

            function updateDisplayedReview(reviewId, reviewData) {
                const ratingContainer = document.getElementById(`rating-display-${reviewId}`);
                if (ratingContainer) {
                    ratingContainer.innerHTML = '';
                    for (let i = 1; i <= 5; i++) {
                        const input = document.createElement('input');
                        input.type = 'radio';
                        input.name = `rating-${reviewId}`;
                        input.className = 'mask mask-star-2 bg-yellow-400';
                        if (i <= reviewData.rating) input.checked = true;
                        input.disabled = true;
                        ratingContainer.appendChild(input);
                    }
                }

                const reviewText = document.getElementById(`review-text-${reviewId}`);
                if (reviewText) {
                    reviewText.textContent = reviewData.review || '';
                }
            }

            function showToast(type, message) {
                const toast = document.createElement('div');
                toast.className =
                    `alert ${type === 'success' ? 'alert-success' : 'alert-error'} fixed top-4 right-4 z-50 max-w-sm`;
                toast.style.zIndex = '9999';
                toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'} mr-2"></i>
                <span>${message}</span>
            </div>
        `;

                document.body.appendChild(toast);

                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 3000);
            }
        });
    </script>
@endpush

<style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-auto-scroll {
        display: inline-block;
    }

    .relative:hover .animate-auto-scroll {
        animation-play-state: paused;
    }

    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }

    .star-rating input {
        position: absolute;
        opacity: 0;
    }

    .star-rating label {
        cursor: pointer;
        font-size: 1.5rem;
        color: #ccc;
        transition: color 0.2s;
    }

    .star-rating input:checked~label,
    .star-rating input:hover~label,
    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #f59e0b;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.modal-open {
        display: flex;
    }

    .modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        border: none;
        cursor: pointer;
    }

    .modal-box {
        position: relative;
        z-index: 1001;
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .btn-error {
        background-color: #ef4444;
        border-color: #ef4444;
        color: white;
    }

    .btn-error:hover {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .rating-sm .mask {
        width: 1rem;
        height: 1rem;
    }
</style>
