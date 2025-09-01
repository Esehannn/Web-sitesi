
<?php
include 'header.php';
include '../whoismoda/db.php';

// Silme işlemi
if (isset($_GET['sil'])) {
    $sil_id = intval($_GET['sil']);
    mysqli_query($conn, "DELETE FROM mesajlar WHERE id=$sil_id");
    header('Location: mesajlar.php');
    exit;
}

// Mesajları çek
$mesajlar = mysqli_query($conn, "SELECT * FROM mesajlar ORDER BY tarih DESC");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mesajlar</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mesajlar.css">
</head>
<body>
    <h1>Gelen Mesajlar</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>E-posta</th>
            <th>Mesaj</th>
            <th>Tarih</th>
            <th>İşlemler</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($mesajlar)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['ad']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['mesaj'])); ?></td>
            <td><?php echo $row['tarih']; ?></td>
            <td>
                <a href="mesaj_duzenle.php?id=<?php echo $row['id']; ?>" class="btn btn-duzenle">Düzenle</a>
                <a href="mesajlar.php?sil=<?php echo $row['id']; ?>" class="btn btn-sil" onclick="return confirm('Mesajı silmek istediğinize emin misiniz?');">Sil</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
