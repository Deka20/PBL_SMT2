@extends('layout.app')

@section('title', 'Potretine')

@section('content')
    <section class="bg-center bg-no-repeat bg-[url('/images/hero1.jpg')] bg-cover min-h-[700px] w-full" id="home">
    </section>

    <h1 class="mt-10 text-center text-3xl font-bold">Studio Kami</h1>
    <h2 class="text-center text-2xl">Pilih Studio Sesuai Keinginanmu</h2>

    <div class="container mx-auto px-4 py-8" id="studio">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="card bg-[#fef6f6] shadow-sm hover:shadow-md cursor-pointer">
                <figure><img src="{{ asset('images/hero.jpg') }}" alt="Group Photo Studio" class="w-full h-48 object-cover" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">Selfphoto</h2>
                    <p>Kapasitas 1-3 Orang</p>
                    <p>Deskripsi</p>
                    <p>Rp 100.000/30 menit</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-neutral w-full"
                            onclick="document.getElementById('detail-modal').showModal()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card bg-[#fef6f6] shadow-sm hover:shadow-md cursor-pointer">
                <figure><img src="https://i.pinimg.com/736x/33/1d/8e/331d8e22914d565c43850d6ed33bfeec.jpg"
                        alt="Group Photo Studio" class="w-full h-48 object-cover" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Family</h2>
                    <p>Kapasitas 3-6 Orang</p>
                    <p>Deskripsi</p>
                    <p>Rp 150.000/30 menit</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-neutral w-full"
                            onclick="document.getElementById('detail-modal').showModal()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card bg-[#fef6f6] shadow-sm hover:shadow-md cursor-pointer">
                <figure><img src="https://i.pinimg.com/736x/ab/24/28/ab24286cfda32b7fc8fd791f8ca029da.jpg"
                        alt="Group Photo Studio" class="w-full h-48 object-cover" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Graduation</h2>
                    <p>Kapasitas 5-10 Orang</p>
                    <p>Deskripsi</p>
                    <p>Rp 250.000/30 menit</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-neutral w-full"
                            onclick="document.getElementById('detail-modal').showModal()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="card bg-[#fef6f6] shadow-sm hover:shadow-md cursor-pointer">
                <figure><img src="https://i.pinimg.com/736x/73/b6/d4/73b6d4e8548a248be9c5e0a615772e0b.jpg"
                        alt="Group Photo Studio" class="w-full h-48 object-cover" /></figure>
                <div class="card-body">
                    <h2 class="card-title">Group Photo</h2>
                    <p>Kapasitas 10-15 Orang</p>
                    <p>Deskripsi</p>
                    <p>Rp 300.000/30 menit</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-neutral w-full"
                            onclick="document.getElementById('detail-modal').showModal()">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="detail-modal" class="modal">
        <div class="modal-box w-11/12 max-w-5xl p-0 rounded-xl overflow-hidden shadow-lg relative">

            <!-- Tombol Close -->
            <form method="dialog" class="absolute right-4 top-4 z-10">
                <button class="text-xl font-bold text-gray-500 hover:text-red-500">✕</button>
            </form>

            <!-- Konten modal: layout horizontal -->
            <div class="flex flex-row h-[340px]">
                <!-- Gambar kiri -->
                <div class="w-1/2 h-full">
                    <img src="https://i.pinimg.com/736x/73/b6/d4/73b6d4e8548a248be9c5e0a615772e0b.jpg"
                        alt="Selfphoto Studio" class="w-full h-full object-cover">
                </div>

                <!-- Konten teks kanan -->
                <div class="w-1/2 p-8 flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Selfphoto Studio</h3>
                        <ul class="space-y-2 text-gray-700 text-sm">
                            <li><span class="text-pink-600 font-bold">✓</span> Kapasitas 1–3 orang</li>
                            <li><span class="text-pink-600 font-bold">✓</span> Rp. 100.000 per 30 menit</li>
                            <li><span class="text-pink-600 font-bold">✓</span> Bebas memilih latar</li>
                        </ul>
                    </div>

                    <!-- Tombol Pesan -->
                    <a href="{{ route('pemesanan') }}">
                        <button class="mt-6 bg-black text-white w-full py-3 rounded-md font-medium">
                            Pesan Sekarang
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Backdrop -->
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <div class="container mx-auto px-4 py-8">
        <h1 class="mt-10 text-center text-3xl font-bold">Portofolio</h1>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mt-5">
            <!-- Polaroid Card 1 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-1 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+1" alt="Portrait 1"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Polaroid Card 2 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-2 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+2" alt="Portrait 2"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Polaroid Card 3 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-2 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+3" alt="Portrait 3"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Polaroid Card 4 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-1 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+4" alt="Portrait 4"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Polaroid Card 5 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-3 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+5" alt="Portrait 5"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Polaroid Card 6 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-3 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+6" alt="Portrait 6"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Polaroid Card 7 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-1 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+7" alt="Portrait 7"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Polaroid Card 8 -->
            <div
                class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-2 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+8" alt="Portrait 8"
                        class="w-full h-full object-cover">
                </div>
            </div>
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
                            <input type="radio" name="rating-10" class="bg-yellow-100 mask mask-star-2 mask-half-1"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-2"
                                checked />
                            <input type="radio" name="rating-10" class="bg-yellow-400 mask mask-star-2 mask-half-1"
                                checked />
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
