<?php
session_start();
include('db_connect.php');

// Define Tingkat - Rombel options
$rombel_options = [
    "Kelas 7 - 01",
    "Kelas 8 - 01",
    "Kelas 9 - 01"
];

// Get selected rombel from the dropdown
$selected_rombel = isset($_GET['rombel']) ? $_GET['rombel'] : "";

// Fetch students based on the selected rombel
$query = "SELECT * FROM siswa";
if ($selected_rombel != "") {
    $query .= " WHERE `Tingkat - Rombel` = '$selected_rombel'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Siswa</title>
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
    background: url('asset/img/back.png') no-repeat center center fixed;
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

<?php include('navbar.php'); ?>
    <div class="container mt-4">
    
        <h2>Manage Students</h2>

        <!-- Dropdown to filter by Tingkat - Rombel -->
        <form method="GET" class="mb-4">
            <label for="rombel" class="form-label">Filter by Tingkat - Rombel</label>
            <select name="rombel" id="rombel" class="form-select" onchange="this.form.submit()">
                <option value="">All Rombel</option>
                <?php
                foreach ($rombel_options as $option) {
                    $selected = ($option == $selected_rombel) ? "selected" : "";
                    echo "<option value='$option' $selected>$option</option>";
                }
                ?>
            </select>
        </form>

        <!-- Add Student Button -->
        <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>

        <!-- Table of Students -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Tingkat - Rombel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['Nama Lengkap']) ?></td>
                            <td><?= htmlspecialchars($row['NISN']) ?></td>
                            <td><?= htmlspecialchars($row['Tingkat - Rombel']) ?></td>
                            <td>
                                <a href="edit_student.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="manage_students.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No students found for the selected Rombel.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
