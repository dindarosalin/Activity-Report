<!DOCTYPE html>
<html>
<head>
    <title>Edit Kegiatan</title>
</head>
<body>
    <h2>Tambah Kegiatan Baru</h2>
    <a href="javascript:history.back()">Kembali</a>
    <?php
    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
        header('Location: login.php');
        exit();
    }
    
    include 'koneksi.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['update'])) {
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $tanggal = $_POST['tanggal'];

            // Mengupdate gambar jika ada file yang diunggah
            if (!empty($_FILES['gambar']['name'])) {
                $gambar = $_FILES['gambar']['name'];
                $gambar_tmp = $_FILES['gambar']['tmp_name'];
                move_uploaded_file($gambar_tmp, "uploads/" . $gambar);

                $sql = "UPDATE kegiatan SET judul='$judul', isi='$isi', tanggal='$tanggal', gambar='$gambar' WHERE id=$id";
            } else {
                $sql = "UPDATE kegiatan SET judul='$judul', isi='$isi', tanggal='$tanggal' WHERE id=$id";
            }

            $conn->query($sql);
            header('Location: dashboard-admin.php');
        }

        $sql = "SELECT * FROM kegiatan WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>

    <h2>Edit Kegiatan</h2>
    <nav>
        <ul>
            <li><a href="dashboard-admin.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <form method="post" action="" enctype="multipart/form-data">
        <label>Judul:</label>
        <input type="text" name="judul" value="<?php echo $row['judul']; ?>" required><br>
        <label>Isi:</label>
        <textarea name="isi" required><?php echo $row['isi']; ?></textarea><br>
        <label>Tanggal:</label>
        <input type="date" name="tanggal" value="<?php echo $row['tanggal']; ?>" required><br>
        <label>Gambar:</label>
        <input type="file" name="gambar"><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
