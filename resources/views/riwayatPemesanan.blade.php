<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pemesanan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="dashboard.css">
  <style>
    body {
      background-color: #eaeaea;
      font-family: "Poppins", sans-serif;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">TICS ID</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link text-light" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle" style="font-size: 24px;"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                <li>
                  <h6 class="dropdown-header">Hello, Zidan</h6>
                </li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
              </ul>
            </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Layout -->
  <div class="container-fluid mt-5">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 bg-dark sidebar d-flex flex-column pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active text-white" href="dashboard_bioskop.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
            <hr class="bg-secondary">
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="user.php"><i class="fas fa-user me-2"></i> Data Pengguna</a>
            <hr class="bg-secondary">
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="film.php"><i class="fas fa-video me-2"></i> Daftar Film</a>
            <hr class="bg-secondary">
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="tiket.php"><i class="fas fa-clock me-2"></i> Riwayat Pemesanan</a>
            <hr class="bg-secondary">
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="coming_soon.php"><i class="fas fa-video me-2"></i> Film Coming Soon</a>
            <hr class="bg-secondary">
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="carousel.php"><i class="fas fa-image me-2"></i> Edit Carousel</a>
            <hr class="bg-secondary">
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="kursi.php"><i class="fas fa-chair me-2"></i> Data Kursi</a>
            <hr class="bg-secondary">
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <div class="col-md-10 p-5 pt-3">
        <h3><i class="fas fa-clock me-2"></i> Riwayat Pemesanan</h3>
        <hr>

        <!-- Table for Booking History -->
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Booking ID</th>
                <th>Username</th>
                <th>Judul Film</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Theater</th>
                <th>Kursi</th>
                <th>Total Seats</th>
                <th>Total Price</th>
                <th>Waktu Pemesanan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <td>1</td>
              <td>TD0124012413</td>
              <td>Zidan</td>
              <td>Deadpool</td>
              <td>18 Agustus 2024</td>
              <td>21.00</td>
              <td>3</td>
              <td>A4</td>
              <td>1</td>
              <td>Rp45.000</td>
              <td>17 Agustus 2024, 20.04</td>
              <td><button class="btn-danger">Delete</button></td>
            </tbody>
            <tbody>
                <td>2</td>
                <td>TD021941245</td>
                <td>Masadita</td>
                <td>Avenger</td>
                <td>12 Agustus 2024</td>
                <td>18.00</td>
                <td>2</td>
                <td>C1</td>
                <td>1</td>
                <td>Rp45.000</td>
                <td>10 Agustus 2024, 10.04</td>
                <td><button class="btn-danger">Delete</button></td>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
