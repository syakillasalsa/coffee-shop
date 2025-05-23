<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$error = '';
$username = '';
$remember_checked = '';

// Cek jika pengguna sudah "remembered" dari cookie
if (isset($_COOKIE['remember_me'])) {
    $username = $_COOKIE['remember_me'];
    $remember_checked = 'checked';
} elseif (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $remember_checked = 'checked';
}

// Validasi login saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    // Mencari pengguna berdasarkan username di tabel admin
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Memverifikasi password untuk admin menggunakan password_verify
        if (password_verify($password, $hashed_password)) {
            // Simpan username ke dalam session untuk admin
            $_SESSION['admin_login'] = $username;

            // Redirect ke halaman dashboard.php setelah login berhasil sebagai admin
            header('Location: dashboard.php');
            exit;
        }
    } else {
        // Jika tidak ditemukan di tabel admin, cari di tabel users
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Memverifikasi password untuk pengguna
            if (password_verify($password, $hashed_password)) {
                // Simpan username ke dalam session untuk pengguna
                $_SESSION['username'] = $username;

                // Set cookie untuk mengingat akun jika dicentang "Remember Me"
                if ($remember) {
                    setcookie('remember_me', $username, time() + (3600 * 24 * 30), "/"); // Cookie berlaku selama 30 hari
                } else {
                    // Hapus cookie jika "Remember Me" tidak dicentang
                    setcookie('remember_me', '', time() - 3600, "/");
                }

                // Redirect ke halaman home.php setelah login berhasil sebagai pengguna
                header('Location: home.php');
                exit;
            } else {
                $error = 'Username or password is incorrect.';
            }
        } else {
            $error = 'Username or password is incorrect.';
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Coffee Shop</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            color: #666;
            margin-bottom: 5px;
        }

        .input-group input {
            width: calc(100% - 20px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
        }

        .input-group input:focus {
            border-color: #333;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #AF8F6F;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #EADBC8;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

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

        label.remember-me {
            display: inline-flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to Coffee Shop</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <label class="remember-me">
                <input type="checkbox" id="remember" name="remember" <?php echo $remember_checked; ?>> Remember Me
            </label>
            <input type="submit" value="Login" class="btn">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>
