<?php
session_start();
include 'config/database.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Periksa apakah ID tersedia di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

// Periksa apakah koneksi ke database berhasil
if (!$conn) {
    die("Koneksi database tidak tersedia!");
}

// Ambil data user berdasarkan ID
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query gagal: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah user ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User tidak ditemukan!");
}

// Pastikan variabel tidak null sebelum digunakan
$username = isset($user['username']) ? $user['username'] : '';
$role = isset($user['role']) ? $user['role'] : '';
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: rgb(65, 148, 243);
            font-family: Arial, sans-serif;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 350px;
        }
        h2 {
            font-size: 22px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #625bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #5145cd;
        }
        .btn-secondary {
            background: #888;
        }
        .btn-secondary:hover {
            background: #666;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Edit User</h2>
        <form action="edit_user.php?id=<?php echo $user['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role">
                    <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>
            
            <button type="submit" class="btn">Simpan</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
