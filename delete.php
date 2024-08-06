<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $conn = new mysqli('localhost', 'root', '', 'iban');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM iban_info WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla silindi";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: admin.php');
    exit;
} else {
    header('Location: admin.php');
    exit;
}
