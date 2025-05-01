<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Dashboard</title>
    <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fc;
      display: flex;
    }

    /* --- SIDEBAR STYLING --- */
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
    .add-studio {
      margin-bottom: 20px;
      padding: 10px 15px;
      background-color: hotpink;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
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
    </style>
</head>
<body>
    <!-- Sidebar -->
<aside class="sidebar">
    <img src="<img src={{ asset('images/logo.png') }}" alt="Logo"> 
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
   <!-- Content -->
   <div class="content">
    <button id="addStudioBtn" class="add-studio">+ Tambah Studio</button>

    <!-- Tabel Studio -->
    <table>
      <thead>
        <tr>
          <th>Nama Studio</th>
          <th>Deskripsi</th>
          <th>Kapasitas</th>
          <th>Harga per Jam</th>
          <th>Dibuat Pada</th>
          <th>Diubah Pada</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="studioTable">
        <!-- Data akan diisi lewat JS -->
      </tbody>
    </table>
  </div>

  <!-- Modal Tambah/Edit Studio -->
  <div id="modalForm" class="modal">
    <div class="modal-content">
      <button id="closeModal" style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 20px;">&times;</button>
      <h2 id="modalTitle">Tambah Studio</h2>
      <form id="studioForm">
        <input type="text" id="studioName" placeholder="Nama Studio" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
        <textarea id="description" placeholder="Deskripsi" required style="width: 100%; padding: 10px; margin-bottom: 10px;"></textarea>
        <input type="number" id="capacity" placeholder="Kapasitas" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
        <input type="number" id="price" placeholder="Harga per Jam" required style="width: 100%; padding: 10px; margin-bottom: 20px;">
        <button type="submit" id="submitBtn" class="add-studio" style="width: 100%;">Simpan</button>
      </form>
    </div>
  </div>

<script>
  const initialStudios = [
    {
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
    table.innerHTML = ""; // Clear tabel
    initialStudios.forEach((studio, index) => {
      const row = table.insertRow();
      row.innerHTML = `
        <td>${studio.name}</td>
        <td>${studio.description}</td>
        <td>${studio.capacity}</td>
        <td>Rp ${studio.price.toLocaleString()}</td>
        <td>${studio.createdAt}</td>
        <td>${studio.updatedAt}</td>
        <td>
          <button class="button btn-edit" onclick="editStudio(${index})">🖉 Ubah</button>
          <button class="button btn-delete" onclick="deleteStudio(${index})">🗑️ Hapus</button>
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
    document.getElementById('modalForm').style.display = 'flex';
    document.getElementById('modalTitle').innerText = 'Ubah Studio';

    document.getElementById('studioForm').onsubmit = function(e) {
      e.preventDefault();
      const updatedStudio = {
        name: document.getElementById('studioName').value,
        description: document.getElementById('description').value,
        capacity: document.getElementById('capacity').value,
        price: document.getElementById('price').value,
        createdAt: studio.createdAt,
        updatedAt: new Date().toLocaleString() // Update waktu perubahan
      };
      initialStudios[index] = updatedStudio;  // Update studio yang sudah ada
      renderTable();
      document.getElementById('modalForm').style.display = 'none';
      alert('Data studio berhasil diubah!');
    };
  }

  function deleteStudio(index) {
    if(confirm("Yakin ingin menghapus studio ini?")) {
      initialStudios.splice(index, 1);
      renderTable();
    }
  }

  document.getElementById('addStudioBtn').addEventListener('click', () => {
    document.getElementById('modalTitle').innerText = 'Tambah Studio';
    document.getElementById('modalForm').style.display = 'flex';
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
      document.getElementById('modalForm').style.display = 'none';
      document.getElementById('studioForm').reset();
      alert('Data studio berhasil ditambahkan!');
    }
  });

  document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('modalForm').style.display = 'none';
  });

  window.onload = renderTable;
</script>
</body>
</html>
