<?php
require_once __DIR__ . "/db_con.php";
require_once __DIR__ . "/helpers/formazotKi.php";

function emailMegerosit($tipus)
{
    $token = $_GET["token"] ?? "";
    if (!$token) {
        echo json_encode(["error" => "Token hiányzik"]);
    } else {
        $check = $adatBazis->prepare("SELECT felhasznalo_id
    FROM felhasznalo_tokenek
    WHERE token = ?
      AND tipus = $tipus
      AND felhasznalva = 0
      AND lejarat > NOW()
");
        $check->execute([$token]);
        $user = $check->fetch(PDO::FETCH_ASSOC);
        $update_felhasznalo = $adatBazis->prepare("UPDATE felhasznalo SET email_megerositve = 1  WHERE id = ?
    ");
        $update_felhasznalo->execute([$user["felhasznalo_id"]]);

        $update_token = $adatBazis->prepare("UPDATE felhasznalo_tokenek SET felhasznalva = 1 WHERE felhasznalo_id = ?
    ");
        $update_token->execute([$user["felhasznalo_id"]]);

        if ($check->rowCount() === 1) {
            header("Location: ../frontend/regVisszaigazolas.html");
            echo json_encode(["success" => "Siker!", "email_megerositve" => true], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "Érvénytelen, lejárt vagy már használt token"], JSON_UNESCAPED_UNICODE);
        }
    }
}
?>
