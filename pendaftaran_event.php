<?php
session_start();
include '.includes/sidemenu.php';
$koneksi = mysqli_connect("localhost", "root", "", "event_management");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$message = "";
$event_id = $_SESSION['event_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $_SESSION['event_id'] = $event_id;

    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Cek apakah email sudah terdaftar
    $cek_email = $koneksi->prepare("SELECT partisipan_id FROM partisipan WHERE email = ?");
    $cek_email->bind_param("s", $email);
    $cek_email->execute();
    $result = $cek_email->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $partisipan_id = $row['partisipan_id'];
    } else {
        $insert_partisipan = $koneksi->prepare("INSERT INTO partisipan (nama, email) VALUES (?, ?)");
        $insert_partisipan->bind_param("ss", $nama, $email);
        if ($insert_partisipan->execute()) {
            $partisipan_id = $insert_partisipan->insert_id;
        } else {
            die("Gagal insert partisipan: " . $koneksi->error);
        }
    }

    // Insert ke pendaftaran
    $daftar = $koneksi->prepare("INSERT INTO pendaftaran (event_id, partisipan_id, tanggal_pendaftaran) VALUES (?, ?, NOW())");
    $daftar->bind_param("ii", $event_id, $partisipan_id);
    if ($daftar->execute()) {
        $message = "Pendaftaran berhasil!";
    } else {
        $message = "Gagal mendaftar: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran Event</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #fce4ec, #f8bbd0);
      margin: 0;
      overflow-x: hidden;
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

    h2, h5 {
      color: #d63384;
      font-weight: 600;
      text-align: center;
    }

    label {
      color: #6d214f;
      font-weight: 500;
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

    .table thead {
      background-color: #f8bbd0;
    }

    .table th {
      color: #6d214f;
    }

    .alert {
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="container-box">
  <h2>Form Pendaftaran Event</h2>

  <?php if ($message): ?>
    <div class="alert <?= strpos($message, 'berhasil') !== false ? 'alert-success' : 'alert-danger' ?>">
      <?= $message ?>
    </div>
  <?php endif; ?>

  <form method="POST" class="row g-3 mb-4">
    <div class="col-md-12">
      <label class="form-label">Pilih Event</label>
      <select class="form-select" name="event_id" required>
        <option value="">-- Pilih Event --</option>
        <?php
        $eventlist = $koneksi->query("SELECT * FROM events");
        while ($row = $eventlist->fetch_assoc()) {
          $selected = ($event_id == $row['event_id']) ? 'selected' : '';
          echo "<option value='{$row['event_id']}' $selected>{$row['nama_event']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="col-md-6">
      <input type="text" name="nama" class="form-control" placeholder="Nama" required>
    </div>
    <div class="col-md-6">
      <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-success w-100">Daftar</button>
    </div>
  </form>

  <?php if ($event_id): ?>
    <?php
    $list = $koneksi->prepare("
      SELECT p.penyewaan_id, p.tanggal_pendaftaran, e.nama_event, ps.nama 
      FROM pendaftaran p
      JOIN events e ON p.event_id = e.event_id
      JOIN partisipan ps ON p.partisipan_id = ps.partisipan_id
      WHERE p.event_id = ?
    ");
    $list->bind_param("i", $event_id);
    $list->execute();
    $result = $list->get_result();
    ?>

    <hr>
    <h5 class="mt-4">Daftar Pendaftaran untuk Event Ini</h5>
    <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped mt-2">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Nama Partisipan</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_event']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= $row['tanggal_pendaftaran'] ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <p class="text-muted text-center">Belum ada pendaftaran untuk event ini.</p>
    <?php endif; ?>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>