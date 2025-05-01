<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Keamanan & Privasi</title>
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
                class="flex items-center gap-2 px-4 py-3 border-b border-gray-200 text-black font-normal text-sm active-menu"
                type="button"
            >
                <i class="fas fa-lock"></i>
                Keamanan &amp; Privasi
            </button>
            <button
                onclick="window.location.href='riwayat'"
                class="flex items-center gap-2 px-4 py-3 border-b border-gray-200 text-black font-normal text-sm"
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
                <h2 class="font-semibold text-lg text-black">Keamanan & Privasi</h2><br><br><br>
                <div
                    class="flex flex-col items-center text-xs text-gray-500"
                    style="min-width: 3rem"
                >
                    </label>
                    <input accept="image/*" class="hidden" id="profile-upload" type="file" />
                </div>
            </div>
            <form class="space-y-4">
            <p class="text-sm font-semibold">Ganti Password</p>
                <div>
                    <label
                        for="current-password"
                        class="block text-xs font-normal mb-1 text-gray-900"
                        >Password saat ini</label
                    >
                    <input
                        id="current-password"
                        type="password"
                        class="w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#f9d6d6] focus:border-[#f9d6d6]"
                    />
                </div>
                <div>
                    <label
                        for="new-password"
                        class="block text-xs font-normal mb-1 text-gray-900"
                        >Password baru</label
                    >
                    <input
                        id="new-password"
                        type="password"
                        class="w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#f9d6d6] focus:border-[#f9d6d6]"
                    />
                    <p class="text-[9px] text-gray-300 mt-1">Minimal 8 karakter, mengandung angka</p>
                </div>
                <div>
                    <label
                        for="confirm-password"
                        class="block text-xs font-normal mb-1 text-gray-900"
                        >Konfirmasi Password baru</label
                    >
                    <input
                        id="confirm-password"
                        type="password"
                        class="w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#f9d6d6] focus:border-[#f9d6d6]"
                    />
                </div>
            </form>
            <div class="flex items-center justify-end gap-4 mt-8">
                <button class="text-xs text-gray-400 font-normal" type="button">
                    Batal
                </button>
                <button
                    class="text-xs bg-[#f9d6d6] text-black rounded-full px-3 py-1 font-normal"
                    type="button"
                >
                    Simpan Perubahan
                </button>
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