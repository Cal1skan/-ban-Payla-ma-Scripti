<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'admin_panel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: admin.php');
            exit;
        } else {
            $error_message = 'Geçersiz şifre';
        }
    } else {
        $error_message = 'Geçersiz kullanıcı adı';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container">
        <h1>Admin Girişi</h1>
        <form action="login.php" method="post">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Giriş Yap">
        </form>
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
