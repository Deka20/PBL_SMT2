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
        button {
            transition: all 0.2s ease;
        }

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
            position: relative;
        }

        .booked-slot {
            background-color: #f3f4f6 !important;
            color: #9ca3af !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            border: 1px solid #e5e7eb !important;
        }

        .processing-slot {
            background-color: #fff3cd !important;
            color: #856404 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            border: 1px solid #ffeeba !important;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .time-slot {
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-inactive {
            background-color: #e5e7eb !important;
            color: #9ca3af !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }

        .time-slot.selected {
            background-color: #fce4ec;
            border: 1px solid #d94c82;
        }

        .selected-slots-container {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 8px;
        }

        .selected-slot-tag {
            background-color: #fce4ec;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
            display: flex;
            align-items: center;
            color: #d94c82;
        }

        .remove-slot-btn {
            margin-left: 4px;
            cursor: pointer;
            color: #d94c82;
        }

        .summary-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            height: fit-content;
        }

        .summary-title {
            color: #d94c82;
            font-weight: 600;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .summary-item {
            margin-bottom: 0.75rem;
        }

        .summary-label {
            font-weight: 500;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .summary-value {
            font-weight: 600;
            color: #111827;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            color: #d94c82;
            font-weight: 600;
        }

        .form-input {
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: #d94c82;
            box-shadow: 0 0 0 3px rgba(217, 76, 130, 0.1);
        }

        .form-label {
            color: #4b5563;
            font-weight: 500;
        }

        .primary-button {
            background-color: #d94c82;
            color: white;
            transition: all 0.2s;
        }

        .primary-button:hover {
            background-color: #c04472;
            transform: translateY(-1px);
        }

        .dropdown-button {
            border: 1px solid #e5e7eb;
            transition: all 0.2s;
        }

        .dropdown-button:hover {
            border-color: #d94c82;
        }

        .dropdown-content {
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .number-input-button {
            background-color: #f3f4f6;
            transition: all 0.2s;
        }

        .number-input-button:hover {
            background-color: #e5e7eb;
        }

        .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top-color: #d94c82;
            animation: spin 1s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen">
    @php
        $user = Auth::user();
    @endphp

    <header class="flex items-center justify-between px-6 py-4 bg-white shadow-sm">
        <button onclick="window.location.href='/'"
            class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-[#d94c82]" type="button">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="relative">
            <button aria-label="Toggle user profile dropdown" id="profileBtn"
                class="text-gray-700 text-lg focus:outline-none hover:text-[#d94c82]" type="button">
                <i class="fas fa-user-circle"></i>
            </button>
            <div id="dropdownMenu"
                class="hidden absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow-md z-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button onclick="event.preventDefault(); this.closest('form').submit();"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d94c82]"
                        type="button">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- Laravel Blade error display --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4 mx-auto w-full max-w-4xl">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <h1 class="text-2xl font-bold text-[#d94c82] mb-2">Pemesanan Studio</h1>
        <p class="text-gray-600 mb-8">Isi formulir di bawah ini untuk melakukan pemesanan studio</p>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Form Section --}}
            <div class="w-full lg:w-2/3">
                <div class="form-container p-6">
                    <form method="POST" action="{{ route('pemesanan.simpan') }}" id="bookingForm">
                        @csrf

                        <div id="form-error-display"
                            class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        </div>

                        <h2 class="form-title text-xl mb-6">Detail Pemesanan</h2>

                        <div class="mb-6">
                            <label for="nama" class="form-label block mb-2">Nama Lengkap</label>
                            <input id="nama" name="nama" type="text" required
                                class="form-input w-full rounded-lg bg-gray-50 px-4 py-3"
                                value="{{ Auth::user()->nama_lengkap ?? '' }}" readonly />
                        </div>

                        <div class="mb-6">
                            <label for="no_hp" class="form-label block mb-2">No. Handphone</label>
                            <input id="no_hp" name="no_hp" type="tel" required pattern="[0-9]+"
                                class="form-input w-full rounded-lg bg-gray-50 px-4 py-3"
                                value="{{ Auth::user()->telepon ?? '' }}" readonly />
                        </div>

                        <div class="mb-6">
                            <label for="id_studio" class="form-label block mb-2">Studio</label>
                            <select id="id_studio" name="id_studio" required
                                class="form-input w-full rounded-lg bg-gray-50 px-4 py-3">
                                <option value="" disabled selected>Pilih Studio</option>
                                @foreach ($studioList as $studio)
                                    <option value="{{ $studio->id_studio }}" data-kapasitas="{{ $studio->kapasitas }}"
                                        data-harga="{{ $studio->harga }}">
                                        {{ $studio->jenis_studio }} - {{ $studio->nama_studio }} (Kapasitas:
                                        {{ $studio->kapasitas }}
                                        orang)
                                        - Rp{{ number_format($studio->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="tanggal" class="form-label block mb-2">Tanggal</label>
                            <input id="tanggal" name="tanggal" type="date" required
                                class="form-input w-full rounded-lg bg-gray-50 px-4 py-3" />
                        </div>

                        <div class="mb-6">
                            <label for="jamDropdown" class="form-label block mb-2">Jam</label>
                            <div class="relative">
                                <button type="button" id="jamDropdownBtn"
                                    class="dropdown-button w-full text-left bg-gray-50 rounded-lg px-4 py-3 flex justify-between items-center">
                                    <span id="selectedJamText">Pilih Jam</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>

                                <!-- Dropdown -->
                                <div id="jamDropdown"
                                    class="hidden absolute z-10 w-full mt-1 bg-white rounded-lg dropdown-content max-h-60 overflow-hidden shadow-lg border border-gray-200">

                                    <!-- Scrollable container -->
                                    <div class="max-h-48 overflow-y-auto custom-scrollbar">
                                        <div id="timeSlotsContainer" class="grid grid-cols-2 gap-1 p-2">
                                            <div class="col-span-2 p-2 text-center text-gray-500">
                                                Pilih tanggal dan studio terlebih dahulu
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sticky Footer -->
                                    <div
                                        class="p-2 border-t border-gray-200 sticky bottom-0 bg-white flex justify-between items-center">
                                        <button type="button" id="selectAllBtn"
                                            class="text-sm text-[#d94c82] hover:underline">
                                            Pilih Semua
                                        </button>
                                        <button type="button" id="confirmSelectionBtn"
                                            class="px-3 py-1 bg-[#d94c82] text-white rounded text-sm">
                                            Konfirmasi
                                        </button>
                                    </div>
                                </div>

                                <!-- Selected slots display -->
                                <div id="selectedSlotsDisplay" class="mt-2 hidden">
                                    <div class="text-sm text-gray-600">Slot waktu yang dipilih:</div>
                                    <div id="selectedSlotsList" class="selected-slots-container"></div>
                                </div>
                                <input type="hidden" id="selectedJam" name="jam" required />
                            </div>
                        </div>


                        <div class="mb-6">
                            <label for="jumlahOrang" class="form-label block mb-2">Jumlah Orang</label>
                            <div class="flex items-center">
                                <button type="button" id="decrease"
                                    class="number-input-button px-4 py-2 rounded-l-lg">-</button>
                                <input id="jumlahOrang" name="jumlah_orang" type="number" min="1"
                                    value="1" required
                                    class="text-center w-full max-w-[60px] bg-gray-50 border-t border-b border-gray-300 py-2"
                                    readonly />
                                <button type="button" id="increase"
                                    class="number-input-button px-4 py-2 rounded-r-lg">+</button>
                            </div>
                            <div id="kapasitasInfo" class="text-sm text-gray-500 mt-2">
                                Kapasitas studio: <span id="kapasitasValue">-</span> orang
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-lg font-medium text-gray-700">Total Harga:</span>
                                <span id="totalHarga" class="text-xl font-bold text-[#d94c82]">Rp 0</span>
                            </div>
                            <button type="button" id="submitBtn"
                                class="primary-button w-full text-lg py-3 rounded-lg font-medium">
                                Lanjutkan ke Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Summary Card --}}
            <div class="w-full lg:w-1/3">
                <div class="summary-card sticky top-8">
                    <h3 class="summary-title">Ringkasan Pemesanan</h3>

                    <div class="summary-item">
                        <div class="summary-label">Nama</div>
                        <div id="summaryNama" class="summary-value">{{ Auth::user()->nama_lengkap ?? '-' }}</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">No. HP</div>
                        <div id="summaryNoHp" class="summary-value">{{ Auth::user()->telepon ?? '-' }}</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Studio</div>
                        <div id="summaryStudio" class="summary-value">-</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Tanggal</div>
                        <div id="summaryTanggal" class="summary-value">-</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Jam</div>
                        <div id="summaryJam" class="summary-value">-</div>
                    </div>

                    <div class="summary-item">
                        <div class="summary-label">Jumlah Orang</div>
                        <div id="summaryJumlahOrang" class="summary-value">1</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Payment Modal --}}
    <div id="paymentModal" class="modal">
        <div class="modal-content relative">
            <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-[#d94c82]">
                <i class="fas fa-times"></i>
            </button>

            <h2 class="text-xl font-semibold text-[#d94c82] text-center mb-4">Form Pembayaran</h2>

            <div class="space-y-3 mb-4">
                <div class="summary-item">
                    <div class="summary-label">Nama</div>
                    <div id="modalNama" class="summary-value"></div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">No. Handphone</div>
                    <div id="modalNoHp" class="summary-value"></div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Studio</div>
                    <div id="modalStudio" class="summary-value"></div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Tanggal</div>
                    <div id="modalTanggal" class="summary-value"></div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Jam</div>
                    <div id="modalJam" class="summary-value"></div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Jumlah Orang</div>
                    <div id="modalJumlahOrang" class="summary-value"></div>
                </div>
            </div>

            <div class="mb-4 bg-gray-50 p-3 rounded-lg">
                <p class="text-sm font-medium text-gray-700 mb-2">Transfer ke Rekening:</p>
                <p class="font-medium">BNI a.n. Potretine - 1234567890</p>
            </div>

            <div class="mb-4">
                <label class="block text-base font-medium text-gray-700 mb-2">Total Pembayaran :</label>
                <div id="modalTotalHarga" class="text-xl font-bold text-[#d94c82]">Rp 0</div>
            </div>

            <form method="POST" action="{{ route('bukti.upload') }}" enctype="multipart/form-data"
                id="paymentForm">
                @csrf
                <input type="hidden" name="id_pemesanan" id="modal_pemesanan_id">

                <label class="block text-base font-medium text-gray-700 mb-2">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" required
                    class="w-full text-sm bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 mb-4">

                <button type="submit" class="primary-button w-full text-lg py-3 rounded-lg font-medium">
                    Kirim Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>

    <script>
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
        const closeModalBtn = document.getElementById('closeModal');
        const bookingForm = document.getElementById('bookingForm');
        const paymentForm = document.getElementById('paymentForm');
        const formErrorDisplay = document.getElementById('form-error-display');
        const selectAllBtn = document.getElementById('selectAllBtn');
        const confirmSelectionBtn = document.getElementById('confirmSelectionBtn');
        const selectedSlotsDisplay = document.getElementById('selectedSlotsDisplay');
        const selectedSlotsList = document.getElementById('selectedSlotsList');

        const summaryNama = document.getElementById('summaryNama');
        const summaryNoHp = document.getElementById('summaryNoHp');
        const summaryStudio = document.getElementById('summaryStudio');
        const summaryTanggal = document.getElementById('summaryTanggal');
        const summaryJam = document.getElementById('summaryJam');
        const summaryJumlahOrang = document.getElementById('summaryJumlahOrang');
        const summaryTotalHarga = document.getElementById('summaryTotalHarga');

        let kapasitasStudio = 0;
        let selectedTimeSlots = [];
        let allTimeSlots = [];

        // --- Event Listeners ---
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            tanggalInput.setAttribute('min', today);
            updateKapasitasInfo();
        });

        profileBtn.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        tanggalInput.addEventListener('change', function() {
            selectedTimeSlots = [];
            updateSelectedSlotsDisplay();
            generateTimeSlots();
            calculateTotal();
            updateSummary();
        });

        studioSelect.addEventListener('change', function() {
            selectedTimeSlots = [];
            updateSelectedSlotsDisplay();
            updateKapasitasInfo();
            generateTimeSlots();
            updateSummary();
        });

        jamDropdownBtn.addEventListener('click', function() {
            jamDropdown.classList.toggle('hidden');
            if (!jamDropdown.classList.contains('hidden')) {
                generateTimeSlots();
            }
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('#jamDropdown') && !e.target.closest('#jamDropdownBtn')) {
                jamDropdown.classList.add('hidden');
            }
        });

        decreaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(jumlahOrangInput.value);
            if (currentValue > 1) {
                jumlahOrangInput.value = currentValue - 1;
                calculateTotal();
                updateButtonStates();
                updateSummary();
            }
        });

        increaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(jumlahOrangInput.value);
            if (currentValue < kapasitasStudio) {
                jumlahOrangInput.value = currentValue + 1;
                calculateTotal();
                updateButtonStates();
                updateSummary();
            }
        });

        selectAllBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.time-slot-checkbox:not(:disabled)');
            const allSelected = Array.from(checkboxes).every(checkbox => checkbox.checked);

            checkboxes.forEach(checkbox => {
                checkbox.checked = !allSelected;
                const slotElement = checkbox.closest('.time-slot');
                if (checkbox.checked) {
                    slotElement.classList.add('selected');
                } else {
                    slotElement.classList.remove('selected');
                }
            });
        });

        confirmSelectionBtn.addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.time-slot-checkbox:checked');
            selectedTimeSlots = Array.from(checkboxes).map(checkbox => {
                return {
                    value: checkbox.value,
                    displayText: checkbox.dataset.displayText
                };
            });

            updateSelectedSlotsDisplay();
            jamDropdown.classList.add('hidden');
            calculateTotal();
            updateSummary();
        });

        closeModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });

        function updateSummary() {
            summaryNama.textContent = document.getElementById('nama').value;
            summaryNoHp.textContent = document.getElementById('no_hp').value;

            const selectedStudioOption = studioSelect.options[studioSelect.selectedIndex];
            if (selectedStudioOption && selectedStudioOption.value !== "") {
                const studioNameMatch = selectedStudioOption.textContent.match(/ - ([^-]+) - Rp/);
                summaryStudio.textContent = studioNameMatch ?
                    studioNameMatch[1].trim() : selectedStudioOption.textContent.split(' - ')[2] || 'N/A';
            } else {
                summaryStudio.textContent = '-';
            }

            summaryTanggal.textContent = tanggalInput.value || '-';

            if (selectedTimeSlots.length > 0) {
                summaryJam.textContent = selectedTimeSlots.map(slot => slot.displayText).join(', ');
            } else {
                summaryJam.textContent = '-';
            }

            summaryJumlahOrang.textContent = jumlahOrangInput.value;

            summaryTotalHarga.textContent = document.getElementById('totalHarga').textContent;
        }

        function updateSelectedSlotsDisplay() {
            if (selectedTimeSlots.length === 0) {
                selectedSlotsDisplay.classList.add('hidden');
                document.getElementById('selectedJamText').textContent = 'Pilih Jam';
                document.getElementById('selectedJam').value = '';
                return;
            }

            selectedSlotsDisplay.classList.remove('hidden');
            document.getElementById('selectedJamText').textContent = `${selectedTimeSlots.length} slot dipilih`;

            document.getElementById('selectedJam').value = selectedTimeSlots.map(slot => slot.value).join(',');

            selectedSlotsList.innerHTML = '';
            selectedTimeSlots.forEach((slot, index) => {
                const slotTag = document.createElement('div');
                slotTag.className = 'selected-slot-tag';
                slotTag.innerHTML = `
                ${slot.displayText}
                <span class="remove-slot-btn" data-index="${index}">
                    <i class="fas fa-times"></i>
                </span>
            `;
                selectedSlotsList.appendChild(slotTag);
            });

            document.querySelectorAll('.remove-slot-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    selectedTimeSlots.splice(index, 1);
                    updateSelectedSlotsDisplay();
                    calculateTotal();
                    updateSummary();

                    const checkboxes = document.querySelectorAll('.time-slot-checkbox');
                    checkboxes.forEach(checkbox => {
                        if (checkbox.value === selectedTimeSlots[index]?.value) {
                            checkbox.checked = false;
                            checkbox.closest('.time-slot').classList.remove('selected');
                        }
                    });
                });
            });
        }

        async function generateTimeSlots() {
            const selectedDate = tanggalInput.value;
            const selectedStudio = studioSelect.value;

            if (!selectedDate || !selectedStudio) {
                timeSlotsContainer.innerHTML = `
                <div class="col-span-2 p-2 text-center text-gray-500">
                    Pilih tanggal dan studio terlebih dahulu
                </div>
            `;
                return;
            }

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

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal memuat data');
                }

                const bookedSlots = Array.isArray(data.booked) ? data.booked : [];
                const processingSlots = Array.isArray(data.processing) ? data.processing : [];

                const startHour = 10;
                const endHour = 21;
                const interval = 15;
                let slotsHTML = '';
                allTimeSlots = [];

                for (let currentMinute = startHour * 60; currentMinute < endHour * 60; currentMinute += interval) {
                    const hourStart = Math.floor(currentMinute / 60);
                    const minuteStart = currentMinute % 60;
                    const timeStart = `${String(hourStart).padStart(2, '0')}:${String(minuteStart).padStart(2, '0')}`;

                    const endMinute = currentMinute + interval;
                    const hourEnd = Math.floor(endMinute / 60);
                    const minuteEnd = endMinute % 60;
                    const timeEnd = `${String(hourEnd).padStart(2, '0')}:${String(minuteEnd).padStart(2, '0')}`;
                    const displayText = `${timeStart} - ${timeEnd}`;

                    // Cek apakah slot waktu ini sudah dipesan
                    const isBooked = bookedSlots.some(slot => {
                        const slotTime = typeof slot === 'string' ? slot : String(slot);
                        const [bookedHour, bookedMinute] = slotTime.split(':').map(Number);

                        if (isNaN(bookedHour)) return false;

                        return bookedHour === hourStart && bookedMinute === minuteStart;
                    });

                    // Cek apakah slot waktu ini sedang dalam proses pembayaran
                    const isProcessing = processingSlots.some(slot => {
                        const slotTime = typeof slot === 'string' ? slot : String(slot);
                        const [processingHour, processingMinute] = slotTime.split(':').map(Number);

                        if (isNaN(processingHour)) return false;

                        return processingHour === hourStart && processingMinute === minuteStart;
                    });

                    allTimeSlots.push({
                        value: timeStart,
                        displayText: displayText,
                        isBooked: isBooked,
                        isProcessing: isProcessing
                    });

                    if (isBooked) {
                        slotsHTML += `
                <div class="booked-slot text-left px-3 py-2 text-sm rounded flex items-center">
                    <span class="mr-2">❌</span>
                    ${displayText}
                    <span class="text-xs block ml-2">Sudah dipesan</span>
                </div>
            `;
                    } else if (isProcessing) {
                        slotsHTML += `
                <div class="processing-slot text-left px-3 py-2 text-sm rounded flex items-center">
                    <span class="mr-2"></span>
                    ${displayText}
                    <span class="text-xs block ml-2">Studio sudah dipesan</span>
                </div>
            `;
                    } else {
                        const isSelected = selectedTimeSlots.some(slot => slot.value === timeStart);

                        slotsHTML += `
                <label class="time-slot text-left px-3 py-2 text-sm hover:bg-gray-100 rounded flex items-center border border-gray-200 ${isSelected ? 'selected' : ''}">
                    <input type="checkbox" class="time-slot-checkbox mr-2" value="${timeStart}" 
                        data-display-text="${displayText}"
                        ${isSelected ? 'checked' : ''}>
                    ${displayText}
                </label>
            `;
                    }
                }

                timeSlotsContainer.innerHTML = slotsHTML;

                document.querySelectorAll('.time-slot-checkbox:not(:disabled)').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const slotElement = this.closest('.time-slot');
                        if (this.checked) {
                            slotElement.classList.add('selected');
                        } else {
                            slotElement.classList.remove('selected');
                        }
                    });
                });

            } catch (error) {
                console.error('Error:', error);
                timeSlotsContainer.innerHTML = `
                <div class="col-span-2 p-2 text-center text-red-500">
                    ${error.message || 'Gagal memuat slot waktu'}
                </div>
            `;
            }
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

            if (kapasitasStudio > 0 && currentValue < kapasitasStudio) {
                increaseBtn.classList.add('btn-active');
                increaseBtn.classList.remove('btn-inactive');
            } else {
                increaseBtn.classList.add('btn-inactive');
                increaseBtn.classList.remove('btn-active');
            }
        }

        function calculateTotal() {
            const jumlahOrang = parseInt(jumlahOrangInput.value) || 1;
            const selectedOption = studioSelect.options[studioSelect.selectedIndex];
            const selectedSlotsCount = selectedTimeSlots.length || 0;

            if (!selectedOption || selectedOption.value === "") {
                kapasitasStudio = 0;
                document.getElementById('totalHarga').textContent = `Rp 0`;
                updateKapasitasInfo();
                return;
            }

            kapasitasStudio = parseInt(selectedOption.getAttribute('data-kapasitas')) || 0;

            if (jumlahOrang > kapasitasStudio) {
                jumlahOrangInput.value = kapasitasStudio > 0 ? kapasitasStudio : 1;
            }
            if (jumlahOrangInput.value < 1) {
                jumlahOrangInput.value = 1;
            }

            const hargaPerSlot = parseInt(selectedOption.getAttribute('data-harga')) || 0;

            const biayaTambahanPerOrang = 5000;

            const total = (hargaPerSlot * selectedSlotsCount) +
                (Math.max(0, jumlahOrangInput.value - 1) * biayaTambahanPerOrang * selectedSlotsCount);

            const formattedTotal = total.toLocaleString('id-ID');
            document.getElementById('totalHarga').textContent = `Rp ${formattedTotal}`;
            updateButtonStates();
        }

        submitBtn.addEventListener('click', async function(e) {
            e.preventDefault();

            if (selectedTimeSlots.length === 0) {
                formErrorDisplay.classList.remove('hidden');
                formErrorDisplay.innerHTML = '<p>Silakan pilih setidaknya satu slot waktu</p>';
                return;
            }

            if (!bookingForm.checkValidity()) {
                bookingForm.reportValidity();
                return;
            }

            formErrorDisplay.classList.add('hidden');
            formErrorDisplay.innerHTML = '';

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

                document.getElementById('modal_pemesanan_id').value = data
                    .id_pemesanan;

                document.getElementById('modalNama').textContent = formData.get('nama');
                document.getElementById('modalNoHp').textContent = formData.get('no_hp');

                const selectedStudioOption = studioSelect.options[studioSelect.selectedIndex];
                const studioNameMatch = selectedStudioOption.textContent.match(/ - ([^-]+) - Rp/);
                document.getElementById('modalStudio').textContent = studioNameMatch ?
                    studioNameMatch[1].trim() : selectedStudioOption.textContent.split(' - ')[2] || 'N/A';

                document.getElementById('modalTanggal').textContent = formData.get('tanggal');

                const selectedTimesDisplay = selectedTimeSlots.map(slot => slot.displayText).join(', ');
                document.getElementById('modalJam').textContent = selectedTimesDisplay;

                document.getElementById('modalJumlahOrang').textContent = formData.get('jumlah_orang');
                document.getElementById('modalTotalHarga').textContent = document.getElementById('totalHarga')
                    .textContent;

                modal.style.display = 'flex';

            } catch (error) {
                console.error('Error:', error);
                formErrorDisplay.classList.remove('hidden');
                formErrorDisplay.innerHTML =
                    `<p>${error.message || 'Terjadi kesalahan tidak dikenal.'}</p>`;
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Lanjutkan ke Pembayaran';
            }
        });

        function updateKapasitasInfo() {
            const selectedOption = studioSelect.options[studioSelect.selectedIndex];

            if (selectedOption && selectedOption.value !== "") {
                kapasitasStudio = parseInt(selectedOption.getAttribute('data-kapasitas')) || 0;
            } else {
                kapasitasStudio = 0;
            }

            document.getElementById('kapasitasValue').textContent = kapasitasStudio;
            jumlahOrangInput.setAttribute('max', kapasitasStudio);

            if (parseInt(jumlahOrangInput.value) > kapasitasStudio && kapasitasStudio > 0) {
                jumlahOrangInput.value = kapasitasStudio;
            } else if (kapasitasStudio === 0) {
                if (parseInt(jumlahOrangInput.value) > 1) {
                    jumlahOrangInput.value = 1;
                }
            }

            updateButtonStates();
            calculateTotal();
            updateSummary();
        }
    </script>
</body>

</html>
