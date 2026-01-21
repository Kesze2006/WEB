<?php
require_once __DIR__ . "/db_con.php";
require_once __DIR__ . "/helpers/formazotKi.php";

$headers = getallheaders();
$token = $headers["Authorization"] ?? null;

if (!$token) {
    echo json_encode(["error" => "Token hiányzik"]);
} else {
    $check = $adatBazis->prepare("SELECT id 
    FROM felhasznalo
    WHERE email_token = ?
      AND email_token_lejarat > NOW()
      AND email_megerositve = 0
");
    $check->execute([$token]);
    $tabla = $check->fetch(PDO::FETCH_ASSOC);
    $felhasznaloId = $tabla["id"];
}
?>
