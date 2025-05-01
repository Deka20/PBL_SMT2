<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Potretine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .bg-auth {
            background-image: url("{{ asset('images/bg-login.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-auth flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md border border-gray-500">
        <h2 class="text-2xl font-bold text-center text-gray-600 mb-6">Daftar</h2>
        
        <form method="POST" action="{{ route('auth.daftar') }}">
            @csrf
        
            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none">
                @error('nama_lengkap')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Nama Pengguna -->
            <div class="mb-4">
                <label for="nama_pengguna" class="block text-sm font-medium text-gray-700 mb-2">Nama Pengguna</label>
                <input type="text" name="nama_pengguna" id="nama_pengguna" value="{{ old('nama_pengguna') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none">
                @error('nama_pengguna')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Telepon -->
            <div class="mb-4">
                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none">
                @error('telepon')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:outline-none">
            </div>
        
            <button type="submit"
                class="w-full bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-pink-200 transition duration-200">
                DAFTAR
            </button>
        </form>        
    </div>
</body>
</html>