<?php
require_once __DIR__ . "/db_con.php";
require_once __DIR__ . "/helpers/formazotKi.php";

$token = $_GET["token"] ?? "";
if (!$token) {
    echo json_encode(["error" => "Token hiányzik"]);
} else {
    $check = $adatBazis->prepare("UPDATE felhasznalo
    SET email_megerositve = 1, email_token = NULL, email_token_lejarat = NULL
    WHERE email_token = ?
      AND email_token_lejarat > NOW()
      AND email_megerositve = 0
");
    $check->execute([$token]);
    if ($check->rowCount() === 1) {
        header("Location: ../frontend/emailVissza.html");
        echo json_encode(["success" => "Siker!", "email_megerositve" => true], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["error" => "Érvénytelen, lejárt vagy már használt token"], JSON_UNESCAPED_UNICODE);
    }
}
?>
