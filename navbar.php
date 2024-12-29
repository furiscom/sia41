<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <?php
        // Tentukan URL berdasarkan peran pengguna
        $dashboard_url = "#"; // Default jika role tidak dikenali
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                $dashboard_url = "dashboard_admin.php";
            } elseif ($_SESSION['role'] == 'guru') {
                $dashboard_url = "dashboard_guru.php";
            }
        }
        ?>
        <a class="navbar-brand" href="<?php echo $dashboard_url; ?>">Sistem Absensi Siswa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <!-- Tambahkan menu hanya untuk Admin atau Guru -->
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'guru')): ?>
                        <a class="nav-link" href="mark_attendance.php">Mark Attendance</a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_students.php">Manage Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="attendance_report.php">Attendance Report</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
