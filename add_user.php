<?php
// Veritabanı bağlantısı
$conn = new mysqli('localhost', 'root', '', 'admin_panel');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Şifreyi hashleyin

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Yeni kullanıcı başarıyla oluşturuldu";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Ekle</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container">
        <h1>Yeni Kullanıcı Ekle</h1>
        <form action="add_user.php" method="post">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Kullanıcı Ekle">
        </form>
    </div>
</body>
</html>
