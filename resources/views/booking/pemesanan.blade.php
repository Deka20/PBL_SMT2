<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Pemesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        /* General button transitions for hover effects */
        button {
            transition: transform 0.2s ease, filter 0.2s ease, background-color 0.2s ease;
        }

        button:hover {
            transform: translateY(-2px);
            filter: brightness(0.85);
            /* Darken on hover */
            background-color: #f3f4f6;
            /* Light gray background on hover */
        }

        /* Active menu item styling */
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
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Dark overlay */
            z-index: 1000;
            /* Ensure it's on top */
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
            position: relative;
            /* For absolute positioning of close button if added */
        }

        /* Close modal button (not directly used in JS but good to have) */
        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Style for booked time slots */
        .booked-slot {
            background-color: #f3f4f6;
            /* Lighter gray */
            color: #9ca3af;
            /* Grayed out text */
            cursor: not-allowed;
            /* Indicate it's not clickable */
            pointer-events: none;
            /* Ensures no click events are registered */
        }

        .booked-slot:hover {
            background-color: #f3f4f6 !important;
            /* Prevent hover effect */
        }

        /* Loading spinner animation */
        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top-color: #000;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .time-slot {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .time-slot:hover {
            background-color: #f3f4f6;
        }

        .booked-slot {
            background-color: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
            pointer-events: none;
        }

        .btn-inactive {
            background-color: #e5e7eb !important;
            color: #9ca3af !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }

        /* Style untuk tombol aktif */
        .btn-active {
            background-color: #d1d5db !important;
            color: #000 !important;
            cursor: pointer !important;
        }
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen flex flex-col">
    @php
        $user = Auth::user();
    @endphp

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

    {{-- Laravel Blade error display --}}
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

        {{-- Dynamic JavaScript error display --}}
        <div id="form-error-display"
            class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        </div>

        <h2 class="text-center font-semibold text-xl mb-2">Form Pemesanan</h2>
        <p class="text-center text-base mb-6">Isi form di bawah ini untuk melakukan pemesanan</p>

        <label for="nama" class="block text-base mb-2">Nama Lengkap</label>
        <input id="nama" name="nama" type="text" required
            class="w-full text-base rounded-full bg-gray-300 px-4 py-2 mb-4"
            value="{{ Auth::user()->nama_lengkap ?? '' }}" readonly />

        <label for="no_hp" class="block text-base mb-2">No. Handphone</label>
        <input id="no_hp" name="no_hp" type="tel" required pattern="[0-9]+"
            class="w-full text-base rounded-full bg-gray-300 px-4 py-2 mb-4" value="{{ Auth::user()->telepon ?? '' }}"
            readonly />

        <label for="id_studio" class="block text-base mb-2">Studio</label>
        <select id="id_studio" name="id_studio" required
            class="w-full text-base rounded-full bg-gray-300 px-4 py-2 mb-4">
            <option value="" disabled selected>Pilih Studio</option>
            @foreach ($studioList as $studio)
                <option value="{{ $studio->id_studio }}" data-kapasitas="{{ $studio->kapasitas }}">
                    {{ $studio->jenis_studio }} - {{ $studio->nama_studio }} (Kapasitas: {{ $studio->kapasitas }}
                    orang)
                    - Rp{{ number_format($studio->harga, 0, ',', '.') }}
                </option>
            @endforeach
        </select>

        <label for="tanggal" class="block text-base mb-2">Tanggal</label>
        <input id="tanggal" name="tanggal" type="date" required
            class="w-full text-base rounded-full bg-gray-300 px-4 py-2 mb-4" />

        <label for="jamDropdown" class="block text-base mb-2">Jam</label>
        <div class="relative mb-4">
            <button type="button" id="jamDropdownBtn"
                class="w-full text-left bg-gray-300 rounded-full px-4 py-2 flex justify-between items-center">
                <span id="selectedJamText">Pilih Jam</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div id="jamDropdown"
                class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto custom-scrollbar">
                <div id="timeSlotsContainer" class="grid grid-cols-2 gap-1 p-2">
                    {{-- Initial message for time slots --}}
                    <div class="col-span-2 p-2 text-center text-gray-500">
                        Pilih tanggal dan studio terlebih dahulu
                    </div>
                </div>
            </div>
            <input type="hidden" id="selectedJam" name="jam" required />
        </div>

        <label for="jumlahOrang" class="block text-base mb-2">Jumlah Orang</label>
        <div class="flex items-center mb-4">
            <button type="button" id="decrease" class="bg-gray-300 px-3 py-1 rounded-full">-</button>
            <input id="jumlahOrang" name="jumlah_orang" type="number" min="1" value="1" required
                class="text-center w-full max-w-[60px] mr-2 ml-2 rounded-full bg-gray-100 border border-gray-300"
                readonly />
            <button type="button" id="increase" class="bg-gray-300 px-3 py-1 rounded-full">+</button>
        </div>
        <div id="kapasitasInfo" class="text-sm text-gray-600 mb-4">
            Kapasitas studio: <span id="kapasitasValue">-</span> orang
        </div>

        <div class="mb-4">
            <label class="block text-base mb-2">Total Harga:</label>
            <div id="totalHarga" class="text-lg font-semibold text-gray-700">Rp 0</div>
        </div>

        <button type="button" id="submitBtn"
            class="w-full bg-black text-white text-base py-3 rounded-xl transition">
            Lanjutkan ke Pembayaran
        </button>
    </form>

    {{-- Payment Modal --}}
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
        // --- DOM Elements ---
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const tanggalInput = document.getElementById('tanggal');
        const jamDropdownBtn = document.getElementById('jamDropdownBtn');
        const jamDropdown = document.getElementById('jamDropdown');
        const timeSlotsContainer = document.getElementById('timeSlotsContainer');
        const decreaseBtn = document.getElementById('decrease');
        const increaseBtn = document.getElementById('increase');
        const jumlahOrangInput = document.getElementById('jumlahOrang');
        const studioSelect = document.getElementById('id_studio');
        const submitBtn = document.getElementById('submitBtn');
        const modal = document.getElementById('paymentModal');
        const bookingForm = document.querySelector('form[action="{{ route('pemesanan.simpan') }}"]');
        const paymentForm = document.getElementById('paymentForm');
        const formErrorDisplay = document.getElementById('form-error-display');

        // Initialize kapasitasStudio to a reasonable default or 0, it will be updated when a studio is selected.
        let kapasitasStudio = 0;


        // --- Event Listeners ---
        document.addEventListener('DOMContentLoaded', function() {
            // Set min date to today
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.setAttribute('min', today);

            // Set initial button states. They should be handled by updateButtonStates() after a studio is selected.
            // Initially, since no studio is selected, the capacity is unknown or 0.
            // So, avoid setting them based on an unknown capacity.
            updateKapasitasInfo
                (); // This will initialize kapasitasStudio based on the *currently selected* (or default) studio.
            // If no studio is selected by default, kapasitasStudio will be 0, and the buttons will be inactive until a studio is picked.
        });


        // Profile dropdown toggle
        profileBtn.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            // Check if the click is outside the profile button and the dropdown menu
            if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Date change handler
        tanggalInput.addEventListener('change', function() {
            // Clear selected jam when date changes
            document.getElementById('selectedJam').value = '';
            document.getElementById('selectedJamText').textContent = 'Pilih Jam';
            generateTimeSlots(); // Regenerate time slots for the new date
            calculateTotal();
        });

        // Studio change handler
        studioSelect.addEventListener('change', function() {
            // Clear selected jam when studio changes
            document.getElementById('selectedJam').value = '';
            document.getElementById('selectedJamText').textContent = 'Pilih Jam';
            updateKapasitasInfo(); // Update capacity info when studio changes
            generateTimeSlots(); // Regenerate time slots for the new studio
        });

        // Toggle time slots dropdown
        jamDropdownBtn.addEventListener('click', function() {
            jamDropdown.classList.toggle('hidden');
            // Only generate time slots if the dropdown is becoming visible
            if (!jamDropdown.classList.contains('hidden')) {
                generateTimeSlots();
            }
        });

        // Close time slots dropdown when clicking outside
        document.addEventListener('click', function(e) {
            // Check if the click is outside the dropdown container and the button that triggers it
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
                updateButtonStates();
            }
        });

        // Increase number of people
        increaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(jumlahOrangInput.value);
            // Only allow increment if current value is less than studio capacity
            if (currentValue < kapasitasStudio) {
                jumlahOrangInput.value = currentValue + 1;
                calculateTotal();
                updateButtonStates();
            }
        });


        // --- Functions ---

        /**
         * Generates time slots and marks booked slots as unavailable
         */
        async function generateTimeSlots() {
            const selectedDate = tanggalInput.value;
            const selectedStudio = studioSelect.value;

            // Validasi input
            if (!selectedDate || !selectedStudio) {
                timeSlotsContainer.innerHTML = `
                <div class="col-span-2 p-2 text-center text-gray-500">
                    Pilih tanggal dan studio terlebih dahulu
                </div>
            `;
                return;
            }

            // Tampilkan loading
            timeSlotsContainer.innerHTML = `
            <div class="col-span-2 p-2 text-center">
                <span class="loading-spinner"></span> Memuat slot waktu...
            </div>
        `;

            try {
                const response = await fetch('/booked-slots', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        tanggal: selectedDate,
                        id_studio: selectedStudio
                    })
                });

                const bookedSlots = await response.json();

                if (!response.ok) {
                    throw new Error(bookedSlots.message || 'Gagal memuat data');
                }

                // Generate time slots dari jam 10:00 sampai 21:00 dengan interval 15 menit
                const startHour = 10;
                const endHour = 21;
                const interval = 15;
                let slotsHTML = '';

                for (let currentMinute = startHour * 60; currentMinute < endHour * 60; currentMinute += interval) {
                    const hourStart = Math.floor(currentMinute / 60);
                    const minuteStart = currentMinute % 60;
                    const timeStart = `${String(hourStart).padStart(2, '0')}:${String(minuteStart).padStart(2, '0')}`;

                    const endMinute = currentMinute + interval;
                    const hourEnd = Math.floor(endMinute / 60);
                    const minuteEnd = endMinute % 60;
                    const timeEnd = `${String(hourEnd).padStart(2, '0')}:${String(minuteEnd).padStart(2, '0')}`;

                    // Cek apakah slot waktu ini sudah dipesan
                    const isBooked = bookedSlots.some(slot => {
                        const [bookedHour, bookedMinute] = slot.split(':').map(Number);
                        const bookedTime = new Date();
                        bookedTime.setHours(bookedHour, bookedMinute, 0, 0);

                        const currentTime = new Date();
                        currentTime.setHours(hourStart, minuteStart, 0, 0);

                        // Hitung selisih waktu dalam menit
                        const diffInMinutes = (currentTime - bookedTime) / (1000 * 60);
                        return Math.abs(diffInMinutes) < 15;
                    });

                    if (isBooked) {
                        slotsHTML += `
                        <div class="text-left px-3 py-2 text-sm rounded bg-gray-200 text-gray-500 cursor-not-allowed">
                            ${timeStart} - ${timeEnd}
                            <span class="text-xs block">Sudah dipesan</span>
                        </div>
                    `;
                    } else {
                        slotsHTML += `
                        <button type="button"
                            class="time-slot text-left px-3 py-2 text-sm hover:bg-gray-100 rounded"
                            data-value="${timeStart}"
                            onclick="selectTimeSlot(this, '${timeStart} - ${timeEnd}')">
                            ${timeStart} - ${timeEnd}
                        </button>
                    `;
                    }
                }

                timeSlotsContainer.innerHTML = slotsHTML;

            } catch (error) {
                console.error('Error:', error);
                timeSlotsContainer.innerHTML = `
                <div class="col-span-2 p-2 text-center text-red-500">
                    ${error.message || 'Gagal memuat slot waktu'}
                </div>
            `;
            }
        }

        /**
         * Selects a time slot and updates the hidden input and displayed text.
         * @param {HTMLElement} element - The clicked button element.
         * @param {string} displayText - The formatted text to display for the selected time.
         */
        function selectTimeSlot(element, displayText) {
            // Update the hidden input with the selected time
            document.getElementById('selectedJam').value = element.dataset.value;
            // Update the displayed text on the jam selection button
            document.getElementById('selectedJamText').textContent = displayText;
            // Hide the dropdown after selection
            document.getElementById('jamDropdown').classList.add('hidden');
            calculateTotal(); // Recalculate total as time might influence pricing in more complex scenarios
        }

        function updateButtonStates() {
            const currentValue = parseInt(jumlahOrangInput.value) || 1;

            // Tombol -
            if (currentValue <= 1) {
                decreaseBtn.classList.add('btn-inactive');
                decreaseBtn.classList.remove('btn-active');
            } else {
                decreaseBtn.classList.add('btn-active');
                decreaseBtn.classList.remove('btn-inactive');
            }

            // Tombol +
            // Only activate if a studio is selected and current value is less than capacity
            if (kapasitasStudio > 0 && currentValue < kapasitasStudio) {
                increaseBtn.classList.add('btn-active');
                increaseBtn.classList.remove('btn-inactive');
            } else {
                increaseBtn.classList.add('btn-inactive');
                increaseBtn.classList.remove('btn-active');
            }
        }


        /**
         * Calculates the total price based on the number of people and selected studio.
         */
        function calculateTotal() {
            const jumlahOrang = parseInt(jumlahOrangInput.value) || 1;
            const selectedOption = studioSelect.options[studioSelect.selectedIndex];

            // If no studio is selected, set a default capacity (e.g., 1 or 0)
            if (!selectedOption || selectedOption.value === "") {
                kapasitasStudio = 0; // Or a suitable default if you want to allow some booking without studio selection
                document.getElementById('totalHarga').textContent = `Rp 0`;
                updateKapasitasInfo(); // Update display and button states for no studio selected
                return;
            }

            // Extract capacity from the selected studio option
            kapasitasStudio = parseInt(selectedOption.getAttribute('data-kapasitas')) || 0;

            // Ensure jumlahOrang does not exceed the current studio's capacity
            if (jumlahOrang > kapasitasStudio) {
                // Do NOT show an alert here on initial load.
                // This alert should ideally only trigger on user interaction (e.g., increasing the number).
                // For initial load or selection change, just cap the value.
                jumlahOrangInput.value = kapasitasStudio > 0 ? kapasitasStudio :
                    1; // Cap to capacity or default to 1 if capacity is 0
                // You could add a temporary message here if you want to inform the user silently.
            }
            if (jumlahOrangInput.value < 1) {
                jumlahOrangInput.value = 1;
            }


            // Extract price from the option's text content using a regex
            const hargaText = selectedOption.textContent.match(/Rp([\d.]+)/);
            // Parse the extracted price, removing dots for thousands separators
            const hargaPerSlot = hargaText ? parseInt(hargaText[1].replace(/\./g, '')) : 0;

            // Define additional cost per person (after the first person)
            const biayaTambahanPerOrang = 5000;
            // Calculate total: base price + (number of additional people * cost per additional person)
            const total = hargaPerSlot + (Math.max(0, jumlahOrangInput.value - 1) * biayaTambahanPerOrang);

            // Display the formatted total price
            document.getElementById('totalHarga').textContent = `Rp ${total.toLocaleString('id-ID')}`;
            updateButtonStates(); // Re-evaluate button states after calculations
        }


        // --- Payment Modal Functionality ---

        submitBtn.addEventListener('click', async function(e) {
            e.preventDefault(); // Prevent default form submission

            // Client-side form validation using HTML5 built-in validation
            if (!bookingForm.checkValidity()) {
                bookingForm.reportValidity(); // Show native browser validation messages
                return; // Stop execution if form is not valid
            }

            // Hide any previous server-side validation errors
            formErrorDisplay.classList.add('hidden');
            formErrorDisplay.innerHTML = '';

            // Show loading state for the button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            try {
                const formData = new FormData(bookingForm);
                const response = await fetch(bookingForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json', // Expect JSON response
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json(); // Parse response body as JSON

                if (!response.ok) {
                    // Handle server-side validation errors (status 422)
                    if (response.status === 422 && data.errors) {
                        let errorMessages = '';
                        for (const key in data.errors) {
                            if (data.errors.hasOwnProperty(key)) {
                                errorMessages += `<p>${data.errors[key].join('<br>')}</p>`;
                            }
                        }
                        // Throw an error with collected messages to be caught by the catch block
                        throw new Error(errorMessages || 'Validasi gagal.');
                    }
                    // Handle other HTTP errors (e.g., 500 server error)
                    throw new Error(data.message || 'Terjadi kesalahan saat memproses pemesanan');
                }

                // If booking is successful:
                document.getElementById('modal_pemesanan_id').value = data
                    .id_pemesanan; // Set booking ID for payment form

                // Populate modal details from form data
                document.getElementById('modalNama').textContent = formData.get('nama');
                document.getElementById('modalNoHp').textContent = formData.get('no_hp');

                // Extract studio name for the modal display
                const selectedStudioOption = studioSelect.options[studioSelect.selectedIndex];
                const studioNameMatch = selectedStudioOption.textContent.match(/ - ([^-]+) - Rp/);
                document.getElementById('modalStudio').textContent = studioNameMatch ?
                    studioNameMatch[1].trim() : selectedStudioOption.textContent.split(' - ')[2] || 'N/A';

                document.getElementById('modalTanggal').textContent = formData.get('tanggal');
                document.getElementById('modalJam').textContent = document.getElementById('selectedJamText')
                    .textContent;
                document.getElementById('modalJumlahOrang').textContent = formData.get('jumlah_orang');
                document.getElementById('modalTotalHarga').textContent = document.getElementById(
                    'totalHarga').textContent;

                // Show the payment modal
                modal.style.display = 'flex';

            } catch (error) {
                console.error('Error:', error);
                // Display error message in the form's error display area
                formErrorDisplay.classList.remove('hidden');
                formErrorDisplay.innerHTML =
                    `<p>${error.message || 'Terjadi kesalahan tidak dikenal.'}</p>`;
            } finally {
                // Always reset button state after request completes
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Lanjutkan ke Pembayaran';
            }
        });

        // Close modal when clicking outside of the modal content
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });

        // Make selectTimeSlot function globally accessible for onclick attributes
        window.selectTimeSlot = selectTimeSlot;

        // --- Fungsi Baru ---
        function updateKapasitasInfo() {
            const selectedOption = studioSelect.options[studioSelect.selectedIndex];

            // Only update kapasitasStudio if a valid studio is selected
            if (selectedOption && selectedOption.value !== "") {
                kapasitasStudio = parseInt(selectedOption.getAttribute('data-kapasitas')) || 0;
            } else {
                kapasitasStudio = 0; // Reset to 0 if no studio or "Pilih Studio" is selected
            }

            document.getElementById('kapasitasValue').textContent = kapasitasStudio;
            jumlahOrangInput.setAttribute('max', kapasitasStudio);

            // Adjust jumlahOrang if it exceeds the new capacity, but do not alert on load
            // or when a studio is changed, just cap the value.
            if (parseInt(jumlahOrangInput.value) > kapasitasStudio && kapasitasStudio > 0) {
                jumlahOrangInput.value = kapasitasStudio;
            } else if (kapasitasStudio === 0) {
                // If no studio is selected (capacity 0), default to 1 person if not already 0.
                // This prevents issues with calculation, but the user still needs to pick a studio.
                // Maybe set to 1, or keep it at 1 if it was already 1.
                if (parseInt(jumlahOrangInput.value) > 1) { // Only reset if it was something else, and capacity is 0
                    jumlahOrangInput.value = 1;
                }
            }


            updateButtonStates(); // Update tombol +/-
            calculateTotal(); // Recalculate total as capacity changes might influence it.
        }
    </script>
</body>

</html>
