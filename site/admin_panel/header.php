<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="css/header.css">
<div class="navbar">
    <a href="dashboard.php">Ana Sayfa</a>
    <a href="urun_ekle.php">Ürün Ekle</a>
    <a href="urunler.php">Ürünleri Listele</a>
    <a href="sepetler.php">Sepetler</a>
    <a href="musteriler.php">Müsteriler</a>
    <a href="logout.php">Çıkış Yap</a>
</div>
