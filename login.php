<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- style untuk memeperbagus tampilan login -->
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(0, 119, 255);       
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        .login-box h3 {
            margin-bottom: 20px;
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
            height: 45px;
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .btn-primary {
            background-color: #0056ff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0041cc;
        }
        .register-link {
            margin-top: 10px;
            font-size: 14px;
        }
        .register-link a {
            text-decoration: none;
            color: #5a67d8;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Login</h3>

    <!-- Notifikasi Error -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']); // Hapus error setelah ditampilkan
            ?>
        </div>
    <?php endif; ?>

    <!-- Notifikasi Sukses -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']); // Hapus success setelah ditampilkan
            ?>
        </div>
    <?php endif; ?>

    <form action="login_handler.php" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3 password-container">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="register-link"><a href="register.php">Daftar</a></p>
</div>

<!-- Script untuk toggle password -->
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
