<?php
// Oturum başlatılmamışsa başlatır. Bu, session değişkenlerini kullanmak için gereklidir.
if (session_status() == PHP_SESSION_NONE) { session_start(); }
// Veritabanı bağlantısı dosyasını dahil eder. Yolun doğru olduğundan emin olun.
include_once("db.php"); 
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>WhoisModa</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
  <div class="container-header">

    <div class="logo">
      <a href="eticaretsitesi.php"> <img src="resimler/logo ana2.png" alt="Logo"> </a>
    </div>

    <div class="uyelik-butonlari">
      <?php 
      // Kullanıcının oturum açıp açmadığını kontrol eder.
      // Eğer 'kullanici_id' session değişkeni ayarlıysa (yani kullanıcı giriş yapmışsa)...
      if (isset($_SESSION['kullanici_id'])): ?>
          <?php
              $kullanici_id = $_SESSION['kullanici_id'];
              // Veritabanından kullanıcının adsoyad bilgisini çeker.
              $sorgu = mysqli_query($conn, "SELECT adsoyad FROM kullanicilar WHERE id = $kullanici_id");
              $kullanici = mysqli_fetch_assoc($sorgu);
              // Eğer adsoyad bulunamazsa 'Profil' olarak ayarlar
              $adsoyad = $kullanici['adsoyad'] ?? 'Profil';
              // Session'da adsoyad bilgisini günceller/ayarlar (eğer henüz ayarlanmadıysa veya değiştiyse).
              $_SESSION['adsoyad'] = $adsoyad;
          ?>
          <a href="profil.php" class="header-profil-link"> <span class="hosgeldin-kutu-header">
              <?php echo htmlspecialchars($adsoyad); ?> </span>
          </a>
          <a href="logout.php" class="giris-btn">Çıkış Yap</a> <?php else: // Kullanıcı oturum açmamışsa... ?>
          <a href="kayit.php" class="kayit-btn">Kayıt Ol</a> <a href="kullanici_login.php" class="giris-btn">Giriş Yap</a> <?php endif; ?>
    </div>

    <nav class="menu">
      <ul>
        <li><a href="eticaretsitesi.php">Anasayfa</a></li> <li><a href="Onlınemagaza.php">Online Mağaza</a></li> <li><a href="nedir.php">E-Ticaret Nedir</a></li> <li><a href="hakkımızda.php">Hakkımızda</a></li> <li><a href="iletisim.php">İletişim</a></li> </ul>
    </nav>

  </div>
  <div class="header-divider"></div> </header>

<main>