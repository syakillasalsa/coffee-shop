<?php
session_start();

// Konfigurasi database
$servername = "localhost";
$db_username = "root"; // Sesuaikan dengan username MySQL Anda
$db_password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "coffee_shop"; // Nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validasi registrasi saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menyimpan data pengguna ke database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        // Redirect ke halaman login setelah registrasi berhasil
        header('Location: login.php?registered=true');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
//Memproses data saat form dikirim dengan metode POST, mengenkripsi password menggunakan password_hash, 
//menyimpan data pengguna ke database, dan mengarahkan ke halaman login jika registrasi berhasil.
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Coffee Shop</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Style tambahan untuk form registrasi */
        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 15px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Gaya tambahan untuk tautan "Login here" */
        p {
            text-align: center;
            margin-top: 20px;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Register to Coffee Shop</h1>
    </header>
    <main>
        <form action="register.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Register">
        </form>
        
        <!-- Tautan untuk kembali ke halaman login -->
        <p>Already registered? <a href="login.php">Login here</a></p>
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop. All rights reserved.</p>
    </footer>
</body>
</html>
