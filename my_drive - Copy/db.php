<?php
$host = "localhost";
$user = "admin_drive";        // <-- Ubah menjadi username baru
$pass = getenv('DB_PASS');    // <-- Ambil password dari variabel lingkungan, jangan simpan langsung di kode
$db = "my_drive";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
