<?php
include('db/config.php'); // Menghubungkan file konfigurasi database
session_start(); // Memulai sesi

// Pastikan admin sudah login
if (!isset($_SESSION['admin_login'])) {
    header("location: login.php"); // Mengarahkan ke halaman login jika belum login
    exit; // Menghentikan eksekusi skrip
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title> 
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <style>
        /* Gaya CSS internal */
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
            padding: 0;
            flex-grow: 1;
        }

        h2 {
            margin: 2rem 0 1rem;
            color: #343a40;
            font-size: 1.5rem;
            text-align: center;
            font-family: 'Merriweather', serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        th, td {
            padding: 1rem;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            background-color: #776B5D;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #007bff;
            text-decoration: none;
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
            background-color: #C08261;
            color: white;
        }

        .actions a.delete {
            background-color: #C08261;
            color: white;
        }

        .actions a.edit:hover {
            background-color: #BCA37F;
        }

        .actions a.delete:hover {
            background-color: #BCA37F;
        }

        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 1rem 0;
            width: 100%;
            position: relative;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?> <!-- Menyertakan file header -->
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Name</th> <
                    <th>Phone Number</th> 
                    <th>Dine/Take</th> 
                    <th>Queue Number</th> 
                    <th>Payment Method</th> 
                    <th>Order Time</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                // Ambil data pesanan dari database
                $sql = "SELECT * FROM orders"; // Query SQL untuk mengambil semua data dari tabel orders
                $result = $conn->query($sql); // Menjalankan query dan menyimpan hasilnya di variabel $result

                // Tampilkan pesanan dalam tabel
                while ($row = $result->fetch_assoc()) { // Mengambil data baris demi baris dari hasil query
                    echo "<tr>
                            <td>".$row['id']."</td> 
                            <td>".$row['name']."</td> 
                            <td>".$row['phone']."</td> 
                            <td>".$row['dine_take']."</td> 
                            <td>".$row['number']."</td> 
                            <td>".$row['payment']."</td> 
                            <td>".$row['order_time']."</td> 
                            <td><div class='actions'><a class='edit' href='edit_order.php?id=".$row['id']."'>Edit</a> <a class='delete' href='delete_order.php?id=".$row['id']."' onclick=\"return confirm('Are you sure you want to delete this order?')\">Delete</a></div></td> <!-- Menampilkan tautan Edit dan Delete dengan konfirmasi penghapusan -->
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        &copy; 2024 Admin Panel. All Rights Reserved. 
    </footer>
</body>
</html>