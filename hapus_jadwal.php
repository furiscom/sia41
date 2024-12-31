<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM schedule WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "Jadwal pelajaran berhasil dihapus.";
        header("Location: kelola_jadwal.php"); // Redirect kembali ke halaman kelola_jadwal.php
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "ID jadwal pelajaran tidak ditemukan.";
}
?>