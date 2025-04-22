<?php
include '.includes/header.php';
$koneksi = mysqli_connect("localhost", "root", "", "event_management");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Tambah data partisipan
if (isset($_POST['tambah'])) {
<<<<<<< HEAD
    $partisipan_id = $_POST['partisipan_id'];
=======
    $partisipan_id = $_POST['id_partisipan'];
>>>>>>> f5521e4277211b863c8785a77e208a173e46f83a
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    
    $query = "INSERT INTO partisipan (partisipan_id, nama, email) VALUES ('$partisipan_id', '$nama', '$email')";
    mysqli_query($koneksi, $query);
}

// Hapus data partisipan
if (isset($_GET['hapus'])) {
    $partisipan_id = $_GET['hapus'];
    
    $query = "DELETE FROM partisipan WHERE partisipan_id=$partisipan_id";
    mysqli_query($koneksi, $query);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Partisipan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Data Partisipan</h2>

<<<<<<< HEAD
    <form method="post" style="margin: -280px 0;">
    <input type="hidden" name="partisipan_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <input type="text" name="nama" placeholder="Nama Partisipan" required
           value="<?php echo isset($edit_nama) ? $edit_nama : ''; ?>">
    <input type="email" name="email" placeholder="Email Partisipan" required
           value="<?php echo isset($edit_email) ? $edit_email : ''; ?>">

    <?php if (isset($_GET['id'])): ?>
        <button type="submit" name="edit">Update</button>
    <?php else: ?>
        <button type="submit" name="tambah">Tambah Partisipan</button>
    <?php endif; ?>
=======
    <!-- Form Tambah Partisipan -->
    <form method="post" class="row g-3 mb-4">
         <div class="col-md-3">
            <input type="text" name="id_partisipan" class="form-control" placeholder="Id" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama Partisipan" required>
        </div>
        <div class="col-md-3">
            <input type="email" name="email" class="form-control" placeholder="Email Partisipan" required>
        </div>
        <div class="col-md-3">
            <button type="submit" name="tambah" class="btn btn-primary w-100">Tambah</button>
        </div>
>>>>>>> f5521e4277211b863c8785a77e208a173e46f83a
    </form>

    <!-- Tabel Daftar Partisipan -->
    <h4>Daftar Partisipan</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-secondary">
            <tr>
<<<<<<< HEAD
                <th>id</th>
=======
                <th>ID</th>
>>>>>>> f5521e4277211b863c8785a77e208a173e46f83a
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM partisipan ORDER BY partisipan_id DESC";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['partisipan_id']}</td>";
                echo "<td>{$row['nama']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>
                        <a href='edit_partisipan.php?id={$row['partisipan_id']}' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='partisipan.php?hapus={$row['partisipan_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin mau hapus?')\">Hapus</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>