<?php
session_start();
include 'db/config.php'; // Sesuaikan dengan lokasi file konfigurasi database Anda

// Ambil data menu dari database
$sql = "SELECT * FROM menu";
$result = mysqli_query($conn, $sql);

// memeriksa apakah ada permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_name = $_POST['menu_name']; // Ambil data menu dari form
    $menu_price = $_POST['menu_price'];
    $menu_description = $_POST['menu_description'];
    $menu_image = $_FILES['menu_image']['name'];

    // Upload gambar ke folder images
    $target_dir = "images/";
    $target_file = $target_dir . basename($menu_image);
    move_uploaded_file($_FILES['menu_image']['tmp_name'], $target_file);//disimpan sesuai nama gambar

    // Simpan data menu ke database
    $sql = "INSERT INTO menu (nama_menu, harga, deskripsi, gambar) VALUES ('$menu_name', '$menu_price', '$menu_description', '$menu_image')";//masukin ke database
    if (mysqli_query($conn, $sql)) {
        header("Location: manage_menu.php");// Redirect ke halaman manage_menu.php
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <style>
        .actions a.edit,
        .actions a.delete {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
            background-color: #B99470; /* Warna latar belakang */
            color: black; /* Warna teks */
            text-decoration: none; /* Hapus garis bawah default */
        }

        .actions a.edit:hover,
        .actions a.delete:hover {
            background-color: #948979; /* Warna latar belakang saat dihover */
        }

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
            margin-bottom: 2rem;
            max-width: 400px;
            margin: 0 auto;
            background: #AF8F6F;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"], 
        textarea, 
        input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #FAEED1;
            color: #333;
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #948979;
        }

        table {
            width: 80%;
            max-width: 800px;
            margin: 2rem auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        .price-column {
            white-space: nowrap; /* Agar teks tidak patah-patah ke baris baru */
            text-align: right; /* Posisi teks ke kanan */
            padding-right: 15px; /* Jarak dari kanan agar tetap terlihat rapih */
        }

        a:hover {
            text-decoration: underline;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .actions a {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .actions a.edit {
            background-color: #B99470;
            color: black;
        }

        .actions a.delete {
            background-color: #B99470;
            color: black;
        }

        .actions a.edit:hover {
            background-color: #948979;
        }

        .actions a.delete:hover {
            background-color: #948979;
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>  

<div class="container">
    <h2>Add New Menu</h2>
    <form id="addMenuForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <label for="menu_name">Menu Name:</label>
        <input type="text" id="menu_name" name="menu_name" required><br><br>

        <label for="menu_price">Price:</label>
        <input type="text" id="menu_price" name="menu_price" required><br><br>

        <label for="menu_description">Description:</label><br>
        <textarea id="menu_description" name="menu_description" rows="4" required></textarea><br><br>

        <label for="menu_image">Image:</label>
        <input type="file" id="menu_image" name="menu_image" accept="image/*" required><br><br>

        <input type="submit" value="Add Menu">
    </form>
    <p id="message"></p>

    <hr>

    <h2>Current Menu</h2>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead><tr><th>Menu Name</th><th>Price</th><th>Description</th><th>Image</th><th>Action</th></tr></thead>';
        echo '<tbody id="menuTableBody">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['nama_menu']) . '</td>';
            echo '<td class="price-column">Rp. ' . number_format($row['harga'], 0, ',', '.') . '</td>';
            echo '<td>' . htmlspecialchars($row['deskripsi']) . '</td>';
            echo '<td><img src="images/' . htmlspecialchars($row['gambar']) . '" width="100"></td>';
            echo '<td><div class="actions"><a class="edit" href="edit_menu.php?id=' . $row['id'] . '">Edit</a> <a class="delete" href="delete_menu.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this menu?\')">Delete</a></div></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No menu items found.</p>';
    }
    mysqli_close($conn);
    ?>
</div>
<footer>
        <p>&copy; 2024 Coffee Shop Admin Panel</p>
</footer>
</body>
</html>