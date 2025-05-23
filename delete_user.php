<?php
include('db/config.php');
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("location: login.php");
}

$id = $_GET['id'];

// Ambil informasi pengguna yang akan dihapus
$sql_select = "SELECT username FROM users WHERE id = $id";
$result = $conn->query($sql_select); 
if ($result->num_rows > 0) { 
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    echo "User not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses penghapusan jika pengguna mengonfirmasi
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("location: manage_users.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 30px;
            font-size: 18px;
        }
        form {
            display: inline-block;
        }
        input[type="submit"], a {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            background-color: #ff4d4d;
            cursor: pointer;
        }
        a {
            background-color: #4CAF50;
        }
        input[type="submit"]:hover {
            background-color: #ff3333;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete user '<?php echo $username; ?>'?");
        }
    </script>
</head>
<body>

    <div class="container">
        <h2>Delete User</h2>
        <p>You are about to delete user: <strong><?php echo $username; ?></strong></p>
        
        <form method="POST" onsubmit="return confirmDelete()">
            <input type="submit" value="Delete">
            <a href="manage_users.php">Cancel</a>
        </form>
    </div>

</body>
</html>
