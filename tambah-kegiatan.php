<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kegiatan</title>
</head>
<body>
    <h2>Tambah Kegiatan</h2>
    <a href="javascript:history.back()">Kembali</a>
    <nav>
        <ul>
            <li><a href="dashboard-admin.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <?php
    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
        header('Location: login.php');
        exit();
    }
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $judul = mysqli_real_escape_string($conn, $_POST['judul']);
        $isi = mysqli_real_escape_string($conn, $_POST['isi']);
        $tanggal = $_POST['tanggal'];
    
        // Mengamankan unggahan gambar
        $gambar = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_path = "uploads/" . basename($gambar);
    
        // Memastikan hanya file gambar yang diunggah
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $file_extension = strtolower(pathinfo($gambar_path, PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diizinkan.";
        } else {
            move_uploaded_file($gambar_tmp, $gambar_path);
    
            $sql = "INSERT INTO kegiatan (judul, isi, tanggal, gambar) VALUES ('$judul', '$isi', '$tanggal', '$gambar_path')";
            if ($conn->query($sql) === TRUE) {
                echo "Kegiatan berhasil ditambahkan!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>

    <form method="post" action="" enctype="multipart/form-data">
        <label>Judul:</label>
        <input type="text" name="judul" required><br>
        <label>Isi:</label>
        <textarea name="isi" required></textarea><br>
        <label>Tanggal:</label>
        <input type="date" name="tanggal" required><br>
        <label>Gambar:</label>
        <input type="file" name="gambar" required><br>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>
