<?php
session_start();
include('db_connect.php');

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Fetch semua pengguna dari database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi - Sistem Absensi Siswa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
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
    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Manage Users</h1>

        <!-- Tabel Pengguna -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo ucfirst($row['role']); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $row['id']; ?>" data-username="<?php echo $row['username']; ?>" data-email="<?php echo $row['email']; ?>" data-role="<?php echo $row['role']; ?>">Edit</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Button Tambah Pengguna -->
        <button class="btn btn-success mt-3" data-toggle="modal" data-target="#userModal" id="addUserBtn">Add User</button>
    </div>

    <!-- Modal Tambah/Edit Pengguna -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="userForm" method="POST" action="user_action.php">
                    <input type="hidden" name="id" id="userId" value="">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>

                   <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $row['id']; ?>">Delete</button>

                </form>
            </div>
        </div>
    </div>
                        
    <script>
        $(document).ready(function () {
            // Tambah User
            $('#addUserBtn').click(function () {
                $('#userForm')[0].reset();
                $('#userId').val('');
                $('#userModalLabel').text('Add User');
            });

            // Edit User
            $('.edit-btn').click(function () {
                $('#userForm')[0].reset();
                $('#userId').val($(this).data('id'));
                $('#username').val($(this).data('username'));
                $('#email').val($(this).data('email'));
                $('#role').val($(this).data('role'));
                $('#userModalLabel').text('Edit User');
                $('#userModal').modal('show');
            });

            // Hapus User
            $('.delete-btn').click(function () {
    if (confirm('Are you sure you want to delete this user?')) {
        const userId = $(this).data('id');
        $.post('user_action.php', { delete: true, id: userId }, function (response) {
            console.log(response); // Tambahkan log untuk memeriksa respons
            location.reload();
        });
    }
});


            // Validasi Password Tidak Kosong
            $('#userForm').submit(function (e) {
                const password = $('#password').val();
                if (!password) {
                    alert('Password tidak boleh kosong.');
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
