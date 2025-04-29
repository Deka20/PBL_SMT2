<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Pemesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
    <form id="orderForm" class="bg-white rounded-md p-6 w-full max-w-md mx-auto mt-6 shadow-lg ring-1 ring-gray-300">
        <h2 class="text-center font-semibold mb-1">Form Pemesanan</h2>
        <p class="text-center text-sm mb-4">Isi form dibawah ini untuk melakukan pemesanan</p>
        <label class="block text-xs mb-1" for="nama">Nama Lengkap</label>
        <input
            id="nama"
            name="nama"
            type="text"
            placeholder="Nama Pelanggan"
            class="w-full text-xs rounded-md bg-gray-300 placeholder:text-gray-400 px-2 py-1 mb-3"
            required
        />
        <label class="block text-xs mb-1" for="hp">No. Handphone</label>
        <input
            id="hp"
            name="hp"
            type="tel"
            placeholder="Nomor Handphone"
            class="w-full text-xs rounded-md bg-gray-300 placeholder:text-gray-400 px-2 py-1 mb-3"
            required
            pattern="[0-9]+"
        />
        <label class="block text-xs mb-1" for="studio">Studio</label>
        <input
            id="studio"
            name="studio"
            type="text"
            placeholder="Studio pilihan pelanggan"
            class="w-full text-xs rounded-md bg-gray-300 placeholder:text-gray-400 px-2 py-1 mb-3"
            required
        />
        <label class="block text-xs mb-1" for="tanggal">Tanggal</label>
        <input
            id="tanggal"
            name="tanggal"
            type="date"
            class="w-full text-xs rounded-md bg-gray-300 px-2 py-1 mb-3"
            required
        />
        <label class="block text-xs mb-1">Jam</label>
        <div id="jamContainer" class="flex flex-wrap gap-1 mb-3 text-xs">
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="09.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">09.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="10.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">10.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="11.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">11.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="12.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">12.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="13.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">13.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="14.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">14.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="15.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">15.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="16.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">16.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="17.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">17.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="18.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">18.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="19.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">19.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="20.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">20.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="21.00" class="hidden peer" />
                <span class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">21.00</span>
            </label>
        </div>
        <label class="block text-xs mb-1">Jumlah Orang</label>
        <div class="flex items-center gap-2 mb-3 text-xs">
            <button type="button" id="decrease" class="bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center select-none hover:bg-gray-400 transition">−</button>
            <input
                id="jumlahOrang"
                name="jumlahOrang"
                type="number"
                value="5"
                min="1"
                max="20"
                readonly
                class="w-10 text-center rounded-md bg-gray-300 text-xs py-1"
            />
            <button type="button" id="increase" class="bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center select-none hover:bg-gray-400 transition">+</button>
        </div>
        <div class="flex gap-2 mb-4">
            <input
                type="text"
                readonly
                value="Total Pembayaran"
                class="flex-1 text-xs rounded-md bg-gray-300 px-2 py-1"
            />
            <input
                type="text"
                readonly
                value="Rp."
                class="w-16 text-xs rounded-md bg-gray-300 px-2 py-1"
            />
        </div>
        <button
            type="submit"
            class="w-full bg-[#f9d6d6] text-black text-[8px] py-1 rounded-sm hover:bg-[#e6bcbc] transition"
        >
            Konfirmasi Pesanan
        </button>
    </form>
    <script>
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        profileBtn.addEventListener('click', () => {
          dropdownMenu.classList.toggle('hidden');
        });
      
        window.addEventListener('click', (e) => {
          if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
          }
        });
      
        const tanggalInput = document.getElementById('tanggal');
        const today = new Date().toISOString().split('T')[0];
        tanggalInput.setAttribute('min', today);
      
        const decreaseBtn = document.getElementById('decrease');
        const increaseBtn = document.getElementById('increase');
        const jumlahOrangInput = document.getElementById('jumlahOrang');
      
        decreaseBtn.addEventListener('click', () => {
          let currentValue = parseInt(jumlahOrangInput.value);
          if (currentValue > 1) {
            jumlahOrangInput.value = currentValue - 1;
          }
        });
      
        increaseBtn.addEventListener('click', () => {
          let currentValue = parseInt(jumlahOrangInput.value);
          if (currentValue < 20) {
            jumlahOrangInput.value = currentValue + 1;
          }
        });
    </script>
</body>
</html>