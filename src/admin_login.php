<?php
session_start();

$username = "andika yuda setyawan";
$password = "12345678";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['admin'] = true;
        header("Location: admin_panel.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Abila Bakery</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('gambar/background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .container {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mb-4">Login Admin</h2>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
