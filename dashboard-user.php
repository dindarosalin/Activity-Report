<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
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
    <title>Dashboard User</title>
</head>
<body>
    <h2>Selamat datang di Dashboard User</h2>
    <nav>
        <ul>
            <li><a href="dashboard-user.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h3>Daftar Kegiatan</h3>
    
    <?php
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><a href='detail-kegiatan.php?id={$row['id']}'>{$row['judul']}</a> - {$row['tanggal']}</li>";
        }
        echo "</ul>";
    } else {
        echo "Belum ada kegiatan.";
    }
    ?>

</body>
</html>
