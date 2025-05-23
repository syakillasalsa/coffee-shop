<?php
include('db/config.php'); // Mengimpor konfigurasi database
session_start(); // Memulai session PHP

if (!isset($_SESSION['admin_login'])) {
    header("location: login.php"); // Redirect ke halaman login jika tidak ada sesi admin
    exit; // Menghentikan eksekusi kode selanjutnya
}

$id = $_GET['id']; // Mengambil nilai ID yang diberikan dari parameter GET

$sql = "DELETE FROM menu WHERE id = $id"; // Query SQL untuk menghapus data berdasarkan ID

if ($conn->query($sql) === TRUE) {
    header("location: manage_menu.php"); // Redirect ke halaman pengelolaan menu jika berhasil
} else {
    echo "Error deleting record: " . $conn->error; // Tampilkan pesan error jika query gagal
}


?>
