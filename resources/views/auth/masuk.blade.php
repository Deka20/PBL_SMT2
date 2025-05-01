<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Potretine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        .bg-auth {
            background-image: url("{{ asset('images/bg-login.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-auth flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-xl w-80 border border-gray-500">
        <h2 class="text-2xl font-bold text-center text-gray-600 mb-6">Masuk</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf <!-- CSRF Token untuk keamanan -->
            
            @if(session('error'))
            <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-pink-100 rounded-lg shadow-sm" role="alert">
                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-full">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('error') }}</div>
            </div>
            @endif
            <!-- Email/Username Input -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="login">Email/Nama Pengguna</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="login" 
                        name="login"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-3xl focus:outline-none focus:ring-2 focus:ring-pink-200 @error('login') border-red-500 @enderror"
                        value="{{ old('login') }}"
                        required
                        autofocus
                    >
                </div>
                @error('login')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Password Input -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2" for="password">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7c0-1.1.9-2 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6c.6 0 1 .4 1 1v3a1 1 0 1 1-2 0v-3c0-.6.4-1 1-1Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-3xl focus:outline-none focus:ring-2 focus:ring-pink-200 @error('password') border-red-500 @enderror"
                        required
                        autocomplete="current-password"
                    >
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="flex justify-between items-center mb-6">
                <label class="flex items-center text-gray-700 text-sm">
                    <input 
                        type="checkbox" 
                        name="remember"
                        class="rounded-full border border-gray-600 text-pink-500 focus:ring-pink-200"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <span class="ml-2">Ingat saya</span>
                </label>
                <a href="" class="text-sm text-gray-800 hover:underline">Lupa Password</a>
            </div>
            
            <button 
                type="submit" 
                class="w-full bg-gray-800 text-white py-2 px-4 rounded-3xl hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2 transition duration-200"
            >
                LOGIN
            </button>
        </form>
        
        <p class="text-center text-gray-600 text-sm mt-4">
            Belum punya akun? <a href="{{ route('auth.daftar') }}" class="text-gray-800 hover:underline">Daftar sekarang</a>
        </p>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>