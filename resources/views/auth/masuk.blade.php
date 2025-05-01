<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Potretine</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-auth {
            background-image: url("{{ asset('images/bg-login.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-auth flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-6 sm:p-8 rounded-box shadow-xl w-full max-w-xs border border-gray-500">
        <h2 class="text-2xl font-bold text-center text-gray-600 mb-6">Masuk</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            @if (session('error'))
                <div role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Email/Username Input -->
            <div class="form-control">
                <div class="relative">
                    <input type="text" id="login" name="login"
                        class="input input-bordered w-full rounded-full peer focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder=" " value="{{ old('login') }}" required autofocus>
                    <label for="login"
                        class="absolute left-4 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                        peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                        peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                        bg-white px-1">
                        Email/Nama Pengguna
                    </label>
                    @error('login')
                        <span class="label-text-alt text-error mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Password Input -->
            <div class="form-control">
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="input input-bordered w-full rounded-full pr-10 peer focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder=" " required>
                    <label for="password"
                        class="absolute left-4 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                        peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                        peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                        bg-white px-1">
                        Password
                    </label>
                    <button type="button" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700"
                        onclick="togglePasswordVisibility('password')" aria-label="Toggle password visibility">
                        <svg id="eye-icon-password" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-width="2" d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z" />
                            <path stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg id="eye-slash-icon-password" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 14c-.5-.6-.9-1.3-1-2 0-1 4-6 9-6m7.6 3.8A5 5 0 0 1 21 12c0 1-3 6-9 6h-1m-6 1L19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                    @error('password')
                        <span class="label-text-alt text-error mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex justify-between items-center">
                <label class="label cursor-pointer gap-2 p-0">
                    <input type="checkbox" name="remember"
                        class="checkbox checkbox-sm rounded-full border-gray-600 checked:border-pink-500 [--chkbg:theme(colors.pink.500)]"
                        {{ old('remember') ? 'checked' : '' }}>
                    <span class="label-text">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-gray-800 hover:underline">Lupa Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-neutral w-full rounded-full">
                LOGIN
            </button>
        </form>

        <!-- Registration Link -->
        <p class="text-center text-gray-600 text-sm mt-4">
            Belum punya akun?
            <a href="{{ route('auth.daftar') }}" class="text-gray-800 hover:underline font-medium">
                Daftar sekarang
            </a>
        </p>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`eye-icon-${fieldId}`);
            const eyeSlashIcon = document.getElementById(`eye-slash-icon-${fieldId}`);

            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            eyeIcon.classList.toggle('hidden', !isPassword);
            eyeSlashIcon.classList.toggle('hidden', isPassword);
        }
    </script>
</body>

</html>
