<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Profile Page with Left-Aligned Form and Shadow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        rel="stylesheet"
    />
    <style>
        button {
            transition: transform 0.2s ease, filter 0.2s ease, background-color 0.2s ease;
        }
        button:hover {
            transform: translateY(-2px);
            filter: brightness(0.85);
            background-color: #f3f4f6; /* Tailwind gray-100 */
        }
        .active-menu {
            background-color: #f9d6d6;
            color: black;
            font-weight: 400;
        }
        .active-menu:hover {
            filter: brightness(0.85);
        }
    </style>
</head>
<body class="bg-[#fef6f6] min-h-screen flex flex-col">
    <header
      class="flex items-center justify-between px-4 py-3 bg-white shadow-sm relative"
    >
        <button
            onclick="window.location.href='kembali'"
            class="flex items-center gap-2 text-sm font-normal text-black"
            type="button"
        >
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="relative">
            <button
                aria-label="User profile"
                id="profileBtn"
                class="text-black text-lg focus:outline-none"
                type="button"
            >
                <i class="fas fa-user-circle"></i>
            </button>
            <div
                id="dropdownMenu"
                class="hidden absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow-md z-10"
            >
                <button
                    onclick="window.location.href='keluar'"
                    class="w-full text-left px-4 py-2 text-sm text-black hover:bg-gray-100"
                    type="button"
                >
                    Keluar
                </button>
            </div>
        </div>
    </header>
    <main
        class="flex max-w-4xl bg-white rounded-lg overflow-hidden w-full mx-4 md:mx-auto mt-10"
    >
        <nav
          class="flex flex-col w-48 border border-r border-gray-200 hidden md:flex"
        >
            <button
                onclick="window.location.href='profil'"
                class="flex items-center gap-2 px-4 py-3 border-b border-gray-200 text-black font-normal text-sm"
                type="button"
            >
                <i class="fas fa-user"></i>
                Profil
            </button>
            <button
                onclick="window.location.href='keamanan'"
                class="flex items-center gap-2 px-4 py-3 border-b border-gray-200 text-black font-normal text-sm"
                ype="button"
            >
                <i class="fas fa-lock"></i>
                Keamanan &amp; Privasi
            </button>
            <button
                onclick="window.location.href='riwayat'"
                class="flex items-center gap-2 px-4 py-3 border-b border-gray-200 text-black font-normal text-sm active-menu"
                type="button"
            >
                <i class="fas fa-history"></i>
                Riwayat Pemesanan
            </button>
            <button
                onclick="window.location.href='keluar'"
                class="flex items-center gap-2 px-4 py-3 mt-auto bg-[#f9d6d6] text-black font-normal text-sm"
                type="button"
            >
                <i class="fas fa-sign-out-alt"></i>
                Keluar
            </button>
        </nav>
        <section class="flex-1 p-6 relative w-full rounded-lg shadow-lg min-h-[460px] max-h-[460px]">
            <div class="flex justify-between items-start mb-2">
                <h2 class="font-semibold text-lg text-black">Riwayat Pemesanan</h2>
                <div
                    class="flex flex-col items-center text-xs text-gray-500"
                    style="min-width: 3rem"
                >
                    </label>
                    <input accept="image/*" class="hidden" id="profile-upload" type="file" />
                </div>
            </div>
            <div class="overflow-y-auto h-[400px] pr-1">
                <section class="flex items-center px-6 py-4 border-b border-gray-200 w-full" style="">
                    <img alt="Placeholder circle image 48x48 px in light gray" class="w-12 h-12 rounded-full" height="48" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" width="48"/>
                    <div class="text-black text-sm leading-relaxed flex flex-col gap-1 ml-4 flex-grow">
                        <p>
                            Booking ID:
                        </p>
                        <p>
                            Studio:
                        </p>
                        <p class="flex items-center justify-between">
                            <span>
                                Tanggal:
                            </span>
                            <button class="bg-[#fcd9db] text-black text-xs rounded-md px-3 py-1" type="button" style="">
                                Lihat Detail
                            </button>
                        </p>
                    </div>
                </section>
                <section class="flex items-center px-6 py-4 border-b border-gray-200 w-full" style="">
                    <img alt="Placeholder circle image 48x48 px in light gray" class="w-12 h-12 rounded-full" height="48" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" width="48"/>
                    <div class="text-black text-sm leading-relaxed flex flex-col gap-1 ml-4 flex-grow">
                        <p>
                            Booking ID:
                        </p>
                        <p>
                            Studio:
                        </p>
                        <p class="flex items-center justify-between">
                            <span>
                                Tanggal:
                            </span>
                            <button class="bg-[#fcd9db] text-black text-xs rounded-md px-3 py-1" type="button" style="">
                                Lihat Detail
                            </button>
                        </p>
                    </div>
                </section>
                <section class="flex items-center px-6 py-4 border-b border-gray-200 w-full" style="">
                    <img alt="Placeholder circle image 48x48 px in light gray" class="w-12 h-12 rounded-full" height="48" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" width="48"/>
                    <div class="text-black text-sm leading-relaxed flex flex-col gap-1 ml-4 flex-grow">
                        <p>
                            Booking ID:
                        </p>
                        <p>
                            Studio:
                        </p>
                        <p class="flex items-center justify-between">
                            <span>
                                Tanggal:
                            </span>
                            <button class="bg-[#fcd9db] text-black text-xs rounded-md px-3 py-1" type="button" style="">
                                Lihat Detail
                            </button>
                        </p>
                    </div>
                </section>
                <section class="flex items-center px-6 py-4 border-b border-gray-200 w-full" style="">
                    <img alt="Placeholder circle image 48x48 px in light gray" class="w-12 h-12 rounded-full" height="48" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" width="48"/>
                    <div class="text-black text-sm leading-relaxed flex flex-col gap-1 ml-4 flex-grow">
                        <p>
                            Booking ID:
                        </p>
                        <p>
                            Studio:
                        </p>
                        <p class="flex items-center justify-between">
                            <span>
                                Tanggal:
                            </span>
                            <button class="bg-[#fcd9db] text-black text-xs rounded-md px-3 py-1" type="button" style="">
                                Lihat Detail
                            </button>
                        </p>
                    </div>
                </section>
                <section class="flex items-center px-6 py-4 border-b border-gray-200 w-full" style="">
                    <img alt="Placeholder circle image 48x48 px in light gray" class="w-12 h-12 rounded-full" height="48" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" width="48"/>
                    <div class="text-black text-sm leading-relaxed flex flex-col gap-1 ml-4 flex-grow">
                        <p>
                            Booking ID:
                        </p>
                        <p>
                            Studio:
                        </p>
                        <p class="flex items-center justify-between">
                            <span>
                                Tanggal:
                            </span>
                            <button class="bg-[#fcd9db] text-black text-xs rounded-md px-3 py-1" type="button" style="">
                                Lihat Detail
                            </button>
                        </p>
                    </div>
                </section>
                <section class="flex items-center px-6 py-4 border-b border-gray-200 w-full" style="">
                    <img alt="Placeholder circle image 48x48 px in light gray" class="w-12 h-12 rounded-full" height="48" src="https://storage.googleapis.com/a1aa/image/3d6745d5-8e69-4701-3b07-ed9250390457.jpg" width="48"/>
                    <div class="text-black text-sm leading-relaxed flex flex-col gap-1 ml-4 flex-grow">
                        <p>
                            Booking ID:
                        </p>
                        <p>
                            Studio:
                        </p>
                        <p class="flex items-center justify-between">
                            <span>
                                Tanggal:
                            </span>
                            <button class="bg-[#fcd9db] text-black text-xs rounded-md px-3 py-1" type="button" style="">
                                Lihat Detail
                            </button>
                        </p>
                    </div>
                </section>
            </div>
        </section>
    </main>
    <script>
        const profileBtn = document.getElementById("profileBtn");
        const dropdownMenu = document.getElementById("dropdownMenu");
        
        profileBtn.addEventListener("click", () => {
          dropdownMenu.classList.toggle("hidden");
        });
      
      // Close dropdown if clicked outside
        window.addEventListener("click", (e) => {
        if (
          !profileBtn.contains(e.target) &&
          !dropdownMenu.contains(e.target)
        ) {
          dropdownMenu.classList.add("hidden");
        }
      });
    </script>
</body>
</html>