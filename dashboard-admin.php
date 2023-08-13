<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include 'koneksi.php';

// Mengambil Data Kegiatan
$sql = "SELECT * FROM kegiatan ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h2>Selamat datang di Dashboard Admin</h2>
    <a href="javascript:history.back()">Kembali</a>
    <nav>
        <ul>
            <li><a href="dashboard-admin.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h3>Daftar Kegiatan</h3>
    <a href="tambah-kegiatan.php">Tambah Kegiatan</a>
    
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Judul</th><th>Tanggal</th><th>Gambar</th><th>Aksi</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['judul']}</td>";
            echo "<td>{$row['tanggal']}</td>";
            echo "<td><img src='uploads/{$row['gambar']}' width='100'></td>";
            echo "<td>
                    <a href='edit-kegiatan.php?id={$row['id']}'>Edit</a> |
                    <a href='dashboard-admin.php?delete={$row['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kegiatan ini?\")'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Belum ada kegiatan.";
    }
    ?>

</body>
</html>