<?php
include('db/config.php');
session_start();

// Pastikan admin sudah login
if (!isset($_SESSION['admin_login'])) {
    header("location: login.php");
    exit;
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("location: manage_orders.php");
    exit();
}
$id = intval($_GET['id']);

// Ambil data pesanan berdasarkan ID
$sql = "SELECT * FROM orders WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
    header("location: manage_orders.php");
    exit();
}

$row = $result->fetch_assoc();

// Handle form submission untuk update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $dine_take = $conn->real_escape_string($_POST['dine_take']);
    $number = $conn->real_escape_string($_POST['number']);
    $payment = $conn->real_escape_string($_POST['payment']);

    // Update pesanan di database tanpa field order_time
    $sql_update = "UPDATE orders SET name = '$name', phone = '$phone', dine_take = '$dine_take', number = '$number', payment = '$payment' WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        header("location: manage_orders.php");
        exit();
    } else {
        $error_message = "Error updating record: " . $conn->error;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
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
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"], 
        textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .button-group button {
            background-color: #AF8F6F;
            color: white;
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 1rem;
        }

        .button-group button:last-child {
            margin-right: 0;
        }

        .button-group button:hover {
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

        header {
            background-color: #AF8F6F;
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 1.5rem;
        }

        header h1 {
            margin: 0;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h2>Edit Order</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br><br>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required><br><br>

            <label for="dine_take">Dine/Take:</label>
            <input type="text" id="dine_take" name="dine_take" value="<?php echo htmlspecialchars($row['dine_take']); ?>" required><br><br>

            <label for="number">Queue Number:</label>
            <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($row['number']); ?>" required><br><br>

            <label for="payment">Payment Method:</label>
            <input type="text" id="payment" name="payment" value="<?php echo htmlspecialchars($row['payment']); ?>" required><br><br>

            <label for="order_time">Order Time:</label>
            <input type="text" id="order_time" name="order_time" value="<?php echo htmlspecialchars($row['order_time']); ?>" readonly><br><br>

            <div class="button-group">
                <button type="submit">Update Order</button>
                <button type="button" onclick="window.location.href='manage_orders.php'">Back</button>
            </div>
        </form>
        <?php
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
