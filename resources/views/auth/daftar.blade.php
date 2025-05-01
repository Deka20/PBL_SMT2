<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Potretine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.42.0/dist/full.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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

        .input-container {
            position: relative;
            margin-bottom: 1rem;
        }

        /* Menghilangkan placeholder default pada input date */
        input[type="date"]::before {
            content: attr(placeholder);
            position: absolute;
            color: #9CA3AF;
        }

        input[type="date"]:focus::before,
        input[type="date"]:valid::before {
            display: none;
        }

        /* Untuk browser WebKit (Chrome, Safari) */
        input[type="date"]::-webkit-datetime-edit,
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-clear-button {
            display: none;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            right: 1rem;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-auth flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md border border-gray-500">
        <h2 class="text-2xl font-bold text-center text-gray-600 mb-6">Daftar</h2>

        <form method="POST" action="{{ route('auth.daftar') }}">
            @csrf

            <!-- Nama Lengkap -->
            <div class="input-container">
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                    class="input input-bordered w-full rounded-3xl peer focus:outline-none focus:ring-2 focus:ring-pink-400 pl-12"
                    placeholder=" " value="{{ old('nama_lengkap') }}" required>
                <div class="absolute left-4 top-3 text-gray-500">
                    <i class="fas fa-user w-5 h-5"></i>
                </div>
                <label for="nama_lengkap"
                    class="absolute left-14 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                               peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                               peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                               bg-white px-1">
                    Nama Lengkap
                </label>
                @error('nama_lengkap')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Pengguna -->
            <div class="input-container">
                <input type="text" id="nama_pengguna" name="nama_pengguna"
                    class="input input-bordered w-full rounded-3xl peer focus:outline-none focus:ring-2 focus:ring-pink-400 pl-12"
                    placeholder=" " value="{{ old('nama_pengguna') }}" required>
                <div class="absolute left-4 top-3 text-gray-500">
                    <i class="fas fa-user-tag w-5 h-5"></i>
                </div>
                <label for="nama_pengguna"
                    class="absolute left-14 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                               peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                               peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                               bg-white px-1">
                    Nama Pengguna
                </label>
                @error('nama_pengguna')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div class="input-container relative">
                <input type="date" id="tgl_lahir" name="tgl_lahir"
                    class="input input-bordered w-full rounded-3xl peer focus:outline-none focus:ring-2 focus:ring-pink-400 pl-12 text-center placeholder-shown:text-gray-400"
                    value="{{ old('tgl_lahir') }}" required onfocus="this.classList.add('has-value')"
                    onblur="if(!this.value)this.classList.remove('has-value')">

                <!-- Icon -->
                <div class="absolute left-4 top-3 text-gray-500">
                    <i class="fas fa-calendar-day w-5 h-5"></i>
                </div>

                <!-- Label floating -->
                <label for="tgl_lahir"
                    class="absolute left-14 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
               peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
               peer-[.has-value]:-translate-y-5 peer-[.has-value]:scale-90 peer-[.has-value]:text-primary
               bg-white px-1">
                    Tanggal Lahir
                </label>

                @error('tgl_lahir')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="input-container">
                <input type="email" id="email" name="email"
                    class="input input-bordered w-full rounded-3xl peer focus:outline-none focus:ring-2 focus:ring-pink-400 pl-12"
                    placeholder=" " value="{{ old('email') }}" required>
                <div class="absolute left-4 top-3 text-gray-500">
                    <i class="fas fa-envelope w-5 h-5"></i>
                </div>
                <label for="email"
                    class="absolute left-14 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                               peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                               peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                               bg-white px-1">
                    Email
                </label>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Telepon -->
            <div class="input-container">
                <input type="text" id="telepon" name="telepon"
                    class="input input-bordered w-full rounded-3xl peer focus:outline-none focus:ring-2 focus:ring-pink-400 pl-12"
                    placeholder=" " value="{{ old('telepon') }}" required>
                <div class="absolute left-4 top-3 text-gray-500">
                    <i class="fas fa-phone w-5 h-5"></i>
                </div>
                <label for="telepon"
                    class="absolute left-14 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                               peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                               peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                               bg-white px-1">
                    Telepon
                </label>
                @error('telepon')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-container">
                <input type="password" id="password" name="password"
                    class="input input-bordered w-full rounded-3xl peer focus:outline-none focus:ring-2 focus:ring-pink-400 pl-12"
                    placeholder=" " required>
                <div class="absolute left-4 top-3 text-gray-500">
                    <i class="fas fa-lock w-5 h-5"></i>
                </div>
                <label for="password"
                    class="absolute left-14 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                               peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                               peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                               bg-white px-1">
                    Password
                </label>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="input-container">
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="input input-bordered w-full rounded-3xl peer focus:outline-none focus:ring-2 focus:ring-pink-400 pl-12"
                    placeholder=" " required>
                <div class="absolute left-4 top-3 text-gray-500">
                    <i class="fas fa-lock w-5 h-5"></i>
                </div>
                <label for="password_confirmation"
                    class="absolute left-14 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                               peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                               peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                               bg-white px-1">
                    Konfirmasi Password
                </label>
            </div>

            <button type="submit" class="btn btn-neutral w-full mt-6 rounded-md">DAFTAR</button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-gray-800 hover:underline font-medium">Masuk
                disini</a>
        </p>
    </div>
</body>

</html>
