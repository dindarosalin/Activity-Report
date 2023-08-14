<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login-out-reg/login.php');
    exit();
}

include '../koneksi/koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk memastikan bahwa kegiatan tersebut milik admin yang sedang login
    $query = "SELECT * FROM kegiatan WHERE id = $id";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // Hapus kegiatan dari database
        $deleteQuery = "DELETE FROM kegiatan WHERE id = $id";
        if ($conn->query($deleteQuery) === TRUE) {
            header('Location: daftar-kegiatan-crud.php');
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        header('Location: daftar-kegiatan-crud.php');
        exit();
    }
} else {
    header('Location: daftar-kegiatan-crud.php');
    exit();
}
?>
