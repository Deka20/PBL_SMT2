<html lang="en">
@php
    $user = Auth::user();
@endphp
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
            background-color: #f3f4f6;
            /* Tailwind gray-100 */
        }

        .active-menu {
            background-color: #f9d6d6;
            color: black;
            font-weight: 400;
        }

        .active-menu:hover {
            filter: brightness(0.85);
        }
        
        /* Custom scrollbar for time dropdown */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen flex flex-col">
    <header class="flex items-center justify-between px-4 py-3 bg-white shadow-sm relative">
        <button onclick="window.location.href='/'" class="flex items-center gap-2 text-sm font-normal text-black" type="button">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="relative">
            <button aria-label="User profile" id="profileBtn" class="text-black text-lg focus:outline-none" type="button">
                <i class="fas fa-user-circle"></i>
            </button>
            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow-md z-10">
                <button onclick="window.location.href='keluar'" class="w-full text-left px-4 py-2 text-sm text-black hover:bg-gray-100" type="button">
                    Keluar
                </button>
            </div>
        </div>
    </header>
@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<form method="POST" action="{{ route('pemesanan.simpan') }}" class="bg-white rounded-md mt-5 p-6 w-full max-w-lg mx-auto shadow-lg ring-1 ring-gray-300">
    @csrf

    <h2 class="text-center font-semibold text-xl mb-2">Form Pemesanan</h2>
    <p class="text-center text-base mb-6">Isi form di bawah ini untuk melakukan pemesanan</p>

    <label for="nama" class="block text-base mb-2">Nama Lengkap</label>
    <input id="nama" name="nama" type="text" required class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4" value="{{ Auth::user()->nama_lengkap ?? '' }}" readonly />

    <label for="no_hp" class="block text-base mb-2">No. Handphone</label>
    <input id="no_hp" name="no_hp" type="tel" required pattern="[0-9]+" class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4" value="{{ Auth::user()->telepon ?? '' }}" readonly />

    <label for="id_studio" class="block text-base mb-2">Studio</label>
    <select id="id_studio" name="id_studio" required class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4">
        <option value="" disabled selected>Pilih Studio</option>
        @foreach ($studioList as $studio)
            <option value="{{ $studio->id_studio }}">
                {{ $studio->id_studio }} - {{ $studio->jenis_studio }} - {{ $studio->nama_studio }} - Rp{{ number_format($studio->harga, 0, ',', '.') }}
            </option>
        @endforeach
    </select>

    <label for="tanggal" class="block text-base mb-2">Tanggal</label>
    <input id="tanggal" name="tanggal" type="date" required class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4" />

    <label for="jamDropdown" class="block text-base mb-2">Jam</label>
    <div class="relative mb-4">
        <button type="button" id="jamDropdownBtn" class="w-full text-left bg-gray-300 rounded-md px-4 py-2 flex justify-between items-center">
            <span id="selectedJamText">Pilih Jam</span>
            <i class="fas fa-chevron-down"></i>
        </button>
        <div id="jamDropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
            <div class="grid grid-cols-2 gap-1 p-2">
                <!-- Jam akan di-generate lewat JS -->
            </div>
        </div>
        <input type="hidden" id="selectedJam" name="jam" required />
    </div>

    <label for="jumlahOrang" class="block text-base mb-2">Jumlah Orang</label>
    <div class="flex items-center mb-4">
        <button type="button" id="decrease" class="bg-gray-300 px-3 py-1 rounded-l">-</button>
        <input id="jumlahOrang" name="jumlah_orang" type="number" min="1" value="1" required class="text-center w-full max-w-[60px] bg-gray-100 border border-gray-300" readonly />
        <button type="button" id="increase" class="bg-gray-300 px-3 py-1 rounded-r">+</button>
    </div>

    <div class="mb-4">
        <label class="block text-base mb-2">Total Harga:</label>
        <div id="totalHarga" class="text-lg font-semibold text-gray-700">Rp 0</div>
    </div>

    <button type="submit" class="w-full bg-[#f9d6d6] text-black text-base py-3 rounded-sm hover:bg-[#e6bcbc] transition">
        Lanjutkan ke Pembayaran
    </button>
</form>

<script>
    // Generate time slots from 10:00 to 21:00 in 15-minute intervals
    function generateTimeSlots() {
        const container = document.querySelector('#jamDropdown .grid');
        container.innerHTML = '';

        const startHour = 10;
        const endHour = 21;
        const interval = 15;

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let minute = 0; minute < 60; minute += interval) {
                if (hour === endHour && minute > 0) break;

                const timeStart = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                const nextMinute = minute + interval;
                const endHourAdj = nextMinute >= 60 ? hour + 1 : hour;
                const endMinute = nextMinute % 60;
                const timeEnd = `${endHourAdj.toString().padStart(2, '0')}:${endMinute.toString().padStart(2, '0')}`;

                const timeSlot = document.createElement('button');
                timeSlot.type = 'button';
                timeSlot.className = 'text-left px-3 py-2 text-sm hover:bg-gray-100 rounded';
                timeSlot.textContent = `${timeStart} - ${timeEnd}`;
                timeSlot.dataset.value = timeStart;

                timeSlot.addEventListener('click', function () {
                    document.getElementById('selectedJam').value = this.dataset.value;
                    document.getElementById('selectedJamText').textContent = this.textContent;
                    document.getElementById('jamDropdown').classList.add('hidden');
                    calculateTotal();
                });

                container.appendChild(timeSlot);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        generateTimeSlots();

        document.getElementById('jamDropdownBtn').addEventListener('click', function () {
            document.getElementById('jamDropdown').classList.toggle('hidden');
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('#jamDropdown') && !e.target.closest('#jamDropdownBtn')) {
                document.getElementById('jamDropdown').classList.add('hidden');
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
                calculateTotal();
            }
        });

        increaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(jumlahOrangInput.value);
            jumlahOrangInput.value = currentValue + 1;
            calculateTotal();
        });

        document.getElementById('id_studio').addEventListener('change', calculateTotal);
    });

    function calculateTotal() {
        const jumlahOrang = parseInt(document.getElementById('jumlahOrang').value) || 1;
        const studioSelect = document.getElementById('id_studio');
        const selectedOption = studioSelect.options[studioSelect.selectedIndex];
        const hargaText = selectedOption.textContent.match(/Rp([\d.]+)/);
        const hargaPerSlot = hargaText ? parseInt(hargaText[1].replace(/\./g, '')) : 0;

        // Jumlah slot default: 1 (15 menit)
        const jumlahSlot = 1; 
        const total = (hargaPerSlot * jumlahSlot) + (jumlahOrang * 5000);

        document.getElementById('totalHarga').textContent = `Rp ${total.toLocaleString('id-ID')}`;
    }
</script>

</body>

</html>