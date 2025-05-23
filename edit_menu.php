<?php
session_start();
include 'db/config.php';

// Pastikan admin sudah login
if (!isset($_SESSION['admin_login'])) {
    header("location: login.php");
    exit;
}

// Ambil ID menu dari parameter GET
if (!isset($_GET['id'])) { //melakukan sesuatu di bagian menu lewat id
    header("location: manage_menu.php");
    exit();
}
$id = $_GET['id'];

// Ambil data menu berdasarkan ID
$sql = "SELECT * FROM menu WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) != 1) {
    header("location: manage_menu.php");
    exit();
}

$row = mysqli_fetch_assoc($result);

// Handle form submission untuk update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $menu_name = mysqli_real_escape_string($conn, $_POST['menu_name']);
    $menu_price = mysqli_real_escape_string($conn, $_POST['menu_price']);
    $menu_description = mysqli_real_escape_string($conn, $_POST['menu_description']);

    // Update menu item di database
    $sql_update = "UPDATE menu SET nama_menu = '$menu_name', harga = '$menu_price', deskripsi = '$menu_description' WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        $message = "Menu item updated successfully";
        // Redirect kembali ke manage_menu.php setelah update berhasil
        header("location: manage_menu.php");
        exit();
    } else {
        $error_message = "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1rem;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 1rem;
            color: #343a40;
            font-size: 1.5rem;
            text-align: center;
            font-family: 'Merriweather', serif;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 0.25rem; /* Perkecil jarak antar label */
            font-weight: bold;
        }

        input[type="text"], 
        textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 0.75rem; /* Perkecil jarak antar input */
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="file"] {
            margin-bottom: 0.75rem; /* Jarak input file dengan input lainnya */
        }

        input[type="submit"], 
        .back-btn {
            background-color: #AF8F6F;
            color: white;
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, 
        .back-btn:hover {
            background-color: #948979;
        }

        .error {
            color: red;
            margin-top: 1rem;
        }

        footer {
            background-color: #AF8F6F;
            color: white;
            text-align: center;
            padding: 1rem;
            width: 100%;
            position: relative;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h2>Edit Menu</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST" enctype="multipart/form-data">
            <label for="menu_name">Menu Name:</label>
            <input type="text" id="menu_name" name="menu_name" value="<?php echo htmlspecialchars($row['nama_menu']); ?>" required><br><br>

            <label for="menu_price">Price:</label>
            <input type="text" id="menu_price" name="menu_price" value="<?php echo htmlspecialchars($row['harga']); ?>" required><br><br>

            <label for="menu_description">Description:</label><br>
            <textarea id="menu_description" name="menu_description" rows="4" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea><br><br>

            <label for="menu_image">Image:</label><br>
            <input type="file" id="menu_image" name="menu_image"><br><br> <!-- Input file untuk gambar -->

            <input type="submit" value="Update Menu">
            <a href="manage_menu.php" class="back-btn">Back</a> <!-- Tombol Back -->
        </form>
        <?php
        // Tampilkan pesan kesalahan jika ada
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
    </div>
    <footer>
        &copy; 2024 Admin Panel. All Rights Reserved.
    </footer>
</body>
</html>
