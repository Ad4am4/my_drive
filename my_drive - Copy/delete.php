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

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // Cari data file di database
    $query = mysqli_query($conn, "SELECT * FROM files WHERE id = '$id'");
    $data = mysqli_fetch_array($query);
    
    if($data){
        // Hapus file fisik dari folder uploads
        if(file_exists($data['file_path'])){
            unlink($data['file_path']);
        }
        
        // Hapus data dari database
        mysqli_query($conn, "DELETE FROM files WHERE id = '$id'");
        header("Location: index.php?status=deleted");
        exit();
    }
}
header("Location: index.php");
?>