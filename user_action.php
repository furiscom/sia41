<?php
include('db_connect.php');

if (isset($_POST['delete']) && isset($_POST['id'])) { $userId = $_POST['id']; $query = "DELETE FROM users WHERE id = ?"; $stmt = $conn->prepare($query); $stmt->bind_param("i", $userId); if ($stmt->execute()) { echo "User deleted successfully."; } else { echo "Error deleting user."; } $stmt->close(); $conn->close(); }
// Tambah/Edit User
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Input password
    $role = $_POST['role'];

    if ($id) {
        // Edit User: Perbarui password hanya jika diberikan
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password baru
            $query = "UPDATE users SET username = '$username', password = '$hashed_password', role = '$role' WHERE id = $id";
        } else {
            $query = "UPDATE users SET username = '$username', role = '$role' WHERE id = $id";
        }
    } else {
        // Tambah User
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    }

    mysqli_query($conn, $query);
    header("Location: manage_users.php");
    exit();
}

// Hapus User
