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


<?php include('header.php'); ?>
<body>

    <div class="container mt-5">
        <h2 class="text-center mb-5">Login Sistem Informasi Absensi</h2>

        <!-- Menampilkan pesan error jika ada -->
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="login.php">
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
                    <a href="register.php">Daftar Pengguna Baru</a> | <a href="#">Lupa Password?</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
