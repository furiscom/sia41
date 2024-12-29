<?php
// Include database connection
include('db_connect.php');

// Define Tingkat - Rombel options (you can fetch these from the database if needed)
$rombel_options = [
    "Kelas 7 - 01",
    "Kelas 8 - 01",
    "Kelas 9 - 01"
   
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nisn = $_POST['nisn'];
    $tingkat_rombel = $_POST['tingkat_rombel'];

    $query = "INSERT INTO siswa (`Nama Lengkap`, `NISN`, `Tingkat - Rombel`) VALUES ('$nama_lengkap', '$nisn', '$tingkat_rombel')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Student added successfully'); window.location='manage_students.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include('navbar.php'); ?>


    <div class="container mt-4">
        <h2 class="mb-4">Add New Student</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" class="form-control" id="nisn" name="nisn" required>
            </div>
            <div class="mb-3">
                <label for="tingkat_rombel" class="form-label">Tingkat - Rombel</label>
                <select class="form-select" id="tingkat_rombel" name="tingkat_rombel" required>
                    <option value="" disabled selected>Select Rombel</option>
                    <?php
                    foreach ($rombel_options as $option) {
                        echo "<option value='$option'>$option</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2024 SIA. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
