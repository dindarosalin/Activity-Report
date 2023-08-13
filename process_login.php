<?php
session_start();
include 'koneksi.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Validasi informasi login dengan data dari database
$sql = "SELECT * FROM user WHERE username='$username' AND password='$password' AND role='$role'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $role;
    
    if ($role === 'admin') {
        header('Location: dashboard-admin.php'); // Redirect ke dashboard admin
    } elseif ($role === 'user') {
        header('Location: dashboard-user.php'); // Redirect ke dashboard user
    }
} else {
    echo "Username, password, atau peran salah.";
}

$conn->close();
?>
