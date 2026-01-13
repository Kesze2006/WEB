<?php
require_once __DIR__ . "/helpers/formazotKi.php";
$config = require_once __DIR__ . "/../config/config.php";
try {
    $adatBazis =
        new PDO(
            "mysql:host=" . $config["db_szerver"] . ";dbname=" . $config["db_nev"] . ";charset=utf8",
            $config["db_user"],
            $config["db_jelszo"],
        ) ?? "";
} catch (PDOException $e) {
    /*$fajl = fopen(__DIR__ . "/../logs/error.log", "a");
    fwrite($fajl, "\n[" . date("Y-m-d H:i:s") . "] " . $e->getMessage());
    fclose($fajl);
    */
    echo json_encode(["error" => "Nem lehet kapcsolódni az adatbázishoz!"], JSON_UNESCAPED_UNICODE);
}

?>
