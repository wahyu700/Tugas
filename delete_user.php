<?php
session_start();
include 'config/database.php';

// Pastikan hanya admin yang bisa menghapus user
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Pastikan ada parameter ID yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus user berdasarkan ID
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=User berhasil dihapus!");
        exit();
    } else {
        echo "Gagal menghapus user!";
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
