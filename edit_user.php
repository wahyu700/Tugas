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

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User tidak ditemukan!");
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id'], $_POST['username'], $_POST['role'])) {
        die("Data tidak lengkap!");
    }

    $id = $_POST['id'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Update data user di database
    $sql = "UPDATE users SET username = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Query gagal: " . $conn->error);
    }

    $stmt->bind_param("ssi", $username, $role, $id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=User berhasil diperbarui!");
        exit();
    } else {
        echo "Gagal memperbarui data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit User</h2>
    <form action="edit_user.php?id=<?php echo $user['id']; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="admin_dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
