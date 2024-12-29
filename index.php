<?php
session_start();
include('db_connect.php');

// Cek apakah form login sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data username dan password dari form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk mencari pengguna berdasarkan username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Pengguna ditemukan
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session untuk menyimpan informasi login
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Menyimpan role pengguna (admin, guru, dll.)

            // Arahkan ke dashboard sesuai dengan role
            if ($user['role'] == 'admin') {
                header("Location: dashboard_admin.php");
                exit();
            } elseif ($user['role'] == 'guru' || $user['role'] == 'wali_kelas') {
                header("Location: dashboard_guru.php");
                exit();
            } else {
                echo "Role tidak dikenal.";
            }
        } else {
            // Password salah
            $error_message = "Password salah.";
        }
    } else {
        // Username tidak ditemukan
        $error_message = "Username tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi Siswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (required for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="asset/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('asset/img/laptop.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        .container {
            max-width: 500px;
            padding-top: 100px;
            flex: 1;
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
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .center {
display: block;
margin-left: auto;
margin-right: auto;
width: 50%;
}
    </style>
</head>
<body>

    <div class="background-overlay"></div>

    <!-- Navbar -->
   

    <!-- Login Form -->
    <div class="container">
        <div class="login-form">
            <h2>Login <br>
                 Sistem Absensi Siswa</h2>
            <img src="asset/img/logo.jpg" alt="Logo" class="center" >
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="mt-3 text-center">
                <a href="#">Lupa Password?</a>
            </div>
            <!-- Register Link -->
            <div class="mt-3 text-center">
                <p>Belum punya akun? <a href="register.html">Daftar di sini</a></p>
            </div>
        </div>
    </div>

   
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
