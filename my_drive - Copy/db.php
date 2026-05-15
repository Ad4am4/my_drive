<?php
$host = "localhost";
$user = "admin_drive";        // <-- Ubah menjadi username baru
$pass = "Securedrive123";      // <-- Masukkan password yang kamu buat tadi
$db = "my_drive";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
