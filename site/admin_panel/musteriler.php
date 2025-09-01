<?php
// Oturumu başlat ve admin kontrolü yap
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
// Veritabanı bağlantısı
require_once "db.php";

// Hata ve başarı mesajları için değişkenler
$hata = "";
$basari = "";

// Müşteri silme işlemi (GET ile sil parametresi gelirse)
if (isset($_GET['sil'])) {
    $id = intval($_GET['sil']);
    $conn->query("DELETE FROM kullanicilar WHERE id=$id");
    $basari = "Müşteri başarıyla silindi.";
}

// Müşteri ekleme işlemi (POST ile ekle butonuna basılırsa)
if (isset($_POST['ekle'])) {
    $kullanici_adi = trim($_POST['kullanici_adi']); // Ad soyad
    $email = trim($_POST['email']);
    $sifre = trim($_POST['sifre']);
    if ($kullanici_adi == '' || $sifre == '' || $email == '') {
        $hata = "Ad soyad, email ve şifre boş olamaz.";
    } else {
        // Aynı adsoyad veya email var mı kontrol et
        $varmi = $conn->query("SELECT id FROM kullanicilar WHERE adsoyad='".$conn->real_escape_string($kullanici_adi)."' OR email='".$conn->real_escape_string($email)."'");
        if ($varmi->num_rows > 0) {
            $hata = "Bu kullanıcı adı veya email zaten kayıtlı.";
        } else {
            // Yeni müşteri ekle
            $conn->query("INSERT INTO kullanicilar (adsoyad, email, sifre, tarih) VALUES ('".$conn->real_escape_string($kullanici_adi)."', '".$conn->real_escape_string($email)."', '".$conn->real_escape_string($sifre)."', NOW())");
            $basari = "Müşteri başarıyla eklendi.";
        }
    }
}

// Müşteri düzenleme işlemi (POST ile guncelle butonuna basılırsa)
if (isset($_POST['guncelle'])) {
    $id = intval($_POST['id']);
    $kullanici_adi = trim($_POST['kullanici_adi']);
    $email = trim($_POST['email']);
    $sifre = trim($_POST['sifre']);
    if ($kullanici_adi == '' || $email == '') {
        $hata = "Ad soyad ve email boş olamaz.";
    } else {
        // Şifre girildiyse şifre de güncellenir
        if ($sifre != '') {
            $conn->query("UPDATE kullanicilar SET adsoyad='".$conn->real_escape_string($kullanici_adi)."', email='".$conn->real_escape_string($email)."', sifre='".$conn->real_escape_string($sifre)."' WHERE id=$id");
        } else {
            $conn->query("UPDATE kullanicilar SET adsoyad='".$conn->real_escape_string($kullanici_adi)."', email='".$conn->real_escape_string($email)."' WHERE id=$id");
        }
        $basari = "Müşteri başarıyla güncellendi.";
    }
}

// Düzenlenecek müşteri (GET ile duzenle parametresi gelirse)
$duzenle = null;
if (isset($_GET['duzenle'])) {
    $id = intval($_GET['duzenle']);
    $res = $conn->query("SELECT * FROM kullanicilar WHERE id=$id");
    if ($res->num_rows > 0) {
        $duzenle = $res->fetch_assoc();
    }
}

// Tüm müşterileri çek
$musteriler = $conn->query("SELECT * FROM kullanicilar ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Müşteriler</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .center {
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            overflow-x: auto;
        }
        .center table {
            min-width: 900px;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            word-break: break-word;
            max-width: 220px;
        }
        th {
            background: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
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
        .form-container {
            margin: 20px 0;
        }
        .form-container input {
            width: 200px;
            margin: 5px;
        }
        .form-container button {
            width: auto;
        }
        .mesaj {
            text-align:center;
            margin:10px 0;
            font-weight:600;
        }
        .mesaj.hata {
            color: #d32f2f;
        }
        .mesaj.basari {
            color: #28a745;
        }
        @media (max-width: 1100px) {
            .center {
                padding: 10px;
            }
            .center table {
                min-width: 700px;
                font-size: 13px;
            }
            th, td {
                padding: 6px;
                max-width: 120px;
            }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="center">
    <h2>Müşteriler</h2>
    <a href="dashboard.php" class="button anamenubuton">Ana Menüye Dön</a>

    <?php if ($hata): ?><div class="mesaj hata"><?php echo $hata; ?></div><?php endif; ?>
    <?php if ($basari): ?><div class="mesaj basari"><?php echo $basari; ?></div><?php endif; ?>

    <!-- Ekle veya düzenle formu -->
    <div class="form-container">
        <form method="post">
            <?php if ($duzenle): ?>
                <input type="hidden" name="id" value="<?php echo $duzenle['id']; ?>">
                <input type="text" name="kullanici_adi" value="<?php echo htmlspecialchars($duzenle['adsoyad']); ?>" placeholder="Ad Soyad" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($duzenle['email']); ?>" placeholder="Email" required>
                <input type="password" name="sifre" placeholder="Yeni Şifre (değiştirmek için)">
                <button type="submit" name="guncelle">Güncelle</button>
                <a href="musteriler.php" class="button" style="background:#888;">İptal</a>
            <?php else: ?>
                <input type="text" name="kullanici_adi" placeholder="Ad Soyad" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="sifre" placeholder="Şifre" required>
                <button type="submit" name="ekle">Ekle</button>
            <?php endif; ?>
        </form>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Ad Soyad</th>
            <th>Email</th>
            <th>Şifre</th>
            <th>Tarih</th>
            <th>İşlemler</th>
        </tr>
        <?php while ($m = $musteriler->fetch_assoc()): ?>
            <tr>
                <td><?php echo $m['id']; ?></td>
                <td><?php echo htmlspecialchars($m['adsoyad']); ?></td>
                <td><?php echo htmlspecialchars($m['email']); ?></td>
                <td><?php echo htmlspecialchars($m['sifre']); ?></td>
                <td><?php echo $m['tarih']; ?></td>
                <td class="islem-linkleri">
                    <a href="musteriler.php?duzenle=<?php echo $m['id']; ?>" class="duzenle">Düzenle</a>
                    <a href="musteriler.php?sil=<?php echo $m['id']; ?>" class="sil" onclick="return confirm('Bu müşteriyi silmek istediğinize emin misiniz?')">Sil</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
