<?php
include('db/config.php');
session_start();

if(!isset($_SESSION['admin_login'])) { 
    header("location: login.php");
    exit();
}
?>

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

        main {
            padding: 1rem;
            flex: 1;
            text-align: center;
            overflow-y: auto;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .welcome-text {
            background-color: #A0937D; /* Slightly transparent background */
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .welcome-text h2 {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .welcome-text p {
            font-family: 'Nunito', sans-serif;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <div class="container">
            <div class="welcome-text">
                <h2>Welcome, Admin</h2>
                <p>This is the admin dashboard. Don't forget to check the orders, Admin!</p>
            </div>
            <div class="image-container">
                <img src="images/b1.jpg" alt="Image 1">
                <img src="images/b3.jpg" alt="Image 2">
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>
