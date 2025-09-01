<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
require_once "db.php";

$aktifSepetler = [];
if (isset($_GET['aktif'])) {
    $sql = "SELECT sepet.id, kullanicilar.adsoyad, urunler.ad AS urun_adi, sepet.adet FROM sepet 
            JOIN kullanicilar ON sepet.kullanici_id = kullanicilar.id 
            JOIN urunler ON sepet.urun_id = urunler.id";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $aktifSepetler[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sepet Yönetimi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sepetler.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="center">
        <a href="sepetler.php?aktif=1" class="button" style="background:#4CAF50;color:white;padding:10px 20px;border-radius:5px;text-decoration:none;">Aktif Sepetler</a>
        <a href="sepetler.php?siparisler=1" class="button" style="background:#2196F3;color:white;padding:10px 20px;border-radius:5px;text-decoration:none;">Siparişler</a>
    </div>

    <?php if (isset($_GET['aktif'])): ?>
        <h2 style="text-align:center;">Aktif Sepetler</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Kullanıcı</th>
                <th>Ürün</th>
                <th>Adet</th>
                <th>İşlem</th>
            </tr>
            <?php foreach($aktifSepetler as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['adsoyad']); ?></td>
                <td><?php echo htmlspecialchars($row['urun_adi']); ?></td>
                <td><?php echo $row['adet']; ?></td>
                <td>
                    <form method="post" action="sepet_sil.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="delete-btn" onclick="return confirm('Sepeti silmek istediğinize emin misiniz?');">Sil</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <?php if (isset($_GET['siparisler'])): ?>
        <?php
        // Siparişler ve kullanıcı adı
        $siparisler = [];
        $sql = "SELECT siparisler.id, kullanicilar.adsoyad, siparisler.toplam_tutar, siparisler.tarih, siparisler.durum FROM siparisler 
                JOIN kullanicilar ON siparisler.kullanici_id = kullanicilar.id ORDER BY siparisler.id DESC";
        $result = $conn->query($sql);
        if (isset($_POST['durum_guncelle']) && isset($_POST['siparis_id'])) {
            $yeni_durum = $_POST['yeni_durum'];
            $siparis_id = intval($_POST['siparis_id']);
            $conn->query("UPDATE siparisler SET durum='".$conn->real_escape_string($yeni_durum)."' WHERE id=$siparis_id");
            echo '<meta http-equiv="refresh" content="0;url=sepetler.php?siparisler=1">';
            exit;
        }
        $siparisler = [];
        while($row = $result->fetch_assoc()) {
            $siparisler[] = $row;
        }
        $durumlar = ['Beklemede', 'Hazırlanıyor', 'Kargoda', 'Teslim Edildi', 'İptal Edildi'];
        ?>
        <h2 style="text-align:center;">Siparişler</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Kullanıcı</th>
                <th>Toplam Tutar</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>Durum Güncelle</th>
                <th>Detay</th>
            </tr>
            <?php foreach($siparisler as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['adsoyad']); ?></td>
                <td><?php echo $row['toplam_tutar']; ?> TL</td>
                <td><?php echo $row['tarih']; ?></td>
                <td><?php echo htmlspecialchars($row['durum'] ?? 'Beklemede'); ?></td>
                <td>
                    <form method="post" class="siparis-durum-form" style="display:inline;">
                        <input type="hidden" name="siparis_id" value="<?php echo $row['id']; ?>">
                        <select name="yeni_durum">
                            <?php foreach($durumlar as $durum): ?>
                                <option value="<?php echo $durum; ?>" <?php if(($row['durum'] ?? 'Beklemede')==$durum) echo 'selected'; ?>><?php echo $durum; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="durum_guncelle">Güncelle</button>
                    </form>
                </td>
                <td>
                    <a href="sepetler.php?siparisler=1&detay=<?php echo $row['id']; ?>" class="detay-btn" style="background:#1976D2;color:white;padding:5px 10px;border-radius:3px;text-decoration:none;">Detay</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <?php if (isset($_GET['siparisler']) && isset($_GET['detay'])): ?>
        <?php
        $siparis_id = intval($_GET['detay']);
        $sql = "SELECT sd.id, u.ad AS urun_adi, sd.adet, sd.birim_fiyat FROM siparis_detay sd 
                JOIN urunler u ON sd.urun_id = u.id WHERE sd.siparis_id = $siparis_id";
        $result = $conn->query($sql);
        ?>
        <h2 style=\"text-align:center;\">Sipariş Detayı (ID: <?php echo $siparis_id; ?>)</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Ürün</th>
                <th>Adet</th>
                <th>Birim Fiyat</th>
                <th>Toplam</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['urun_adi']); ?></td>
                <td><?php echo $row['adet']; ?></td>
                <td><?php echo $row['birim_fiyat']; ?> TL</td>
                <td><?php echo number_format($row['adet'] * $row['birim_fiyat'], 2); ?> TL</td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</body>
</html>
