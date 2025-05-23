<?php
// Memulai sesi atau melanjutkan sesi yang sudah ada
session_start();

// Memasukkan file yg berhubungan dgn database
require_once 'db/config.php'; 

// Inisialisasi keranjang belanja jika belum ada
if (!isset($_SESSION['cart'])) { 

    $_SESSION['cart'] = [];
}

// Menangani penambahan atau pembaruan item di keranjang belanja
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_name = $_POST['menu_name'] ?? ''; // Mengambil nama menu dari POST, default ke string kosong jika tidak ada,menetapkan nilai default kalo string kosong
    $menu_price = $_POST['menu_price'] ?? 0; // Mengambil harga menu dari POST, default ke 0 jika tidak ada

    if (!empty($menu_name)) {
        // Memperbarui atau menambahkan item ke keranjang
        if (!isset($_SESSION['cart'][$menu_name])) {
            $_SESSION['cart'][$menu_name] = [
                'nama_menu' => $menu_name, // Menyimpan nama menu
                'quantity' => 1, // Kuantitas default
                'price' => $menu_price // Menggunakan harga yang dikirim dari menu.php
            ];
        } else {
            $_SESSION['cart'][$menu_name]['quantity'] += 1; // Menambah kuantitas
        }
    }
}

// Memperbarui atau menghapus item di keranjang
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $menu_name = $_POST['menu_name']; // Mengambil nama menu dari POST
        $quantity = $_POST['quantity']; // Mengambil kuantitas dari POST
        
        if (isset($_SESSION['cart'][$menu_name])) {
            $_SESSION['cart'][$menu_name]['quantity'] = $quantity; // Memperbarui kuantitas
        }
    } elseif (isset($_POST['delete'])) {
        $menu_name = $_POST['menu_name']; // Mengambil nama menu dari POST

        if (isset($_SESSION['cart'][$menu_name])) {
            unset($_SESSION['cart'][$menu_name]); // Menghapus item dari keranjang
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Coffee Shop</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- Menyertakan file CSS eksternal -->
</head>
<body>
    <header>
        <h1>Shopping Cart</h1> <!-- Judul halaman -->
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li> <!-- Tautan ke halaman Home -->
                <li><a href="menu.php">Menu</a></li> <!-- Tautan ke halaman Menu -->
                <li><a href="contact.php">Contact</a></li> <!-- Tautan ke halaman Contact -->
            </ul>
        </nav>
    </header>
    <main>
        <section id="cart-items">
            <h2>Cart Items</h2> <!-- Judul bagian keranjang belanja -->
            <div class="cart-items">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <table>
                        <tr>
                            <th>Menu Item</th> <!-- Kolom nama menu -->
                            <th>Quantity</th> <!-- Kolom kuantitas -->
                            <th>Price</th> <!-- Kolom harga -->
                            <th>Action</th> <!-- Kolom aksi -->
                        </tr>
                        <?php foreach ($_SESSION['cart'] as $menu_name => $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['nama_menu']); ?></td> <!-- Menampilkan nama menu -->
                                <td>
                                    <form action="cart.php" method="POST"> <!-- Form untuk memperbarui kuantitas -->
                                        <input type="hidden" name="menu_name" value="<?php echo $menu_name; ?>"> <!-- Input tersembunyi untuk nama menu -->
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1"> <!-- Input untuk kuantitas -->
                                        <input type="submit" name="update" value="Update"> <!-- Tombol untuk memperbarui -->
                                    </form>
                                </td>
                                <td>Rp. <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></td> <!-- Menampilkan harga total -->
                                <td>
                                    <form action="cart.php" method="POST"> <!-- Form untuk menghapus item -->
                                        <input type="hidden" name="menu_name" value="<?php echo $menu_name; ?>"> <!-- Input tersembunyi untuk nama menu -->
                                        <input type="submit" name="delete" value="Delete"> <!-- Tombol untuk menghapus -->
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="cart-buttons">
                        <a href="menu.php" class="back-btn">Back to Menu</a> <!-- Tautan kembali ke menu -->
                        <a href="order.php" class="proceed-btn">Proceed to Order</a> <!-- Tautan untuk melanjutkan ke pemesanan -->
                    </div>
                <?php else: ?>
                    <p>Your cart is empty.</p> <!-- Pesan jika keranjang kosong -->
                    <a href="menu.php" class="back-btn">Back to Menu</a> <!-- Tautan kembali ke menu -->
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop. All rights reserved.</p> 
    </footer>
</body>
</html>
