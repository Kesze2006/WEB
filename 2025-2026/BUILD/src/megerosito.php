<?php
require_once __DIR__ . "/db_con.php";
require_once __DIR__ . "/helpers/formazotKi.php";

$tipus = $_GET["tipus"] ?? "";
$token = $_GET["token"] ?? "";
if (!$token) {
    echo json_encode(["error" => "Token hiányzik"]);
} else {
    $check = $adatBazis->prepare(
        "SELECT felhasznalo_id
    FROM felhasznalo_tokenek
    WHERE token = ?
      AND tipus = ?
      AND felhasznalva = 0
      AND lejarat > NOW()
",
    );
    $check->execute([$token, $tipus]);
    $user = $check->fetch(PDO::FETCH_ASSOC);

    switch ($tipus) {
        case "email_megerosites":
            $update_felhasznalo = $adatBazis->prepare("UPDATE felhasznalo SET " . $tipus . " = 1  WHERE id = ? ");
            $update_felhasznalo->execute([$user["felhasznalo_id"]]);
            break;
        case "jelszo_helyreallitas":
            break;
    }

    $update_token = $adatBazis->prepare("UPDATE felhasznalo_tokenek SET felhasznalva = 1 WHERE felhasznalo_id = ?
    ");
    $update_token->execute([$user["felhasznalo_id"]]);

    if ($check->rowCount() === 1) {
        header("Location: ../frontend/regVisszaigazolas.html");
        echo json_encode(["success" => "Siker!", $tipus => true], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["error" => "Érvénytelen, lejárt vagy már használt token"], JSON_UNESCAPED_UNICODE);
    }
}

?>
