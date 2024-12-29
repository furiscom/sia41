<?php
session_start();
include('db_connect.php');

// Cek apakah user memiliki role yang sesuai
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guru') {
    header("Location: dashboard_guru.php");
    exit();
}

// Ambil Tingkat - Rombel dari database
$query_rombel = "SELECT DISTINCT `Tingkat - Rombel` FROM siswa"; // Ganti students menjadi siswa
$result_rombel = mysqli_query($conn, $query_rombel);
if (!$result_rombel) {
    die("Error fetching rombel data: " . mysqli_error($conn));
}

// Proses input absensi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rombel = $_POST['rombel'];
    $attendance_data = $_POST['attendance']; // Array yang berisi absensi siswa

    // Menyimpan absensi untuk siswa
    foreach ($attendance_data as $student_id => $status) {
        $query_check = "SELECT * FROM attendance WHERE student_id = '$student_id' AND `Tingkat - Rombel` = '$rombel' AND date = CURDATE()";
        $result_check = mysqli_query($conn, $query_check);

        if (!$result_check) {
            die("Error checking attendance: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result_check) == 0) {
            $query_insert = "INSERT INTO attendance (student_id, `Tingkat - Rombel`, status, date) VALUES ('$student_id', '$rombel', '$status', CURDATE())";
            if (!mysqli_query($conn, $query_insert)) {
                echo "Error saving attendance: " . mysqli_error($conn);
            }
        }
    }

    header("Location: mark_attendance.php?rombel=$rombel&status=saved");
    exit();
}

// Ambil data siswa berdasarkan Tingkat - Rombel yang dipilih
$siswa = [];
$already_marked = false;
if (isset($_GET['rombel'])) {
    $rombel = $_GET['rombel'];

    // Cek apakah absensi sudah dilakukan untuk Tingkat - Rombel ini hari ini
    $query_check_rombel = "SELECT * FROM attendance WHERE `Tingkat - Rombel` = '$rombel' AND date = CURDATE()";
    $result_check_rombel = mysqli_query($conn, $query_check_rombel);

    if (!$result_check_rombel) {
        die("Error checking rombel attendance: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result_check_rombel) > 0) {
        $already_marked = true;
    } else {
        $query_siswa = "SELECT * FROM siswa WHERE `Tingkat - Rombel` = '$rombel'"; // Ganti students menjadi siswa
        $result_siswa = mysqli_query($conn, $query_siswa);

        if (!$result_siswa) {
            die("Error fetching students: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result_siswa)) {
            $siswa[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
<body>

    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container">
        <h2 class="text-center mb-4">Mark Attendance</h2>

        <!-- Form Pilih Tingkat - Rombel -->
        <form method="GET" action="mark_attendance.php">
            <div class="form-group">
                <label for="rombel">Pilih Tingkat - Rombel:</label>
                <select name="rombel" id="rombel" class="form-control" required>
                    <option value="">Pilih Tingkat - Rombel</option>
                    <?php while ($row_rombel = mysqli_fetch_assoc($result_rombel)): ?>
                        <option value="<?php echo $row_rombel['Tingkat - Rombel']; ?>" <?php echo (isset($_GET['rombel']) && $_GET['rombel'] == $row_rombel['Tingkat - Rombel']) ? 'selected' : ''; ?>>
                            <?php echo $row_rombel['Tingkat - Rombel']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan Siswa</button>
        </form>

        <!-- Jika absensi sudah dilakukan, tampilkan pesan -->
        <?php if ($already_marked): ?>
            <div class="alert alert-warning mt-4">
                Absensi untuk Tingkat - Rombel <strong><?php echo htmlspecialchars($rombel); ?></strong> sudah dilakukan hari ini.
            </div>
        <?php elseif (isset($_GET['rombel']) && count($siswa) > 0): ?>
            <!-- Jika Tingkat - Rombel dipilih, tampilkan tabel absensi -->
            <form method="POST" action="mark_attendance.php">
                <input type="hidden" name="rombel" value="<?php echo $_GET['rombel']; ?>">
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswa as $index => $s): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $s['Nama Lengkap']; ?></td>
                                <td>
                                    <select name="attendance[<?php echo $s['id']; ?>]" class="form-control">
                                        <option value="Hadir">Hadir</option>
                                        <option value="Tidak Hadir">Tidak Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-3">Simpan Absensi</button>
            </form>
        <?php elseif (isset($_GET['rombel'])): ?>
            <p>Belum ada siswa di Tingkat - Rombel ini.</p>
        <?php endif; ?>
    </div>

</body>
</html>
