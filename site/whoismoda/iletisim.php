<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WHOISMODA - HOME</title>
    
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/iletisim.css">


</head>
<body>

<?php include("header.php"); ?>

    <section class="iletisim">
        <div class="iletisimarea">
            <div class="iletisimimg">
                <img src="resimler/iletisim1.jpg">
                <h2 class="iletisimcaption">WHOISMODA <br> İLE <br> İLETİŞİME GEÇ </h2>
            </div>
            <p class="iletisimparagraf">
                Whoismoda, moda dünyasında sizlere en trend ürünleri sunan bir e-ticaret platformudur.
                Moda tutkunlarına hitap eden geniş ürün yelpazesi ile Whoismoda, kullanıcılarına kaliteli
                ve şık tasarımları uygun fiyatlarla sunmayı amaçlamaktadır.
                Sizlere benzersiz bir alışveriş deneyimi sunan Whoismoda, güvenilir altyapısı ve
                profesyonel ekibi ile müşteri memnuniyetini her zaman ön planda tutmaktadır.
                Moda dünyasındaki güncel trendleri takip ederek, her zevke uygun ürünleri kolayca bulabileceğiniz bir platform sunmaktadır.
                <br>
                <br>
    
                Whoismoda ile iletişime geçmek, ürünlerimiz veya hizmetlerimiz hakkında daha fazla bilgi almak,
                önerilerde bulunmak veya sorularınızı sormak için bize aşağıdaki iletişim bilgilerinden ulaşabilirsiniz.
                Siz değerli müşterilerimizle güçlü bir iletişim kurmayı ve modayı birlikte keşfetmeyi dört gözle bekliyoruz.
                <br>
               <br>
                İletişim Bilgileri:
                <br>
                - Telefon: [Telefon Numarası]
                <br>
                - E-posta: [E-posta Adresi]
                <br>
                - Adres: [Fiziksel Adres]
                <br>
                <br>

    
                Whoismoda ekibi olarak, sizlere moda dünyasındaki en iyi deneyimi sunmak için buradayız.
                Bizi tercih ettiğiniz için teşekkür eder, keyifli alışverişler dileriz.
            </p>
        </div>
    </section>
    <section id="mainSlideriletisim" class="slider">
        <div id="mainCaption" class="captioniletişim">
            <h1>GÜVENİLİR VE UCUZ GİYİMİN ADRESİ</h1>
        <p>Whoismoda ile kendinize en yakışan kıyafeti alın</p>
        </div>
        
    </section>

    <!-- Adres bölümü en alta taşındı -->
    <section class="iletisim-alani">
        <div class="iletisim-resim">
            <p class="iletisim-paragraf">
                Whoismoda, moda dünyasında sizlere en trend ürünleri sunan bir e-ticaret platformudur.
                Moda tutkunlarına hitap eden geniş ürün yelpazesi ile Whoismoda, kullanıcılarına kaliteli
                ve şık tasarımları uygun fiyatlarla sunmayı amaçlamaktadır.
                Sizlere benzersiz bir alışveriş deneyimi sunan Whoismoda, güvenilir altyapısı ve
                profesyonel ekibi ile müşteri memnuniyetini her zaman ön planda tutmaktadır.
                Moda dünyasındaki güncel trendleri takip ederek, her zevke uygun ürünleri kolayca bulabileceğiniz bir platform sunmaktadır.
                <br>
                <br>
        
                Whoismoda ile iletişime geçmek, ürünlerimiz veya hizmetlerimiz hakkında daha fazla bilgi almak,
                önerilerde bulunmak veya sorularınızı sormak için bize aşağıdaki iletişim bilgilerinden ulaşabilirsiniz.
                Siz değerli müşterilerimizle güçlü bir iletişim kurmayı ve modayı birlikte keşfetmeyi dört gözle bekliyoruz.
                <br>
               <br>
                İletişim Bilgileri:
                <br>
                - Telefon: [Telefon Numarası]
                <br>
                - E-posta: [E-posta Adresi]
                <br>
                - Adres: [Fiziksel Adres]
                <br>
                <br>
        
                Whoismoda ekibi olarak, sizlere moda dünyasındaki en iyi deneyimi sunmak için buradayız.
                Bizi tercih ettiğiniz için teşekkür eder, keyifli alışverişler dileriz.
            </p>
            <img src="resimler/iletisim 3.jpg">
            <h2 class="iletisim-baslik">WHOISMODA <br> İLE <br> BAĞLARINI <br> KOPARMA </h2>
        </div>
       
    </section>
    



    <!-- Mesaj Gönderme Formu (Daha alt kısımda) -->


    <section class="adres-section">
        <h2>Adresimiz</h2>
        <div class="adres-map-container">
            <iframe src="https://www.google.com/maps?q=Ankara&output=embed" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- Mesaj Gönderme Formu (Daha alt kısımda) -->
    <section class="mesaj-section" style="margin: 40px 0 60px 0;">
        <h2>Bize Mesaj Gönderin</h2>
        <?php
        if (isset($_POST['mesaj_gonder'])) {
            include_once "db.php";
            $ad = mysqli_real_escape_string($conn, $_POST['ad'] ?? '');
            $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
            $mesaj = mysqli_real_escape_string($conn, $_POST['mesaj'] ?? '');
            $hata = '';
            if (empty($ad) || empty($email) || empty($mesaj)) {
                $hata = 'Lütfen tüm alanları doldurunuz.';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $hata = 'Geçerli bir e-posta adresi giriniz.';
            }
            if ($hata) {
                echo '<div style="color:red;">'.$hata.'</div>';
            } else {
                $sql = "INSERT INTO mesajlar (ad, email, mesaj, tarih) VALUES ('$ad', '$email', '$mesaj', NOW())";
                if (mysqli_query($conn, $sql)) {
                    echo '<div style="color:green;">Mesajınız başarıyla gönderildi.</div>';
                } else {
                    echo '<div style="color:red;">Bir hata oluştu. Lütfen tekrar deneyin.</div>';
                }
            }
        }
        ?>
        <form method="POST" style="max-width:400px;margin:auto;display:flex;flex-direction:column;gap:10px;">
            <input type="text" name="ad" placeholder="Adınız Soyadınız" required>
            <input type="email" name="email" placeholder="E-posta Adresiniz" required>
            <textarea name="mesaj" placeholder="Mesajınız" rows="4" required></textarea>
            <button type="submit" name="mesaj_gonder" style="background:#222;color:#fff;padding:10px 0;border:none;cursor:pointer;">Gönder</button>
        </form>
    </section>

    <?php include("footer.php"); ?>

  
</body>
</html>