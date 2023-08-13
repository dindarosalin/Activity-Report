<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Dashboard</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?></h2>
    <h3>Role: <?php echo $role; ?></h3>
    <a href="logout.php">Logout</a>
</body>
</html>
