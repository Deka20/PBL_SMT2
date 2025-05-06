<footer class="footer p-10 text-base-content w-full" id="kontak">
    <div class="w-full mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center w-full">
            <div class="flex flex-col items-center md:items-start mb-6 md:mb-0 w-full md:w-1/4">
                <div class="flex items-center space-x-4">
                    <div class="avatar">
                        <div class="w-12 rounded-full">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Potretine Logo" />
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-pink-600">Potrétine</h2>
                    </div>
                </div>
            </div>

            <!-- Menu dan Kontak -->
            <div class="flex flex-col md:flex-row gap-8 md:gap-16 text-center w-full md:w-2/4 justify-center">
                <!-- Navigasi Menu -->
                <div class="w-full md:w-1/2">
                    <h3 class="text-lg font-semibold text-pink-600 mb-3">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="#studio" class="link link-hover hover:text-pink-500 transition-colors">Studio</a>
                        </li>
                        <li><a href="#" class="link link-hover hover:text-pink-500 transition-colors">Layanan</a>
                        </li>
                        <li><a href="#" class="link link-hover hover:text-pink-500 transition-colors">Harga</a>
                        </li>
                        <li><a href="#kontak" class="link link-hover hover:text-pink-500 transition-colors">Kontak</a>
                        </li>
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

            <!-- Sosial Media -->
            <div class="flex flex-col items-center md:items-end w-full md:w-1/4">
                <h3 class="text-lg font-semibold text-pink-600 mb-3">Sosial Media</h3>
                <div class="flex gap-4">
                    <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="text-pink-500 hover:text-pink-700 transition-colors">
                        <i class="fab fa-tiktok text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-t-2 border-pink-300 w-full max-w-5xl mx-auto mt-5 mb-5">
        <div class="text-center py-4 w-full">
            <span class="text-sm text-gray-500">Copyright © {{ date('Y') }} <a href="#"
                    class="text-pink-500 hover:underline">Potrétine</a> - All Rights Reserved.</span>
        </div>
    </div>
</footer>
