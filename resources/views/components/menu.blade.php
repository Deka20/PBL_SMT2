<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar | Potretine</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .nav-link.active {
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 500;
        }

        .nav-link:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        #mobile-menu {
            transition: max-height 0.3s ease-in-out;
            max-height: 0;
            overflow: hidden;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 40;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        #mobile-menu.show {
            max-height: 500px;
            overflow-y: auto;
        }

        html {
            scroll-behavior: smooth;
        }

        section {
            min-height: 100vh;
            padding: 2rem;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Desktop dan Mobile Navbar -->
    <div class="navbar sticky top-0 z-50 bg-[#fef6f6] shadow-lg relative">
        <!-- Logo - Left side -->
        <div class="navbar-start">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.jpg') }}" class="h-8 w-8 rounded-full object-cover"
                    alt="Potretine Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-pink-600">Potrétine</span>
            </a>
        </div>

        <!-- Desktop Navbar - Hidden on mobile -->
        <div class="navbar-center hidden lg:flex">
            <nav>
                <ul class="flex space-x-6">
                    <!-- ini tadi error gabisa diklik yg beranda jd aku buat hrefnya #home -->
                    <li><a href="#home" class="nav-link active" data-section="home">Beranda</a></li>
                    <li><a href="#studio" class="nav-link" data-section="studio">Studio</a></li>
                    <li><a href="#kontak" class="nav-link" data-section="kontak">Kontak</a></li>
                </ul>
            </nav>
        </div>

        <!-- Navbar Bagian Kanan -->
        <div class="navbar-end">
            <div class="hidden lg:flex items-center">
                @auth
                    <!-- Search Bar untuk user sudah login -->
                    <div class="relative w-52">
                        <input id="searchInput" type="text" placeholder="Cari studio..."
                            class="w-full px-4 py-2 border border-pink-500 rounded-full mr-2 shadow-sm focus:outline-none" />
                        <ul id="suggestions"
                            class="absolute right-0 mt-1 w-80 bg-white border border-gray-300 rounded-md shadow-lg z-50 hidden max-h-72 overflow-y-auto">
                        </ul>
                    </div>
                    <!-- User Dropdown Menu -->
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-8 rounded-full">
                                @if (Auth::user()->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                        alt="{{ Auth::user()->nama_pengguna }}" />
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                        </label>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white rounded-box w-52">
                            <div class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-bold">{{ Auth::user()->nama_pengguna }}</div>
                                <div class="text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <li><a href="/profil">Profil</a></li>
                            <li><a href="/keamanan">Pengaturan</a></li>
                            <li><a href="/riwayat">Riwayat Pemesanan</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Tombol Masuk/Daftar untuk guest -->
                    <a href="{{ route('login') }}">
                        <button class="btn !bg-black !text-white hover:bg-gray-800 mr-2">Masuk</button>
                    </a>
                    <a href="{{ route('auth.daftar') }}">
                        <button class="btn border-black hover:bg-gray-100">Daftar</button>
                    </a>

                    <!-- Search Bar untuk guest -->
                    <div class="relative w-52">
                        <input id="searchInput" type="text" placeholder="Cari studio..."
                            class="w-full px-4 py-2 border border-pink-500 rounded-full ml-2 shadow-sm focus:outline-none" />

                        <ul id="suggestions"
                            class="absolute right-0 mt-1 w-80 bg-white border border-gray-300 rounded-md shadow-lg z-50 hidden max-h-72 overflow-y-auto">
                        </ul>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu -->
            <div class="flex lg:hidden">
                <button id="mobile-menu-btn" class="btn btn-square btn-ghost">
                    <svg id="menu-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="lg:hidden">
            <div class="p-4 space-y-4">
                <!-- Mobile Navigation Links -->
                <ul class="menu menu-vertical w-full">
                    <li><a href="#home" class="nav-link active" data-section="home">Beranda</a></li>
                    <li><a href="#studio" class="nav-link" data-section="studio">Studio</a></li>
                    <li><a href="#kontak" class="nav-link" data-section="kontak">Kontak</a></li>
                </ul>

                <!-- Mobile Search Bar -->
                <div class="mt-4">
                    <div class="join w-full">
                        <input type="text" placeholder="Cari studio..."
                            class="input input-bordered w-full join-item" />
                        <button class="btn join-item bg-pink-200 hover:bg-pink-300 border-pink-300">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Tombol Masuk/Daftar -->
                @auth
                    <div class="divider"></div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.jpg') }}"
                                    alt="{{ Auth::user()->nama_pengguna }}">
                            </div>
                        </div>
                        <div>
                            <span class="font-medium">{{ Auth::user()->nama_pengguna }}</span>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <ul class="menu menu-vertical w-full">
                        <li><a href="/profil">Profil</a></li>
                        <li><a href="/keamanan">Pengaturan</a></li>
                    </ul>

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-outline w-full">Keluar</button>
                    </form>
                @else
                    <div class="divider"></div>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('login') }}">
                            <button class="btn bg-black text-white hover:bg-gray-800 w-full">Masuk</button>
                        </a>
                        <a href="{{ route('auth.daftar') }}">
                            <button class="btn border-black hover:bg-gray-100 w-full">Daftar</button>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cache DOM elements
            const domElements = {
                mobileMenuBtn: document.getElementById("mobile-menu-btn"),
                mobileMenu: document.getElementById("mobile-menu"),
                menuIcon: document.getElementById("menu-icon"),
                closeIcon: document.getElementById("close-icon"),
                navLinks: document.querySelectorAll(".nav-link"),
                sections: document.querySelectorAll("section"),
                searchInput: document.getElementById("searchInput"),
                suggestions: document.getElementById("suggestions"),
                detailModal: document.getElementById("detail-modal")
            };

            // State management
            let state = {
                isScrolling: false,
                userJustClicked: false,
                lastSearchQuery: ""
            };

            // ========== MOBILE MENU HANDLING ==========
            function setupMobileMenu() {
                domElements.mobileMenuBtn.addEventListener("click", toggleMobileMenu);

                document.addEventListener("click", function(event) {
                    if (domElements.mobileMenu.classList.contains("show") &&
                        !domElements.mobileMenu.contains(event.target) &&
                        !domElements.mobileMenuBtn.contains(event.target)) {
                        closeMobileMenu();
                    }
                });
            }

            function toggleMobileMenu() {
                domElements.mobileMenu.classList.toggle("show");
                domElements.menuIcon.classList.toggle("hidden");
                domElements.closeIcon.classList.toggle("hidden");
            }

            function closeMobileMenu() {
                domElements.mobileMenu.classList.remove("show");
                domElements.menuIcon.classList.remove("hidden");
                domElements.closeIcon.classList.add("hidden");
            }

            // ========== NAVIGATION HANDLING ==========
            function setupNavigation() {
                domElements.navLinks.forEach(link => {
                    link.addEventListener("click", handleNavLinkClick);
                });
            }

            function handleNavLinkClick(e) {
                e.preventDefault();
                const targetId = this.getAttribute("href");
                const targetElement = document.querySelector(targetId);
                const sectionName = this.getAttribute("data-section");

                domElements.navLinks.forEach(navLink => navLink.classList.remove("active"));
                document.querySelectorAll(`.nav-link[data-section="${sectionName}"]`)
                    .forEach(navLink => navLink.classList.add("active"));

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: "smooth"
                    });
                }

                closeMobileMenu();

                state.userJustClicked = true;
                setTimeout(() => {
                    state.userJustClicked = false;
                }, 1000);
            }

            // ========== SCROLL HANDLING ==========
            function setupScrollHandling() {
                window.addEventListener("scroll", handleScroll);
                highlightActiveSection();
            }

            function handleScroll() {
                if (!state.isScrolling) {
                    state.isScrolling = true;

                    if (!state.userJustClicked) {
                        setTimeout(() => {
                            highlightActiveSection();
                            state.isScrolling = false;
                        }, 100);
                    } else {
                        state.isScrolling = false;
                    }
                }
            }

            function isInViewport(element, threshold = 0.5) {
                const rect = element.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;
                return rect.top <= windowHeight * threshold && rect.bottom >= windowHeight * threshold;
            }

            function highlightActiveSection() {
                let activeSection = null;

                domElements.sections.forEach(section => {
                    if (isInViewport(section)) {
                        activeSection = section;
                    }
                });

                if (activeSection) {
                    const sectionId = activeSection.id;
                    domElements.navLinks.forEach(link => link.classList.remove("active"));
                    document.querySelectorAll(`.nav-link[data-section="${sectionId}"]`)
                        .forEach(link => link.classList.add("active"));
                }
            }

            // ========== SEARCH & MODAL FUNCTIONALITY ==========
            function setupSearchAndModal() {
                domElements.searchInput.addEventListener("input", debounce(handleSearchInput, 300));

                document.addEventListener("click", handleDocumentClick);
            }

            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        func.apply(context, args);
                    }, wait);
                };
            }

            async function handleSearchInput() {
                const query = this.value.trim();
                state.lastSearchQuery = query;

                if (query.length === 0) {
                    domElements.suggestions.classList.add("hidden");
                    domElements.suggestions.innerHTML = "";
                    return;
                }

                try {
                    const response = await fetch(`/search-studio?q=${encodeURIComponent(query)}`);
                    if (!response.ok) throw new Error('Network response was not ok');

                    const data = await response.json();
                    updateSearchSuggestions(data, query);
                } catch (error) {
                    console.error('Error fetching search results:', error);
                }
            }

            function updateSearchSuggestions(data, query) {
                domElements.suggestions.innerHTML = "";
                if (query !== state.lastSearchQuery) return;

                if (data.length > 0) {
                    domElements.suggestions.classList.remove("hidden");

                    data.forEach((item) => {
                        const li = document.createElement("li");
                        li.className = "flex items-center gap-4 px-4 py-2 hover:bg-gray-100 cursor-pointer";

                        li.dataset.studioId = item.id;
                        li.dataset.studioName = item.nama_studio;
                        li.dataset.studioImage = `/storage/${item.gambar}`;
                        li.dataset.studioType = item.jenis_studio;
                        li.dataset.studioPrice = item.harga;
                        li.dataset.studioCapacity = item.kapasitas;

                        const img = document.createElement("img");
                        img.src = `/storage/${item.gambar}`;
                        img.alt = item.nama_studio;
                        img.className = "w-12 h-12 object-cover rounded-2xl";
                        img.loading = "lazy";

                        const infoDiv = document.createElement("div");

                        const name = document.createElement("div");
                        name.textContent = item.nama_studio;
                        name.className = "font-medium text-sm";

                        const price = document.createElement("div");
                        price.textContent = formatRupiah(item.harga);
                        price.className = "text-xs text-gray-500";

                        infoDiv.appendChild(name);
                        infoDiv.appendChild(price);
                        li.appendChild(img);
                        li.appendChild(infoDiv);

                        li.addEventListener("click", () => showStudioDetails(item));

                        domElements.suggestions.appendChild(li);
                    });
                } else {
                    domElements.suggestions.classList.add("hidden");
                }
            }

            function showStudioDetails(item) {
                domElements.searchInput.value = item.nama_studio;
                domElements.suggestions.classList.add("hidden");

                document.getElementById("modal-studio-name").textContent = item.nama_studio;
                document.getElementById("modal-studio-image").src = `/storage/${item.gambar}`;
                document.getElementById("modal-studio-type").textContent = item.jenis_studio;
                document.getElementById("modal-studio-price").textContent = formatRupiah(item.harga);
                document.getElementById("modal-studio-description").textContent = `${item.kapasitas} orang`;

                const bookingLink = document.getElementById("modal-booking-link");
                if (bookingLink) {
                    bookingLink.href = `/pemesanan?studio_id=${item.id}`;
                }

                if (domElements.detailModal) {
                    domElements.detailModal.showModal();
                }
            }

            function handleDocumentClick(e) {
                const isClickInsideInput = domElements.searchInput.contains(e.target);
                const isClickInsideSuggestions = domElements.suggestions.contains(e.target);

                if (!isClickInsideInput && !isClickInsideSuggestions) {
                    domElements.suggestions.classList.add("hidden");
                }
            }

            function formatRupiah(angka) {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0
                }).format(angka);
            }

            function init() {
                setupMobileMenu();
                setupNavigation();
                setupScrollHandling();
                setupSearchAndModal();
            }

            init();
        });
    </script>
</body>

</html>
