<?php
// Langkah 1: Buat koneksi ke database
$host = 'localhost';
$db = 'abila_bakery';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Langkah 2: Buat query untuk mengambil data menu dari database
$query = "SELECT * FROM products WHERE category = 'kue_tradisional'";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kue Tradisional - Abila Bakery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Abila Bakery</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="menu_utama.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kue_tradisional.php">Katalog Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="testimoni.php">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang_kami.php">Tentang Kami</a>
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Kue Tradisional</h1>
        <div class="row mt-5">
            <?php 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card">';
                    echo '<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text">' . $row['description'] . '</p>';
                    echo '<p class="card-text">Harga: Rp. ' . $row['price'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-md-12 text-center">Tidak ada menu yang tersedia saat ini.</div>';
            }
            ?>
        </div>
    </div>

    <footer class="footer mt-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Jln. Jembatan Baru gang 8 no. 2 Pamekasan-Madura | Instagram: @abila_bakery | Telepon: 0877-5050-0222</p>
                    <p>Toko Roti Abila | Menyajikan roti berkualitas dan layanan ramah, pengalaman tak terlupakan bagi pelanggan.</p>
                </div>
                </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    <p>Copyright 2023 • All rights reserved • Abila Bakery</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
