<?php
require_once __DIR__ . "/../../api.php";
require_once __DIR__ . "/../../src/db_con.php";
require_once __DIR__ . "/../../src/token_check.php";

$leKer = $adatBazis->prepare("
    SELECT *
    FROM felhasznalo
    WHERE id = ?
");
$leKer->execute([$felhasznaloId]);

$felhasznalo = $leKer->fetch(PDO::FETCH_ASSOC);

echo json_encode($felhasznalo);
?>
