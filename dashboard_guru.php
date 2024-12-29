<?php
session_start();
include('db_connect.php');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
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
    die("Query gagal dijalankan: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('header.php'); ?>
    <title>Dashboard Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-top: 50px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .dashboard-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #007bff;
        }

        .dashboard-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .dashboard-card {
            flex: 1 1 calc(30% - 20px);
            min-width: 200px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(145deg, #f0f4ff, #dce5ff);
            box-shadow: 4px 4px 10px #b8c2d8, -4px -4px 10px #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-10px);
            box-shadow: 6px 6px 15px #b0bbd6, -6px -6px 15px #ffffff;
        }

        .dashboard-card i {
            font-size: 3rem;
            color: #007bff;
        }

        .dashboard-card .card-body {
            text-align: center;
        }

        .dashboard-card .btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container dashboard-container">
        <h2 class="text-center dashboard-title">Selamat Datang, <?= htmlspecialchars($user['username']); ?>!</h2>
        <p class="text-center mb-4">Selamat datang di Dashboard Guru. Pilih menu di bawah untuk mulai bekerja.</p>
        <div class="dashboard-links">
            <!-- Card: Mark Attendance -->
            <div class="card dashboard-card">
                <div class="card-body">
                    <i class="bi bi-check-circle"></i>
                    <h5 class="card-title mt-2">Mark Attendance</h5>
                    <a href="mark_attendance.php" class="btn btn-primary btn-sm">Go</a>
                </div>
            </div>
            <!-- Card: View Attendance -->
            <div class="card dashboard-card">
                <div class="card-body">
                    <i class="bi bi-file-earmark-text"></i>
                    <h5 class="card-title mt-2">View Attendance</h5>
                    <a href="attendance_report.php" class="btn btn-primary btn-sm">Go</a>
                </div>
            </div>
            <!-- Card: Manage Students -->
            <!-- <div class="card dashboard-card">
                <div class="card-body">
                    <i class="bi bi-people"></i>
                    <h5 class="card-title mt-2">Manage Students</h5>
                    <a href="manage_students.php" class="btn btn-primary btn-sm">Go</a>
                </div>
            </div> -->
        </div>
    </div>

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
