<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <div class="container">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </div>
</body>

</html>