<?php
session_start();
include('db_connect.php');

// Pastikan user sudah login dan memiliki role "admin"
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil data untuk dashboard
// Query untuk mendapatkan jumlah siswa
$query_siswa = "SELECT COUNT(id) AS total_siswa FROM siswa";
$result_siswa = mysqli_query($conn, $query_siswa);

// Periksa apakah query berhasil
if (!$result_siswa) {
    die("Query gagal: " . mysqli_error($conn)); // Menampilkan error jika query gagal
}

// Ambil data jumlah siswa
$data_siswa = mysqli_fetch_assoc($result_siswa);

// Query untuk mendapatkan jumlah absensi
$query_absensi = "SELECT COUNT(id) AS total_absen FROM attendance";
$result_absensi = mysqli_query($conn, $query_absensi);

// Periksa apakah query berhasil
if (!$result_absensi) {
    die("Query gagal: " . mysqli_error($conn)); // Menampilkan error jika query gagal
}

// Ambil data jumlah absensi
$data_absensi = mysqli_fetch_assoc($result_absensi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Absensi Siswa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link href="asset/css/styles.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        body {
    font-family: Arial, sans-serif;
    background: url('asset/img/laptop.jpg') no-repeat center center fixed;
    background-size: cover;
}
.background-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.5); /* Warna putih dengan transparansi 50% */
    z-index: -1;
}

.login-form {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.login-form h2 {
    text-align: center;
    margin-bottom: 30px;
}
.footer {
    text-align: center;
    padding: 20px;
    position: absolute;
    bottom: 0;
    width: 100%;
}
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container">
        <h2 class="text-center mb-5">Dashboard Admin</h2>
        
        <div class="row">
            <!-- Total Siswa -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Siswa</h4>
                        <p class="card-text"><?php echo $data_siswa['total_siswa']; ?> Siswa</p>
                        <a href="manage_students.php" class="btn btn-primary">Kelola Data Siswa</a>
                    </div>
                </div>
            </div>
            
            <!-- Total Absensi -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Absensi</h4>
                        <p class="card-text"><?php echo $data_absensi['total_absen']; ?> Absensi Tercatat</p>
                        <a href="attendance_report.php" class="btn btn-primary">Lihat Laporan Absensi</a>
                    </div>
                </div>
            </div>

            <!-- Manage Users -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manajemen Pengguna</h4>
                        <p class="card-text">Kelola akun pengguna (admin, guru, dll.)</p>
                        <a href="manage_users.php" class="btn btn-primary">Kelola Pengguna</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>
