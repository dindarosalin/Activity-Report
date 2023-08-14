<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login-out-reg/login.php');
    exit();
}

include '../koneksi/koneksi.php';

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

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Kegiatan berhasil ditambahkan!";
            header('Location: daftar-kegiatan-crud.php');
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }

        // $conn->query($sql);
        // header('Location: edit-kegiatan.php');
    }

    $sql = "SELECT * FROM kegiatan WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kegiatan Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <?php
    include '../navbar/header-admin.php'; // Include header untuk admin
    ?>
    <div class="container">
        <h2>Tambah Kegiatan Baru</h2>
        <a href="javascript:history.back()">Kembali</a>


        <h2>Edit Kegiatan</h2>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Judul Kegiatan</label>
                <input type="text" name="judul" required class="form-control" id="exampleFormControlInput1" value="<?php echo $row['judul']; ?>">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Ringkasan Kegiatan</label>
                <textarea class="form-control" name="isi" required id="exampleFormControlTextarea1" rows="3"><?php echo $row['isi']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo $row['tanggal']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Dokumentasi Kegiatan</label>
                <input class="form-control" type="file" id="formFile" name="gambar">
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" name="update">Update Kegiatan</button>
            </div>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>