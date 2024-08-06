<?php
$conn = new mysqli('localhost', 'root', '', 'iban');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM iban_info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBAN Paylaşım Scripti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>IBAN PAYLAŞIM SCRİPTİ</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </header>
    <nav>
        <a href="#">Anasayfa - IBAN</a>
    </nav>
    <main>
        <section class="iban-section">
            <h2>BANKA HESAP BİLGİLERİMİZ</h2>
            <p>Tüm banka hesap bilgilerimizi burada görebilirsiniz.</p>
            <table>
                <thead>
                    <tr>
                        <th>IBAN</th>
                        <th>Alıcı Adı Soyadı</th>
                        <th>Hesap Türü</th>
                        <th>Banka</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["iban"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>TL</td>"; // Hesap Türü sabit olarak TL yazıldı.
                            echo "<td><img src='" . $row["photo"] . "' alt='Bank Logo'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
