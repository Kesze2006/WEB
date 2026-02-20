<?php
$config = include_once "config.php";
$adatBazis = new PDO("mysql:host=" . $host . ";dbname=" . $db . ";charset=utf8", $user, $password);
?>
