<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'iban');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$edit_id = null;
$iban = $name = $bank_name = $photo = "";
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM iban_info WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $iban = $row['iban'];
        $name = $row['name'];
        $bank_name = $row['bank_name'];
        $photo = $row['photo'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iban = $_POST['iban'];
    $name = $_POST['name'];
    $bank_name = $_POST['bank_name'];
    $photo = $_FILES['photo']['name'];

    if ($photo) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);
    } else {
        $target_file = $_POST['current_photo'];
    }

    if ($edit_id) {
        $sql = "UPDATE iban_info SET iban='$iban', name='$name', bank_name='$bank_name', photo='$target_file' WHERE id=$edit_id";
    } else {
        $sql = "INSERT INTO iban_info (iban, name, bank_name, photo) VALUES ('$iban', '$name', '$bank_name', '$target_file')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla kaydedildi";
        header('Location: admin.php');
        exit;
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

$ibans = $conn->query("SELECT * FROM iban_info");

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $edit_id ? 'IBAN Bilgisi Düzenle' : 'IBAN Bilgisi Ekle'; ?></h1>
        <form action="admin.php<?php echo $edit_id ? '?edit=' . $edit_id : ''; ?>" method="post" enctype="multipart/form-data">
            <label for="iban">IBAN:</label>
            <input type="text" id="iban" name="iban" value="<?php echo $iban; ?>" required>
            
            <label for="name">Ad Soyad:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            
            <label for="bank_name">Banka Adı:</label>
            <input type="text" id="bank_name" name="bank_name" value="<?php echo $bank_name; ?>" required>
            
            <label for="photo">Fotoğraf:</label>
            <input type="file" id="photo" name="photo">
            <?php if ($photo): ?>
                <input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
                <img src="<?php echo $photo; ?>" alt="Current Photo" width="100">
            <?php endif; ?>
            
            <input type="submit" value="Kaydet">
        </form>
        <h2>Mevcut IBAN Bilgileri</h2>
        <table>
            <thead>
                <tr>
                    <th>IBAN</th>
                    <th>Ad Soyad</th>
                    <th>Banka Adı</th>
                    <th>Fotoğraf</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $ibans->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['iban']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['bank_name']; ?></td>
                        <td><img src="<?php echo $row['photo']; ?>" alt="Bank Logo" width="50"></td>
                        <td>
                            <a href="admin.php?edit=<?php echo $row['id']; ?>">Düzenle</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Bu kaydı silmek istediğinize emin misiniz?');">Sil</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="logout.php">Çıkış Yap</a>
    </div>
</body>
</html>
