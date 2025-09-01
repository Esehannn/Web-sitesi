<?php
// Oturumu başlatır veya mevcut oturumu devam ettirir.
session_start(); 
// Veritabanı bağlantısı dosyasını dahil eder.
include("db.php");

// Eğer POST ile 'urun_id' ve 'adet' bilgileri geldiyse ve kullanıcı oturum açmışsa (kullanici_id session'da varsa)
if (isset($_POST['urun_id']) && isset($_POST['adet']) && isset($_SESSION['kullanici_id'])) {
    // POST ile gelen ürün ID'sini tamsayıya çevirir.
    $urun_id = intval($_POST['urun_id']); 
    // POST ile gelen adet bilgisini tamsayıya çevirir.
    $adet = intval($_POST['adet']); 
    // Oturumdan kullanıcı ID'sini alır.
    $kullanici_id = $_SESSION['kullanici_id']; 

    // Sepette ilgili kullanıcıya ait bu ürünün daha önce eklenip eklenmediğini kontrol eder.
    // NOT: Bu sorgu, SQL Enjeksiyonuna karşı savunmasızdır. Hazırlanmış ifadeler (prepared statements) kullanılması şiddetle önerilir.
    $kontrol = mysqli_query($conn, "SELECT * FROM sepet WHERE kullanici_id='$kullanici_id' AND urun_id='$urun_id'");
    
    // Eğer ürün sepette zaten varsa
    if (mysqli_num_rows($kontrol) > 0) {
        // Ürünün adedini günceller (mevcut adede yenisini ekler).
        // NOT: Bu sorgu da SQL Enjeksiyonuna karşı savunmasızdır.
        mysqli_query($conn, "UPDATE sepet SET adet = adet + $adet WHERE kullanici_id='$kullanici_id' AND urun_id='$urun_id'");
    } else {
        // Eğer ürün sepette yoksa, yeni bir kayıt olarak ekler.
        // NOT: Bu sorgu da SQL Enjeksiyonuna karşı savunmasızdır.
        mysqli_query($conn, "INSERT INTO sepet (kullanici_id, urun_id, adet) VALUES ('$kullanici_id', '$urun_id', '$adet')");
    }

    // Kullanıcının güncel sepet içeriğini ve toplam adeti çekmek için sorgu.
    // 'sepet' tablosu ile 'urunler' tablosunu birleştirerek ürün adı ve fiyatını da alır.
    // NOT: Bu sorgu da SQL Enjeksiyonuna karşı savunmasızdır.
    $sepet_sorgu = mysqli_query($conn, "
        SELECT s.adet, u.ad, u.fiyat 
        FROM sepet s 
        JOIN urunler u ON s.urun_id = u.id 
        WHERE s.kullanici_id='$kullanici_id'
    ");

    $urunler = []; // Sepetteki ürünleri depolamak için boş dizi.
    $toplam_adet = 0; // Toplam ürün adedini tutmak için sayaç.

    // Sorgu sonucundaki her bir satırı döngüyle işler.
    while ($row = mysqli_fetch_assoc($sepet_sorgu)) {
        // Ürün bilgilerini (ad, adet, fiyat) diziye ekler.
        $urunler[] = [
            'ad' => $row['ad'],
            'adet' => $row['adet'],
            'fiyat' => $row['fiyat']
        ];
        // Toplam adedi günceller.
        $toplam_adet += $row['adet']; 
    }

    // Başarılı bir yanıtı JSON formatında geri döndürür.
    // 'success' durumu, toplam ürün adedi ve güncel ürün listesi bu yanıtta bulunur.
    echo json_encode(['success' => true, 'toplam_adet' => $toplam_adet, 'urunler' => $urunler]); 
}
?>