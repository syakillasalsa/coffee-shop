<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Coffee Shop</title>
    <!-- Link to Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!-- Link to FontAwesome for the menu toggle icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            overflow-y: auto;
        }

        body {
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background-color: #AF8F6F;
            color: #fff;
            padding: 1rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            flex-wrap: wrap;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 0 20px;
        }

        .header-content .menu-toggle {
            cursor: pointer;
        }

        .header-content h1 {
            font-family: 'Merriweather', serif; /* Terapkan font Merriweather */
            margin: 0 auto;
        }

        /* Navigation */
        nav {
            display: none; /* Disembunyikan karena menggunakan sidebar */
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        nav ul li {
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-family: 'Nunito', sans-serif; /* Terapkan font Nunito */
            font-size: 0.9rem; /* Ukuran font disesuaikan */
            font-weight: 400; /* Berat font normal */
        }

        nav ul li a:hover {
            background-color: #EADBC8;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: -250px;
            top: 0;
            bottom: 0;
            width: 250px;
            background: #333;
            padding: 1rem;
            transition: left 0.3s ease;
            z-index: 9;
            overflow-y: auto;
            padding-top: 80px; /* Tambahkan padding di atas untuk menggeser navigasi ke bawah */
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: opacity 0.3s;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar ul li a:hover {
            opacity: 0.7;
            background-color: #AF8F6F;
        }

        /* User Info */
        .user-info {
            font-family: 'Nunito', sans-serif;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .user-info .username {
            color: #fff;
        }

        .user-info .logout-btn {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .user-info .logout-btn:hover {
            background-color: #EADBC8;
        }

        /* Main Content */
        main {
            padding: 0;
            padding-top: 70px; /* Tambahkan padding atas untuk menghindari konten tersembunyi di belakang header tetap */
        }

        .banner {
            width: 100%;
            height: 100vh; /* Setel tinggi ke tinggi layar */
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .banner-top {
            background-image: url('images/fixxx.jpg'); /* Ganti dengan path gambar atas Anda */
        }

        .banner-bottom {
            background-image: url('images/fix22.jpg'); /* Ganti dengan path gambar bawah Anda */
        }

        .content {
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.8); /* Tambahkan transparansi agar teks dapat dibaca */
            width: 80%;
            margin: 2rem auto;
            text-align: center;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 1rem;
            background-color: #AF8F6F;
            color: #fff;
            width: 100%;
            z-index: 10;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-content h1 {
                margin: 10px auto;
            }

            .user-info {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }
        }

        @media (max-width: 480px) {
            .content {
                width: 90%;
            }

            .user-info .logout-btn {
                padding: 0.3rem 0.7rem;
            }

            .sidebar ul li a {
                padding: 4px 8px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars fa-2x"></i>
            </div>
            <h1>Welcome to Blooms Coffee</h1>
            <?php if (isset($_SESSION['username'])): ?>
                <!-- Tampilkan nama pengguna dan tombol logout di header -->
                <div class="user-info">
                    <span class="username">Hello, <?php echo $_SESSION['username']; ?></span>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="profile.php">About Us</a></li>
            <li><a href="login.php">Admin</a></li>
            <?php if (isset($_SESSION['username'])) : ?>
                <!-- Pindahkan tombol logout ke sidebar -->
                <li>
                    <a href="logout.php" class="logout-btn">Logout</a>
                </li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['username'])) : ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <main>
        <div class="banner banner-top">
            <div class="content">
                <section id="about">
                    <h2>About Us</h2>
                    <p>Welcome to Coffee Shop, where we serve the best coffee in town. Whether you prefer a simple black coffee or a creamy latte, we have something for everyone.</p>
                </section>
            </div>
        </div>

        <div class="banner banner-bottom">
            <div class="content">
                <!-- Tidak ada konten di sini, bagian "Our Services" dihapus -->
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Coffee Shop. All rights reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>

