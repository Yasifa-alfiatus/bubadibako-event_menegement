<?php
include '.includes/header.php';
$koneksi = mysqli_connect("localhost", "root", "", "event_management");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Tambah data partisipan
if (isset($_POST['tambah'])) {
    $partisipan_id = $_POST['partisipan_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    
    $query = "INSERT INTO partisipan (nama, email) VALUES ('$nama', '$email')";
    mysqli_query($koneksi, $query);
}

// Edit data partisipan
if (isset($_POST['edit'])) {
    $partisipan_id = $_POST['partisipan_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    
    $query = "UPDATE partisipan SET nama='$nama', email='$email' WHERE partisipan_id=$partisipan_id";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Partisipan</title>
</head>
<body style="font-family: sans-serif; padding: 0px;">

    <h2 style="margin: 5;">Data Partisipan</h2>

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
    </form>

    <h2 style="margin: 0; padding: 0;">Daftar Partisipan</h2>
    <table border="2" cellpadding="8" cellspacing="0" style="margin: 0; padding: 0; position: relative; top: -260px;">
        <thead>
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM partisipan";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['nama']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>
                        <a href='edit_partisipan.php?id={$row['partisipan_id']}'>Edit</a> | 
                        <a href='partisipan.php?hapus={$row['partisipan_id']}'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>