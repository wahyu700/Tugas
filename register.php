<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- style untuk memperbagus tampilan register -->
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(65, 148, 243);       
        }
        .register-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        .register-box h3 {
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
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0041cc;
        }
        .login-link {
            font-size: 14px;
        }
        .login-link a {
            text-decoration: none;
            color: #5a67d8;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h3>Daftar</h3>

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
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <form action="register_handler.php" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="mb-3 password-container">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
        </div>
        <div class="mb-3 password-container">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <span class="toggle-password" onclick="togglePassword('confirm_password')">👁️</span>
        </div>
        
        <!-- Pilihan Role (Admin/User) -->
        <div class="mb-3">
            <select class="form-control" id="role" name="role" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>
    <p class="login-link text-center mt-3">Sudah punya akun? <a href="index.php">Login</a></p>
</div>

<script>
    function togglePassword(id) {
        var passwordField = document.getElementById(id);
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
