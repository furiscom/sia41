<?php
include('db_connect.php');

// Define Tingkat - Rombel options
$rombel_options = [
    "Kelas 7 - 01",
    "Kelas 8 - 01",
    "Kelas 9 - 01"
];

// Get student ID from query parameters
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch student data
    $query = "SELECT * FROM siswa WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Student not found'); window.location='manage_students.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid ID'); window.location='manage_students.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no = $_POST['no'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nisn = $_POST['nisn'];
    $nik = $_POST['nik'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tingkat_rombel = $_POST['tingkat_rombel'];
    $umur = $_POST['umur'];
    $status = $_POST['status'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $kebutuhan_khusus = $_POST['kebutuhan_khusus'];
    $disabilitas = $_POST['disabilitas'];
    $nomor_kip_pip = $_POST['nomor_kip_pip'];
    $nama_ayah = $_POST['nama_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $nama_wali = $_POST['nama_wali'];

    // Update query
    $update_query = "UPDATE siswa SET 
        `No` = '$no',
        `Nama Lengkap` = '$nama_lengkap',
        `NISN` = '$nisn',
        `NIK` = '$nik',
        `Tempat Lahir` = '$tempat_lahir',
        `Tanggal Lahir` = '$tanggal_lahir',
        `Tingkat - Rombel` = '$tingkat_rombel',
        `Umur` = '$umur',
        `Status` = '$status',
        `Jenis Kelamin` = '$jenis_kelamin',
        `Alamat` = '$alamat',
        `No Telepon` = '$no_telepon',
        `Kebutuhan Khusus` = '$kebutuhan_khusus',
        `Disabilitas` = '$disabilitas',
        `Nomor KIP/PIP` = '$nomor_kip_pip',
        `Nama Ayah Kandung` = '$nama_ayah',
        `Nama Ibu Kandung` = '$nama_ibu',
        `Nama Wali` = '$nama_wali'
        WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Student updated successfully'); window.location='manage_students.php';</script>";
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
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('navbar.php'); ?>

    <div class="container mt-4">
        <h2>Edit Student</h2>
        <form method="POST">
            <!-- General Information -->
            <div class="mb-3">
                <label for="no" class="form-label">No</label>
                <input type="text" class="form-control" id="no" name="no" value="<?= $student['No'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $student['Nama Lengkap'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $student['NISN'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="<?= $student['NIK'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $student['Tempat Lahir'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $student['Tanggal Lahir'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tingkat_rombel" class="form-label">Tingkat - Rombel</label>
                <select class="form-select" id="tingkat_rombel" name="tingkat_rombel" required>
                    <option value="" disabled>Select Rombel</option>
                    <?php
                    foreach ($rombel_options as $option) {
                        $selected = ($option == $student['Tingkat - Rombel']) ? "selected" : "";
                        echo "<option value='$option' $selected>$option</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Additional Information -->
            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="text" class="form-control" id="umur" name="umur" value="<?= $student['Umur'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= $student['Status'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= $student['Jenis Kelamin'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $student['Alamat'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= $student['No Telepon'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="kebutuhan_khusus" class="form-label">Kebutuhan Khusus</label>
                <input type="text" class="form-control" id="kebutuhan_khusus" name="kebutuhan_khusus" value="<?= $student['Kebutuhan Khusus'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="disabilitas" class="form-label">Disabilitas</label>
                <input type="text" class="form-control" id="disabilitas" name="disabilitas" value="<?= $student['Disabilitas'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nomor_kip_pip" class="form-label">Nomor KIP/PIP</label>
                <input type="text" class="form-control" id="nomor_kip_pip" name="nomor_kip_pip" value="<?= $student['Nomor KIP/PIP'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_ayah" class="form-label">Nama Ayah Kandung</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $student['Nama Ayah Kandung'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_ibu" class="form-label">Nama Ibu Kandung</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $student['Nama Ibu Kandung'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali</label>
                <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?= $student['Nama Wali'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
            <a href="manage_students.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
