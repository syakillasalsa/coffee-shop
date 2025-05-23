<?php
session_start();

// Ambil username dari session jika ada
$username = $_SESSION['username'] ?? '';

// Hancurkan session
session_destroy();

// Set cookie untuk menyimpan username jika username tidak kosong
if (!empty($username)) {
    setcookie('username', $username, time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
}

// Hapus cookie remember_me
setcookie('remember_me', '', time() - 3600, '/');

// Redirect ke halaman login
header('Location: home.php');
exit;
?>