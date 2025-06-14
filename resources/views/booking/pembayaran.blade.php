<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="bg-white max-w-lg mx-auto mt-10 p-6 rounded-md shadow-lg">
        <h2 class="text-xl font-semibold text-center mb-4">Upload Bukti Pembayaran</h2>

        <p class="text-sm mb-2">Transfer ke Rekening:</p>
        <p class="bg-gray-100 px-3 py-2 rounded mb-4">BNI a.n. ShutterSpace - 1234567890</p>

        <form method="POST" action="{{ route('bukti.upload') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_pemesanan" value="{{ $id }}">

            <label class="block text-base mb-2">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf" required class="w-full text-sm bg-gray-200 px-4 py-2 rounded mb-4">

            <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                Kirim Bukti Pembayaran
            </button>
        </form>
    </div>
</body>
</html>
