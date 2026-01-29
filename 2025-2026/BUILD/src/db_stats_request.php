<?php
require_once __DIR__ . "/db_con.php";
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/helpers/szerepDb.php";

$diakDb = szerepDb($adatBazis, "diak");
$tanarDb = szerepDb($adatBazis, "tanar");

echo json_encode(["success" => "Sikeres kapcsolat", "tanarDb" => $tanarDb, "diakDb" => $diakDb]);
?>
