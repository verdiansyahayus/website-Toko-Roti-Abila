<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$host = 'localhost';
$db = 'abila_bakery';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add_item'])) {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO products (category, name, price, description, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $category, $name, $price, $description, $target);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Failed to upload image.";
    }
}

if (isset($_POST['delete_item'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['update_item'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if ($image != "") {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $stmt = $conn->prepare("UPDATE products SET category = ?, name = ?, price = ?, description = ?, image = ? WHERE id = ?");
            $stmt->bind_param("ssdssi", $category, $name, $price, $description, $target, $id);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        $stmt = $conn->prepare("UPDATE products SET category = ?, name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssdsi", $category, $name, $price, $description, $id);
        $stmt->execute();
        $stmt->close();
    }
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Abila Bakery</title>
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
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Menu Admin</h1>
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Tambah/Edit Item
                    </div>
                    <div class="card-body">
                        <form action="admin_panel.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="edit_id">
                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="kue_tradisional">Kue Tradisional</option>
                                    <option value="roti_terbaru">Roti Terbaru</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" name="price" id="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <button type="submit" name="add_item" class="btn btn-primary">Tambah Item</button>
                            <button type="submit" name="update_item" class="btn btn-primary">Update Item</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-5">
                <div class="card-header">
                        Daftar Item
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td><img src="<?php echo $row['image']; ?>" width="100"></td>
                                        <td>
                                            <form action="admin_panel.php" method="post" class="d-inline">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_item" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                            <button class="btn btn-warning btn-sm" onclick="fillForm(<?php echo $row['id']; ?>, '<?php echo $row['category']; ?>', '<?php echo $row['name']; ?>', <?php echo $row['price']; ?>, '<?php echo $row['description']; ?>')">Edit</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fillForm(id, category, name, price, description) {
            document.getElementById('edit_id').value = id;
            document.getElementById('category').value = category;
            document.getElementById('name').value = name;
            document.getElementById('price').value = price;
            document.getElementById('description').value = description;
        }
    </script>
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
