<!-- login_process.php -->
<?php
session_start();

// Dummy credentials (replace with database query in real application)
$valid_username = 'admin';
$valid_password = 'password';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate username and password
    if ($username === $valid_username && $password === $valid_password) {
        // Set session variables
        $_SESSION['username'] = $username;

        // Set cookie for remember me (optional)
        if (isset($_POST['remember'])) {
            $cookie_name = 'user';
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        }

        // Redirect to menu page or other authenticated page
        header('Location: home.php');
        exit;
    } else {
        echo "Invalid username or password. Please try again.";
    }
}
?>
