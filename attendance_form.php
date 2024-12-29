<?php
include('db_connect.php');

// Fetch students for the dropdown
$students_query = "SELECT id, `Nama Lengkap` FROM siswa";
$students_result = mysqli_query($conn, $students_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include('navbar.php'); ?>


    <!-- Content -->
    <div class="container mt-4">
        <h2>Form Absensi Siswa</h2>
        <form method="POST" action="mark_attendance.php">
            <!-- Student Dropdown -->
            <div class="mb-3">
                <label for="student_id" class="form-label">Pilih Siswa</label>
                <select name="student_id" id="student_id" class="form-select" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($students_result)) {
                        echo "<option value='{$row['id']}'>{$row['Nama Lengkap']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Attendance Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status Kehadiran</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                    <option value="Sakit">Sakit</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2024 SIA. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
