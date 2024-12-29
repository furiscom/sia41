<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

echo "<h1>Welcome, " . $_SESSION['username'] . "!</h1>";

if ($_SESSION['role'] == 'admin') {
    echo "<p>Welcome Admin!</p>";
    // Tampilkan menu khusus admin
} elseif ($_SESSION['role'] == 'guru') {
    echo "<p>Welcome Guru!</p>";
    // Tampilkan menu khusus guru
} else {
    echo "<p>Welcome to the system!</p>";
}
?>
