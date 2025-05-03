<?php
include '.includes/sidemenu.php';
include '.includes/header.php';
$koneksi = mysqli_connect("localhost", "root", "", "event_management");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil total event
$total_event = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM events"));

// Ambil total partisipan
$total_partisipan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM partisipan"));

// Ambil semua event
$events = mysqli_query($koneksi, "SELECT * FROM events ORDER BY tanggal ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #fce4ec, #f8bbd0);
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    .container {
      margin-left: 250px;
      padding: 30px;
      width: calc(100% - 270px);
    }

    .card-box {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      transition: all 0.3s ease-in-out;
    }

    .card-box:hover {
      box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }

    h2 {
      color: #d63384;
      font-weight: 600;
    }

    .card-box h3 {
      color: #d63384;
      font-weight: 500;
    }

    .card-box p {
      font-size: 22px;
      color: #333;
    }

    .event-list li {
      margin-bottom: 8px;
      font-size: 15px;
    }

    .btn-pink {
      background-color: #d63384;
      border: none;
      color: white;
    }

    .btn-pink:hover {
      background-color: #c2186a;
    }

    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }
  </style>
</head>
<body>

<div class="container">
  <h2 class="mb-4 text-center">Selamat Datang, Admin!</h2>

  <!-- Stat Box -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card-box text-center">
        <h3>Total Event</h3>
        <p><?= $total_event ?> Event</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box text-center">
        <h3>Total Partisipan</h3>
        <p><?= $total_partisipan ?> Orang</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box">
        <h3 class="text-center">Event yang Tersedia</h3>
        <ul class="event-list list-unstyled mt-3">
          <?php while ($row = mysqli_fetch_assoc($events)): ?>
            <li><?= $row['nama_event'] ?> - <?= date("d M Y", strtotime($row['tanggal'])) ?></li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
  </div>

  <!-- Aksi -->
  <div class="text-center">
    <a href="posts.php" class="btn btn-pink me-3">Tambah Event</a>
    <a href="partisipan.php" class="btn btn-secondary">Lihat Partisipan</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>