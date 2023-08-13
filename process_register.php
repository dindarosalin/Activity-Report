<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menyimpan pengguna dengan peran "user"
    $sql = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', 'user')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil!";
        header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
