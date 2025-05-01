<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Pelanggan</title>
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fc;
      display: flex;
    }
    .sidebar {
      width: 250px;
      background: #ffeaf3;
      height: 100vh;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      color: #cc5480;
      border-right: 2px solid #f9d4e4;
    }
    .sidebar img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
      display: block;
      margin: 0 auto;
    }
    .sidebar h2 {
      text-align: center;
      font-size: 24px;
      color: #d94c82;
      font-weight: bold;
      margin-top: 10px;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 16px;
      text-decoration: none;
      color: black;
      font-size: 16px;
      font-weight: 500;
      border-radius: 8px;
      transition: 0.3s;
      margin-bottom: 10px;
    }
    .sidebar a:hover {
      background-color: #ffd6e7;
      color: #7d2c4e;
      transform: translateX(5px);
    }
    .content {
      margin-left: 250px;
      padding: 20px;
      flex: 1;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #fff0f5;
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      padding: 15px;
      text-align: center;
    }
    th {
      background: #ffd6e7;
    }
    .button {
      padding: 5px 10px;
      margin-left: 5px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn-edit { background-color: #ffc107; color: white; }
    .btn-delete { background-color: #dc3545; color: white; }
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }
    .modal-content {
      background: white;
      padding: 20px;
      border-radius: 10px;
      width: 400px;
      max-width: 90%;
      position: relative;
    }
    .modal-content input {
      width: 100%;
      margin-bottom: 10px;
      padding: 8px;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
  <img src="images/logo.png">
  <h2>Potrétine</h2>
  <nav>
    <a href="dashboardadmin1.html">🏠 Dashboard</a>
    <a href="studionew.html">📷 Studio</a>
    <a href="datapelanggan1.html">👥 Pelanggan</a>
    <a href="pengaturan.html">⚙️ Pengaturan</a>
    <a href="ulasan.html">⭐ Rating & Review</a>
    <a href="#">📈 Statistik Pendapatan</a>
  </nav>
</aside> 

<!-- Konten Tabel -->
<div class="content">
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nama Pengguna</th>
        <th>Email</th>
        <th>No. Telepon</th>
        <th>Dibuat Pada</th>
        <th>Diubah Pada</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="customerTable">
      <!-- Data akan diisi lewat JS -->
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal" id="modalForm">
  <div class="modal-content">
    <h3 id="modalTitle">Ubah Pelanggan</h3>
    <form id="customerForm">
      <input type="text" id="customerName" placeholder="Nama" required />
      <input type="text" id="username" placeholder="Username" required />
      <input type="email" id="email" placeholder="Email" required />
      <input type="text" id="phone" placeholder="No. Telepon" required />
      <button type="submit" class="button btn-edit">Simpan</button>
      <button type="button" class="button" id="closeModal">Batal</button>
    </form>
  </div>
</div>

<!-- Script -->
<script>
  const initialCustomer = [
    {
      name: "Raniya",
      username: "raniyaaww",
      email: "raniyaa@gmail.com",
      phone: "081234567890",
      createdAt: new Date().toLocaleString(),
      updatedAt: "-"
    }
  ];
  
  let editingIndex = null;

  function renderTable() {
    const table = document.getElementById('customerTable');
    table.innerHTML = "";
    initialCustomer.forEach((customer, index) => {
      const row = table.insertRow();
      row.innerHTML = `
        <td>${index + 1}</td>
        <td>${customer.name}</td>
        <td>${customer.username}</td>
        <td>${customer.email}</td>
        <td>${customer.phone}</td>
        <td>${customer.createdAt}</td>
        <td>${customer.updatedAt}</td>
        <td>
          <button class="button btn-edit" onclick="editCustomer(${index})">🖉 Ubah</button>
          <button class="button btn-delete" onclick="deleteCustomer(${index})">🗑️ Hapus</button>
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
    document.getElementById('modalForm').style.display = 'flex';
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
    document.getElementById('modalForm').style.display = 'none';
    renderTable();
    alert("Data berhasil disimpan!"); // Alert bawaan browser
  });

  document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('modalForm').style.display = 'none';
    editingIndex = null;
  });

  window.onload = renderTable;
</script>

</body>
</html>
