<?php
session_start();

// Koneksi ke database
include '../koneksi/koneksi.php';

// Mengamankan URL dan hak akses
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Query untuk mengambil daftar kegiatan yang ditambahkan oleh admin
$sql = "SELECT * FROM kegiatan ORDER BY tanggal DESC";
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

<?php if (isset($successMessage)) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $successMessage; ?>
    </div>
<?php } elseif (isset($errorMessage)) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
<?php } ?>
<?php
    include '../navbar/header-admin.php';
    ?>

    <div class="container">
        <h2>Daftar Kegiatan Admin</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Isi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['judul'];?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['isi']; ?></td>
                        <td><img src="../uploads/<?php echo $row['gambar']; ?>" alt="Gambar Kegiatan" width="100"></td>
                        <td>
                            <a href="detail-kegiatan.php?id=<?php echo $row['id']; ?>">Detail</a>
                            <a href="edit-kegiatan.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a href="hapus-kegiatan.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
