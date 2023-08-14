<?php
session_start();
include '../koneksi/koneksi.php';

// Mengamankan halaman agar hanya dapat diakses oleh admin
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Fungsi untuk menghapus pengguna
if (isset($_GET['hapus'])) {
    $idHapus = $_GET['hapus'];
    $sqlHapus = "DELETE FROM user WHERE id = '$idHapus'";
    if ($conn->query($sqlHapus)) {
        header('Location: daftar-user.php');
        exit();
    } else {
        echo "Gagal menghapus pengguna: " . $conn->error;
    }
}

// Query untuk mengambil daftar pengguna
$sql = "SELECT id, username, role FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kegiatan Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <?php include '../navbar/header-admin.php'; ?>

    <div class="container mt-5">
        <h2>Daftar User</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                            <a href="daftar-user.php?hapus=<?php echo $row['id']; ?>"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
