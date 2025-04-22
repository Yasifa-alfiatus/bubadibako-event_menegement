<?php
$koneksi = mysqli_connect("localhost", "root", "", "event_management");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses Edit
if (isset($_POST['edit'])) {
    $partisipan_id = $_POST['partisipan_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Query untuk update data
    $query = "UPDATE partisipan SET nama='$nama', email='$email' WHERE partisipan_id=$partisipan_id";

    if (mysqli_query($koneksi, $query)) {
        header("Location: partisipan.php");  // Setelah sukses, kembali ke halaman daftar
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Mengambil data partisipan berdasarkan ID
$id = $_GET['id'];
$query = "SELECT * FROM partisipan WHERE partisipan_id=$id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
?>

<h2>Edit Partisipan</h2>
<form method="post" action="edit_partisipan.php">
    <input type="hidden" name="partisipan_id" value="<?php echo $data['partisipan_id']; ?>">
    <div>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $data['email']; ?>" required>
    </div>
    <button type="submit" name="edit">Simpan Perubahan</button>
</form>