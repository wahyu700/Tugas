<?php
session_start();
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = trim($_POST['role']); // Ambil role dari form

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password) || empty($role)) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header("Location: register.php");
        exit();
    }

    // Validasi panjang username
    if (strlen($username) < 4) {
        $_SESSION['error'] = "Username minimal 4 karakter!";
        header("Location: register.php");
        exit();
    }

    // Validasi password minimal 6 karakter
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password minimal 6 karakter!";
        header("Location: register.php");
        exit();
    }

    // Cek konfirmasi password
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Konfirmasi password tidak cocok!";
        header("Location: register.php");
        exit();
    }

    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Koneksi ke database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Cek apakah username sudah ada
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan, coba yang lain!";
        $stmt->close();
        $conn->close();
        header("Location: register.php");
        exit();
    }

    $stmt->close();

    // Simpan ke database dengan role
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Pendaftaran berhasil, silakan login!";
        header("Location: login.php");
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat mendaftar, coba lagi.";
        header("Location: register.php");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: register.php");
    exit();
}
?>
