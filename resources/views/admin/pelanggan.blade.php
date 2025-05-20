<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <title>Pelanggan Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#d94c82',
                        secondary: '#ffd6e7',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50">

    <x-sidebar></x-sidebar>

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
