<?php
include "db.php"; // veritabanı bağlantısı
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WHOISMODA - HOME</title>
    
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/hakkimizda.css">

</head>
<body>

<?php include("header.php"); ?>

    <section class="hakkimizda">
        <section class="hakkimizdasol1">
            <img src="resimler/1.jpg" class="hakkimizdaimgsol1" alt="Resim 1">
            <div class="text-container1">
                <h2>HAZİRAN 2023'DE KURULDUK</h2>
                <br>
                <p>2023'ün yaz aylarında faaliyete geçtik.Büyük bir <br> kararlılıkla yaz aylarında <br> büyük bir cesaretle kurulduk.</p>
            </div>
        </section>
    
        <section class="hakkimizdasag1">
            <img src="resimler/2.jpg" class="hakkimizdaimgsag1" alt="Resim 2">
            <div class="text-container2">
                <h2>AĞUSTOS AYINDA SOSYAL MEDYA</h2>
                <br>
                <p>Ağustos aylarında tüm sosyal medya hesaplarımızı <br> faaliyete geçirdik.</p>
            </div>
        </section>
    
        <section class="hakkimizdasol2">
            <img src="resimler/3.jpg" class="hakkimizdaimgsol2" alt="Resim 3">
            <div class="text-container3">
                <h2>5 KİŞİLİK DEV KADRO</h2>
                <br>
                <p>1 CEO , 1 satış danışmanımız ve 3 tane ofis çalışanımızla <br> hizmetinizdeyiz</p>
            </div>
        </section>
    
        <section class="hakkimizdasag2">
            <img src="resimler/4.jpg" class="hakkimizdaimgsag2" alt="Resim 4">
            <div class="text-container4">
                <h2>7/24 HİZMET</h2>
                <br>
                <p>Haftanın her günü ve günün her saati <br> hizmetinizdeyiz.</p>
            </div>
        </section>
    </section>
    <?php include("footer.php"); ?>
   
  
</body>
</html>