<?php
session_start();
include('db_connect.php');

// Validasi login dan role pengguna
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guru') {
    header("Location: dashboard_guru.php");
    exit();
}

// Pemetaan nama hari ke bahasa Indonesia
$hari_map = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];
$hari_ini = $hari_map[date('l')];

// Ambil Tingkat - Rombel dari database
$query_rombel = "SELECT DISTINCT `Tingkat - Rombel` FROM siswa";
$result_rombel = mysqli_query($conn, $query_rombel);
if (!$result_rombel) {
    die("Error fetching Rombel data: " . mysqli_error($conn));
}

// Ambil mata pelajaran berdasarkan hari ini
$query_mata_pelajaran = "SELECT DISTINCT mp.nama AS nama_mata_pelajaran, mp.id AS mata_pelajaran_id 
                         FROM schedule s 
                         JOIN mata_pelajaran mp ON s.mata_pelajaran_id = mp.id 
                         WHERE s.hari = ?";
$stmt = $conn->prepare($query_mata_pelajaran);
$stmt->bind_param('s', $hari_ini);
$stmt->execute();
$result_mata_pelajaran = $stmt->get_result();
if (!$result_mata_pelajaran) {
    die("Error fetching Mata Pelajaran data: " . mysqli_error($conn));
}

// Proses input absensi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rombel = $_POST['rombel'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $attendance_data = $_POST['attendance'];

    foreach ($attendance_data as $student_id => $status) {
        // Ambil schedule_id berdasarkan mata pelajaran dan hari
        $query_schedule = "SELECT id FROM schedule WHERE mata_pelajaran_id = ? AND hari = ?";
        $stmt_schedule = $conn->prepare($query_schedule);
        $stmt_schedule->bind_param('ss', $mata_pelajaran, $hari_ini);
        $stmt_schedule->execute();
        $result_schedule = $stmt_schedule->get_result();

        if ($result_schedule->num_rows > 0) {
            $schedule_id = $result_schedule->fetch_assoc()['id'];

            // Cek apakah data kehadiran sudah ada
            $query_check = "SELECT id FROM attendance WHERE student_id = ? AND `Tingkat - Rombel` = ? AND date = CURDATE() AND `schedule_id` = ?";
            $stmt_check = $conn->prepare($query_check);
            $stmt_check->bind_param('iss', $student_id, $rombel, $schedule_id);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();

            if ($result_check->num_rows === 0) {
                // Insert data kehadiran
                $query_insert = "INSERT INTO attendance (student_id, `Tingkat - Rombel`, status, date, `schedule_id`, `mata_pelajaran_id`) VALUES (?, ?, ?, CURDATE(), ?, ?)";
                $stmt_insert = $conn->prepare($query_insert);
                $stmt_insert->bind_param('issis', $student_id, $rombel, $status, $schedule_id, $mata_pelajaran);
                
                if (!$stmt_insert->execute()) {
                    echo "Error saving attendance: " . $stmt_insert->error;
                }
            }
        } else {
            echo "Schedule not found for the selected Mata Pelajaran and Hari.";
        }
    }

    header("Location: mark_attendance.php?rombel=$rombel&mata_pelajaran=$mata_pelajaran&status=saved");
    exit();
}

// Ambil data siswa berdasarkan Tingkat - Rombel yang dipilih
$siswa = [];
$already_marked = false;
$mata_pelajaran_name = '';
if (isset($_GET['rombel'], $_GET['mata_pelajaran'])) {
    $rombel = $_GET['rombel'];
    $mata_pelajaran = $_GET['mata_pelajaran'];

    // Ambil nama mata pelajaran berdasarkan ID
    $query_mata_pelajaran_name = "SELECT nama FROM mata_pelajaran WHERE id = ?";
    $stmt_mata_pelajaran_name = $conn->prepare($query_mata_pelajaran_name);
    $stmt_mata_pelajaran_name->bind_param('i', $mata_pelajaran);
    $stmt_mata_pelajaran_name->execute();
    $result_mata_pelajaran_name = $stmt_mata_pelajaran_name->get_result();
    if ($row_mata_pelajaran_name = $result_mata_pelajaran_name->fetch_assoc()) {
        $mata_pelajaran_name = $row_mata_pelajaran_name['nama'];
    }

    // Cek apakah absensi sudah dilakukan untuk Tingkat - Rombel dan Mata Pelajaran
    $query_check_rombel = "SELECT id FROM attendance WHERE `Tingkat - Rombel` = ? AND date = CURDATE() AND `mata_pelajaran_id` = ?";
    $stmt_check_rombel = $conn->prepare($query_check_rombel);
    $stmt_check_rombel->bind_param('ss', $rombel, $mata_pelajaran);
    $stmt_check_rombel->execute();
    $result_check_rombel = $stmt_check_rombel->get_result();

    if ($result_check_rombel->num_rows > 0) {
        $already_marked = true;
    } else {
        // Ambil data siswa untuk Tingkat - Rombel yang dipilih
        $query_siswa = "SELECT id, `Nama Lengkap` FROM siswa WHERE `Tingkat - Rombel` = ?";
        $stmt_siswa = $conn->prepare($query_siswa);
        $stmt_siswa->bind_param('s', $rombel);
        $stmt_siswa->execute();
        $result_siswa = $stmt_siswa->get_result();

        while ($row = $result_siswa->fetch_assoc()) {
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

        <!-- Form Pilih Tingkat - Rombel dan Mata Pelajaran -->
        <form method="GET" action="mark_attendance.php">
            <div class="form-group">
                <label for="rombel">Pilih Tingkat - Rombel:</label>
                <select name="rombel" id="rombel" class="form-control" required>
                    <option value="">Pilih Tingkat - Rombel</option>
                    <?php while ($row_rombel = $result_rombel->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row_rombel['Tingkat - Rombel']); ?>" 
                            <?= (isset($_GET['rombel']) && $_GET['rombel'] === $row_rombel['Tingkat - Rombel']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($row_rombel['Tingkat - Rombel']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mata_pelajaran">Pilih Mata Pelajaran:</label>
                <select name="mata_pelajaran" id="mata_pelajaran" class="form-control" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    <?php while ($row_mata_pelajaran = $result_mata_pelajaran->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row_mata_pelajaran['mata_pelajaran_id']); ?>" 
                            <?= (isset($_GET['mata_pelajaran']) && $_GET['mata_pelajaran'] === $row_mata_pelajaran['mata_pelajaran_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($row_mata_pelajaran['nama_mata_pelajaran']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan Siswa</button>
        </form>

        <!-- Jika absensi sudah dilakukan, tampilkan pesan -->
        <?php if ($already_marked): ?>
            <div class="alert alert-warning mt-4">
                Absensi untuk Tingkat - Rombel <strong><?= htmlspecialchars($rombel); ?></strong> dan Mata Pelajaran <strong><?= htmlspecialchars($mata_pelajaran_name); ?></strong> sudah dilakukan hari ini.
            </div>
        <?php elseif (!empty($siswa)): ?>
            <form method="POST" action="mark_attendance.php">
                <input type="hidden" name="rombel" value="<?= htmlspecialchars($rombel); ?>">
                <input type="hidden" name="mata_pelajaran" value="<?= htmlspecialchars($mata_pelajaran); ?>">
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
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($s['Nama Lengkap']); ?></td>
                                <td>
                                    <select name="attendance[<?= $s['id']; ?>]" class="form-control">
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
        <?php elseif (isset($_GET['rombel'], $_GET['mata_pelajaran'])): ?>
            <p class="mt-4">Belum ada siswa di Tingkat - Rombel ini.</p>
        <?php endif; ?>
    </div>
</body>
</html>
