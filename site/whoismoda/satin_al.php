<?php
// Oturumu başlatır veya mevcut oturumu devam ettirir.
session_start();
// Veritabanı bağlantısı dosyasını dahil eder.
include("db.php");

// Kullanıcının oturum açıp açmadığını kontrol eder.
// Eğer oturum açmamışsa, 'giris.php' sayfasına yönlendirir ve scripti durdurur.
if(!isset($_SESSION['kullanici_id'])){
    header("Location: giris.php");
    exit();
}

// Oturumdan kullanıcı ID'sini alır.
$kullanici_id = $_SESSION['kullanici_id'];

// Kullanıcının sepetindeki ürünleri veritabanından çeker.
$sepet_sorgu = mysqli_query($conn, "SELECT * FROM sepet WHERE kullanici_id = $kullanici_id");

// Eğer sepet boşsa, kullanıcıya mesaj gösterir ve scripti durdurur.
if(mysqli_num_rows($sepet_sorgu) == 0){
    echo "Sepetiniz boş!";
    exit();
}

// Toplam sipariş tutarını ve sepetteki ürün detaylarını tutacak değişkenleri başlatır.
$toplam_tutar = 0;
$sepet_urunler = [];

// Sepetteki her bir ürünü döngüyle işler.
while($row = mysqli_fetch_assoc($sepet_sorgu)){
    $urun_id = $row['urun_id'];
    $adet = $row['adet'];

    // Her ürünün detaylarını (özellikle fiyatını) 'urunler' tablosundan çeker.
    $urun_sorgu = mysqli_query($conn, "SELECT * FROM urunler WHERE id = $urun_id");
    $urun = mysqli_fetch_assoc($urun_sorgu);
    
    $birim_fiyat = $urun['fiyat']; // Ürünün birim fiyatını alır.
    $toplam_tutar += $birim_fiyat * $adet; // Toplam tutara bu ürünün maliyetini ekler.

    // İşlem kolaylığı için ürün detaylarını bir diziye ekler.
    $sepet_urunler[] = [
        'urun_id' => $urun_id,
        'adet' => $adet,
        'birim_fiyat' => $birim_fiyat
    ];
}

// Yeni bir sipariş kaydı oluşturur.
// 'siparisler' tablonun olmadığına dair veritabanı dökümünde bir bilgi yok, varsayılan olarak var kabul edilmiştir.
mysqli_query($conn, "INSERT INTO siparisler (kullanici_id, toplam_tutar) VALUES ($kullanici_id, $toplam_tutar)");

// Oluşturulan siparişin ID'sini alır.
$siparis_id = mysqli_insert_id($conn);

// Her bir sepet ürünü için sipariş detaylarını kaydeder.
foreach($sepet_urunler as $item){
    $urun_id = $item['urun_id'];
    $adet = $item['adet'];
    $birim_fiyat = $item['birim_fiyat'];
    mysqli_query($conn, "INSERT INTO siparis_detay (siparis_id, urun_id, adet, birim_fiyat) VALUES ($siparis_id, $urun_id, $adet, $birim_fiyat)");
}

// Sipariş başarıyla oluşturulduktan sonra kullanıcının sepetini temizler.
mysqli_query($conn, "DELETE FROM sepet WHERE kullanici_id = $kullanici_id");

// Kullanıcıya siparişin başarıyla oluşturulduğunu bildirir.
echo "Siparişiniz başarıyla oluşturuldu!";
// Kullanıcıyı Online Mağaza sayfasına geri dönmesi için link sunar.
echo '<br><a href="Onlınemagaza.php">Mağazaya dön</a>';

?>