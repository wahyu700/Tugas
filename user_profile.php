<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
</head>
<body>
    <h1 style="text-align: center; ">Selamat datang,  <?php echo $username; ?>!</h1>
    <div class="text-center">
         <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html> 
