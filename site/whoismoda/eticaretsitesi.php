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
    <link rel="stylesheet" type="text/css" href="css/eticaretsitesi.css">
    

</head>


<?php include("header.php"); ?>

<body>



    <section id="mainSlider" class="slider">
        <div id="mainCaption" class="caption">
            
            <h1>GÜVENİLİR VE UCUZ GİYİMİN ADRESİ</h1>
        <p>Whoismoda ile kendinize en yakışan kıyafeti alın</p>
        
        </div>
        
        
    </section>

    <section id="Sezon" class="sectionArea">
        <h1 style="text-align:center; margin-bottom: 10px;">Kampanyalı Ürünler</h1>
        <div class="SezonTop"> <h2 class="sectionHeader"> Sezon Ürünleri </h2>   
        </div>
        <div class="SezonBody">
            <div class="container">
                <div class="col3">
                    <div class="item">
                        <div class="zoom">
                            <img src="resimler\Tablo görsel 1.jpg ">

                        </div>
                        <div class="itemText">
                            <h3>Sezonun En Şık Kombinleri</h3>
                            <p>Whoismoda ile sezonun en şık kombinlerini yapın. Hemde en kaliteli ürünlerle en uyguna </p>
                            <a href="#" class="detaylar">Daha fazla detay</a>
                        </div>
                    </div>
                </div>
                <div class="col3">
                    <div class="item">
                        <div class="zoom">
                            <img src="resimler\tablo görsel 2.jpg ">

                        </div>
                        <div class="itemText">
                            <h3>Sezonun En Şık Kombinleri</h3>
                            <p>Whoismoda ile sezonun en şık kombinlerini yapın. Hemde en kaliteli ürünlerle en uyguna.</p>
                            <a href="#" class="detaylar">Daha fazla detay</a>
                        </div>
                    </div>
                </div>
                <div class="col3">
                    <div class="item">
                        <div class="zoom">
                            <img src="resimler\Tablo görsel 2.jpg ">

                        </div>
                        <div class="itemText">
                            <h3>Sezonun En Şık Kombinleri</h3>
                            <p>Whoismoda ile sezonun en şık kombinlerini yapın. Hemde en kaliteli ürünlerle en uyguna.</p>
                            <a href="#" class="detaylar">Daha fazla detay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="parallax" class="sectionArea">
        <div class="parallaxTop">
            <h2 class="sectionHeader"> Whoismoda'ya Hoşgeldiniz </h2>
        </div>
    </section>
    <section id="platformlar" class="sectionArea">
        <div class="platformlarTop">
            <h2 class="sectionHeader">Aktif Satış Yaptığımız Platfromlar</h2>
            <div class="platformBody">
                <div class="container">
                    <div class="col2">
                        <div class="platformlarcontainer">
                            <img src="resimler\trendyol platform.jpg" class="imageOver">
                            <div class="platformlarOverlay">
                                <div class="platformlarText">
                                    <h3>Trendyol</h3>
                                    <p>En yeni ve trend ürünleri burada bulabilirsiniz.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="platformlarcontainer">
                            <img src="resimler\amazon platform.jpg" class="imageOver">
                            <div class="platformlarOverlay">
                                <div class="platformlarText">
                                    <h3>Amazon</h3>
                                    <p>Dünya genelinde alışverişin keyfini Amazon ile çıkarın.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="platformlarcontainer">
                            <img src="resimler\hepsiburada.jpg" class="imageOver">
                            <div class="platformlarOverlay">
                                <div class="platformlarText">
                                    <h3>Hepsiburada</h3>
                                    <p>Bütün ürünlerin Hepsiburada</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="platformlarcontainer">
                            <img src="resimler\n11.jpg" class="imageOver">
                            <div class="platformlarOverlay">
                                <div class="platformlarText">
                                    <h3>n11</h3>
                                    <p>Yenilenen yüzü ile getir bir n11.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include("footer.php"); ?>

  
</body>
</html>