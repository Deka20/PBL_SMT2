<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 fixed top-0 left-0 h-screen bg-pink-50 text-pink-600 border-r-2 border-pink-200 p-5">
        <img src="images/logo.png" class="w-16 h-16 rounded-full object-cover block mx-auto">
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

    <!-- Konten Tabel -->
    <div class="ml-64 p-5 flex-1">
        <table class="w-full mt-5 bg-pink-50 rounded-box overflow-hidden">
            <thead>
                <tr class="bg-pink-200">
                    <th class="p-3 text-center">No</th>
                    <th class="p-3 text-center">Nama</th>
                    <th class="p-3 text-center">Nama Pengguna</th>
                    <th class="p-3 text-center">Email</th>
                    <th class="p-3 text-center">No. Telepon</th>
                    <th class="p-3 text-center">Dibuat Pada</th>
                    <th class="p-3 text-center">Diubah Pada</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="customerTable">
                <!-- Data akan diisi lewat JS -->
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal" id="modalForm">
        <div class="modal-box w-11/12 max-w-md relative">
            <h3 class="text-lg font-bold" id="modalTitle">Ubah Pelanggan</h3>
            <form id="customerForm" class="mt-4">
                <input type="text" id="customerName" placeholder="Nama" class="input input-bordered w-full mb-2"
                    required />
                <input type="text" id="username" placeholder="Username" class="input input-bordered w-full mb-2"
                    required />
                <input type="email" id="email" placeholder="Email" class="input input-bordered w-full mb-2"
                    required />
                <input type="text" id="phone" placeholder="No. Telepon" class="input input-bordered w-full mb-4"
                    required />
                <div class="flex justify-end gap-2">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                    <button type="button" class="btn" id="closeModal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        const initialCustomer = [{
            name: "Raniya",
            username: "raniyaaww",
            email: "raniyaa@gmail.com",
            phone: "081234567890",
            createdAt: new Date().toLocaleString(),
            updatedAt: "-"
        }];

        let editingIndex = null;

        function renderTable() {
            const table = document.getElementById('customerTable');
            table.innerHTML = "";
            initialCustomer.forEach((customer, index) => {
                const row = table.insertRow();
                row.className = "hover:bg-pink-100";
                row.innerHTML = `
          <td class="p-3 text-center">${index + 1}</td>
          <td class="p-3 text-center">${customer.name}</td>
          <td class="p-3 text-center">${customer.username}</td>
          <td class="p-3 text-center">${customer.email}</td>
          <td class="p-3 text-center">${customer.phone}</td>
          <td class="p-3 text-center">${customer.createdAt}</td>
          <td class="p-3 text-center">${customer.updatedAt}</td>
          <td class="p-3 text-center">
            <button class="btn btn-warning btn-sm" onclick="editCustomer(${index})">🖉 Ubah</button>
            <button class="btn btn-error btn-sm ml-1" onclick="deleteCustomer(${index})">🗑 Hapus</button>
          </td>
        `;
            });
        }

        function editCustomer(index) {
            const customer = initialCustomer[index];
            document.getElementById('customerName').value = customer.name;
            document.getElementById('username').value = customer.username;
            document.getElementById('email').value = customer.email;
            document.getElementById('phone').value = customer.phone;
            document.getElementById('modalForm').classList.add('modal-open');
            document.getElementById('modalTitle').innerText = 'Ubah Pelanggan';
            editingIndex = index;
        }

        function deleteCustomer(index) {
            if (confirm("Yakin ingin menghapus pelanggan ini?")) {
                initialCustomer.splice(index, 1);
                renderTable();
            }
        }

        document.getElementById('customerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (editingIndex !== null) {
                const updatedCustomer = initialCustomer[editingIndex];
                updatedCustomer.name = document.getElementById('customerName').value;
                updatedCustomer.username = document.getElementById('username').value;
                updatedCustomer.email = document.getElementById('email').value;
                updatedCustomer.phone = document.getElementById('phone').value;
                updatedCustomer.updatedAt = new Date().toLocaleString();
                editingIndex = null;
            }
            document.getElementById('modalForm').classList.remove('modal-open');
            renderTable();
            alert("Data berhasil disimpan!");
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('modalForm').classList.remove('modal-open');
            editingIndex = null;
        });

        window.onload = renderTable;
    </script>
</body>

</html>
<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.2/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside class="w-64 fixed top-0 left-0 h-screen bg-pink-50 text-pink-600 border-r-2 border-pink-200 p-5">
        <img src="images/logo.png" class="w-16 h-16 rounded-full object-cover block mx-auto">
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

    <!-- Konten Tabel -->
    <div class="ml-64 p-5 flex-1">
        <table class="w-full mt-5 bg-pink-50 rounded-box overflow-hidden">
            <thead>
                <tr class="bg-pink-200">
                    <th class="p-3 text-center">No</th>
                    <th class="p-3 text-center">Nama</th>
                    <th class="p-3 text-center">Nama Pengguna</th>
                    <th class="p-3 text-center">Email</th>
                    <th class="p-3 text-center">No. Telepon</th>
                    <th class="p-3 text-center">Dibuat Pada</th>
                    <th class="p-3 text-center">Diubah Pada</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="customerTable">
                <!-- Data akan diisi lewat JS -->
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal" id="modalForm">
        <div class="modal-box w-11/12 max-w-md relative">
            <h3 class="text-lg font-bold" id="modalTitle">Ubah Pelanggan</h3>
            <form id="customerForm" class="mt-4">
                <input type="text" id="customerName" placeholder="Nama" class="input input-bordered w-full mb-2"
                    required />
                <input type="text" id="username" placeholder="Username" class="input input-bordered w-full mb-2"
                    required />
                <input type="email" id="email" placeholder="Email" class="input input-bordered w-full mb-2"
                    required />
                <input type="text" id="phone" placeholder="No. Telepon" class="input input-bordered w-full mb-4"
                    required />
                <div class="flex justify-end gap-2">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                    <button type="button" class="btn" id="closeModal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        const initialCustomer = [{
            name: "Raniya",
            username: "raniyaaww",
            email: "raniyaa@gmail.com",
            phone: "081234567890",
            createdAt: new Date().toLocaleString(),
            updatedAt: "-"
        }];

        let editingIndex = null;

        function renderTable() {
            const table = document.getElementById('customerTable');
            table.innerHTML = "";
            initialCustomer.forEach((customer, index) => {
                const row = table.insertRow();
                row.className = "hover:bg-pink-100";
                row.innerHTML = `
          <td class="p-3 text-center">${index + 1}</td>
          <td class="p-3 text-center">${customer.name}</td>
          <td class="p-3 text-center">${customer.username}</td>
          <td class="p-3 text-center">${customer.email}</td>
          <td class="p-3 text-center">${customer.phone}</td>
          <td class="p-3 text-center">${customer.createdAt}</td>
          <td class="p-3 text-center">${customer.updatedAt}</td>
          <td class="p-3 text-center">
            <button class="btn btn-warning btn-sm" onclick="editCustomer(${index})">🖉 Ubah</button>
            <button class="btn btn-error btn-sm ml-1" onclick="deleteCustomer(${index})">🗑 Hapus</button>
          </td>
        `;
            });
        }

        function editCustomer(index) {
            const customer = initialCustomer[index];
            document.getElementById('customerName').value = customer.name;
            document.getElementById('username').value = customer.username;
            document.getElementById('email').value = customer.email;
            document.getElementById('phone').value = customer.phone;
            document.getElementById('modalForm').classList.add('modal-open');
            document.getElementById('modalTitle').innerText = 'Ubah Pelanggan';
            editingIndex = index;
        }

        function deleteCustomer(index) {
            if (confirm("Yakin ingin menghapus pelanggan ini?")) {
                initialCustomer.splice(index, 1);
                renderTable();
            }
        }

        document.getElementById('customerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (editingIndex !== null) {
                const updatedCustomer = initialCustomer[editingIndex];
                updatedCustomer.name = document.getElementById('customerName').value;
                updatedCustomer.username = document.getElementById('username').value;
                updatedCustomer.email = document.getElementById('email').value;
                updatedCustomer.phone = document.getElementById('phone').value;
                updatedCustomer.updatedAt = new Date().toLocaleString();
                editingIndex = null;
            }
            document.getElementById('modalForm').classList.remove('modal-open');
            renderTable();
            alert("Data berhasil disimpan!");
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('modalForm').classList.remove('modal-open');
            editingIndex = null;
        });

        window.onload = renderTable;
    </script>
</body>

</html>