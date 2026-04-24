<?php include 'db.php'; ?>
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    // Jika belum login, usir kembali ke halaman login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Local Drive</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f0f2f5; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #1a73e8; }
        .upload-section { background: #e8f0fe; padding: 20px; border-radius: 8px; margin-bottom: 20px; text-align: center; border: 2px dashed #1a73e8; }
        input[type="file"] { margin-bottom: 10px; width: 100%; max-width: 300px; }
        .btn { background-color: #1a73e8; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; text-decoration: none; display: inline-block; margin: 5px; }
        .btn:hover { background-color: #1557b0; }
        .btn-danger { background-color: #dc3545; font-size: 14px; padding: 8px 15px; }
        .btn-danger:hover { background-color: #c82333; }
        .file-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px; margin-top: 20px; }
        .file-card { background: #fff; border: 1px solid #ddd; padding: 15px; border-radius: 8px; text-align: center; word-wrap: break-word; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .file-card span { display: block; margin: 10px 0; font-weight: 500; }
        .alert { padding: 10px; text-align: center; border-radius: 6px; margin-bottom: 15px; font-weight: bold; }
        .alert.success { background-color: #d4edda; color: #155724; }
        .alert.error { background-color: #f8d7da; color: #721c24; }
        .alert.deleted { background-color: #fff3cd; color: #856404; }
    </style>
</head>
<body>

<div class="container">
    <h2>☁️ My Local Drive</h2>
    <div style="text-align: right; margin-bottom: 20px;">
    Halo, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>! 
    <a href="logout.php" style="color: red; text-decoration: none; font-weight: bold;">[Logout]</a>
</div>

    <?php if(isset($_GET['status'])): ?>
        <?php if($_GET['status'] == 'success'): ?>
            <div class="alert success">✔️ File berhasil diunggah!</div>
        <?php elseif($_GET['status'] == 'deleted'): ?>
            <div class="alert deleted">🗑️ File berhasil dihapus!</div>
        <?php elseif($_GET['status'] == 'error'): ?>
            <div class="alert error">❌ Gagal memproses file.</div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="upload-section">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file_upload" required>
            <br>
            <button type="submit" class="btn">Upload File</button>
        </form>
    </div>

    <h3>File Tersimpan</h3>
    <div class="file-grid">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM files ORDER BY id DESC");
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_array($query)){
                echo "
                <div class='file-card'>
                    📁 <br>
                    <span>".htmlspecialchars($row['file_name'])."</span>
                    <a href='".$row['file_path']."' class='btn' download>Download</a>
                    <a href='delete.php?id=".$row['id']."' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus file ini?');\">Hapus</a>
                </div>";
            }
        } else {
            echo "<p style='grid-column: 1 / -1; text-align: center; color: #777;'>Belum ada file. Yuk upload sesuatu!</p>";
        }
        ?>
    </div>
</div>

</body>
</html>