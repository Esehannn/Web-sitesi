

<?php include("db.php"); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Online Mağaza</title>

    <!-- CSS Dosyaları -->
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/Onlınemagaza.css">
    
</head>

<?php include("header.php"); ?>

<body>

    <!-- Banner -->
    <section id="onlıneSlider" class="onlıneslider">
        <div id="onlıneCaption" class="onlınecaption">
            <h1>TEK TIKLA HEMEN KAPINDA</h1>
            <p>Whoismoda ile kolay alışveriş</p>
        </div>
    </section>

    <!-- Erkek Ürünleri -->
    <h2 class="kategoriBaslik">Erkek Giyim Ürünleri</h2>
    <div class="containerMagaza">
        <?php
        $sql = "SELECT * FROM urunler WHERE kategori = 'erkek'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($urun = $result->fetch_assoc()) {
                echo '<div class="urun">';
                echo '<img src="'.$urun["resim"].'" alt="'.$urun["ad"].'">';
                echo '<h3>'.$urun["ad"].'</h3>';
                echo '<p>'.$urun["aciklama"].'</p>';
                echo '<p class="urunFiyat">'.$urun["fiyat"].' TL</p>';
                echo '<form action="sepete_ekle.php" method="POST">
    <input type="hidden" name="urun_id" value="'.$urun['id'].'">
    <input type="number" name="adet" value="1" min="1" style="width:50px;">
    <button type="submit" class="satinalBtn">Sepete Ekle</button>
</form>
';
                echo '</div>';
            }
        } else {
            echo "<p>Erkek ürün bulunamadı.</p>";
        }
        ?>
    </div>

    <!-- Kadın Ürünleri -->
    <h2 class="kategoriBaslik">Kadın Giyim Ürünleri</h2>
    <div class="containerMagaza">
        <?php
        $sql = "SELECT * FROM urunler WHERE kategori = 'kadin'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($urun = $result->fetch_assoc()) {
                echo '<div class="urun">';
                echo '<img src="'.$urun["resim"].'" alt="'.$urun["ad"].'">';
                echo '<h3>'.$urun["ad"].'</h3>';
                echo '<p>'.$urun["aciklama"].'</p>';
                echo '<p class="urunFiyat">'.$urun["fiyat"].' TL</p>';
                echo '<button class="satinalBtn sepeteEkleBtn" 
                     data-id="'.$urun["id"].'" 
                     data-ad="'.$urun["ad"].'" 
                     data-fiyat="'.$urun["fiyat"].'">Sepete Ekle</button>';
                echo '</div>';
            }
        } else {
            echo "<p>Kadın ürün bulunamadı.</p>";
        }
        ?>
    </div>

    <!-- Çocuk Ürünleri -->
    <h2 class="kategoriBaslik">Çocuk Giyim Ürünleri</h2>
    <div class="containerMagaza">
        <?php
        $sql = "SELECT * FROM urunler WHERE kategori = 'cocuk'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($urun = $result->fetch_assoc()) {
                echo '<div class="urun">';
                echo '<img src="'.$urun["resim"].'" alt="'.$urun["ad"].'">';
                echo '<h3>'.$urun["ad"].'</h3>';
                echo '<p>'.$urun["aciklama"].'</p>';
                echo '<p class="urunFiyat">'.$urun["fiyat"].' TL</p>';
                echo '<button class="satinalBtn sepeteEkleBtn" 
                     data-id="'.$urun["id"].'" 
                     data-ad="'.$urun["ad"].'" 
                     data-fiyat="'.$urun["fiyat"].'">Sepete Ekle</button>';
                echo '</div>';
            }
        } else {
            echo "<p>Çocuk ürün bulunamadı.</p>";
        }
        ?>
    </div>

    <!-- Sepet Alanı -->
    <section>
  <div class="sepet-container">
    <!-- Sepet ikonu: TIKLANINCA açılacak -->
    <div class="sepet-icon" id="sepetIcon">
      <img src="resimler/sepet.png" alt="Sepet İkonu">
      <?php
      if (isset($_SESSION['kullanici_id'])) {
          $kullanici_id = $_SESSION['kullanici_id'];
          $sepet_sorgu = mysqli_query($conn, "SELECT SUM(adet) AS toplam_adet FROM sepet WHERE kullanici_id='$kullanici_id'");
          $sepet_sonuc = mysqli_fetch_assoc($sepet_sorgu);
          $sepet_adet = $sepet_sonuc['toplam_adet'] ?? 0;
      } else {
          $sepet_adet = 0;
      }
      ?>
      <span class="sepet-count"><?php echo $sepet_adet; ?></span>
    </div>
    <!-- Sepet listesi: başta gizli, aktif class gelince görünür -->
    <div class="sepet-listesi" id="sepetListesi">
      <h3>Sepetim</h3>
      <ul class="sepet-urunler"></ul>
      <form action="satin_al.php" method="post" id="satinAlForm">
        <button type="submit" class="satinalBtn">Satın Al</button>
      </form>
    </div>
  </div>
</section>


    <?php include("footer.php"); ?>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // --- SEPET TIKLA-AÇ/KAPA ---
    var sepetIcon = document.getElementById('sepetIcon');
    var sepetContainer = document.querySelector('.sepet-container');
    var sepetListesiDiv = document.getElementById('sepetListesi');

    sepetIcon.addEventListener('click', function(e) {
        e.stopPropagation(); // Başka event tetiklenmesin
        sepetContainer.classList.toggle('active');
    });

    // Sepetin içi tıklanınca kapanmasın
    sepetListesiDiv.addEventListener('click', function(e){
        e.stopPropagation();
    });

    // Sayfada başka yere tıklanınca sepeti kapat
    document.addEventListener('click', function() {
        if (sepetContainer.classList.contains('active')) {
            sepetContainer.classList.remove('active');
        }
    });

    // --- SEPETE EKLEME AJAX ---
    let formlar = document.querySelectorAll('form'); 

    // PHP'den oturum bilgisini alın
    var kullaniciGirisYapti = <?php echo isset($_SESSION['kullanici_id']) ? 'true' : 'false'; ?>;

    formlar.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Satın Al formuna engel olma!
            if(form.getAttribute('id') !== 'satinAlForm'){
                if(!kullaniciGirisYapti){
                    e.preventDefault();
                    alert('Lütfen giriş yapınız.');
                    return;
                }
                e.preventDefault(); 

                let formData = new FormData(this); 

                fetch('sepete_ekle.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Sepet sayacını güncelle
                        document.querySelector('.sepet-count').textContent = data.toplam_adet;

                        // Sepet ürünlerini güncelle
                        let sepetListesi = document.querySelector('.sepet-urunler');
                        sepetListesi.innerHTML = ""; // Önce temizle

                        let toplamTutar = 0;

                        data.urunler.forEach(item => {
                            toplamTutar += item.fiyat * item.adet;
                            let li = document.createElement('li');
                            li.innerHTML = `<span>${item.ad} (${item.adet} adet)</span> 
                                            <span>${(item.fiyat * item.adet).toFixed(2)} TL</span>`;
                            sepetListesi.appendChild(li);
                        });

                        // Toplam tutar göster
                        let toplamLi = document.createElement('li');
                        toplamLi.innerHTML = `<strong>Toplam Tutar:</strong> <span>${toplamTutar.toFixed(2)} TL</span>`;
                        sepetListesi.appendChild(toplamLi);
                    }
                });
            }
        });
    });
});
</script>



</body>
</html>
