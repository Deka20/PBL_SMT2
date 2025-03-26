<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Menu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images5.alphacoders.com/349/349822.jpg'); 
            background-size: cover;
            background-position: center;
            filter: blur(8px); 
            z-index: 1;
        }
        .registration-container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
        .registration-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="background"></div>
<div class="registration-container">
    <h2 class="text-center">Register</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required> <!-- Input untuk email -->
        </div>
        <div class="form-group">
            <label for="nomor">Nomor Handphone</label>
            <input type="tel" class="form-control" id="nomor" name="nomor" placeholder="Enter phone number" 
                   minlength="10" maxlength="15" required title="Nomor telepon harus berupa angka dengan panjang 10-15 karakter"> <!-- Input untuk nomor telepon -->
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required> <!-- Input untuk password -->
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required> <!-- Input untuk konfirmasi password -->
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button> <!-- Tombol untuk submit form -->
        <div class="text-center mt-3">
            <p>Already have an account? <a href="login" class="text-primary">Login here</a></p> <!-- Link menuju halaman login -->
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
