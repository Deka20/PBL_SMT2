<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Potretine</title>
    <!-- DaisyUI via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="bg-white text-black">
    <x-menu></x-menu>

    <section class="bg-center bg-no-repeat bg-[url('/images/hero.jpg')] bg-cover min-h-[700px] w-full">
    </section>

    <h1 class="mt-10 text-center text-3xl font-bold">Studio Kami</h1>
    <h2 class="text-center text-2xl">Pilih Studio Sesuai Keinginanmu</h2>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="card bg-[#fef6f6] shadow-sm hover:shadow-md cursor-pointer">
                <figure><img src="images/hero.jpg" alt="Group Photo Studio" class="w-full h-48 object-cover" /></figure>
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
        <div class="modal-box p-0 max-w-4xl h-[80vh]">
            <form method="dialog" class="absolute right-4 top-4 z-10">
                <button class="btn btn-sm btn-circle btn-ghost">✕</button>
            </form>

            <div class="flex h-full">
                <!-- Full-height image on left (50%) -->
                <div class="w-1/2 h-full">
                    <img src="https://i.pinimg.com/736x/73/b6/d4/73b6d4e8548a248be9c5e0a615772e0b.jpg"
                        alt="Selfphoto Studio" class="w-full h-full object-cover">
                </div>

                <!-- Text content on right (50%) -->
                <div class="w-1/2 p-6 flex flex-col h-full overflow-y-auto">
                    <h2 class="text-2xl font-bold mb-4">Selfphoto Studio</h2>

                    <ul class="space-y-3 mb-6">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Kapasitas 1-3 orang</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Rp. 100.000 per 30 menit</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>3 print photo</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Bebas memilih latar belakang</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Mendapat semua soft file foto</span>
                        </li>
                    </ul>

                    <button class="btn btn-primary w-full mt-auto uppercase font-bold py-3 text-lg">
                        PESAN SEKARANG
                    </button>
                </div>
            </div>
        </div>

        <!-- Click outside to close -->
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
            <!-- Card 1: Rating Summary -->
            <div class="bg-pink-100 rounded-box p-6">
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

                    <!-- Rating Distribution -->
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
            <div class="bg-pink-100 rounded-box p-6">
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

    <footer class="footer p-10 text-base-content w-full">
        <div class="w-full mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center w-full">
                <!-- Logo dan Brand (Kiri) -->
                <div class="flex flex-col items-center md:items-start mb-6 md:mb-0 w-full md:w-1/4">
                    <div class="flex items-center space-x-4">
                        <div class="avatar">
                            <div class="w-12 rounded-full ring ring-pink-300 ring-offset-2">
                                <img src="images/logo.jpg" alt="Potretine Logo" />
                            </div>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-pink-600">Potretine</h2>
                            <p class="text-sm text-gray-600">Studio Fotografi Profesional</p>
                        </div>
                    </div>
                </div>

                <!-- Menu dan Kontak (Tengah) -->
                <div class="flex flex-col md:flex-row gap-8 md:gap-16 text-center w-full md:w-2/4 justify-center">
                    <!-- Navigasi Menu -->
                    <div class="w-full md:w-1/2">
                        <h3 class="text-lg font-semibold text-pink-600 mb-3">Menu</h3>
                        <ul class="space-y-2">
                            <li><a href="#"
                                    class="link link-hover hover:text-pink-500 transition-colors">Studio</a></li>
                            <li><a href="#"
                                    class="link link-hover hover:text-pink-500 transition-colors">Layanan</a></li>
                            <li><a href="#"
                                    class="link link-hover hover:text-pink-500 transition-colors">Harga</a></li>
                            <li><a href="#"
                                    class="link link-hover hover:text-pink-500 transition-colors">Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Kontak & Lokasi -->
                    <div class="w-full md:w-1/2">
                        <h3 class="text-lg font-semibold text-pink-600 mb-3">Kontak</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
                                    <circle cx="12" cy="9" r="2.5" />
                                </svg>
                                <span>Jl. Photo Studio No. 123, Jakarta</span>
                            </li>
                            <li class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-pink-500 flex-shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8 4a2.6 2.6 0 0 0-2 .9 6.2 6.2 0 0 0-1.5 6 12 12 0 0 0 3.4 5.5 12 12 0 0 0 5.5 3.4 6.2 6.2 0 0 0 6-1.5 2.6 2.6 0 0 0 .9-2v-1.3a1.4 1.4 0 0 0-1.2-1.4 7.3 7.3 0 0 0-2.6-.4 8 8 0 0 0-2.6.4l-.4.1a1.4 1.4 0 0 1-1.1-.2 1.6 1.6 0 0 1-.6-1l-.1-.5a8 8 0 0 1 .4-2.6 1.4 1.4 0 0 0-.4-1.2A1.4 1.4 0 0 0 9 4Z" />
                                </svg>
                                <span>+62 81234567890</span>
                            </li>
                            <li class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75M21.75 6.75L12 13.5 2.25 6.75" />
                                </svg>
                                <span>Potretine@gmail.com</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Sosial Media (Kanan) -->
                <div class="flex flex-col items-center md:items-end w-full md:w-1/4">
                    <h3 class="text-lg font-semibold text-pink-600 mb-3">Sosial Media</h3>
                    <div class="flex gap-4">
                        <!-- Instagram -->
                        <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <!-- X (Twitter) -->
                        <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                        <!-- Facebook -->
                        <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <!-- TikTok -->
                        <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                            <i class="fab fa-tiktok text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Garis Pemisah -->
            <hr class="border-t-2 border-pink-300 w-full max-w-5xl mx-auto mt-5 mb-5">
            <div class="text-center py-4 w-full">
                <span class="text-sm text-gray-500">Copyright © 2025 <a href="#"
                        class="text-pink-500 hover:underline">Potretine</a> - All Rights Reserved.</span>
            </div>
        </div>
    </footer>

</body>

</html>
