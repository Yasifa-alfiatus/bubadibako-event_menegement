<?php
ob_start();
include '.includes/header.php';

$conn = new mysqli("localhost", "root", "", "event_management");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$query = "SELECT * FROM events WHERE event_id = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_event = $_POST['nama_event'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];

    $sql = "UPDATE events SET nama_event='$nama_event', tanggal='$tanggal', lokasi='$lokasi' WHERE event_id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: posts.php");    
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Event</title>
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
      background-color: #f9a825;
      border: none;
    }
  </style>
</head>
<body>
  <div class="container-box">
    <h2>Edit Event</h2>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Pilihan Event:</label>
        <select name="nama_event" class="form-select" required>
          <option disabled>-- Pilih Salah Satu --</option>
          <?php
          $eventOptions = ["Cosplay", "Fashion show", "Pengajian", "Bazar", "Pameran"];
          foreach ($eventOptions as $option) {
              $selected = ($row['nama_event'] == $option) ? "selected" : "";
              echo "<option value=\"$option\" $selected>$option</option>";
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal:</label>
        <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal']; ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Lokasi:</label>
        <input type="text" name="lokasi" class="form-control" value="<?= $row['lokasi']; ?>" required>
      </div>
      <button type="submit" class="btn btn-success">Update</button>
      <a href="posts.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>