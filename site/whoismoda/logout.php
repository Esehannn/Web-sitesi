<?php
session_start();
session_destroy();
header("Location: eticaretsitesi.php");
exit;
?>