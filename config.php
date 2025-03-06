<?php

//konfigurasi koneksi database
$host = "localhost"; // Nama host server database
$username ="root"; // Username untuk akses database
$password =""; // Password untuk akses database
$database = "event_"; // Nama database yang di gunakan

// Membuat koneksi ke database menggunakan mysql
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // Menampilkan pesan error jika koneksi gagal
    die("Database gagal terkoneksi: " .$conn->connect_error);
}

// jika berhasil, script akan terus berjalan tanpa pesan erros
?>