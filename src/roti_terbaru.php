<?php
session_start();
$host = 'localhost';
$db = 'abila_bakery';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products WHERE category = 'roti_terbaru'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roti Terbaru - Abila Bakery</title>
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
                        <a class="nav-link" href="katalog_produk.php">Katalog Produk</a>
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
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Roti Terbaru</h1>
        <div class="row mt-5">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-text">Harga: Rp. <?php echo $row['price']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
