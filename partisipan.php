<?php
include '.includes/sidemenu.php';
include '.includes/header.php';
$koneksi = mysqli_connect("localhost", "root", "", "event_management");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Hapus partisipan
if (isset($_GET['hapus'])) {
    $partisipan_id = $_GET['hapus'];
    $query = "DELETE FROM partisipan WHERE partisipan_id=$partisipan_id";
    mysqli_query($koneksi, $query);
}

// Pencarian Event
$filter_event = '';
if (isset($_GET['cari_event'])) {
    $filter_event = mysqli_real_escape_string($koneksi, $_GET['cari_event']);
}

$query = "
    SELECT p.partisipan_id, p.nama, p.email, e.nama_event
    FROM partisipan p
    LEFT JOIN pendaftaran pd ON p.partisipan_id = pd.partisipan_id
    LEFT JOIN events e ON pd.event_id = e.event_id
";
if ($filter_event !== '') {
    $query .= " WHERE e.nama_event LIKE '%$filter_event%'";
}
$query .= " ORDER BY p.partisipan_id DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Partisipan</title>
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
    <h2>Data Partisipan</h2>

    <!-- Form Pencarian -->
    <form method="get" class="row g-3 mb-4">
      <div class="col-md-10">
        <input type="text" name="cari_event" class="form-control" placeholder="Cari nama event..." value="<?= htmlspecialchars($filter_event) ?>">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Cari</button>
      </div>
    </form>

    <!-- Tabel Partisipan + Event -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-secondary">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Event</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= $row['partisipan_id'] ?></td>
              <td><?= $row['nama'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['nama_event'] ?? '-' ?></td>
              <td>
                <a href="edit_partisipan.php?id=<?= $row['partisipan_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="partisipan.php?hapus=<?= $row['partisipan_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
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