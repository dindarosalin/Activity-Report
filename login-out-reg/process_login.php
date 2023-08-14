<?php
session_start();
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validasi informasi login dengan data dari database
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['id']; // Menambahkan user ID ke dalam session
        $_SESSION['role'] = $role;

        if ($role === 'admin') {
            header('Location: ../admin/dashboard-admin.php');
        } elseif ($role === 'user') {
            header('Location: ../user/dashboard-user.php');
        }
        exit();
    } else {
        $loginError = "Username, password, atau peran salah.";
    }
}

$conn->close();
?>
