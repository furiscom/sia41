<?php
// Mengatur koneksi ke database
$servername = "localhost"; // Atau alamat server jika tidak menggunakan localhost
$username = "root";        // Ganti dengan username database Anda
$password = "";            // Ganti dengan password database Anda jika ada
$dbname = "sia"; // Nama database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
