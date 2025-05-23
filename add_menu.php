<?php
include 'db/config.php'; // Menghubungkan file konfigurasi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data yang dikirim melalui form
    $menu_name = $_POST['menu_name'];
    $menu_price = $_POST['menu_price'];
    $menu_description = $_POST['menu_description'];
    $menu_image = $_FILES['menu_image']; // Mengambil data file gambar

    // Mengambil nama file gambar dan lokasi sementara
    $image_name = $menu_image['name'];
    $image_tmp_name = $menu_image['tmp_name'];
    $image_folder = 'images/' . $image_name; // Menentukan lokasi penyimpanan gambar

    // Memindahkan file gambar dari lokasi sementara ke folder tujuan
   
}
// Menutup koneksi database
mysqli_close($conn);
?>
