<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Potretine</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-menu></x-menu>

    <section class="bg-center bg-no-repeat bg-[url('/images/hero.jpg')] bg-cover min-h-[700px] w-full">
    </section>

    <h1 class="mt-10 text-center text-3xl font-bold">Studio Kami</h1>
    <h2 class="text-center text-2xl">Pilih Studio Sesuai Keinginanmu</h2>
        
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="max-w-sm bg-pink-100 border border-gray-200 rounded-lg shadow-sm cursor-pointer">
                        <img class="rounded-t-lg w-full h-48 object-cover" src="images/hero.jpg" alt="Group Photo Studio" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Selfphoto</h5>
                            <p class="mb-3 font-normal text-gray-700">Kapasitas 1-3 Orang</p>
                    <p class="mb-3 font-normal text-gray-700">Deskripsi</p>
                    <p class="mb-3 font-normal text-gray-700">Rp 100.000/30 menit</p>
                        <button type="button"
                                class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-pink-200"
                                data-modal-target="detail-modal" 
                                data-modal-toggle="detail-modal"
                                data-modal-backdrop="false">
                            Lihat Detail
                        </button>
                    </div>
                </div>

            <!-- Card 2 -->
            <div class="max-w-sm bg-pink-100 border border-gray-200 rounded-lg shadow-sm cursor-pointer">
                        <img class="rounded-t-lg w-full h-48 object-cover" src="https://i.pinimg.com/736x/33/1d/8e/331d8e22914d565c43850d6ed33bfeec.jpg" alt="Group Photo Studio" />
                    <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Family</h5>
                            <p class="mb-3 font-normal text-gray-700">Kapasitas 3-6 Orang</p>
                            <p class="mb-3 font-normal text-gray-700">Deskripsi</p>
                            <p class="mb-3 font-normal text-gray-700">Rp 150.000/30 menit</p>
                        <button type="button"
                                class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-pink-200"
                                data-modal-target="detail-modal" 
                                data-modal-toggle="detail-modal"
                                data-modal-backdrop="false">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            
            <!-- Card 3 -->
                <div class="max-w-sm bg-pink-100 border border-gray-200 rounded-lg shadow-sm cursor-pointer">
                        <img class="rounded-t-lg w-full h-48 object-cover" src="https://i.pinimg.com/736x/ab/24/28/ab24286cfda32b7fc8fd791f8ca029da.jpg" alt="Group Photo Studio" />
                    <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Graduation</h5>
                            <p class="mb-3 font-normal text-gray-700">Kapasitas 5-10 Orang</p>
                            <p class="mb-3 font-normal text-gray-700">Deskripsi</p>
                            <p class="mb-3 font-normal text-gray-700">Rp 250.000/30 menit</p>
                        <button type="button"
                                class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-pink-200"
                                data-modal-target="detail-modal" 
                                data-modal-toggle="detail-modal"
                                data-modal-backdrop="false">
                            Lihat Detail
                        </button>
                    </div>
                </div>

            <!-- Card 4 -->
                <div class="max-w-sm bg-pink-100 border border-gray-200 rounded-lg shadow-sm cursor-pointer">
                        <img class="rounded-t-lg w-full h-48 object-cover" src="https://i.pinimg.com/736x/73/b6/d4/73b6d4e8548a248be9c5e0a615772e0b.jpg" alt="Group Photo Studio" />
                    <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Group Photo</h5>
                        <p class="mb-3 font-normal text-gray-700">Kapasitas 10-15 Orang</p>
                        <p class="mb-3 font-normal text-gray-700">Deskripsi</p>
                        <p class="mb-3 font-normal text-gray-700">Rp 300.000/30 menit</p>
                        <button type="button"
                                class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-800 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-pink-200"
                                data-modal-target="detail-modal" 
                                data-modal-toggle="detail-modal"
                                data-modal-backdrop="false">
                            Lihat Detail
                        </button>
                    </div>
                </div>

<!-- Modal (Tanpa Background Gelap) -->
<div id="detail-modal" tabindex="-1" 
     class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-none">
    <div class="relative w-full max-w-4xl mx-auto">
        <!-- Modal Container -->
        <div class="bg-white rounded-lg shadow-xl w-full overflow-hidden border border-gray-200">
            <!-- Modal header -->
            <div class="flex justify-between items-center border-b p-4 md:p-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">Detail Studio</h1>
                <button type="button" 
                        class="text-gray-400 hover:text-gray-900 text-3xl"
                        data-modal-hide="detail-modal">
                    &times;
                </button>
            </div>
            
            <!-- Modal content -->
            <div class="flex flex-col md:flex-row">
                <!-- Image side -->
                <div class="w-full md:w-1/2">
                    <img src="https://i.pinimg.com/736x/73/b6/d4/73b6d4e8548a248be9c5e0a615772e0b.jpg" 
                         alt="Family photo in studio" 
                         class="w-full h-64 md:h-full object-cover">
                </div>
                
                <!-- Details side -->
                <div class="w-full md:w-1/2 p-4 md:p-6">
                    <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-gray-800">Selfphoto Studio</h2>
                    
                    <ul class="space-y-3 md:space-y-4">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Kapasitas 10-15 orang</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Rp 300.000 per 30 menit</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Print photo berkualitas</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">10+ pilihan background</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Soft file semua foto</span>
                        </li>
                    </ul>
                    
                    <button type="button" 
                            class="mt-6 w-full bg-gray-900 hover:bg-gray-800 text-white py-3 px-4 rounded-lg transition duration-200">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
  

    <div class="container mx-auto px-4 py-8">
        <h1 class="mt-10 text-center text-3xl font-bold">Portofolio</h1>
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mt-5">
            <!-- Polaroid Card 1 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-1 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+1" alt="Portrait 1" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Polaroid Card 2 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-2 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+2" alt="Portrait 2" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Polaroid Card 3 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-2 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+3" alt="Portrait 3" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Polaroid Card 4 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-1 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+4" alt="Portrait 4" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Polaroid Card 5 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-3 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+5" alt="Portrait 5" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Polaroid Card 6 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-3 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+6" alt="Portrait 6" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Polaroid Card 7 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform -rotate-1 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+7" alt="Portrait 7" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            
            <!-- Polaroid Card 8 -->
            <div class="bg-white p-4 pb-10 shadow-md hover:shadow-xl transition-all duration-300 transform rotate-2 hover:rotate-0 hover:scale-105 h-full flex flex-col">
                <div class="border border-gray-100 bg-gray-50 p-2 flex-grow">
                    <img src="https://placehold.co/400x500/efefef/aaa?text=Photo+8" alt="Portrait 8" 
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <h1 class="mt-10 text-center text-3xl font-bold">Ratings & Reviews</h1>

        <div class="max-w-3xl mx-auto space-y-4 mt-5">
           <!-- Card 1: Rating Summary -->
<div class="bg-pink-100 rounded-lg shadow-md p-6">
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Average Rating -->
        <div class="text-center md:text-left md:w-1/3">
            <h2 class="text-4xl font-bold mb-2">5.0</h2>
            <div class="flex justify-center md:justify-start text-yellow-400 mb-2">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="text-gray-600 mt-6">Dari 6 Ulasan</p>  <!-- Mengurangi mt dari 10 ke 6 -->
        </div>
        
        <!-- Rating Distribution -->
        <div class="md:w-2/3">
            <div class="space-y-2">  <!-- Mengurangi space-y dari 3 ke 2 -->
                <!-- 5 Stars -->
                <div class="flex items-center">
                    <span class="w-8 flex items-center justify-center">
                        <span class="text-yellow-400">★</span><span class="text-gray-700">5</span>
                    </span>
                    <div class="flex-1 mx-2">
                        <div class="w-full bg-gray-400 rounded-full h-2.5">
                            <div class="bg-gray-600 h-2.5 rounded-full" style="width: 80%"></div>
                        </div>
                    </div>
                    <span class="text-gray-600 text-sm w-16">4 Orang</span>
                </div>

                <!-- 4 Stars -->
                <div class="flex items-center">
                    <span class="w-8 flex items-center justify-center">
                        <span class="text-yellow-400">★</span><span class="text-gray-700">4</span>
                    </span>
                    <div class="flex-1 mx-2">
                        <div class="w-full bg-gray-400 rounded-full h-2.5">
                            <div class="bg-gray-600 h-2.5 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                    <span class="text-gray-600 text-sm w-16">1 Orang</span>
                </div>

                <!-- 3 Stars -->
                <div class="flex items-center">
                    <span class="w-8 flex items-center justify-center">
                        <span class="text-yellow-400">★</span><span class="text-gray-700">3</span>
                    </span>
                    <div class="flex-1 mx-2">
                        <div class="w-full bg-gray-400 rounded-full h-2.5">
                            <div class="bg-gray-600 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    <span class="text-gray-600 text-sm w-16">0 Orang</span>
                </div>

                <!-- 2 Stars -->
                <div class="flex items-center">
                    <span class="w-8 flex items-center justify-center">
                        <span class="text-yellow-400">★</span><span class="text-gray-700">2</span>
                    </span>
                    <div class="flex-1 mx-2">
                        <div class="w-full bg-gray-400 rounded-full h-2.5">
                            <div class="bg-gray-600 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    <span class="text-gray-600 text-sm w-16">0 Orang</span>
                </div>

                <!-- 1 Star -->
                <div class="flex items-center">
                    <span class="w-8 flex items-center justify-center">
                        <span class="text-yellow-400">★</span><span class="text-gray-700">1</span>
                    </span>
                    <div class="flex-1 mx-2">
                        <div class="w-full bg-gray-400 rounded-full h-2.5">
                            <div class="bg-gray-600 h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    <span class="text-gray-600 text-sm w-16">0 Orang</span>
                </div>
            </div>
        </div>
    </div>
</div>
    
            <!-- Card 2: User Review -->
            <div class="bg-pink-100 rounded-lg shadow-md p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 bg-gray-400 rounded-full mr-3"></div>
                            <div>
                                <h3 class="font-bold">Nama Pengguna</h3>
                                <p class="text-gray-600 text-sm">Selfphoto</p>
                            </div>
                        </div>
                        <div class="text-yellow-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700">Review pengguna tentang studio foto ini sangat memuaskan!</p>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 bg-gray-200 text-black rounded hover:bg-gray-400 text-sm">
                            <i class="fas fa-edit mr-1"></i> Ubah
                        </button>
                        <button class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-400 text-sm">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<footer class="bg-white">
  <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
      <!-- Avatar dan Brand -->
      <div class="flex items-center space-x-4 mb-6 md:mb-0">
        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-300">
          <img src="images/logo.jpg" alt="Avatar" class="object-cover w-full h-full">
        </div>
      </div>

<!-- Link Navigasi, Kontak, dan Sosial Media -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-20 text-center md:text-left justify-items-center md:justify-items-start">
  
    <!-- Navigasi Menu -->
    <div>
      <ul class="text-gray-600 dark:text-gray-400 space-y-2">
        <li><a href="#" class="hover:underline">Studio</a></li>
        <li><a href="#" class="hover:underline">Layanan</a></li>
        <li><a href="#" class="hover:underline">Harga</a></li>
        <li><a href="#" class="hover:underline">Kontak</a></li>
      </ul>
    </div>
  
    <!-- Kontak & Lokasi -->
    <div>
      <ul class="text-gray-600 dark:text-gray-400 space-y-3">
        <li class="flex items-center justify-center md:justify-start space-x-2">
          <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
            <circle cx="12" cy="9" r="2.5" />
          </svg>
          <span>Jl. Photo Studio</span>
        </li>
        <li class="flex items-center justify-center md:justify-start space-x-2">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 4a2.6 2.6 0 0 0-2 .9 6.2 6.2 0 0 0-1.5 6 12 12 0 0 0 3.4 5.5 12 12 0 0 0 5.5 3.4 6.2 6.2 0 0 0 6-1.5 2.6 2.6 0 0 0 .9-2v-1.3a1.4 1.4 0 0 0-1.2-1.4 7.3 7.3 0 0 0-2.6-.4 8 8 0 0 0-2.6.4l-.4.1a1.4 1.4 0 0 1-1.1-.2 1.6 1.6 0 0 1-.6-1l-.1-.5a8 8 0 0 1 .4-2.6 1.4 1.4 0 0 0-.4-1.2A1.4 1.4 0 0 0 9 4Z"/>
            </svg>            
          <span>+62 81234567890</span>
        </li>
        <li class="flex items-center justify-center md:justify-start space-x-2">
          <svg class="w-5 h-5 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75M21.75 6.75L12 13.5 2.25 6.75" />
          </svg>
          <span>Potretine@gmail.com</span>
        </li>
      </ul>
    </div>
  
    <!-- Sosial Media -->
    <div class="flex flex-col items-center md:items-start space-y-3">
      <h2 class="text-gray-400 font-semibold">Sosial Media</h2>
      <div class="flex space-x-4">
        <!-- Instagram -->
        <a href="#" class="text-gray-500 hover:text-pink-500 transition">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm0 2h10c1.6 0 3 1.4 3 3v10c0 1.6-1.4 3-3 3H7c-1.6 0-3-1.4-3-3V7c0-1.6 1.4-3 3-3zm5 2.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9zm0 2a2.5 2.5 0 110 5 2.5 2.5 0 010-5zm4.5-.8a1 1 0 100 2 1 1 0 000-2z"/>
          </svg>
        </a>
        <!-- X (Twitter) -->
        <a href="#" class="text-gray-500 hover:text-blue-500 transition">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 4.6c-.8.3-1.7.5-2.5.6.9-.5 1.6-1.3 1.9-2.3-.8.5-1.8.9-2.8 1.1A4.3 4.3 0 0015.3 3c-2.4 0-4.3 2-4.3 4.3 0 .3 0 .6.1.9C7.7 8 5.1 6.6 3.5 4.5c-.3.6-.5 1.2-.5 2 0 1.4.7 2.7 1.9 3.4-.6 0-1.3-.2-1.8-.5v.1c0 2 1.4 3.7 3.3 4-.4.1-.9.2-1.3.2-.3 0-.6 0-.9-.1.6 1.8 2.3 3 4.2 3a8.7 8.7 0 01-6.4 1.8c1.9 1.2 4.1 1.8 6.4 1.8 7.7 0 11.9-6.4 11.9-11.9v-.6c.8-.6 1.5-1.3 2-2.1z"/>
          </svg>
        </a>
        <!-- Facebook -->
        <a href="#" class="text-gray-500 hover:text-blue-700 transition">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.2 1.8.2v2h-1c-1 0-1.3.6-1.3 1.2V12h2.5l-.4 3H14v7A10 10 0 0022 12z"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</div>  

    <!-- Batas Footer -->
    <hr class="my-6 border-gray-200 dark:border-gray-700 sm:mx-auto" />
    <span class="block text-sm text-gray-500 text-center dark:text-gray-400">Copyright © 2025 <a href="#" class="hover:underline">Potretine </a>- All Rights Reserved.</span>
  </div>
</footer>

    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>