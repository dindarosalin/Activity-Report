<?php

session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login-out-reg/login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM kegiatan WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header('Location: dashboard-user.php');
        exit();
    }
} else {
    header('Location: dashboard-user.php');
    exit();
}

$role = $_SESSION['role']; // Deklarasikan variabel $role

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Kegiatan</title>
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
        <h2>Detail Kegiatan</h2>
        <a href="javascript:history.back()">Kembali</a>

        <h3><?php echo $row['judul']; ?></h3>
        <p><?php echo $row['tanggal']; ?></p>
        <p><?php echo $row['isi']; ?></p>
        <img src="../uploads/<?php echo $row['gambar']; ?>" width="400">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include "../navbar/footer.php" ?>
</body>
</html>
