<?php
ob_start();
include '.includes/header.php';

$id = $_GET['id'];
$query = "SELECT * FROM events WHERE event_id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $nama_event = $_POST['nama_event'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];

    $sql = "UPDATE events SET nama_event='$nama_event', tanggal='$tanggal', lokasi='$lokasi' WHERE event_id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: posts.php");    
    } else {
        echo "Error updating record: " .$conn->error;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Event</h2>
        <form action="" method="post">
        <div class="mb-3">
        <label>Pilihan Event:</label>
        <select name="nama_event" class="form-control" required>
            <option value="" selected disabled>-- Pilih Salah Satu --</option>
            <option value="Cosplay">Cosplay</option>
            <option value="Fashion show">Fashion show</option>
            <option value="Pengajian">Pengajian</option>
            <option value="Bazar">Bazar</option>
            <option value="Pameran">Pameran</option>
        </select>
    </div>
            <div class="mb-3">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Lokasi:</label>
                <input type="text" name="lokasi" class="form-control" value="<?= $row['lokasi']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="posts.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
