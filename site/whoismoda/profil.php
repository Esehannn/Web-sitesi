<style> 

/* PROFİL SAYFASINDAKİ ANA KUTU STİLİNİ TANIMLAR */
.profil-container {
    max-width: 600px;
    margin: 100px auto;
    background: linear-gradient(135deg, #43cea2, #185a9d); /* Gradyan geçişli arka plan */
    padding: 50px 40px;
    border-radius: 20px; /* Köşe yumuşatma */
    box-shadow: 0 20px 50px rgba(0,0,0,0.3); /* Derinlik ve gölge efekti */
    color: #fff;
    text-align: center;
    transition: all 0.3s ease; /* Hover animasyonu için yumuşak geçiş */
}

.profil-container:hover {
    transform: translateY(-5px); /* Hover’da kutuyu hafifçe yukarı kaldırır */
    box-shadow: 0 30px 60px rgba(0,0,0,0.4); /* Hover’da gölgeyi artırır */
}

.profil-container h2 {
    color:rgb(255, 255, 255);
    font-size: 28px;
    margin-bottom: 30px;
    letter-spacing: 1px;
}

.profil-container p {
    font-size: 18px;
    margin: 15px 0;
    background-color: rgba(255,255,255,0.2); /* Arka planı yarı saydam yapar */
    padding: 12px 20px;
    border-radius: 10px;
    backdrop-filter: blur(3px); /* Hafif arka plan bulanıklığı efekti */
    color:rgb(3, 44, 54);
    font-weight: bold;
    border: 1px solid rgba(255, 255, 255, 0.5); /* Yarı saydam kenarlık */
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7); /* Yazıya gölge efekti */
}

.profil-container a {
    display: inline-block;
    margin-top: 25px;
    padding: 12px 25px;
    background-color: #ff5e57;
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s ease; /* Hover’da geçiş animasyonu */
}

.profil-container a:hover {
    background-color: #ff2e20;
    transform: translateY(-2px); /* Hover’da buton yukarı çıkar */
}

</style>


<?php
session_start();

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: kullanici_login.php"); // Giriş yapmayanları geri at
    exit;
}

$adsoyad = isset($_SESSION["adsoyad"]) ? $_SESSION["adsoyad"] : "Bilinmiyor";
$email   = isset($_SESSION["email"]) ? $_SESSION["email"] : "Bilinmiyor";
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Profil - WhoisModa</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        .profil-container {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .profil-container h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .profil-container p {
            font-size: 16px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<?php include("header.php"); ?>

<div class="profil-container">
    <h2>Merhaba, <?php echo $adsoyad; ?>!</h2>
    <p><strong>Ad Soyad:</strong> <?php echo $adsoyad; ?></p>
    <p><strong>E-Posta:</strong> <?php echo $email; ?></p>

    <a href="logout.php">Çıkış Yap</a>
</div>

<?php include("footer.php"); ?>

</body>
</html>
