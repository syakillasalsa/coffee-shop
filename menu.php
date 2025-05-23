<?php
session_start();
include 'db/config.php'; // Memasukkan file config.php untuk koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle POST requests if needed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Coffee Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
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
            font-family: 'Merriweather', serif; /* Apply Merriweather font */
            margin: 0 auto;
        }

        /* Navigation */
        nav {
            display: none; /* Hidden since we are using the sidebar */
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
            font-family: 'Nunito', sans-serif; /* Apply Nunito font */
            font-size: 0.9rem; /* Adjusted font size */
            font-weight: 400; /* Regular weight */
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
            padding-top: 80px; /* Add padding at the top to move the navigation down */
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

        /* Main Content */
        main {
            padding: 0;
            padding-top: 70px; /* Add top padding to avoid content being hidden behind the fixed header */
        }

        .menu-banner img {
            width: 100%;
        }

        .menu-items {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 2rem;
        }

        .menu-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin: 1rem;
            padding: 1rem;
            text-align: center;
            width: calc(33% - 2rem);
        }

        .menu-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .menu-item h3 {
            font-family: 'Merriweather', serif;
            font-size: 1.5rem;
            margin: 0.5rem 0;
        }

        .menu-item p {
            font-family: 'Nunito', sans-serif;
            margin: 0.5rem 0;
        }

        .menu-item form {
            margin-top: 1rem;
        }

        .menu-item form input[type="submit"],
        .menu-item button {
            background-color: #AF8F6F;
            border: none;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .menu-item form input[type="submit"]:hover,
        .menu-item button:hover {
            background-color: #EADBC8;
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

            .menu-item {
                width: calc(50% - 2rem);
            }
        }

        @media (max-width: 480px) {
            .menu-item {
                width: 100%;
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
            <h1>Blooms Menu</h1>
        </div>
    </header>

    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="profile.php">About Us</a></li>
            <li><a href="login_admin.php">Admin</a></li>
        </ul>
    </div>

    <main>
        <section id="menu">
            <div class="menu-banner">
                <img src="images/bann2.png" alt="Menu Banner" style="width: 100%;">
            </div>
            <div class="menu-items">
                <!-- Existing menu items -->
                <?php
                // Query to fetch menu items
                $sql = "SELECT * FROM menu";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="menu-item">';
                        echo '<img src="images/' . $row['gambar'] . '" alt="' . $row['gambar'] . '">';
                        echo '<h3>' . $row['nama_menu'] . '</h3>';
                        echo '<p>' . $row['deskripsi'] . '</p>';
                        echo '<p>Rp. ' . number_format($row['harga']) . '</p>';

                        // Check if user is logged in
                        if (isset($_SESSION['username'])) {
                            echo '<form action="cart.php" method="POST">';
                            echo '<input type="hidden" name="menu_name" value="' . $row['nama_menu'] . '">';
                            echo '<input type="hidden" name="menu_price" value="' . $row['harga'] . '">';
                            echo '<input type="submit" value="Add to Cart">';
                            echo '</form>';

                        } else {
                            // Redirect to login.php if not logged in
                            echo '<button onclick="redirectToLogin()">Add to Cart</button>';
                            echo '<script>';
                            echo 'function redirectToLogin() {';
                            echo '  window.location.href = "login.php";';
                            echo '}';
                            echo '</script>';
                        }

                        echo '</div>';
                    }
                } else {
                    echo "No menu items found.";
                }

                mysqli_close($conn);
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Coffee Shop. All rights reserved.</p>
    </footer>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        window.addEventListener('scroll', function() {
            var footer = document.querySelector('footer');
            if (window.scrollY > 100) {
                footer.classList.add('visible');
            } else {
                footer.classList.remove('visible');
            }
        });
    </script>
</body>
</html>