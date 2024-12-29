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

// Ambil mata pelajaran untuk dropdown
$query_mata_pelajaran = "SELECT id, nama FROM mata_pelajaran";
$result_mata_pelajaran = mysqli_query($conn, $query_mata_pelajaran);

// Filter absensi berdasarkan rombel, tanggal, dan mata pelajaran
$rombel_filter = '';
$date_filter = '';
$mata_pelajaran_filter = '';
$result_absensi = [];
if (isset($_POST['rombel'])) {
    $rombel_filter = $_POST['rombel'];
    $date_filter = isset($_POST['date']) ? $_POST['date'] : '';
    $mata_pelajaran_filter = isset($_POST['mata_pelajaran']) ? $_POST['mata_pelajaran'] : '';

    // Menyusun query absensi
    $query_absensi = "SELECT a.id, a.student_id, a.status, a.date, s.`Nama Lengkap`, s.`Tingkat - Rombel`, 
                             mp.nama AS mata_pelajaran, mp.id AS mata_pelajaran_id, 
                             sch.hari, sch.jam_mulai, sch.jam_selesai
                      FROM attendance a
                      JOIN siswa s ON a.student_id = s.id
                      JOIN schedule sch ON sch.id = a.schedule_id
                      JOIN mata_pelajaran mp ON mp.id = sch.mata_pelajaran_id
                      WHERE s.`Tingkat - Rombel` = ?";

    // Menambahkan filter mata pelajaran jika ada
    if ($mata_pelajaran_filter) {
        $query_absensi .= " AND mp.id = ?";
    }

    // Menambahkan filter tanggal jika ada
    if ($date_filter) {
        $query_absensi .= " AND a.date = ?";
    }

    // Menyiapkan dan mengeksekusi query dengan prepared statements
    $stmt = mysqli_prepare($conn, $query_absensi);

    if ($mata_pelajaran_filter && $date_filter) {
        mysqli_stmt_bind_param($stmt, 'sss', $rombel_filter, $mata_pelajaran_filter, $date_filter);
    } elseif ($mata_pelajaran_filter) {
        mysqli_stmt_bind_param($stmt, 'ss', $rombel_filter, $mata_pelajaran_filter);
    } elseif ($date_filter) {
        mysqli_stmt_bind_param($stmt, 'ss', $rombel_filter, $date_filter);
    } else {
        mysqli_stmt_bind_param($stmt, 's', $rombel_filter);
    }

    mysqli_stmt_execute($stmt);
    $result_absensi = mysqli_stmt_get_result($stmt);

    // Cek apakah query berhasil
    if (!$result_absensi) {
        echo "Query failed: " . mysqli_error($conn);
        exit();
    }
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
    <title>Laporan Absensi - Sistem Absensi Siswa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('asset/img/back.png') no-repeat center center fixed;
            background-size: cover;
        }
        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
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
        <h2 class="text-center mb-5">Laporan Absensi</h2>

        <form method="POST" action="attendance_report.php" class="mb-4">
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
                <label for="mata_pelajaran" class="col-md-2 col-form-label">Pilih Mata Pelajaran</label>
                <div class="col-md-4">
                    <select name="mata_pelajaran" id="mata_pelajaran" class="form-control">
                        <option value="">Pilih Mata Pelajaran</option>
                        <?php while ($row_mata_pelajaran = mysqli_fetch_assoc($result_mata_pelajaran)): ?>
                            <option value="<?= $row_mata_pelajaran['id'] ?>" <?= $mata_pelajaran_filter == $row_mata_pelajaran['id'] ? 'selected' : '' ?>>
                                <?= $row_mata_pelajaran['nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label">Pilih Tanggal</label>
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control" value="<?= $date_filter ?>" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
        </form>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Absensi</h4>
                        <?php if (isset($_POST['rombel']) && mysqli_num_rows($result_absensi) > 0): ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Rombel</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Status Kehadiran</th>
                                        <th>Tanggal</th>
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
                                        echo "<td>{$row['mata_pelajaran']}</td>";
                                        echo "<td>{$row['hari']}</td>";
                                        echo "<td>{$row['jam_mulai']}</td>";
                                        echo "<td>{$row['jam_selesai']}</td>";
                                        echo "<td>{$row['status']}</td>";
                                        echo "<td>{$row['date']}</td>";
                                        echo "</tr>";
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Tidak ada data absensi untuk rombel, mata pelajaran, atau tanggal yang dipilih.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form untuk Export ke Excel dan PDF -->
        <form method="POST" action="export_excel.php" class="mb-3">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($date_filter); ?>">
            <input type="hidden" name="rombel" value="<?php echo htmlspecialchars($rombel_filter); ?>">
            <input type="hidden" name="mata_pelajaran" value="<?php echo htmlspecialchars($mata_pelajaran_filter); ?>">
            <button type="submit" class="btn btn-success">Export to Excel</button>
        </form>

        <form method="POST" action="export_pdf.php" class="mb-3">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($date_filter); ?>">
            <input type="hidden" name="rombel" value="<?php echo htmlspecialchars($rombel_filter); ?>">
            <input type="hidden" name="mata_pelajaran" value="<?php echo htmlspecialchars($mata_pelajaran_filter); ?>">
            <button type="submit" class="btn btn-danger">Export to PDF</button>
        </form>

    </div>

    <?php include('footer.php'); ?>

</body>
</html>
