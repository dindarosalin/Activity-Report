<?php

session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login-out-reg/login.php');
    exit();
}

$role = $_SESSION['role']; // Deklarasikan variabel $role

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
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
    <div class="text-center">
        <h2>Tentang BPSDM Surabaya</h2>
        <p>Halaman ini adalah halaman tentang BPSDM Kominfo Surabaya</p>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<?php include "../navbar/footer.php" ?>
</body>
</html>
