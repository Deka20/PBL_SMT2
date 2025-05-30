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
        <button onclick="window.location.href='/'" class="flex items-center gap-2 text-sm font-normal text-black"
            type="button">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="relative">
            <button aria-label="User profile" id="profileBtn" class="text-black text-lg focus:outline-none"
                type="button">
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
    <form id="orderForm" class="bg-white rounded-md p-6 w-full max-w-lg mx-auto mt-6 shadow-lg ring-1 ring-gray-300">
        <h2 class="text-center font-semibold text-xl mb-2">Form Pemesanan</h2>
        <p class="text-center text-base mb-6">Isi form dibawah ini untuk melakukan pemesanan</p>
        <label class="block text-base mb-2" for="nama">Nama Lengkap</label>
        <input id="nama" name="nama" type="text" placeholder="Nama Pelanggan"
            class="w-full text-base rounded-md bg-gray-300 placeholder:text-gray-400 px-4 py-2 mb-4" required />
        <label class="block text-base mb-2" for="hp">No. Handphone</label>
        <input id="hp" name="hp" type="tel" placeholder="Nomor Handphone"
            class="w-full text-base rounded-md bg-gray-300 placeholder:text-gray-400 px-4 py-2 mb-4" required
            pattern="[0-9]+" />
        <label class="block text-base mb-2" for="studio">Studio</label>
        <input id="studio" name="studio" type="text" placeholder="Studio pilihan pelanggan"
            class="w-full text-base rounded-md bg-gray-300 placeholder:text-gray-400 px-4 py-2 mb-4" required />
        <label class="block text-base mb-2" for="tanggal">Tanggal</label>
        <input id="tanggal" name="tanggal" type="date" class="w-full text-base rounded-md bg-gray-300 px-4 py-2 mb-4"
            required />
        
        <!-- Jam Dropdown -->
        <label class="block text-base mb-2" for="jamDropdown">Jam</label>
        <div class="relative mb-4">
            <button type="button" id="jamDropdownBtn" class="w-full text-left bg-gray-300 rounded-md px-4 py-2 flex justify-between items-center">
                <span id="selectedJamText">Pilih Jam</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div id="jamDropdown" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-2 gap-1 p-2">
                    <!-- Jam options will be generated by JavaScript -->
                </div>
            </div>
            <input type="hidden" id="selectedJam" name="jam" value="">
        </div>

        <label class="block text-base mb-2">Jumlah Orang</label>
        <div class="flex items-center gap-3 mb-6 text-base">
            <button type="button" id="decrease"
                class="bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center select-none hover:bg-gray-400 transition">−</button>
            <input id="jumlahOrang" name="jumlahOrang" type="number" value="5" min="1" max="20"
                readonly class="w-16 text-center rounded-md bg-gray-300 text-base py-2" />
            <button type="button" id="increase"
                class="bg-gray-300 rounded-full w-8 h-8 flex items-center justify-center select-none hover:bg-gray-400 transition">+</button>
        </div>
        <div class="flex gap-3 mb-6">
            <input type="text" readonly value="Total Pembayaran"
                class="flex-1 text-base rounded-md bg-gray-300 px-4 py-2" />
            <input type="text" readonly value="Rp." class="w-20 text-base rounded-md bg-gray-300 px-4 py-2" />
        </div>
        <button type="button" id="konfirmasiPesanan"
            class="w-full bg-[#f9d6d6] text-black text-base py-3 rounded-sm hover:bg-[#e6bcbc] transition">
            Konfirmasi Pesanan
        </button>
    </form>

    <!-- Payment Form Modal -->
    <div
        class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-black opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <!-- Payment Form Card -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <div class="w-12 h-12 bg-green-400 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="modal-close cursor-pointer">
                        <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <h2 class="text-center font-medium text-lg mb-4">Form Pembayaran</h2>
                <div class="border-b border-gray-200 mb-4"></div>

                <div class="space-y-2" id="payment-details">
                    <div class="flex justify-between">
                        <span>Nama :</span>
                        <span class="font-medium" id="payment-nama">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>No. Handphone :</span>
                        <span class="font-medium" id="payment-hp">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pilih Studio :</span>
                        <span class="font-medium" id="payment-studio">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tanggal :</span>
                        <span class="font-medium" id="payment-tanggal">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Jam :</span>
                        <span class="font-medium" id="payment-jam">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Jumlah Orang :</span>
                        <span class="font-medium"><span id="payment-jumlah">-</span> orang</span>
                    </div>
                </div>

                <div class="mt-4 pt-4">
                    <p class="text-sm font-medium mb-2">Transfer ke Rekening:</p>
                    <p class="text-sm mb-1">BNI An ShutterSpace</p>
                    <div class="bg-gray-200 text-gray-500 py-1 px-3 rounded mb-4">
                        xxxxxxxxxxxxx
                    </div>

                    <form id="paymentForm" onsubmit="submitPaymentForm(event)">
                        <p class="text-sm font-medium mb-2">Upload Bukti Pembayaran</p>
                        <div class="flex items-center border border-gray-300 rounded mb-6">
                            <label for="payment_proof" class="cursor-pointer flex items-center">
                                <div class="bg-gray-200 p-2 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-500 ml-2" id="file-name">Pilih File</span>
                            </label>
                            <input type="file" id="payment_proof" name="payment_proof" class="hidden"
                                onchange="updateFileName(this)">
                        </div>

                        <div class="border-b border-gray-200 mb-4"></div>

                        <div class="flex justify-between items-center mb-6">
                            <span class="font-medium">Total Pembayaran :</span>
                            <span class="font-bold" id="payment-total">Rp. 100.000</span>
                        </div>

                        <div class="space-y-2">
                            <button type="submit" class="w-full bg-black text-white py-3 rounded font-medium">
                                Kirim Bukti Pembayaran
                            </button>
                            <button type="button"
                                class="modal-close w-full bg-gray-200 text-gray-500 py-3 rounded font-medium">
                                Tutup
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate time slots from 09:00 to 21:45 in 15-minute intervals
        function generateTimeSlots() {
            const container = document.querySelector('#jamDropdown .grid');
            container.innerHTML = '';
            
            const startHour = 9; // 9 AM
            const endHour = 21;  // 9 PM
            const interval = 15; // 15 minutes
            
            for (let hour = startHour; hour <= endHour; hour++) {
                for (let minute = 0; minute < 60; minute += interval) {
                    if (hour === endHour && minute > 0) break; // Stop at 21:00
                    
                    const timeStart = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    const nextMinute = minute + interval;
                    const endHourAdj = nextMinute >= 60 ? hour + 1 : hour;
                    const endMinute = nextMinute % 60;
                    const timeEnd = `${endHourAdj.toString().padStart(2, '0')}:${endMinute.toString().padStart(2, '0')}`;
                    
                    const timeSlot = document.createElement('button');
                    timeSlot.type = 'button';
                    timeSlot.className = 'text-left px-3 py-2 text-sm hover:bg-gray-100 rounded';
                    timeSlot.textContent = `${timeStart}-${timeEnd}`;
                    timeSlot.dataset.value = `${timeStart}-${timeEnd}`;
                    
                    timeSlot.addEventListener('click', function() {
                        document.getElementById('selectedJam').value = this.dataset.value;
                        document.getElementById('selectedJamText').textContent = this.textContent;
                        document.getElementById('jamDropdown').classList.add('hidden');
                    });
                    
                    container.appendChild(timeSlot);
                }
            }
        }

        // Initialize time slots when page loads
        document.addEventListener('DOMContentLoaded', function() {
            generateTimeSlots();
            
            // Toggle dropdown
            document.getElementById('jamDropdownBtn').addEventListener('click', function() {
                document.getElementById('jamDropdown').classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('#jamDropdown') && !e.target.closest('#jamDropdownBtn')) {
                    document.getElementById('jamDropdown').classList.add('hidden');
                }
            });
        });

        // Modal functionality
        const modal = document.querySelector('.modal');
        const overlay = document.querySelector('.modal-overlay');
        const closeModalButtons = document.querySelectorAll('.modal-close');
        const konfirmasiPesananBtn = document.getElementById('konfirmasiPesanan');
        const orderForm = document.getElementById('orderForm');

        // Open modal and fill it with form data
        konfirmasiPesananBtn.addEventListener('click', () => {
            // Check if form is valid
            if (!orderForm.checkValidity()) {
                orderForm.reportValidity();
                return;
            }

            // Get selected jam
            const selectedJam = document.getElementById('selectedJam').value;

            if (!selectedJam) {
                alert('Silakan pilih jam terlebih dahulu');
                return;
            }

            // Get form values
            const nama = document.getElementById('nama').value;
            const hp = document.getElementById('hp').value;
            const studio = document.getElementById('studio').value;
            const tanggal = document.getElementById('tanggal').value;
            const jamText = selectedJam;
            const jumlahOrang = document.getElementById('jumlahOrang').value;

            // Format tanggal to readable format
            const formattedDate = new Date(tanggal).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });

            // Fill payment details in modal
            document.getElementById('payment-nama').textContent = nama;
            document.getElementById('payment-hp').textContent = hp;
            document.getElementById('payment-studio').textContent = studio;
            document.getElementById('payment-tanggal').textContent = formattedDate;
            document.getElementById('payment-jam').textContent = jamText;
            document.getElementById('payment-jumlah').textContent = jumlahOrang;

            // Calculate total based on number of people (example: 50,000 per person)
            const total = parseInt(jumlahOrang) * 50000;
            document.getElementById('payment-total').textContent = `Rp. ${total.toLocaleString('id-ID')}`;

            // Open modal
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
            document.body.classList.add('modal-active');
        });

        // Close modal function
        const closeModal = () => {
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
            document.body.classList.remove('modal-active');
        };

        // Close modal when clicking close buttons
        closeModalButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });

        // Close modal when clicking on overlay
        overlay.addEventListener('click', closeModal);

        // Close modal with ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('opacity-0')) {
                closeModal();
            }
        });

        // Update file name when file is selected
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'Pilih File';
            document.getElementById('file-name').textContent = fileName;
        }

        // Submit payment form without refreshing page
        function submitPaymentForm(event) {
            event.preventDefault();

            const paymentProof = document.getElementById('payment_proof').files[0];
            if (!paymentProof) {
                alert('Silakan pilih file bukti pembayaran');
                return;
            }

            // Here you would normally send the form data via AJAX
            // For example using fetch or XMLHttpRequest

            // Create FormData object
            const formData = new FormData();
            formData.append('payment_proof', paymentProof);
            formData.append('nama', document.getElementById('payment-nama').textContent);
            formData.append('hp', document.getElementById('payment-hp').textContent);
            formData.append('studio', document.getElementById('payment-studio').textContent);
            formData.append('tanggal', document.getElementById('payment-tanggal').textContent);
            formData.append('jam', document.getElementById('payment-jam').textContent);
            formData.append('jumlah', document.getElementById('payment-jumlah').textContent);
            formData.append('total', document.getElementById('payment-total').textContent);

            // For demo purposes, show success message and close modal
            alert('Bukti pembayaran berhasil dikirim');
            closeModal();
        }
    </script>

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