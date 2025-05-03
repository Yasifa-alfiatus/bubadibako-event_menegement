<?php
ob_start();
include '.includes/header.php';

$conn = mysqli_connect("localhost", "root", "", "event_management");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_event = $_POST['nama_event'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];

    $sql = "INSERT INTO events (nama_event, tanggal, lokasi) VALUES ('$nama_event', '$tanggal', '$lokasi')";
    if (mysqli_query($conn, $sql)) {
        header("Location: posts.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: linear-gradient(to right, #fce4ec, #f8bbd0);
            font-family: 'Poppins', sans-serif;
        }

        .container-box {
            margin-top: 40px;
            margin-left: 250px;
            margin-right: 20px;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            max-width: calc(100% - 270px);
        }

        h2 {
            color: #d63384;
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #f8bbd0;
        }

        .btn-success {
            background-color: #d63384;
            border: none;
        }

        .btn-success:hover {
            background-color: #c2186a;
        }

        .btn-secondary {
            background-color: #aaa;
            border: none;
        }

        label {
            color: #6d214f;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container-box">
    <h2>Tambah Event</h2>
    <form method="post">
        <div class="mb-3">
            <label for="nama_event" class="form-label">Jenis Event</label>
            <select name="nama_event" class="form-select" required>
                <option value="" selected disabled>-- Pilih Salah Satu --</option>
                <option value="Cosplay">Cosplay</option>
                <option value="Fashion show">Fashion show</option>
                <option value="Pengajian">Pengajian</option>
                <option value="Bazar">Bazar</option>
                <option value="Pameran">Pameran</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="posts.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>