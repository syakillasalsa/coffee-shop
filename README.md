
# ☕ Coffee Shop Web App

A lightweight and elegant web application for managing a cozy coffee shop — featuring menu display, cart functionality, and user roles (admin & customer).

---

## 🎯 Fitur Utama

- **Tampilan menu**: Daftar minuman & makanan dengan gambar, harga, dan deskripsi  
- **Keranjang belanja**: Tambah, kurangi, atau hapus item sebelum checkout  
- **Autentikasi pengguna**:
  - **Admin**: Bisa login dan mengelola menu (tambah, edit, hapus)
  - **Customer**: Bisa login untuk memesan dan melihat riwayat pesanan

---

## 🔐 Kredensial Login

| Role     | Username       | Password     |
|----------|----------------|--------------|
| **Admin**    | `AdminCoffee`   | `admin1`     |
| **Customer** | `syakilla`      | `syakilla`   |

---

## 🚀 Cara Menjalankan Aplikasi

1. Clone repository:
   ```bash
   git clone https://github.com/syakillasalsa/coffee-shop.git
   cd coffee-shop
````

2. Siapkan database:

   * Buat database di phpMyAdmin/XAMPP (misalnya `coffee_shop_db`)
   * Import script SQL (`coffee_shop.sql`), atau sesuaikan struktur tabel secara manual

3. Konfigurasi koneksi database:

   * Edit file di folder `config/` atau `db/`
   * Sesuaikan host, username (default: `root`), password, dan nama database

4. Jalankan web server:

   * Tempatkan folder ini di `htdocs/` (jika menggunakan XAMPP)
   * Akses melalui browser:

     ```
     http://localhost/coffee-shop/
     ```

5. Login dengan akun yang tersedia untuk mencoba fitur sesuai role

---

## 🧩 Struktur Proyek

```
coffee-shop/
├── index.php               # Halaman utama & menu
├── login.php               # Halaman login
├── admin.php               # Dashboard admin
├── cart.php                # Halaman keranjang & checkout
├── config/                 # Koneksi database
├── css/                    # File CSS
├── js/                     # Script JavaScript
├── images/                 # Gambar produk
└── database.sql            # Skrip database (jika ada)
```

---

## 💡 Rencana Pengembangan

* Fitur registrasi user baru
* Kategori produk & manajemen stok
* Admin panel untuk pesanan & laporan
* Validasi keamanan & session management
* Integrasi pembayaran digital (e.g. Midtrans)

---

## 📜 Lisensi

MIT License — feel free to use, modify, and distribute this project!

---

## 🤝 Kontribusi

Fork repo ini → buat branch → pull request.
Saran dan bug report sangat diapresiasi!

