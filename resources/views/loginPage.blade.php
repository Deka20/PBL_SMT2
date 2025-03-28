<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestEasy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
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

        .login-container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        .login-container h2 {
            margin-bottom: 10px;
        }

        .login-container .form-group {
            margin-bottom: 20px;
        }

        .login-container button {
            width: 100%;
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 576px) {
            body {
                padding-top: 10vh;  /* Berikan sedikit ruang di atas agar form tidak terlalu turun */
            }

            .login-container {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="background"></div>
<div class="login-container">
    <h2 class="text-center">RestEasy</h2>
    <h5 class="text-center">Welcome to RestEasy</h5>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="text-center mt-3">
            <a href="#" class="text-muted">Forgot Password?</a>
        </div>
        <div class="text-center mt-2">
            <p>Don't have an account? <a href="register" class="text-primary">Register here</a></p>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>