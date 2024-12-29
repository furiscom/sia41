<?php
session_start();
include('db_connect.php');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];  // Ambil username dari session

// Query untuk mendapatkan data pengguna (guru)
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dijalankan
if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Jika query gagal, tampilkan pesan error
    die("Query gagal dijalankan: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php include('navbar.php'); ?>


    <!-- Dashboard Content -->
    <div class="container mt-5">
        <h2>Selamat datang, <?php echo $user['username']; ?>!</h2>
        <p>Ini adalah Dashboard Guru.</p>
        <ul class="list-group">
            <li class="list-group-item"><a href="mark_attendance.php">Mark Attendance</a></li>
            <li class="list-group-item"><a href="view_attendance.php">View Attendance</a></li>
        </ul>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-light">
        <p>&copy; 2024 Sistem Absensi Siswa | Semua Hak Dilindungi</p>
    </footer>
</body>
</html>
