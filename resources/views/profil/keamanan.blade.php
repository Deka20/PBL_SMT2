<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Keamanan & Privasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .active-menu {
            background-color: #f9d6d6;
            color: #4b5563;
            font-weight: 500;
        }

        .active-menu:hover {
            background-color: #f5c2c2;
        }

        .btn-custom {
            background-color: #f9d6d6;
            color: #4b5563;
        }

        .btn-custom:hover {
            background-color: #f5c2c2;
        }
        
        .btn-hover-effect {
            transition: background-color 0.2s ease;
        }
        
        .btn-hover-effect:hover {
            background-color: #f5c2c2;
        }
        
        .btn-ghost-hover:hover {
            background-color: #f9d6d6;
        }
        
        .input-focus:focus {
            border-color: #f9d6d6;
            box-shadow: 0 0 0 1px #f9d6d6;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen">
    <header class="flex items-center justify-between px-4 py-3 bg-white shadow-sm">
        <button onclick="window.location.href='/'" class="flex items-center gap-2 text-sm font-medium text-gray-600 btn btn-ghost btn-hover-effect">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="dropdown dropdown-end">
            <button tabindex="0" class="btn btn-ghost btn-circle btn-hover-effect">
                <i class="fas fa-user-circle text-xl text-gray-600"></i>
            </button>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
                <li><button onclick="window.location.href='keluar'" class="text-sm text-gray-600 btn-hover-effect">Keluar</button></li>
            </ul>
        </div>
    </header>

    <main class="flex justify-center items-center min-h-[calc(100vh-64px)] p-4">
        <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Mobile Menu -->
            <div class="md:hidden flex overflow-x-auto border-b border-gray-200 bg-gray-50">
                <button onclick="window.location.href='profil'" class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-user mr-2 text-lg"></i>Profil
                </button>
                <button onclick="window.location.href='/keamanan'" class="flex-shrink-0 px-4 py-3 text-base font-medium active-menu btn-hover-effect">
                    <i class="fas fa-lock mr-2 text-lg"></i>Keamanan
                </button>
                <button onclick="window.location.href='/riwayat'" class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-history mr-2 text-lg"></i>Riwayat
                </button>
                <button onclick="window.location.href=''" class="flex items-center gap-2 px-4 py-3 mt-auto font-normal text-sm btn-hover-effect">
                    <i class="fas fa-sign-out-alt"></i>Keluar
                </button>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex flex-col w-64 border-r border-gray-200 bg-gray-50 p-2">
                <button onclick="window.location.href='{{ route('profil') }}'" class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-user text-lg"></i>Profil
                </button>
                <button onclick="window.location.href='{{ route('keamanan') }}'" class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium active-menu btn-hover-effect">
                    <i class="fas fa-lock text-lg"></i>Keamanan & Privasi
                </button>
                <button onclick="window.location.href='{{ route('riwayat') }}'" class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-history text-lg"></i>Riwayat Pemesanan
                </button>
                <button onclick="window.location.href=''" class="flex items-center gap-3 px-4 py-4 border-t border-gray-200 text-gray-600 mt-auto font-medium text-sm btn-hover-effect">
                    <i class="fas fa-sign-out-alt"></i>Keluar
                </button>
            </nav>

            <!-- Form Section -->
            <section class="flex-1 p-8 w-full max-w-2xl">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-semibold text-gray-700">Keamanan & Privasi</h2>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.ubah') }}" class="space-y-6">
                    @csrf
                    
                    <p class="text-sm font-semibold text-gray-700">Ganti Password</p>
                    
                    <div class="form-control">
                        <label class="label" for="current_password">
                            <span class="label-text text-gray-600">Password saat ini</span>
                        </label>
                        <input type="password" id="current_password" name="current_password" required
                               class="input input-bordered w-full bg-gray-50 text-gray-700 border-gray-200 input-focus @error('current_password') border-red-500 @enderror" />
                        @error('current_password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-control">
                        <label class="label" for="new_password">
                            <span class="label-text text-gray-600">Password baru</span>
                        </label>
                        <input type="password" id="new_password" name="new_password" required
                               class="input input-bordered w-full bg-gray-50 text-gray-700 border-gray-200 input-focus @error('new_password') border-red-500 @enderror" />
                        <p class="text-xs text-gray-400 mt-1">Minimal 8 karakter, mengandung angka</p>
                        @error('new_password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-control">
                        <label class="label" for="new_password_confirmation">
                            <span class="label-text text-gray-600">Konfirmasi Password baru</span>
                        </label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                               class="input input-bordered w-full bg-gray-50 text-gray-700 border-gray-200 input-focus" />
                    </div>
                    
                    <div class="flex justify-end gap-4 pt-6">
                        <button type="button" onclick="window.location.href='{{ route('profil') }}'" 
                            class="btn btn-ghost text-gray-600 btn-ghost-hover">Batal</button>
                        <button type="submit" class="btn btn-custom btn-hover-effect">Simpan Perubahan</button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script>
        // Handle dropdown menu
        const profileBtn = document.querySelector('.dropdown button');
        const dropdownMenu = document.querySelector('.dropdown-content');

        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;
            
            if (newPassword.length < 8) {
                alert('Password baru minimal 8 karakter!');
                e.preventDefault();
            }
            
            if (!/\d/.test(newPassword)) {
                alert('Password baru harus mengandung angka!');
                e.preventDefault();
            }
            
            if (newPassword !== confirmPassword) {
                alert('Konfirmasi password tidak sesuai!');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>