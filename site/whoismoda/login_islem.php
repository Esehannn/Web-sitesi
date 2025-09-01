<?php
session_start();
include("db.php");

$email = $_POST['email'];
$sifre = $_POST['sifre'];

// Alanlar boş mu kontrolü
if (empty($email) || empty($sifre)) {
    echo "<script>alert('E-posta ve şifre boş olamaz!'); window.location.href='kullanici_login.php';</script>";
    exit;
}

// Veritabanında kullanıcıyı ara
$sql = "SELECT * FROM kullanicilar WHERE email = '$email' AND sifre = '$sifre'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    // Giriş başarılı
    $kullanici = $result->fetch_assoc();
    
    $_SESSION['kullanici_id'] = $kullanici['id'];
    $_SESSION['adsoyad'] = $kullanici['adsoyad'];
    $_SESSION['email'] = $kullanici['email'];
    
    echo "<script>alert('Giriş başarılı! Hoş geldin " . $kullanici['adsoyad'] . "'); window.location.href='eticaretsitesi.php';</script>";
} else {
    // Hatalı giriş
    echo "<script>alert('E-posta veya şifre hatalı!'); window.location.href='kullanici_login.php';</script>";
}

$conn->close();
?>
