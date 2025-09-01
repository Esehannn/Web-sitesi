<?php
$servername = "localhost";
$username = "root";       // Varsayılan MySQL kullanıcısı
$password = "";           // Şifre boş (Eğer şifre koyduysan buraya ekle)
$dbname = "admin_panel";
$port = 3307;             // MySQL portun

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
