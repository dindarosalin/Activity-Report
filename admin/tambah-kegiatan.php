<?php
include '../koneksi/koneksi.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login-out-reg/login.php');
    exit();
}
$role = $_SESSION['role']; // Ambil peran pengguna dari session

// Mengambil Data Kegiatan
$sql = "SELECT * FROM kegiatan ORDER BY tanggal DESC";
$result = $conn->query($sql);
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
    if ($role === 'admin') {
        include '../navbar/header-admin.php'; // Include header untuk admin
    } else {
        include '../navbar/header-user.php'; // Include header untuk user
    }
    ?>
    <div class="container">
        <p class="h5 text-center">Tambah Kegiatan</p>

        <?php

        if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
            header('Location: ../login-out-reg/login.php');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $judul = mysqli_real_escape_string($conn, $_POST['judul']);
            $isi = mysqli_real_escape_string($conn, $_POST['isi']);
            $tanggal = $_POST['tanggal'];

            // Mengamankan unggahan gambar
            $gambar = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];
            $gambar_path = "../uploads/" . basename($gambar);

            // Memastikan hanya file gambar yang diunggah
            $allowed_extensions = array("jpg", "jpeg", "png", "gif");
            $file_extension = strtolower(pathinfo($gambar_path, PATHINFO_EXTENSION));

            if (!in_array($file_extension, $allowed_extensions)) {
                echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diizinkan.";
            } else {
                move_uploaded_file($gambar_tmp, $gambar_path);

                $sql = "INSERT INTO kegiatan (judul, isi, tanggal, gambar) VALUES ('$judul', '$isi', '$tanggal', '$gambar_path')";
                if ($conn->query($sql) === TRUE) {
                    $successMessage = "Kegiatan berhasil ditambahkan!";
                } else {
                    $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        ?>

        <?php if (isset($successMessage)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php } elseif (isset($errorMessage)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php } ?>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Judul Kegiatan</label>
                <input type="text" name="judul" required class="form-control" id="exampleFormControlInput1" placeholder="tuliskan judul/tema kegiatan">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Ringkasan Kegiatan</label>
                <textarea class="form-control" name="isi" required id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Dokumentasi Kegiatan</label>
                <input class="form-control" type="file" id="formFile" name="gambar" required>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Tambah Kegiatan</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>