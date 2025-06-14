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
                        {{-- You might want to add a more detailed description from the database if available --}}
                        {{-- <p>{{ $studio->deskripsi }}</p> --}}
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

    {{-- If you have a shared detail modal, ensure it's outside the loop or dynamically populated --}}
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
            </div>
        </div>
    </dialog>

    <div class="container mx-auto px-4 py-8">
        <h1 class="mt-10 text-center text-3xl font-bold">Portofolio</h1>

        <!-- Define rotations array at the top of the view -->
        @php
            $rotations = ['-rotate-1', 'rotate-2', '-rotate-2', 'rotate-1', '-rotate-3', 'rotate-3'];
        @endphp

        <!-- Auto-scrolling container -->
        <div class="relative mt-5 overflow-hidden">
            <!-- Portfolio cards container with auto-scroll animation -->
            <div class="flex space-x-6 py-4 animate-auto-scroll whitespace-nowrap"
                style="animation: scroll 30s linear infinite;">
                <!-- Duplicate items for seamless looping -->
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

            <!-- Gradient overlay for better UX -->
            <div class="absolute top-0 bottom-0 left-0 w-20 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="absolute top-0 bottom-0 right-0 w-20 bg-gradient-to-l from-white to-transparent z-10"></div>
        </div>

        <!-- Empty state (only shown if no portfolios) -->
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
        <!-- Card 1: Rating -->
        <div class="bg-[#fef6f6] rounded-box p-6">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Average Rating -->
                <div class="text-center md:text-left md:w-1/3">
                    <h2 class="text-4xl font-bold mb-2">5.0</h2>
                    <div class="rating rating-md rating-half">
                        <input type="radio" name="rating-10" class="rating-hidden" />
                        <input type="radio" name="rating-10" class="bg-yellow-100 mask mask-star-2 mask-half-1" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1" checked />
                        <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2"
                            checked />
                    </div>
                    <p class="text-gray-600 mt-6">Dari 6 Ulasan</p>
                </div>

                <!-- Rating Progres -->
                <div class="md:w-2/3">
                    <div class="space-y-2">
                        <!-- 5 Stars -->
                        <div class="flex items-center">
                            <span class="w-8 flex items-center justify-center">
                                <span class="text-yellow-400">★</span><span class="text-gray-700">5</span>
                            </span>
                            <progress class="progress progress-warning mx-2 flex-1" value="80"
                                max="100"></progress>
                            <span class="text-gray-600 text-sm w-16">4 Orang</span>
                        </div>

                        <!-- 4 Stars -->
                        <div class="flex items-center">
                            <span class="w-8 flex items-center justify-center">
                                <span class="text-yellow-400">★</span><span class="text-gray-700">4</span>
                            </span>
                            <progress class="progress progress-warning mx-2 flex-1" value="20"
                                max="100"></progress>
                            <span class="text-gray-600 text-sm w-16">1 Orang</span>
                        </div>

                        <!-- 3 Stars -->
                        <div class="flex items-center">
                            <span class="w-8 flex items-center justify-center">
                                <span class="text-yellow-400">★</span><span class="text-gray-700">3</span>
                            </span>
                            <progress class="progress progress-warning mx-2 flex-1" value="0"
                                max="100"></progress>
                            <span class="text-gray-600 text-sm w-16">0 Orang</span>
                        </div>

                        <!-- 2 Stars -->
                        <div class="flex items-center">
                            <span class="w-8 flex items-center justify-center">
                                <span class="text-yellow-400">★</span><span class="text-gray-700">2</span>
                            </span>
                            <progress class="progress progress-warning mx-2 flex-1" value="0"
                                max="100"></progress>
                            <span class="text-gray-600 text-sm w-16">0 Orang</span>
                        </div>

                        <!-- 1 Star -->
                        <div class="flex items-center">
                            <span class="w-8 flex items-center justify-center">
                                <span class="text-yellow-400">★</span><span class="text-gray-700">1</span>
                            </span>
                            <progress class="progress progress-warning mx-2 flex-1" value="0"
                                max="100"></progress>
                            <span class="text-gray-600 text-sm w-16">0 Orang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: User Review -->
        <div class="bg-[#fef6f6] rounded-box p-6">
            <div class="flex justify-between items-start">
                <div>
                    <div class="flex items-center mb-2">
                        <div class="avatar">
                            <div class="w-10 rounded-full bg-gray-400"></div>
                        </div>
                        <div class="ml-3">
                            <h3 class="font-bold">Nama Pengguna</h3>
                            <p class="text-gray-600 text-sm">Selfphoto</p>
                        </div>
                    </div>
                    <div class="rating rating-sm mb-2">
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-yellow-400" checked />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-yellow-400" checked />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-yellow-400" checked />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-yellow-400" checked />
                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-yellow-400" checked />
                    </div>
                    <p class="text-gray-700">Review pengguna tentang studio foto ini sangat memuaskan!</p>
                </div>
                <div class="flex space-x-2">
                    <button class="btn btn-sm ">
                        <i class="fas fa-edit mr-1"></i> Ubah
                    </button>
                    <button class="btn btn-sm bg-gray-600">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
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
                    // Get data from the clicked button's data attributes
                    const name = this.getAttribute('data-name');
                    const type = this.getAttribute('data-type');
                    const price = this.getAttribute('data-price');
                    const image = this.getAttribute('data-image');
                    const description = this.getAttribute('data-description');

                    // Populate the modal content
                    document.getElementById('modal-studio-name').textContent = name;
                    document.getElementById('modal-studio-type').textContent = type;
                    document.getElementById('modal-studio-price').textContent = price;
                    document.getElementById('modal-studio-image').src = image;
                    document.getElementById('modal-studio-image').alt = name + " image";
                    document.getElementById('modal-studio-description').textContent = description;

                    // Show the modal
                    detailModal.showModal();
                });
            });
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

    /* Pause animation on hover */
    .relative:hover .animate-auto-scroll {
        animation-play-state: paused;
    }
</style>
