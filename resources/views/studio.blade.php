<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 fixed top-0 left-0 h-screen bg-pink-50 text-pink-600 border-r-2 border-pink-200 p-5">
        <img src="{{ asset('images/logo.png') }}" alt="Logo"
            class="w-16 h-16 rounded-full object-cover block mx-auto">
        <h2 class="text-2xl text-center font-bold text-pink-600 mt-2">Potrétine</h2>
        <nav class="mt-6">
            <a href="dashboardadmin1.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>🏠</span> Dashboard
            </a>
            <a href="studionew.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>📷</span> Studio
            </a>
            <a href="datapelanggan1.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>👥</span> Pelanggan
            </a>
            <a href="pengaturan.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>⚙</span> Pengaturan
            </a>
            <a href="ulasan.html"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>⭐</span> Rating & Review
            </a>
            <a href="#"
                class="flex items-center gap-2 p-3 text-black text-base font-medium rounded-lg mb-2 hover:bg-pink-200 hover:text-pink-800 hover:translate-x-1 transition-all duration-300">
                <span>📈</span> Statistik Pendapatan
            </a>
        </nav>
    </aside>

    <!-- Content -->
    <div class="ml-64 p-5 flex-1">
        <button id="addStudioBtn" class="btn bg-pink-500 hover:bg-pink-600 text-white mb-5">
            + Tambah Studio
        </button>

        <!-- Studio Table -->
        <div class="overflow-x-auto">
            <table class="table w-full bg-pink-50 rounded-box">
                <thead>
                    <tr class="bg-pink-200">
                        <th class="text-center">Nama Studio</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Kapasitas</th>
                        <th class="text-center">Harga per Jam</th>
                        <th class="text-center">Dibuat Pada</th>
                        <th class="text-center">Diubah Pada</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="studioTable">
                    <!-- Data will be filled via JS -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add/Edit Studio -->
    <div id="modalForm" class="modal">
        <div class="modal-box w-11/12 max-w-md">
            <button id="closeModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</button>
            <h2 id="modalTitle" class="text-xl font-bold mb-4">Tambah Studio</h2>
            <form id="studioForm">
                <input type="text" id="studioName" placeholder="Nama Studio" class="input input-bordered w-full mb-3"
                    required>
                <textarea id="description" placeholder="Deskripsi" class="textarea textarea-bordered w-full mb-3" required></textarea>
                <input type="number" id="capacity" placeholder="Kapasitas" class="input input-bordered w-full mb-3"
                    required>
                <input type="number" id="price" placeholder="Harga per Jam"
                    class="input input-bordered w-full mb-5" required>
                <button type="submit" id="submitBtn"
                    class="btn bg-pink-500 hover:bg-pink-600 text-white w-full">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        const initialStudios = [{
                name: "Self Photo",
                description: "lorem ipsum",
                capacity: 3,
                price: 150000,
                createdAt: new Date().toLocaleString(),
                updatedAt: "-"
            },
            {
                name: "Family",
                description: "Lorem Ipsum",
                capacity: 10,
                price: 250000,
                createdAt: new Date().toLocaleString(),
                updatedAt: "-"
            },
            {
                name: "Graduation",
                description: "lampuu kakaaa",
                capacity: 8,
                price: 250000,
                createdAt: new Date().toLocaleString(),
                updatedAt: "-"
            }
        ];

        function renderTable() {
            const table = document.getElementById('studioTable');
            table.innerHTML = "";
            initialStudios.forEach((studio, index) => {
                const row = table.insertRow();
                row.className = "hover";
                row.innerHTML = `
                    <td class="text-center">${studio.name}</td>
                    <td class="text-center">${studio.description}</td>
                    <td class="text-center">${studio.capacity}</td>
                    <td class="text-center">Rp ${studio.price.toLocaleString()}</td>
                    <td class="text-center">${studio.createdAt}</td>
                    <td class="text-center">${studio.updatedAt}</td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm" onclick="editStudio(${index})">🖉 Ubah</button>
                        <button class="btn btn-error btn-sm ml-1" onclick="deleteStudio(${index})">🗑 Hapus</button>
                    </td>
                `;
            });
        }

        function editStudio(index) {
            const studio = initialStudios[index];
            document.getElementById('studioName').value = studio.name;
            document.getElementById('description').value = studio.description;
            document.getElementById('capacity').value = studio.capacity;
            document.getElementById('price').value = studio.price;
            document.getElementById('modalForm').classList.add('modal-open');
            document.getElementById('modalTitle').innerText = 'Ubah Studio';

            document.getElementById('studioForm').onsubmit = function(e) {
                e.preventDefault();
                const updatedStudio = {
                    name: document.getElementById('studioName').value,
                    description: document.getElementById('description').value,
                    capacity: document.getElementById('capacity').value,
                    price: document.getElementById('price').value,
                    createdAt: studio.createdAt,
                    updatedAt: new Date().toLocaleString()
                };
                initialStudios[index] = updatedStudio;
                renderTable();
                document.getElementById('modalForm').classList.remove('modal-open');
                alert('Data studio berhasil diubah!');
            };
        }

        function deleteStudio(index) {
            if (confirm("Yakin ingin menghapus studio ini?")) {
                initialStudios.splice(index, 1);
                renderTable();
            }
        }

        document.getElementById('addStudioBtn').addEventListener('click', () => {
            document.getElementById('modalTitle').innerText = 'Tambah Studio';
            document.getElementById('modalForm').classList.add('modal-open');
            document.getElementById('studioForm').reset();
            document.getElementById('studioForm').onsubmit = function(e) {
                e.preventDefault();
                const newStudio = {
                    name: document.getElementById('studioName').value,
                    description: document.getElementById('description').value,
                    capacity: document.getElementById('capacity').value,
                    price: document.getElementById('price').value,
                    createdAt: new Date().toLocaleString(),
                    updatedAt: "-"
                };
                initialStudios.push(newStudio);
                renderTable();
                document.getElementById('modalForm').classList.remove('modal-open');
                document.getElementById('studioForm').reset();
                alert('Data studio berhasil ditambahkan!');
            }
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('modalForm').classList.remove('modal-open');
        });

        window.onload = renderTable;
    </script>
</body>

</html>