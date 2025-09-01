<?php
session_start();
include("db.php");
$hata = '';
// Matematik işlemini sadece GET'te üret, POST'ta üretme
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $sayi1 = rand(1, 10);
    $sayi2 = rand(1, 10);
    $islem = rand(0, 1) ? '+' : '-';
    $soru = $sayi1 . ' ' . $islem . ' ' . $sayi2;
    $dogru_sonuc = $islem === '+' ? ($sayi1 + $sayi2) : ($sayi1 - $sayi2);
    $_SESSION['matematik_soru'] = $soru;
    $_SESSION['matematik_sonuc'] = $dogru_sonuc;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adsoyad = $_POST["adsoyad"];
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];
    $matematik_cevap = isset($_POST['matematik_cevap']) ? trim($_POST['matematik_cevap']) : '';

    // Matematik işlemi kontrolü
    if ($matematik_cevap === '' || !is_numeric($matematik_cevap) || intval($matematik_cevap) !== intval($_SESSION['matematik_sonuc'])) {
        $hata = "<div style='color:red; margin-bottom:10px;'>Lütfen matematik işlemini doğru cevaplayınız.</div>";
        // Yeni bir soru üret
        unset($_SESSION['matematik_sonuc']);
    } else {
        // Bağlantı kontrolü
        if (!$conn || $conn->connect_error) {
            $hata = "<div style='color:red; margin-bottom:10px;'>Veritabanı bağlantı hatası: ".($conn ? $conn->connect_error : 'Bağlantı yok')."</div>";
        } else {
            // Şifreyi hashlemeden kaydet
            $stmt = $conn->prepare("INSERT INTO kullanicilar (adsoyad, email, sifre) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $adsoyad, $email, $sifre);
                if ($stmt->execute()) {
                    $basarili = true;
                    $hata = "<div style='color:green; font-weight:bold; text-align:center; margin-bottom:20px;'>Kayıt başarılı! Giriş yapabilirsiniz.</div>";
                    unset($_SESSION['matematik_sonuc']);
                    unset($_SESSION['matematik_soru']);
                } else {
                    $hata = "<div style='color:red; margin-bottom:10px;'>Kayıt sırasında hata: ".$stmt->error."</div>";
                }
                $stmt->close();
            } else {
                $hata = "<div style='color:red; margin-bottom:10px;'>Sorgu hazırlanamadı: ".$conn->error."</div>";
            }
        }
        // Yeni bir soru üret
        unset($_SESSION['matematik_sonuc']);
        unset($_SESSION['matematik_soru']);
    }
}
?>

<?php include("header.php"); ?>


<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<style>
/* Tüm sayfayı kapsayan flex yapı */
html, body {
    height: 100%;
}
body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Ana içerik alanı (footer'ı alta iter) */
main {
    flex: 1 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: center; /* Formu dikey ortala */
    min-height: 60vh; /* Az içerikte bile ortaya çeker */
}

/* Kayıt Formu Stili */
.kayit-form {
    width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.kayit-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.kayit-form input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.kayit-form button {
    width: 100%;
    background-color: #2196F3;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background 0.2s;
}

.kayit-form button:hover {
    background-color: #1976D2;
}
</style>



<main>
    <?php if (!empty($hata)) { echo $hata; } ?>
    <?php if (empty($basarili)) { ?>
        <form method="POST" action="kayit.php" class="kayit-form">
            <label for="ad">Ad Soyad</label>
            <input type="text" name="adsoyad" id="ad" required>

            <label for="email">E-posta</label>
            <input type="email" name="email" id="email" required>

            <label for="sifre">Şifre</label>
            <input type="password" name="sifre" id="sifre" required>

            <label for="matematik_cevap">Lütfen yandaki işlemi çözünüz: <b><?php echo isset($_SESSION['matematik_soru']) ? $_SESSION['matematik_soru'] : ''; ?></b></label>
            <input type="text" name="matematik_cevap" id="matematik_cevap" required autocomplete="off">

            <button type="submit">Kayıt Ol</button>
        </form>
    <?php } ?>
</main>

<?php include("footer.php"); ?>
