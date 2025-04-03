<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
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
            max-width: 300px;
        }
        h1 {
            font-size: 20px;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #625bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #5145cd;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Username: <strong><?php echo htmlspecialchars($username); ?></strong></p>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
