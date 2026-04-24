<?php
include 'db.php';

<?php
session_start();
if(!isset($_SESSION['user_id'])){
    // Jika belum login, usir kembali ke halaman login
    header("Location: login.php");
    exit();
}
?>

if(isset($_FILES['file_upload'])){
    $name = $_FILES['file_upload']['name'];
    $tmp_name = $_FILES['file_upload']['tmp_name'];
    
    // Folder penyimpanan (akan dibuat otomatis jika belum ada)
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($name);

    if(move_uploaded_file($tmp_name, $target_file)){
        $clean_name = mysqli_real_escape_string($conn, $name);
        $clean_path = mysqli_real_escape_string($conn, $target_file);
        
        $query = "INSERT INTO files (file_name, file_path) VALUES ('$clean_name', '$clean_path')";
        
        if(mysqli_query($conn, $query)){
            header("Location: index.php?status=success");
            exit();
        } else {
            header("Location: index.php?status=error");
            exit();
        }
    } else {
        header("Location: index.php?status=error");
        exit();
    }
}
?>