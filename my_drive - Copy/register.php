<?php
include_once 'db.php';
$pesan = "";

if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    // Enkripsi password untuk keamanan tingkat tinggi
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";
    if(mysqli_query($conn, $query)){
        $pesan = "<div style='color: green;'>Pendaftaran berhasil! Silakan <a href='login.php'>Login di sini</a>.</div>";
    } else {
        $pesan = "<div style='color: red;'>Username sudah dipakai atau terjadi kesalahan.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - My Local Drive</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 350px; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #1a73e8; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background: #1557b0; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Daftar Akun Drive</h2>
        <?php echo $pesan; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Buat Username" required>
            <input type="password" name="password" placeholder="Buat Password" required>
            <button type="submit" name="register">Daftar</button>
        </form>
    </div>
</body>
</html>
