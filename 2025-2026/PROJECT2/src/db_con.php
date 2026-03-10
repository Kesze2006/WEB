<?php
require_once __DIR__ . "/helpers/formazotKi.php";
require_once __DIR__ . "/helpers/errorLog.php";
$config = require_once __DIR__ . "/../config/config.php";

try {
    $adatBazis = new PDO(
        "mysql:host=" . $config["db_szerver"] . ";dbname=" . $config["db_nev"] . ";charset=utf8",
        $config["db_user"],
        $config["db_jelszo"],
    );
} catch (PDOException $e) {
    errorLog($e);
    echo json_encode(["error" => "Nem lehet kapcsolódni az adatbázishoz!"], JSON_UNESCAPED_UNICODE);
    exit();
}

?>
