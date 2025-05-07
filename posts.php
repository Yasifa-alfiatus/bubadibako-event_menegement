<?php
include '.includes/sidemenu.php';
include '.includes/header.php';
$koneksi = mysqli_connect("localhost", "root", "", "event_management");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "SELECT * FROM events ORDER BY tanggal ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Event</title>
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

    .btn-primary {
      background-color: #d63384;
      border: none;
    }

    .btn-primary:hover {
      background-color: #c2186a;
    }

    .btn-warning {
      background-color: #f9a825;
      border: none;
    }

    .btn-danger {
      background-color: #e91e63;
      border: none;
    }

    .table thead {
      background-color: #f8bbd0;
    }

    .table th {
      color: #6d214f;
    }
  </style>
</head>
<body>

<div class="container-box">
  <h2>Daftar Event</h2>

  <div class="text-end mb-3">
    <a href="proses_post.php" class="btn btn-primary">Tambah Event</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-secondary">
        <tr>
          <th>No</th>
          <th>Nama Event</th>
          <th>Tanggal</th>
          <th>Lokasi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['nama_event']; ?></td>
          <td><?= $row['tanggal']; ?></td>
          <td><?= $row['lokasi']; ?></td>
          <td>
            <a href="edit_post.php?id=<?= $row['event_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="hapus_post.php?id=<?= $row['event_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus event ini?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>