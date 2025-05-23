<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Coffee Shop</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Inter:wght@400;700&family=Merriweather:wght@400;700&family=Nunito:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            position: relative;
            font-family: 'Roboto', sans-serif; /* Default font for body */
        }
        header {
            background-color: #AF8F6F;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            display: flex;
            justify-content: center; /* Center align header content */
            align-items: center; /* Center align vertically */
        }
        .header-content h1 {
            font-family: 'Merriweather', serif; /* Apply Merriweather font */
            margin: 0 auto;
        }
        header .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 0 20px;
        }
        header .menu-toggle {
            cursor: pointer;
        }
        nav {
            text-align: center;
            margin-top: 10px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-family: 'Nunito', sans-serif; /* Apply Nunito font */
            font-size: 0.9rem; /* Increase font size */
            font-weight: 400; /* Regular weight */
        }
        nav ul li a:hover {
            background-color: #EADBC8;
        }
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
        main {
            flex: 1;
            padding: 20px;
            position: relative;
            padding-top: 70px; /* Add top padding to avoid content being hidden behind the fixed header */
        }
        footer {
            background-color: #AF8F6F;
            color: #FFF;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9em;
            width: 100%;
            position: relative;
        }
        .center-text {
            text-align: center;
        }
        .contact-image {
            text-align: center;
            margin: 20px auto; /* Memusatkan gambar */
            max-width: 800px; /* Lebar maksimum gambar */
        }
        .contact-image img {
            width: 100%; /* Lebar gambar 100% dari container */
            height: auto; /* Tinggi gambar disesuaikan dengan proporsi */
            display: block; /* Menjamin gambar tampil dengan baik */
            border-radius: 10px; /* Menggunakan border radius */
        }
        .social-media {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px; /* Memberi jarak ke footer */
        }
        .social-media a {
            display: inline-block;
            width: 40px; /* Lebar ikon sosial media */
            height: 40px; /* Tinggi ikon sosial media */
            border-radius: 50%; /* Bentuk bulat */
            overflow: hidden;
        }
        .social-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #contact p {
            font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
            font-weight: 400; /* Regular font */
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #6F4E37; /* Warna untuk paragraf */
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
            <h1>Contact Us</h1>
        </div>
    </header>
    
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="profile.php">About Us</a></li>
            <li><a href="login.php">Admin</a></li>
        </ul>
    </div>
    
    <main>
        <section id="contact" class="center-text">
            <p>Have questions or comments? Just write us a message!</p>
            <div class="contact-image">
                <img src="images/contact.jpeg" alt="Contact Image">
            </div>
        </section>
    </main>
    <footer>
        <div class="social-media">
            <a href="https://www.instagram.com/pompomchocobi?igsh=MWRyYXM4em1tc25naA%3D%3D&utm_source=qr" target="_blank"><img src="images/instagram.jpeg" alt="Instagram"></a>
            <a href="https://wa.me/6282328352246" target="_blank"><img src="images/wa.jpeg" alt="Whatsapp"></a>
            <a href="https://maps.app.goo.gl/YkyCDZin29S56cKq5?g_st=com.google.maps.preview.copy" target="_blank"><img src="images/lokasi.jpeg" alt="Location"></a>
        </div>
        <p>&copy; 2024 Coffee Shop. All rights reserved.</p>
    </footer>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
