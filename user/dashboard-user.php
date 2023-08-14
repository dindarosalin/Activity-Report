<?php
include '../koneksi/koneksi.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
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
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <?php
    include '../navbar/header-user.php'; // Include header untuk user
    ?>
    <div class="container">
        <main>
            <div class="bd-masthead mb-3" id="content">
                <div class="container-xxl bd-gutter">
                    <div class="col-md-8 mx-auto text-center">
                        <a class="d-flex flex-column flex-lg-row justify-content-center align-items-center mb-4 text-dark lh-sm text-decoration-none" href="https://blog.getbootstrap.com/">
                            <strong class="d-sm-inline-block p-2 me-2 mb-2 mb-lg-0 rounded-3 masthead-notice">2023</strong>
                            <span class="text-body-secondary">Kementrian Komunikasi dan Informasi</span>
                        </a>
                        <img src="../uploads/bpsdmp.png" width="200" height="165" alt="Bootstrap" class="d-none d-sm-block mx-auto mb-3">
                        <h1 class="mb-3 fw-semibold lh-1">BPDSMP</h1>
                        <p class="lead mb-4">
                            Lorem ipsum suspendisse curabitur donec congue egestas tempus taciti fames venenatis tempus, sagittis senectus enim interdum tincidunt urna gravida tempor auctor sit fames, tortor lorem ante ipsum eros vel tristique libero felis sociosqu.
                        </p>
                        <div class="d-flex flex-column flex-lg-row align-items-md-stretch justify-content-md-center gap-3 mb-4">
                            <a href="../user/daftar-kegiatan.php" class="btn btn-lg bd-btn-lg btn-bd-primary d-flex align-items-center justify-content-center fw-semibold">
                                Dapatkan Informasi Kegiatan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <?php include "../navbar/footer.php" ?>
</body>

</html>