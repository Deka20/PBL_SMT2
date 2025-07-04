<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP | Potretine</title>
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
        <h2 class="text-2xl font-bold text-center text-gray-600 mb-6">Verifikasi OTP</h2>
        @if ($errors->any())
            <div role="alert" class="alert alert-error mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $errors->first('otp') ?? ($errors->first('email') ?? 'Terjadi kesalahan.') }}</span>
            </div>
        @endif

        @if (session('status'))
            <div role="alert" class="alert alert-success mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <p class="text-sm text-gray-600 mb-4">Kami telah mengirimkan kode OTP ke email <span
                class="font-medium">{{ old('email', $email ?? session('email_for_otp_verification')) }}</span></p>

        <form method="POST" action="{{ route('password.verify') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="email"
                value="{{ old('email', $email ?? session('email_for_otp_verification')) }}">

            <div class="form-control">
                <div class="relative">
                    <input type="text" id="otp" name="otp" maxlength="6"
                        class="input input-bordered w-full rounded-full peer focus:outline-none focus:ring-2 focus:ring-pink-400 @error('otp') border-error @enderror"
                        placeholder=" " required autofocus>
                    <label for="otp"
                        class="absolute left-4 top-3 text-gray-500 transition-all duration-200 ease-out pointer-events-none
                        peer-focus:-translate-y-5 peer-focus:scale-90 peer-focus:text-pink-400
                        peer-[&:not(:placeholder-shown)]:-translate-y-5 peer-[&:not(:placeholder-shown)]:scale-90 peer-[&:not(:placeholder-shown)]:text-primary
                        bg-white px-1">
                        Kode OTP (6 digit)
                    </label>
                    @error('otp')
                        <span class="label-text-alt text-error mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-neutral w-full rounded-md">
                VERIFIKASI
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Tidak menerima OTP?
            <a href="{{ route('password.request') }}" class="text-gray-800 hover:underline font-medium">
                Kirim ulang
            </a>
        </p>
    </div>
</body>

</html>
