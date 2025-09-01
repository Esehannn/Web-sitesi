<?php
session_start();
include "../whoismoda/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ürünün resim dosyasını silmek için önce çekiyoruz
    $result = $conn->query("SELECT resim FROM urunler WHERE id = $id");
    $urun = $result->fetch_assoc();

    // Veritabanından ürünü sil
    $sql = "DELETE FROM urunler WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Resmi dizinden de siliyoruz
        if (file_exists("../whoismoda/" . $urun['resim'])) {
            unlink("../whoismoda/" . $urun['resim']);
        }

        echo "Ürün başarıyla silindi.";
    } else {
        echo "Silme işlemi başarısız oldu.";
    }
}

header("Location: urunler.php");
exit;
?>
