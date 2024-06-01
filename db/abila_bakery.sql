-- Buat database baru
CREATE DATABASE IF NOT EXISTS abila_bakery;

-- Gunakan database yang baru dibuat
USE abila_bakery;

-- Buat tabel 'products' untuk menyimpan data produk
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255) NOT NULL
);
-- Masukkan contoh data produk ke dalam tabel 'products'
INSERT INTO products (category, name, price, description, image) VALUES
('kue_tradisional', 'Kue Tradisional 1', 5000, 'Deskripsi kue tradisional 1.', 'uploads/kue1.jpg'),
('kue_tradisional', 'Kue Tradisional 2', 6000, 'Deskripsi kue tradisional 2.', 'uploads/kue2.jpg'),
('kue_tradisional', 'Kue Tradisional 3', 7000, 'Deskripsi kue tradisional 3.', 'uploads/kue3.jpg'),
('roti_terbaru', 'Roti Terbaru 1', 8000, 'Deskripsi roti terbaru 1.', 'uploads/roti1.jpg'),
('roti_terbaru', 'Roti Terbaru 2', 9000, 'Deskripsi roti terbaru 2.', 'uploads/roti2.jpg');
