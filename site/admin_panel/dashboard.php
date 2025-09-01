
<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .dashboard {
            width: 60%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .logout {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout:hover {
            background: darkred;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="dashboard">
        <h1>Hoş geldin, <?php echo $_SESSION["admin"]; ?>!</h1>
        <p>Buradan yönetim panelini kullanabilirsin.</p>
        <a href="logout.php" class="logout">Çıkış Yap</a>
        
    </div>
</body>
</html>


