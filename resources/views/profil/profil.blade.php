<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Ubah Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" />
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
    </style>
</head>

<body class="bg-[#fef6f6] min-h-screen">
    <header class="flex items-center justify-between px-4 py-3 bg-white shadow-sm">
        <button onclick="window.location.href='/'"
            class="flex items-center gap-2 text-sm font-medium text-gray-600 btn btn-ghost btn-hover-effect">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </button>
        <div class="dropdown dropdown-end">
            <button tabindex="0" class="btn btn-ghost btn-circle btn-hover-effect">
                <i class="fas fa-user-circle text-xl text-gray-600"></i>
            </button>
            <ul tabindex="0"
                class="dropdown-content z-[1] menu p-2 shadow bg-base-75 rounded-box w-32">
                <li>
                    <button onclick="window.location.href='{{ route('logout') }}'" 
                        class="text-sm text-gray-600 bg-white hover:bg-[#f5c2c2] px-4 py-2 w-full text-left rounded transition">
                        Keluar
                    </button>
                </li>
            </ul>
        </div>
    </header>

    <main class="flex justify-center items-center min-h-[calc(100vh-64px)] p-4">
        <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Mobile Menu -->
            <div class="md:hidden flex overflow-x-auto border-b border-gray-200 bg-gray-50">
                <button onclick="window.location.href='profil'"
                    class="flex-shrink-0 px-4 py-3 text-base font-medium active-menu btn-hover-effect">
                    <i class="fas fa-user mr-2 text-lg"></i>Profil
                </button>
                <button onclick="window.location.href='/keamanan'"
                    class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-lock mr-2 text-lg"></i>Keamanan
                </button>
                <button onclick="window.location.href='/riwayat'"
                    class="flex-shrink-0 px-4 py-3 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-history mr-2 text-lg"></i>Riwayat
                </button>
                <button onclick="window.location.href=''" class="flex items-center gap-2 px-4 py-3 mt-auto font-normal text-sm btn-hover-effect">
                    <i class="fas fa-sign-out-alt"></i>Keluar
                </button>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex flex-col w-64 border-r border-gray-200 bg-gray-50 p-2">
                <button onclick="window.location.href='{{ route('profil') }}'"
                    class="flex items-center gap-3 px-4 py-4 border-b border-t border-gray-200 text-base font-medium active-menu btn-hover-effect">
                    <i class="fas fa-user text-lg"></i>Profil
                </button>
                <button onclick="window.location.href='{{ route('keamanan') }}'"
                    class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-lock text-lg"></i>Keamanan & Privasi
                </button>
                <button onclick="window.location.href='{{ route('riwayat') }}'"
                    class="flex items-center gap-3 px-4 py-4 border-b border-gray-200 text-base font-medium text-gray-600 btn-hover-effect">
                    <i class="fas fa-history text-lg"></i>Riwayat Pemesanan
                </button>
                <button onclick="window.location.href=''" class="flex items-center gap-3 px-4 py-4 border-t border-gray-200 text-gray-600 mt-auto font-medium text-sm btn-hover-effect">
                    <i class="fas fa-sign-out-alt"></i>Keluar
                </button>
            </nav>

            <!-- Form Section -->
            <section class="flex-1 p-8 w-full max-w-2xl">
                <form id="profil-form" class="space-y-6" action="{{ route('profil.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-between items-start mb-6">
                        <h2 class="text-2xl font-semibold text-gray-700">Ubah Profil</h2>
                        <div class="flex flex-col items-center text-sm">
                            <span class="text-gray-500">Foto Profil</span>
                            <label for="foto" class="cursor-pointer mt-2 btn-hover-effect rounded-full">
                                <div class="avatar">
                                    <div
                                        class="w-16 rounded-full ring ring-gray-200 ring-offset-base-100 ring-offset-2">
                                        <img
                                            src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/default-photo.jpg') }}"
                                            alt="Foto Profil" id="foto-preview" />
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="foto" name="foto" class="hidden" accept="image/*" />
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label" for="nama_lengkap">
                            <span class="label-text text-gray-600">Nama Lengkap</span>
                        </label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap"
                            value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                            class="input input-bordered w-full bg-gray-50 text-gray-700 border-gray-200 focus:border-[#f9d6d6] focus:ring-1 focus:ring-[#f9d6d6]" />
                    </div>

                    <div class="form-control">
                        <label class="label" for="nama_pengguna">
                            <span class="label-text text-gray-600">Nama Pengguna</span>
                        </label>
                        <input type="text" id="nama_pengguna" name="nama_pengguna"
                            value="{{ old('nama_pengguna', $user->nama_pengguna) }}"
                            class="input input-bordered w-full bg-gray-50 text-gray-700 border-gray-200 focus:border-[#f9d6d6] focus:ring-1 focus:ring-[#f9d6d6]" />
                    </div>

                    <div class="form-control">
                        <label class="label" for="tgl_lahir">
                            <span class="label-text text-gray-600">Tanggal Lahir</span>
                        </label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir"
                            value="{{ old('tgl_lahir', $user->tgl_lahir) }}"
                            class="input input-bordered w-full bg-gray-50 text-gray-700 border-gray-200 focus:border-[#f9d6d6] focus:ring-1 focus:ring-[#f9d6d6]" />
                    </div>

                    <div class="form-control">
                        <label class="label" for="telepon">
                            <span class="label-text text-gray-600">No. Handphone</span>
                        </label>
                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $user->telepon) }}"
                            class="input input-bordered w-full bg-gray-50 text-gray-700 border-gray-200 focus:border-[#f9d6d6] focus:ring-1 focus:ring-[#f9d6d6]"
                            pattern="[0-9]{10,13}" title="Nomor handphone harus 10-13 digit angka" required />
                    </div>

                    <div class="flex justify-end gap-4 pt-6">
                        <a href="{{ route('profil.edit') }}" class="btn btn-ghost text-gray-600 btn-ghost-hover">Batal</a>
                        <button type="button" id="btn-submit" class="btn btn-custom btn-hover-effect">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <!-- Modal Konfirmasi -->
    <div id="confirm-modal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full shadow-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Konfirmasi Perubahan</h3>
            <p class="mb-6 text-gray-600">Yakin mau simpan perubahan profil ini?</p>
            <div class="flex justify-end gap-4">
                <button id="btn-cancel" class="btn btn-ghost btn-hover-effect">Batal</button>
                <button id="btn-confirm" class="btn btn-custom btn-hover-effect">Ya, Simpan</button>
            </div>
        </div>
    </div>

    <script>
        // Preview foto saat pilih file
        const inputFoto = document.getElementById('foto');
        const imgPreview = document.getElementById('foto-preview');

        inputFoto.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imgPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Modal konfirmasi
        const btnSubmit = document.getElementById('btn-submit');
        const modal = document.getElementById('confirm-modal');
        const btnCancel = document.getElementById('btn-cancel');
        const btnConfirm = document.getElementById('btn-confirm');
        const form = document.getElementById('profil-form');

        btnSubmit.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        btnCancel.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        btnConfirm.addEventListener('click', () => {
            form.submit();
        });
    </script>
</body>

</html>
