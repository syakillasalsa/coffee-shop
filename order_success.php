<?php
session_start();
include('db/config.php');


//Kode ini dimulai dengan memulai sesi PHP dengan session_start() dan menyertakan file konfigurasi database (db/config.php). 
//Ini memastikan bahwa admin telah login dengan memeriksa apakah sesi admin_login ada. 
//Jika tidak, pengguna akan diarahkan ke halaman login (login.php).


// Initialize variables with default values to prevent warnings
//agar terisi semua,jd wajib diisi
$name = isset($_SESSION['order_details']['name']) ? htmlspecialchars($_SESSION['order_details']['name']) : 'Not Provided';
$phone = isset($_SESSION['order_details']['phone']) ? htmlspecialchars($_SESSION['order_details']['phone']) : 'Not Provided';
$dine_take = isset($_SESSION['order_details']['dine_take']) ? ($_SESSION['order_details']['dine_take'] == 'dine_in' ? 'Dine In' : 'Take Away') : 'Not Provided';
$queue_number = isset($_SESSION['order_details']['queue_number']) ? htmlspecialchars($_SESSION['order_details']['queue_number']) : 'Not Assigned';
$payment_method = isset($_SESSION['order_details']['payment']) 
    ? ($_SESSION['order_details']['payment'] == 'cash' 
        ? 'Cash' 
        : ($_SESSION['order_details']['payment'] == 'credit_card' 
            ? 'Credit Card' 
            : 'QRIS')) 
    : 'Not Provided';


// Initialize empty array for cart items
//untuk cart agar kosong sebelum pesanan dimasukan ke keranjang
$cart_items = [];

// Calculate total price
$total_price = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) { 
    foreach ($_SESSION['cart'] as $item) {
        $cart_items[] = [
            'name' => isset($item['name']) ? htmlspecialchars($item['name']) : '', 
            'quantity' => isset($item['quantity']) ? $item['quantity'] : 0, 
            'price' => isset($item['price']) ? $item['price'] : 0,
            'total' => isset($item['price']) && isset($item['quantity']) ? $item['price'] * $item['quantity'] : 0
        ];
        $total_price += isset($item['price']) && isset($item['quantity']) ? $item['price'] * $item['quantity'] : 0; 
    }
}



// Save order data to the orders table:menyimpan ke database
$stmt = $conn->prepare("INSERT INTO orders (name, phone, dine_take, number, payment, order_time) VALUES  (?, ?, ?, ?, ?, NOW())"); //untuk menyimpan datanya ke database soalnya disini pakai bind param,jd tanda tanda itu utk place holder
$stmt->bind_param("sssss", $name, $phone, $dine_take, $queue_number, $payment_method); 
$stmt->execute();
$stmt->close();

// Clear the session variables (optional)
unset($_SESSION['cart']);
unset($_SESSION['order_details']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Coffee Shop</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #AF8F6F;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-size: 2em;
        }
        nav {
            text-align: center;
            margin-top: 10px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #EADBC8;
        }
        main {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .order-box {
            background-color: #F6F5F2;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .order-details table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .order-details table th,
        .order-details table td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .order-details h3 {
            margin-top: 0;
        }
        .order-details a {
            display: inline-block;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .order-details a:hover {
            background-color: #555;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #AF8F6F;
            color: #555;
        }
        .queue-number {
            margin: 20px 0;
            font-size: 1.5em;
            font-weight: bold;
            color: #AF8F6F;
        }
        .btn {
            display: inline-block;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        .logout-btn {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #EADBC8;
        }
        /* Receipt-like styling */
        .order-box {
            border: 1px dashed #333;
            padding: 20px;
            text-align: left;
        }
        .order-box h3 {
            margin-bottom: 10px;
        }
        .order-box ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .order-box ul li {
            padding: 5px 0;
            border-bottom: 1px dashed #ddd;
        }
        .order-box ul li:last-child {
            border-bottom: none;
        }
        .order-box .total-price {
            font-weight: bold;
            margin-top: 10px;
        }
        .order-box .receipt-footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Order Success</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>
    <main>
        <section class="order-details">
            <h2>Thank you for your order!</h2>
            <p>Your order has been successfully placed.</p>
            <div class="queue-number">Queue No: <?php echo $queue_number; ?></div>
            <div class="order-box">
                <h3>Order Details:</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $phone; ?></td>
                    </tr>
                    <tr>
                        <th>Information</th>
                        <td><?php echo $dine_take; ?></td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td><?php echo $payment_method; ?></td>
                    </tr>
                </table>
                <?php if (!empty($cart_items)): ?>
                <h3>Ordered Items:</h3>
                <ul>
                    <?php foreach ($cart_items as $item): ?>
                        <li><?php echo $item['name']; ?> - Quantity: <?php echo $item['quantity']; ?> - Total Price: Rp. <?php echo number_format($item['total'], 0, ',', '.'); ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="total-price">Total Price: Rp. <?php echo number_format($total_price, 0, ',', '.'); ?></div>
                <?php endif; ?>
                <div class="receipt-footer">
                    <p>&copy; 2024 Coffee Shop. All rights reserved.</p>
                </div>
            </div>
            <a href="home.php" class="btn">Back to Home</a>
            <a href="#" onclick="window.print();" class="btn">Print Receipt</a>
        </section>
    </main>
</body>
</html>
