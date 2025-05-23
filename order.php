<?php
session_start();

// Fungsi untuk menghasilkan nomor antrian secara berurutan
function generate_queue_number() {
    // Cek apakah nomor antrian sudah disimpan di sesi
    if (!isset($_SESSION['queue_number'])) {
        // Inisialisasi nomor antrian jika belum ada
        $_SESSION['queue_number'] = 0;
    }

    // Tingkatkan nomor antrian dan kembalikan
    return $_SESSION['queue_number']++;
}

// Cek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kumpulkan data dari form
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $dine_take = isset($_POST['dine_take']) ? htmlspecialchars($_POST['dine_take']) : '';
    $payment = isset($_POST['payment']) ? htmlspecialchars($_POST['payment']) : '';

    // Validasi dan simpan ke sesi jika semua field yang diperlukan terisi
    if (!empty($name) && !empty($phone) && !empty($dine_take) && !empty($payment)) {
        // Setel detail pesanan ke dalam sesi
        $_SESSION['order_details'] = [
            'name' => $name,
            'phone' => $phone,
            'dine_take' => $dine_take,
            'payment' => $payment,
            'queue_number' => generate_queue_number(), // Hasilkan dan dapatkan nomor antrian
        ];

        // Redirect ke halaman sukses pesanan
        header("Location: order_success.php");
        exit();
    } else {
        $error = "Silakan isi semua field yang diperlukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Coffee Shop</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            background-image: url('images/t4.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #AF8F6F;
            color: #fff;
            padding: 10px 0;
            text-align: center;
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
            font-family: 'Nunito', sans-serif;
        }
        nav ul li a:hover {
            background-color: #EADBC8;
        }
        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .order-box {
            background-color: #BBAB8C;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .queue-number {
            margin: 20px 0;
            font-size: 1.5em;
            font-weight: bold;
            color: #AF8F6F;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            width: 150px;
            margin-right: 10px;
            text-align: left;
            color: #fff;
        }
        .form-group input,
        .form-group select {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #order-form h2 {
            text-align: center;
            color: #fff;
        }
        .form-submit {
            text-align: center;
        }
        .form-submit input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #AF8F6F;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-submit input[type="submit"]:hover {
            background-color: #8E7354;
        }
        .customer-center {
            display: flex;
            align-items: flex-start;
            background-color: #F6F5F2;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .customer-center img {
            margin-right: 20px;
            border-radius: 5px;
        }
        .customer-center div {
            max-width: 600px;
            margin-right: 70px;
        }
        .contact-info {
            margin-left: 20px;
            margin-right: 20px;
        }
        footer {
            text-align: center;
            padding: 5px 0;
            background-color: #AF8F6F;
            color: #fff;
            width: 100%;
            margin-top: auto;
        }
        footer p {
            margin: 5px 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header>
        <h1>Place Your Order</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="order-form" class="order-box">
            <h2>Order Form</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" pattern="[0-9]{1,12}" title="Phone number should only contain digits and have a maximum length of 12 characters" required>
                </div>
                <div class="form-group">
                    <label for="dine_take">Dine In / Take Away:</label>
                    <select id="dine_take" name="dine_take" required>
                        <option value="dine_in">Dine In</option>
                        <option value="take_away">Take Away</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment">Payment Method:</label>
                    <select id="payment" name="payment" required>
                        <option value="cash">Cash</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
                <div class="form-submit">
                    <input type="submit" value="Place Order">
                </div>
            </form>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop. All Rights Reserved.</p>
    </footer>
</body>
</html>
