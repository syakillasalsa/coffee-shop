<?php
include('db/config.php'); // Menghubungkan file konfigurasi database
session_start(); // Memulai sesi PHP

// Pastikan admin sudah login
if (!isset($_SESSION['admin_login'])) {
    header("location: login.php"); // Mengarahkan ke halaman login jika admin belum login
    exit(); // Menghentikan eksekusi script 
}

// aksi delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id']; // Mendapatkan ID user dari parameter URL
    // Melakukan kueri hapus
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) { // Mengeksekusi kueri hapus
        echo "<script>alert('User deleted successfully');</script>"; // Menampilkan pesan sukses
    } else {
        echo "<script>alert('Error deleting user: " . $conn->error . "');</script>"; // Menampilkan pesan error
    }
}

// Mengambil data users dari database
$sql = "SELECT * FROM users";
$result = $conn->query($sql); // Mengeksekusi kueri untuk mengambil data users
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }

        .content {
            flex: 1; 
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: #333;
            text-align: center;
            font-family: 'Merriweather', serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #007BFF;
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

        .actions a.delete {
            background-color: #A0937D;
            color: white;
        }

        .actions a.delete:hover {
            background-color: #CBB279;
        }

        footer {
            background-color: #A0937D;
            color: white;
            text-align: center;
            padding: 1rem;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?> 

    <div class="content">
        <div class="container">
            <h2>Manage Users</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($result->num_rows > 0) { // Mengecek apakah ada baris hasil
                    while ($row = $result->fetch_assoc()) { // Mengambil setiap baris hasil sebagai array 
                        echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['username']."</td>
                                <td class='actions'>
                                    <a class='delete' href='javascript:void(0);' onclick='confirmDelete(".$row['id'].")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No users found</td></tr>"; // Menampilkan pesan jika tidak ada user ditemukan
                }
                ?>
            </table>
        </div>
    </div>

    <?php include('footer.php'); ?> 
</body>
</html>