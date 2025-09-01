<div class="navbar">
    <a href="login.php">Admin Giriş</a>
</div>

<?php
session_start();
include "db.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password == $user["password"]) {
        $_SESSION["admin"] = $user["username"];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Hatalı giriş!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Giriş</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Giriş</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>
        <a href="../whoismoda/eticaretsitesi.php" class="siteye-don-btn">Siteye Dön</a>
    </div>
</body>
</html>


