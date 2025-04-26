<?php
include '.includes/header.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tanggal_pendaftaran = isset($_POST['tanggal_pendaftaran'])? 
    $_POST['tanggal_pendaftaran']: null;

    // Cek apakah email sudah ada di tabel partisipan
    $cek = $conn->prepare("SELECT partisipan_id FROM partisipan WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        // email sudah ada, ambil partisipan_id
        $row = $result->fetch_assoc();
        $partisipan_id = $row['partisipan_id'];
    } else {
        // email belum ada, insert ke partisipan
        $insert_partisipan = $conn->prepare("INSERT INTO partisipan (nama, email) VALUES (?, ?)");
        $insert_partisipan->bind_param("ss", $nama, $email);
        if ($insert_partisipan->execute()) {
            $partisipan_id = $insert_partisipan->insert_id;
        } else {
            die("Gagal insert partisipan: " . $conn->error);
        }
    }

    // Cek apakah sudah pernah daftar ke event ini
    $cek_duplikat = $conn->prepare("SELECT * FROM pendaftaran WHERE event_id = ? AND partisipan_id = ?");
    $cek_duplikat->bind_param("ii", $event_id, $partisipan_id);
    $cek_duplikat->execute();
    $cek_result = $cek_duplikat->get_result();

    if ($cek_result->num_rows > 0) {
        $message = "Email ini sudah terdaftar di event ini.";
    } else {
        // Simpan ke tabel pendaftaran dengan tanggal dari input
        $daftar = $conn->prepare("INSERT INTO pendaftaran (event_id, partisipan_id, tanggal_pendaftaran) 
                                  VALUES (?, ?, ?)");
        $daftar->bind_param("iis", $event_id, $partisipan_id, $tanggal_pendaftaran);
        if ($daftar->execute()) {
            $message = "Pendaftaran berhasil!";
        } else {
            $message = "Gagal mendaftar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Pendaftaran Event</h4>
        </div>
        <div class="card-body">
            <?php if ($message): ?>
                <div class="alert <?= strpos($message, 'berhasil') !== false ? 'alert-success' : 'alert-danger' ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="event_id" class="form-label">Pilih Event</label>
                    <select class="form-select" name="event_id" required>
                        <option value="">-- Pilih Event --</option>
                        <?php
                        $eventlist = $conn->query("SELECT * FROM events");
                        while ($row = $eventlist->fetch_assoc()) {
                            echo "<option value='{$row['event_id']}'>{$row['nama_event']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
                    <input type="date" class="form-control" name="tanggal_pendaftaran" required>
                </div>
                <button type="submit" class="btn btn-success">Daftar</button>
            </form>

            <?php
            if (isset($event_id)) {
                $list = $conn->prepare("SELECT penyewaan_id, event_id, partisipan_id, tanggal_pendaftaran 
                                        FROM pendaftaran 
                                        WHERE event_id = ?");
                $list->bind_param("i", $event_id);
                $list->execute();
                $result = $list->get_result();

                if ($result->num_rows > 0):
            ?>
            <hr>
            <h5 class="mt-4">Daftar Pendaftaran untuk Event Ini</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-2">
                    <thead class="table-primary">
                        <tr>
                            <th>PENYEWAAN_ID</th>
                            <th>EVENT_ID</th>
                            <th>PARTISIPAN_ID</th>
                            <th>TANGGAL PENDAFTARAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['penyewaan_id'] ?></td>
                            <td><?= $row['event_id'] ?></td>
                            <td><?= $row['partisipan_id'] ?></td>
                            <td><?= $row['tanggal_pendaftaran'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; } ?>
        </div>
    </div>
</div>
</body>
</html>