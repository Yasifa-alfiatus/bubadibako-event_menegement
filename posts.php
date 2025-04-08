<?php
include '.includes/header.php';

$query = "SELECT * FROM events";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Event</h2>
        <a href="proses_post.php" class="btn btn-primary mb-3">Tambah Event</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>event Id</th>
                    <th>Nama Event</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['event_id']; ?></td>
                    <td><?= $row['nama_event']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['lokasi']; ?></td>
                    <td>
                        <a href="edit_event.php?id=<?= $row['event_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_event.php?id=<?= $row['event_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus event ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>