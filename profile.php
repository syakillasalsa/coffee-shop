<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Coffee Shop</title>
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
            background-color: #A79277; /* Background color */
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
        .testimonials-section {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            color: #ffffff;
            flex: 1;
            padding-bottom: 60px;
            margin-bottom: 50px;
        }
        h2 {
            font-family: 'Merriweather', serif; /* Apply Merriweather font */
            color: #fff; /* Text color */
            font-size: 40px; /* Font size */
            margin-bottom: 10px; /* Bottom margin */
        }
        p {
            font-family: 'Inter', sans-serif; /* Apply Inter font */
            color: #6F4E37; /* Text color */
            font-size: 1.2em; /* Font size */
            margin-bottom: 20px; /* Bottom margin */
        }
        .testimonials {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        .testimonial {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 300px;
            text-align: left;
            position: relative;
            background-color: #D1BB9E; /* Background color */
        }
        .testimonial:nth-child(2) {
            background-color: #DED0B6; /* Background color */
        }
        .testimonial:nth-child(3) {
            background-color: #BCA37F; /* Background color */
        }
        .testimonial p {
            font-size: 16px; /* Font size */
            color: #fff; /* Text color */
            margin-bottom: 8px; /* Bottom margin */
        }
        .author {
            display: flex;
            align-items: center;
            margin-top: 20px; /* Top margin */
        }
        .author img {
            width: 50px; /* Image width */
            height: 50px; /* Image height */
            border-radius: 50%; /* Rounded border */
            margin-right: 10px; /* Right margin */
        }
        .author span {
            font-size: 14px; /* Font size */
            color: #666666; /* Text color */
            font-weight: bold; /* Font weight */
            display: block; /* Display block */
            margin-top: 5px; /* Top margin */
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="menu-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars fa-2x"></i>
            </div>
            <h1>Welcome to Blooms Caffee</h1>
        </div>
    </header>

    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>

    <div class="testimonials-section">
        <h2>Our Profile</h2>
        <p>Let's Find Out About Us!</p>
        <div class="testimonials">
            <div class="testimonial">
                <p>Haii, perkenalkan saya Tutut Bagiawati nim L200220283.</p>
                <p>Saya lahir di Surakarta, 7 agustus 2003.</p>
                <p>Hobi saya adalah membaca</p>
                <div class="author">
                    <img src="images/tutut.jpg" alt="tutut">
                    <span>Tutut Bagiawati</span>
                </div>
            </div>
            <div class="testimonial">
                <p>Haii, perkenalkan saya Amara Nazula W nim L200224166.</p>
                <p>Saya lahir di Surakarta, 20 Juli 2004.</p>
                <p>Hobi saya adalah membaca</p>
                <div class="author">
                    <img src="images/amara.jpg" alt="amara">
                    <span>Amara Nazula W</span>
                </div>
            </div>
            <div class="testimonial">
                <p>Haii, perkenalkan saya Syakilla Salsa B nim L200224249.</p>
                <p>Saya lahir di Sukoharjo, 2 Juli 2004.</p>
                <p>Hobi saya adalah membaca</p>
                <div class="author">
                    <img src="images/syakilla.jpg" alt="syakilla">
                    <span>Syakilla Salsa B</span>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Coffee Shop. All rights reserved.</p>
    </footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
