<?php
require_once __DIR__ . "/helpers/formazotKi.php";
$config = require_once __DIR__ . "/../config/config.php";
d($config);
$adatBazis = new PDO(
    "mysql:host=" . $config["db_szerver"] . ";dbname=" . $config["db_nev"] . ";charset=utf8",
    $config["db_user"],
    $config["db_jelszo"],
);
?>
