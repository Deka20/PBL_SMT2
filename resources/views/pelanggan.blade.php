<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="favico.ico">
    <title>Dashboard</title>
    <style>
    .navbar-brand {
        margin-left: 20px;
    }

    .navbar {
        background: linear-gradient(to right, #007aff, #105f2d);
    }

    .icon i {
        font-size: 20px;
        margin-right: 20px;
    }

    .col-md-2 {
        background: linear-gradient(to top, #007bff, #424a45);
        min-height: 100vh;
    }

    .nav {
        position: fixed;
    }

    .bg-info {
        position: fixed;
        /* Sidebar tetap di tempat */
    }

    .nav-link {
        margin: 10px;
    }

    .nav-link:hover {
        background-color: #16A34A;
        color: white !important;
        border-radius: 10px;
        transition: background-color 0.5s ease, color 0.3s ease;
    }

    .content {
        padding: 20px;
        margin-top: 40px;
        margin-left: 17%;
        width: 50%;
    }


    .card {
        background-color: #ecf0f1;
        padding: 20px;
        text-align: center;
        margin: 10px;
        border-radius: 5px;
    }

    .card h1 {
        font-size: 3em;
        margin: 0;
    }

    .card p {
        margin: 0;
    }

    .table-container {
        background-color: #bdc3c7;
        padding: 20px;
        border-radius: 5px;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
        <div class="container-fluid">
            <img alt="logo" class="navbar-brand text-white-fa-2x" height="60"
                src="./image/mahasigma-reservation-high-resolution-logo.png">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto d-flex align-items-center">
                    <div class="icon">
                        <a href="logout.php" class="fas fa-sign-out-alt fa-1x me-4 text-black"></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="row g-0 mt-5">
        <!-- Sidebar -->
        <div class="col-md-2 bg-info mt-2 pt-5">
            <ul class="nav flex-column ms-3 mb-5">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="dashboard.php"><i
                            class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="lapangan.php"><i class="fas fa-cube me-2"></i>Lapangan</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="pelanggan.php"><i class="fas fa-users me-2"></i>Pelanggan</a>
                    <hr class="bg-secondary">
                </li>
            </ul>
        </div>

        <!-- Content -->
       <div class="content flex-grow-1 col-md-10">
            <div class="d-flex justify-content-around">
                <h3 class="text-center">Data Pelanggan</h3>
            </div>
            <div class="table-container mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Pemesan</th>
                            <th>Nama Lapangan</th>
                            <th>Kategori</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Jam</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>