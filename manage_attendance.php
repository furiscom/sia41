<?php
session_start();
include('db_connect.php');

// Pastikan user sudah login dan memiliki role "admin" atau "guru"
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'guru')) {
    header("Location: login.php");
    exit();
}

// Ambil rombel (kelas) untuk dropdown
$query_rombel = "SELECT DISTINCT `Tingkat - Rombel` FROM siswa";
$result_rombel = mysqli_query($conn, $query_rombel);

// Filter absensi berdasarkan rombel
$rombel_filter = '';
if (isset($_POST['rombel'])) {
    $rombel_filter = $_POST['rombel'];
    $query_absensi = "SELECT a.id, a.student_id, a.status, s.`Nama Lengkap`, s.`Tingkat - Rombel`
                      FROM attendance a
                      JOIN siswa s ON a.student_id = s.id
                      WHERE s.`Tingkat - Rombel` = '$rombel_filter'";
    $result_absensi = mysqli_query($conn, $query_absensi);
} else {
    // Jika rombel tidak dipilih
    $result_absensi = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Absensi - Sistem Absensi Siswa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container">
        <h2 class="text-center mb-5">Kelola Absensi Siswa</h2>

        <form method="POST" action="manage_attendance.php" class="mb-4">
            <div class="form-group row">
                <label for="rombel" class="col-md-2 col-form-label">Pilih Kelas (Rombel)</label>
                <div class="col-md-4">
                    <select name="rombel" id="rombel" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        <?php while ($row_rombel = mysqli_fetch_assoc($result_rombel)): ?>
                            <option value="<?= $row_rombel['Tingkat - Rombel'] ?>" <?= $rombel_filter == $row_rombel['Tingkat - Rombel'] ? 'selected' : '' ?>>
                                <?= $row_rombel['Tingkat - Rombel'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Tampilkan Absensi</button>
                </div>
            </div>
        </form>

        <?php if ($rombel_filter): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Absensi Siswa di Rombel <?= $rombel_filter ?></h4>
                            <?php if (mysqli_num_rows($result_absensi) > 0): ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Rombel</th>
                                            <th>Status Kehadiran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result_absensi)) {
                                            echo "<tr>";
                                            echo "<td>{$no}</td>";
                                            echo "<td>{$row['Nama Lengkap']}</td>";
                                            echo "<td>{$row['Tingkat - Rombel']}</td>";
                                            echo "<td>{$row['status']}</td>";
                                            echo "<td><a href='edit_attendance.php?id={$row['id']}' class='btn btn-warning'>Edit</a></td>";
                                            echo "</tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Tidak ada data absensi untuk rombel ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>&copy; 2024 Sistem Absensi Siswa | Semua Hak Dilindungi</p>
    </div>

</body>
</html>
