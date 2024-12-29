<?php
include('db_connect.php');

// Cek apakah rombel dipilih
if (isset($_POST['Tingkat - Rombel'])) {
    $rombel = $_POST['Tingkat - Rombel'];

    // Ambil siswa berdasarkan rombel
    $query_siswa = "SELECT id, `Nama Lengkap` FROM siswa WHERE `Tingkat - Rombel` = '$rombel'";
    $result_siswa = mysqli_query($conn, $query_siswa);

    // Tampilkan siswa sebagai opsi
    while ($row_siswa = mysqli_fetch_assoc($result_siswa)) {
        echo "<option value='" . $row_siswa['id'] . "'>" . $row_siswa['Nama Lengkap'] . "</option>";
    }
}
?>
