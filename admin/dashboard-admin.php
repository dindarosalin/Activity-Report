<?php
include '../koneksi/koneksi.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
$role = $_SESSION['role']; // Ambil peran pengguna dari session

// Mengambil Data Kegiatan
$sql = "SELECT * FROM kegiatan ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    
    <?php
    if ($role === 'admin') {
        include '../navbar/header-admin.php'; // Include header untuk admin
    } else {
        include '../navbar/header-user.php'; // Include header untuk user
    }
    ?>
    <div class="container">
    <h2>Selamat datang di Dashboard Admin</h2>
    <a href="javascript:history.back()">Kembali</a>

    <h3>Daftar Kegiatan</h3>
    <a href="tambah-kegiatan.php">Tambah Kegiatan</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>