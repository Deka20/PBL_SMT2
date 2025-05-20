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
    <form id="orderForm" class="bg-white rounded-md p-6 w-full max-w-md mx-auto mt-6 shadow-lg ring-1 ring-gray-300">
        <h2 class="text-center font-semibold mb-1">Form Pemesanan</h2>
        <p class="text-center text-sm mb-4">Isi form dibawah ini untuk melakukan pemesanan</p>
        <label class="block text-xs mb-1" for="nama">Nama Lengkap</label>
        <input id="nama" name="nama" type="text" placeholder="Nama Pelanggan"
            class="w-full text-xs rounded-md bg-gray-300 placeholder:text-gray-400 px-2 py-1 mb-3" required />
        <label class="block text-xs mb-1" for="hp">No. Handphone</label>
        <input id="hp" name="hp" type="tel" placeholder="Nomor Handphone"
            class="w-full text-xs rounded-md bg-gray-300 placeholder:text-gray-400 px-2 py-1 mb-3" required
            pattern="[0-9]+" />
        <label class="block text-xs mb-1" for="studio">Studio</label>
        <input id="studio" name="studio" type="text" placeholder="Studio pilihan pelanggan"
            class="w-full text-xs rounded-md bg-gray-300 placeholder:text-gray-400 px-2 py-1 mb-3" required />
        <label class="block text-xs mb-1" for="tanggal">Tanggal</label>
        <input id="tanggal" name="tanggal" type="date" class="w-full text-xs rounded-md bg-gray-300 px-2 py-1 mb-3"
            required />
        <label class="block text-xs mb-1">Jam</label>
        <div id="jamContainer" class="flex flex-wrap gap-1 mb-3 text-xs">
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="09.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">09.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="10.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">10.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="11.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">11.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="12.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">12.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="13.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">13.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="14.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">14.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="15.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">15.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="16.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">16.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="17.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">17.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="18.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">18.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="19.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">19.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="20.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">20.00</span>
            </label>
            <label class="cursor-pointer">
                <input type="checkbox" name="jam" value="21.00" class="hidden peer" />
                <span
                    class="bg-gray-300 rounded-full px-2 py-0.5 min-w-[38px] inline-block text-center peer-checked:bg-[#f9d6d6] peer-checked:text-black hover:bg-gray-400 transition">21.00</span>
            </label>
        </div>
        <label class="block text-xs mb-1">Jumlah Orang</label>
        <div class="flex items-center gap-2 mb-3 text-xs">
            <button type="button" id="decrease"
                class="bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center select-none hover:bg-gray-400 transition">−</button>
            <input id="jumlahOrang" name="jumlahOrang" type="number" value="5" min="1" max="20"
                readonly class="w-10 text-center rounded-md bg-gray-300 text-xs py-1" />
            <button type="button" id="increase"
                class="bg-gray-300 rounded-full w-6 h-6 flex items-center justify-center select-none hover:bg-gray-400 transition">+</button>
        </div>
        <div class="flex gap-2 mb-4">
            <input type="text" readonly value="Total Pembayaran"
                class="flex-1 text-xs rounded-md bg-gray-300 px-2 py-1" />
            <input type="text" readonly value="Rp." class="w-16 text-xs rounded-md bg-gray-300 px-2 py-1" />
        </div>
        <button type="button" id="konfirmasiPesanan"
            class="w-full bg-[#f9d6d6] text-black text-[8px] py-1 rounded-sm hover:bg-[#e6bcbc] transition">
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
            const selectedJam = [];
            document.querySelectorAll('input[name="jam"]:checked').forEach(input => {
                selectedJam.push(input.value);
            });

            if (selectedJam.length === 0) {
                alert('Silakan pilih jam terlebih dahulu');
                return;
            }

            // Get form values
            const nama = document.getElementById('nama').value;
            const hp = document.getElementById('hp').value;
            const studio = document.getElementById('studio').value;
            const tanggal = document.getElementById('tanggal').value;
            const jamText = selectedJam.join(', ');
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

            // Example AJAX request (commented out as it needs a real endpoint)
            /*
            fetch('/payment/upload', {
                method: 'POST',
                body: formData,
                // Include CSRF token if needed
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Bukti pembayaran berhasil dikirim');
                    closeModal();
                } else {
                    alert('Gagal mengirim bukti pembayaran: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim bukti pembayaran');
            });
            */

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
