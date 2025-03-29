<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Atur charset ke UTF-8 untuk mencegah masalah encoding
$conn->set_charset("utf8mb4");
?>
