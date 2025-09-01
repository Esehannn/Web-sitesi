<?php
include "db.php"; // Veritabanı bağlantısını dahil et

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<h2>".$row["title"]."</h2>";
    echo "<p>".$row["content"]."</p>";
    echo "<hr>";
}
?>