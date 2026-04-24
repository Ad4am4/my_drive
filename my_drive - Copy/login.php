<?php
session_start();
include 'db.php';
$pesan = "";

// Jika sudah login, langsung lempar ke index
if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $data = mysqli_fetch_array($query);

    // Cek apakah username ada DAN password cocok dengan enkripsi di database
    if($data && password_verify($password, $data['password'])){
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        header("Location: index.php"); // Masuk ke drive!
        exit();
    } else {
        $pesan = "<div style='color: red; margin-bottom: 10px;'>Username atau Password salah!</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - My Local Drive</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 350px; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #1a73e8; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background: #1557b0; }
    </style>
</head>
<body>
    <div class="box">
        <h2>🔒 Login Drive</h2>
        <?php echo $pesan; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Masuk</button>
        </form>
        <p style="font-size: 14px; margin-top: 15px;">Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>