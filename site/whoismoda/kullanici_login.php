<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Giriş Yap - WhoisModa</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 400px;
            margin: 80px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 30px;
            color: #333;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .login-container button {
            background: linear-gradient(135deg, #43cea2, #185a9d);
            color: #fff;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-container button:hover {
            background: linear-gradient(135deg, #185a9d, #43cea2);
        }
        .login-container p {
            margin-top: 15px;
            font-size: 14px;
        }
        .login-container a {
            color: #185a9d;
            text-decoration: none;
        }
        .admin-giris-btn {
    display: block;
    margin-top: 18px;
    background: linear-gradient(135deg,rgb(0, 110, 255),rgb(255, 255, 255));
    color: #fff;
    padding: 10px 0;
    border-radius: 8px;
    text-align: center;
    font-weight: bold;
    font-size: 15px;
    text-decoration: none;
    transition: background 0.3s;
}
.admin-giris-btn:hover {
    background: linear-gradient(135deg,rgb(0, 68, 255),rgb(255, 255, 255));
}

    </style>
</head>
<body>
<?php include("header.php"); ?>
    <div class="login-container">
        <h2>Kullanıcı Giriş Yap</h2>
        <form action="login_islem.php" method="POST">
            <input type="email" name="email" placeholder="E-Posta Adresi" required>
            <input type="password" name="sifre" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>
        <a href="../admin_panel/login.php" class="admin-giris-btn">Admin Girişi Yap</a>
        <p>Hesabınız yok mu? <a href="kayit.php">Kayıt Ol</a></p>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
