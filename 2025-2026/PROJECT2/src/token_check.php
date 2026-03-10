<?php
require_once __DIR__ . "/db_con.php";
require_once __DIR__ . "/helpers/formazotKi.php";

$headers = getallheaders();
$token = $headers["Authorization"] ?? null;

if (!$token) {
    echo json_encode(["error" => "Token hiányzik"]);
} else {
    $check = $adatBazis->prepare("SELECT id, felhasznalo_id
    FROM session
    WHERE token = ?
      AND lejarat > NOW()
      AND kilepes = FALSE
");
    $check->execute([$token]);
    $session = $check->fetch(PDO::FETCH_ASSOC);
    $felhasznaloId = $session["felhasznalo_id"];
}
?>
