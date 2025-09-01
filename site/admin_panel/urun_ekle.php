<?php
session_start();
include "../whoismoda/db.php";

// Admin kontrolü
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

// Ürün ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad'];
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];
    $kategori = $_POST['kategori'];

    // Resim yükleme
    $resimAdi = $_FILES['resim']['name'];
    $geciciYol = $_FILES['resim']['tmp_name'];
    $hedefKlasor = "../whoismoda/resimler/";
    $hedefDosya = $hedefKlasor . $resimAdi;

    if (move_uploaded_file($geciciYol, $hedefDosya)) {
        $resimVeritabaniYolu = "resimler/" . $resimAdi;

        $sql = "INSERT INTO urunler (ad, aciklama, fiyat, kategori, resim) 
                VALUES ('$ad', '$aciklama', '$fiyat', '$kategori', '$resimVeritabaniYolu')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Ürün başarıyla eklendi!'); window.location='urunler.php';</script>";
        } else {
            echo "Hata: " . $conn->error;
        }
    } else {
        echo "Resim yüklenirken hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Ürün Ekle</title>
    <link rel="stylesheet" href="css/style.css">
    <?php include 'header.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        a.button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-bottom: 20px;
            margin-right: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        a.button:hover {
            background-color: #45a049;
        }

        a.anamenubuton {
            background-color: #ff9800;
        }

        a.anamenubuton:hover {
            background-color: #fb8c00;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Yeni Ürün Ekle</h2>

<!-- Ana Menü ve Ürün Listesi Butonları -->
<a href="dashboard.php" class="button anamenubuton">Ana Menüye Dön</a>
<a href="urunler.php" class="button">Ürün Listesine Dön</a>

<form method="POST" enctype="multipart/form-data">
    <label for="ad">Ürün Adı</label>
    <input type="text" name="ad" id="ad" required>

    <label for="aciklama">Açıklama</label>
    <textarea name="aciklama" id="aciklama" required></textarea>

    <label for="fiyat">Fiyat</label>
    <input type="number" step="0.01" name="fiyat" id="fiyat" required>

    <label for="kategori">Kategori</label>
    <select name="kategori" id="kategori" required>
        <option value="erkek">Erkek</option>
        <option value="kadin">Kadın</option>
        <option value="cocuk">Çocuk</option>
        <option value="yetiskin">Yetişkin</option>
    </select>

    <label for="resim">Ürün Resmi</label>
    <input type="file" name="resim" id="resim" required>

    <button type="submit">Ürünü Ekle</button>
</form>

</body>
</html>
