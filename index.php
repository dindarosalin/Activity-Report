<!DOCTYPE html>
<html>
<head>
    <title>Halaman Utama</title>
</head>
<body>
    <h2>Selamat datang di BPSDMP Kominfo Surabaya</h2>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    
    <!-- Menampilkan daftar kegiatan dari database -->
    <?php
    include 'koneksi.php';

    $sql = "SELECT * FROM kegiatan ORDER BY tanggal DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Daftar Kegiatan</h3>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['judul']} - {$row['tanggal']}</li>";
        }
        echo "</ul>";
    } else {
        echo "Belum ada kegiatan.";
    }

    $conn->close();
    ?>
</body>
</html>
