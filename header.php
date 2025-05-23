<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        header {
            background-color: #AF8F6F;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            margin: 0;
        }

        header h1 {
            font-family: 'Merriweather', serif;
            margin-bottom: 0.5rem;
        }

        nav {
            margin-top: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li.logout-btn {
            margin-left: auto;
            padding: 0.5rem 1rem;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            font-weight: 400;
        }

        nav ul li a:hover {
            background-color: #EADBC8;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        footer {
            text-align: center;
            padding: 1rem;
            background-color: #AF8F6F;
            color: #fff;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Admin Panel</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="manage_users.php">Manage Users</a></li>
                    <li><a href="manage_menu.php">Manage Menu</a></li>
                    <li><a href="manage_orders.php">Manage Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
       
    </main>

    
</body>
</html>
