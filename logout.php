<?php
session_start();
session_unset(); // Hapus semua variabel sesi
session_destroy(); // Hapus sesi
header('Location: login.php'); // Redirect ke halaman login
?>
