<?php
session_start();
include "../whoismoda/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: urunler.php");
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM urunler WHERE id = $id";
$result = $conn->query($sql);
$urun = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad'];
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];
    $kategori = $_POST['kategori'];

    // Resim seçildi mi?
    if (!empty($_FILES['resim']['name'])) {
        $resimAdi = $_FILES['resim']['name'];
        $geciciYol = $_FILES['resim']['tmp_name'];
        $hedefKlasor = "../whoismoda/resimler/";
        $hedefDosya = $hedefKlasor . $resimAdi;

        move_uploaded_file($geciciYol, $hedefDosya);

        // Eski resmi sil
        if (file_exists("../whoismoda/" . $urun['resim'])) {
            unlink("../whoismoda/" . $urun['resim']);
        }

        $resimVeritabaniYolu = "resimler/" . $resimAdi;

        $sql = "UPDATE urunler SET ad='$ad', aciklama='$aciklama', fiyat='$fiyat', kategori='$kategori', resim='$resimVeritabaniYolu' WHERE id=$id";
    } else {
        $sql = "UPDATE urunler SET ad='$ad', aciklama='$aciklama', fiyat='$fiyat', kategori='$kategori' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Güncelleme başarılı!";
        header("Location: urunler.php");
        exit;
    } else {
        echo "Güncelleme hatası!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Düzenle</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Ürün Düzenle</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="ad" value="<?php echo $urun['ad']; ?>" required><br><br>
    <textarea name="aciklama" required><?php echo $urun['aciklama']; ?></textarea><br><br>
    <input type="number" step="0.01" name="fiyat" value="<?php echo $urun['fiyat']; ?>" required><br><br>
    
    <select name="kategori" required>
        <option value="erkek" <?php if($urun['kategori'] == 'erkek') echo 'selected'; ?>>Erkek</option>
        <option value="kadin" <?php if($urun['kategori'] == 'kadin') echo 'selected'; ?>>Kadın</option>
        <option value="cocuk" <?php if($urun['kategori'] == 'cocuk') echo 'selected'; ?>>Çocuk</option>
        <option value="yetiskin" <?php if($urun['kategori'] == 'yetiskin') echo 'selected'; ?>>Yetişkin</option>
    </select><br><br>

    <img src="../whoismoda/<?php echo $urun['resim']; ?>" width="100"><br><br>
    Yeni Resim Seç (isteğe bağlı): <input type="file" name="resim"><br><br>

    <button type="submit">Güncelle</button>
</form>

</body>
</html>
