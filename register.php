<?php
// Koneksi ke database
include('db_connect.php'); 

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Misalnya 'admin', 'guru', dll.

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data pengguna
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

    if (mysqli_query($conn, $sql)) {
        // Pendaftaran berhasil, arahkan ke halaman login
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Absensi Siswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (required for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
        }
        .container {
            max-width: 500px;
            padding-top: 100px;
        }
        .register-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .register-form h2 {
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Absensi Siswa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Register Form -->
    <div class="container">
        <div class="register-form">
            <h2>Daftar</h2>
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="wali_kelas">Wali Kelas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </form>
            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Sistem Absensi Siswa | Semua Hak Dilindungi</p>
    </div>

</body>
</html>
