<?php
session_start();
include "../whoismoda/db.php";

// Admin girişi yapılmış mı kontrol
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

// Ürünleri çekiyoruz
$sql = "SELECT * FROM urunler ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Listesi</title>
    <link rel="stylesheet" href="css/style.css">
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
            text-decoration: none;
            border-radius: 5px;
        }

        a.button:hover {
            background-color: #45a049;
        }

        table.urunler-tablo {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        table.urunler-tablo th, table.urunler-tablo td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table.urunler-tablo th {
            background-color: #4CAF50;
            color: white;
        }

        table.urunler-tablo tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table.urunler-tablo tr:hover {
            background-color: #ddd;
        }

        table.urunler-tablo img {
            width: 60px;
            height: auto;
            border-radius: 4px;
        }

        .islem-linkleri a {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .islem-linkleri a.duzenle {
            background-color: #2196F3;
        }

        .islem-linkleri a.duzenle:hover {
            background-color: #1976D2;
        }

        .islem-linkleri a.sil {
            background-color: #f44336;
        }

        .islem-linkleri a.sil:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<h2>Ürün Listesi</h2>
<a href="dashboard.php" class="button anamenubuton">Ana Menüye Dön</a>
<a href="urun_ekle.php" class="button">Yeni Ürün Ekle</a>

<table class="urunler-tablo">
    <tr>
        <th>ID</th>
        <th>Ad</th>
        <th>Açıklama</th>
        <th>Fiyat</th>
        <th>Kategori</th>
        <th>Resim</th>
        <th>İşlemler</th>
    </tr>

    <?php
    while ($urun = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$urun['id']."</td>";
        echo "<td>".$urun['ad']."</td>";
        echo "<td>".$urun['aciklama']."</td>";
        echo "<td>".$urun['fiyat']." TL</td>";
        echo "<td>".$urun['kategori']."</td>";
        echo "<td><img src='../whoismoda/".$urun['resim']."' width='50'></td>";
        echo "<td class='islem-linkleri'>
                <a href='urun_duzenle.php?id=".$urun['id']."' class='duzenle'>Düzenle</a>
                <a href='urun_sil.php?id=".$urun['id']."' class='sil' onclick=\"return confirm('Emin misin?')\">Sil</a>
              </td>";
        echo "</tr>";
    }
    ?>

</table>

</body>
</html>
