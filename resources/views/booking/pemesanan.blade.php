<html lang="en">
@php
    $user = Auth::user();
@endphp

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* Payment modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen flex flex-col">
    <header class="flex items-center justify-between px-4 py-3 bg-white shadow-sm relative">
        <button onclick="window.location.href='/'" class="flex items-center gap-2 text-sm font-normal text-black"
            type="button">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="relative">
            <button aria-label="Toggle user profile dropdown" id="profileBtn"
                class="text-black text-lg focus:outline-none" type="button">
                <i class="fas fa-user-circle"></i>
            </button>
            <div id="dropdownMenu"
                class="hidden absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow-md z-10">
                <button onclick="window.location.href='keluar'"
                    class="w-full text-left px-4 py-2 text-sm text-black hover:bg-gray-100" type="button">
                    Keluar
                </button>
            </div>
        </div>
    </header>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4 mx-auto w-full max-w-lg">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('pemesanan.simpan') }}"
        class="bg-white rounded-md mt-5 p-6 w-full max-w-lg mx-auto shadow-lg ring-1 ring-gray-300">
        @csrf

        <div id="form-error-display"
            class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        </div>

        <h2 class="text-center font-semibold text-xl mb-2">Form Pemesanan</h2>
        <p class="text-center text-base mb-6">Isi form di bawah ini untuk melakukan pemesanan</p>

        <label for="nama" class="block text-base mb-2">Nama Lengkap</label>
        <input id="nama" name="nama" type="text" required
            class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4"
            value="{{ Auth::user()->nama_lengkap ?? '' }}" readonly />

        <label for="no_hp" class="block text-base mb-2">No. Handphone</label>
        <input id="no_hp" name="no_hp" type="tel" required pattern="[0-9]+"
            class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4" value="{{ Auth::user()->telepon ?? '' }}"
            readonly />

        <label for="id_studio" class="block text-base mb-2">Studio</label>
        <select id="id_studio" name="id_studio" required class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4">
            <option value="" disabled selected>Pilih Studio</option>
            @foreach ($studioList as $studio)
                <option value="{{ $studio->id_studio }}">
                    {{ $studio->id_studio }} - {{ $studio->jenis_studio }} - {{ $studio->nama_studio }} -
                    Rp{{ number_format($studio->harga, 0, ',', '.') }}
                </option>
            @endforeach
        </select>

        <label for="tanggal" class="block text-base mb-2">Tanggal</label>
        <input id="tanggal" name="tanggal" type="date" required
            class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4" />

        <label for="jamDropdown" class="block text-base mb-2">Jam</label>
        <div class="relative mb-4">
            <button type="button" id="jamDropdownBtn"
                class="w-full text-left bg-gray-300 rounded-md px-4 py-2 flex justify-between items-center">
                <span id="selectedJamText">Pilih Jam</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div id="jamDropdown"
                class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-2 gap-1 p-2">
                </div>
            </div>
            <input type="hidden" id="selectedJam" name="jam" required />
        </div>

        <label for="jumlahOrang" class="block text-base mb-2">Jumlah Orang</label>
        <div class="flex items-center mb-4">
            <button type="button" id="decrease" class="bg-gray-300 px-3 py-1 rounded-l">-</button>
            <input id="jumlahOrang" name="jumlah_orang" type="number" min="1" value="1" required
                class="text-center w-full max-w-[60px] bg-gray-100 border border-gray-300" readonly />
            <button type="button" id="increase" class="bg-gray-300 px-3 py-1 rounded-r">+</button>
        </div>

        <div class="mb-4">
            <label class="block text-base mb-2">Total Harga:</label>
            <div id="totalHarga" class="text-lg font-semibold text-gray-700">Rp 0</div>
        </div>

        <button type="button" id="submitBtn"
            class="w-full bg-[#f9d6d6] text-black text-base py-3 rounded-sm hover:bg-[#e6bcbc] transition">
            Lanjutkan ke Pembayaran
        </button>
    </form>

    <div id="paymentModal" class="modal">
        <div class="modal-content relative">
            <h2 class="text-xl font-semibold text-center mb-4">Form Pembayaran</h2>

            <div class="mb-2">
                <p class="text-sm">Nama : <span id="modalNama" class="font-medium"></span></p>
            </div>
            <div class="mb-2">
                <p class="text-sm">No. Handphone : <span id="modalNoHp" class="font-medium"></span></p>
            </div>
            <div class="mb-2">
                <p class="text-sm">Pilih Studio : <span id="modalStudio" class="font-medium"></span></p>
            </div>
            <div class="mb-2">
                <p class="text-sm">Tanggal : <span id="modalTanggal" class="font-medium"></span></p>
            </div>
            <div class="mb-2">
                <p class="text-sm">Jam : <span id="modalJam" class="font-medium"></span></p>
            </div>
            <div class="mb-4">
                <p class="text-sm">Jumlah Orang : <span id="modalJumlahOrang" class="font-medium"></span></p>
            </div>

            <p class="text-sm mb-2">Transfer ke Rekening:</p>
            <p class="bg-gray-100 px-3 py-2 rounded mb-4">BNI a.n. ShutterSpace - 1234567890</p>

            <div class="mb-4">
                <label class="block text-base mb-2">Total Pembayaran :</label>
                <div id="modalTotalHarga" class="text-lg font-semibold text-gray-700">Rp 0</div>
            </div>

            <form method="POST" action="{{ route('bukti.upload') }}" enctype="multipart/form-data"
                id="paymentForm">
                @csrf
                <input type="hidden" name="id_pemesanan" id="modal_pemesanan_id">

                <label class="block text-base mb-2">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" required
                    class="w-full text-sm bg-gray-200 px-4 py-2 rounded mb-4">

                <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>

    <script>
        function generateTimeSlots() {
            const container = document.querySelector('#jamDropdown .grid');
            container.innerHTML = ''; // Clear existing slots

            const startHour = 10; // 10:00 AM
            const endHour = 21; // 09:00 PM (end time)
            const interval = 15; // minutes

            for (let currentMinute = startHour * 60; currentMinute < endHour * 60; currentMinute += interval) {
                const hourStart = Math.floor(currentMinute / 60);
                const minuteStart = currentMinute % 60;

                const timeStart = `${hourStart.toString().padStart(2, '0')}:${minuteStart.toString().padStart(2, '0')}`;

                const endMinute = currentMinute + interval;
                const hourEnd = Math.floor(endMinute / 60);
                const minuteEnd = endMinute % 60;

                const timeEnd = `${hourEnd.toString().padStart(2, '0')}:${minuteEnd.toString().padStart(2, '0')}`;

                const timeSlot = document.createElement('button');
                timeSlot.type = 'button';
                timeSlot.className = 'text-left px-3 py-2 text-sm hover:bg-gray-100 rounded';
                timeSlot.textContent = `${timeStart} - ${timeEnd}`;
                timeSlot.dataset.value = timeStart; // Store the start time for submission

                timeSlot.addEventListener('click', function() {
                    document.getElementById('selectedJam').value = this.dataset.value;
                    document.getElementById('selectedJamText').textContent = this.textContent;
                    document.getElementById('jamDropdown').classList.add('hidden');
                    calculateTotal(); // Recalculate total after selecting jam
                });

                container.appendChild(timeSlot);
            }
        }

        /**
         * Calculates and displays the total price based on selected studio,
         * number of people, and an assumed single time slot.
         */
        function calculateTotal() {
            const jumlahOrang = parseInt(document.getElementById('jumlahOrang').value) || 1;
            const studioSelect = document.getElementById('id_studio');
            const selectedOption = studioSelect.options[studioSelect.selectedIndex];

            // Extract price from the option text (e.g., "Rp100.000")
            const hargaText = selectedOption.textContent.match(/Rp([\d.]+)/);
            const hargaPerSlot = hargaText ? parseInt(hargaText[1].replace(/\./g, '')) : 0;

            // Assuming each booking is for one 15-minute slot (duration might be flexible later)
            const jumlahSlot = 1;

            // Additional cost per person (Rp5.000 per person)
            const biayaTambahanPerOrang = 5000;
            const total = (hargaPerSlot * jumlahSlot) + (jumlahOrang * biayaTambahanPerOrang);

            document.getElementById('totalHarga').textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }


        // --- DOM Elements ---
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const tanggalInput = document.getElementById('tanggal');
        const jamDropdownBtn = document.getElementById('jamDropdownBtn');
        const jamDropdown = document.getElementById('jamDropdown');
        const decreaseBtn = document.getElementById('decrease');
        const increaseBtn = document.getElementById('increase');
        const jumlahOrangInput = document.getElementById('jumlahOrang');
        const studioSelect = document.getElementById('id_studio');

        // Payment Modal Elements
        const modal = document.getElementById("paymentModal");
        const submitBtn = document.getElementById("submitBtn");
        const closeModalButtons = document.querySelectorAll(
            ".close-modal"); // Use querySelectorAll for multiple close buttons
        const bookingForm = document.querySelector("form[action='{{ route('pemesanan.simpan') }}']");
        const paymentForm = document.getElementById("paymentForm");
        const formErrorDisplay = document.getElementById('form-error-display');

        // --- Event Listeners ---

        // Toggle profile dropdown
        profileBtn.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        // Close profile dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Initialize date input min attribute to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.setAttribute('min', today);
            generateTimeSlots(); // Generate time slots on page load
            calculateTotal(); // Initial calculation on page load
        });

        // Event listener for date change
        tanggalInput.addEventListener('change', function() {
            // Clear selected jam when date changes
            document.getElementById('selectedJam').value = '';
            document.getElementById('selectedJamText').textContent = 'Pilih Jam';
            calculateTotal(); // Recalculate just in case date impacts price later
        });

        // Toggle jam dropdown
        jamDropdownBtn.addEventListener('click', function() {
            jamDropdown.classList.toggle('hidden');
        });

        // Close jam dropdown if clicked outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#jamDropdown') && !e.target.closest('#jamDropdownBtn')) {
                jamDropdown.classList.add('hidden');
            }
        });

        // Decrease number of people
        decreaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(jumlahOrangInput.value);
            if (currentValue > 1) {
                jumlahOrangInput.value = currentValue - 1;
                calculateTotal();
            }
        });

        // Increase number of people
        increaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(jumlahOrangInput.value);
            jumlahOrangInput.value = currentValue + 1;
            calculateTotal();
        });

        // Event listener for studio change
        studioSelect.addEventListener('change', function() {
            // Clear selected jam and recalculate total when studio changes
            document.getElementById('selectedJam').value = '';
            document.getElementById('selectedJamText').textContent = 'Pilih Jam';
            calculateTotal();
        });

        // --- Payment Modal Functionality ---

        submitBtn.addEventListener("click", async function(e) {
            e.preventDefault();

            // Validate form using native HTML5 validation
            if (!bookingForm.checkValidity()) {
                bookingForm.reportValidity();
                return;
            }

            // Hide previous client-side errors
            formErrorDisplay.classList.add('hidden');
            formErrorDisplay.innerHTML = '';

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            try {
                const formData = new FormData(bookingForm);
                const response = await fetch(bookingForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    // Handle validation errors from Laravel if any
                    if (response.status === 422 && data.errors) {
                        let errorMessages = '';
                        for (const key in data.errors) {
                            if (data.errors.hasOwnProperty(key)) {
                                errorMessages += `<p>${data.errors[key].join('<br>')}</p>`;
                            }
                        }
                        throw new Error(errorMessages || 'Validasi gagal.');
                    }
                    throw new Error(data.message || 'Terjadi kesalahan saat memproses pemesanan');
                }

                // Set the pemesanan ID in the payment form for actual submission
                document.getElementById("modal_pemesanan_id").value = data.id_pemesanan;

                // Populate the payment modal with booking details
                document.getElementById("modalNama").textContent = formData.get('nama');
                document.getElementById("modalNoHp").textContent = formData.get('no_hp');

                // For studio, extract only the studio name from the selected option text
                const selectedStudioOption = studioSelect.options[studioSelect.selectedIndex];
                // Assuming format like "ID - Jenis - Nama - RpPrice". We want "Nama" part.
                // Split by " - " and take the 3rd element (index 2).
                const studioNameMatch = selectedStudioOption.textContent.match(/ - ([^-]+) - Rp/);
                if (studioNameMatch && studioNameMatch[1]) {
                    document.getElementById("modalStudio").textContent = studioNameMatch[1].trim();
                } else {
                    // Fallback if the regex doesn't match perfectly
                    document.getElementById("modalStudio").textContent = selectedStudioOption.textContent.split(
                        ' - ')[2] || 'N/A';
                }


                document.getElementById("modalTanggal").textContent = formData.get('tanggal');
                document.getElementById("modalJam").textContent = document.getElementById('selectedJamText')
                    .textContent; // Use the displayed text for Jam
                document.getElementById("modalJumlahOrang").textContent = formData.get('jumlah_orang');
                document.getElementById("modalTotalHarga").textContent = document.getElementById('totalHarga')
                    .textContent;


                // Show the payment modal
                modal.style.display = "flex";

            } catch (error) {
                console.error('Error:', error);
                // Show error message to user
                formErrorDisplay.classList.remove('hidden');
                formErrorDisplay.innerHTML = `<p>${error.message || 'Terjadi kesalahan tidak dikenal.'}</p>`;

            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Lanjutkan ke Pembayaran';
            }
        });

        // Close modal when close buttons are clicked
        closeModalButtons.forEach(button => {
            button.addEventListener("click", function() {
                modal.style.display = "none";
            });
        });

        // Close modal if clicked outside of the modal content
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>

</body>

</html>
