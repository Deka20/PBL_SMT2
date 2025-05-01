<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengaturan</title>
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

    main {
      flex: 1;
      margin-left: 250px;
      padding: 30px;
      background-color: #fff;
      overflow-y: auto;
    }

    .card {
      background-color: #fff0f4;
      padding: 20px;
      border-radius: 15px;
      margin-bottom: 30px;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
    }

    .gallery-item {
      background-color: #f3f4f6;
      padding: 15px;
      text-align: center;
      border-radius: 10px;
      position: relative;
    }

    .image-preview img {
      max-height: 120px;
      width: auto;
      border-radius: 8px;
    }

    .btn {
      padding: 8px 16px;
      background-color: #e5e7eb;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .top-right-icon {
      position: absolute;
      top: 20px;
      right: 20px;
      border: 1px solid #ccc;
      border-radius: 50%;
      padding: 8px;
    }

    .top-right-icon img {
      height: 24px;
      width: 24px;
    }
  </style>
</head>
<body>
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

  <main>
    <div class="card">
      <h2>Unggah Gambar</h2>
      <form id="uploadForm" style="margin-top: 15px; display: flex; gap: 10px;">
        <input type="file" id="imageInput" accept="image/*" />
        <button type="submit" class="btn">Unggah Gambar</button>
      </form>
    </div>

    <div class="card">
      <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Galeri Portofolio</h2>
        <span>🖼️</span>
      </div>
    </div>

    <div class="gallery" id="gallery"></div>
  </main>

  <div class="top-right-icon">
    <img src="https://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/512/user-icon.png" alt="User Icon">
  </div>

  <script>
    const form = document.getElementById("uploadForm");
    const imageInput = document.getElementById("imageInput");
    const gallery = document.getElementById("gallery");

    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const file = imageInput.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function () {
        const galleryItem = document.createElement("div");
        galleryItem.classList.add("gallery-item");

        galleryItem.innerHTML = `
          <div class="image-preview"><img src="${reader.result}" alt="Preview"></div>
          <div style="font-size: 12px; color: gray;">Diunggah pada: ${new Date().toLocaleDateString()}</div>
          <button class="btn" style="margin-top: 5px; color: red;">🗑️</button>
        `;

        gallery.appendChild(galleryItem);

        const deleteBtn = galleryItem.querySelector("button");
        deleteBtn.addEventListener("click", () => {
          const confirmDelete = confirm("Yakin ingin menghapus portofolio ini?");
          if (confirmDelete) {
            galleryItem.remove();
          }
        });
      };

      reader.readAsDataURL(file);
      form.reset();
    });
  </script>
</body>
</html>

