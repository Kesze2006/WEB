<?php
require_once __DIR__ . "/../init.php";
require_once __DIR__ . "/../../src/helpers/formazotKi.php";
require_once __DIR__ . "/../../src/db_con.php";
require_once __DIR__ . "/../../src/helpers/errorLog.php";
require_once __DIR__ . "/../../src/helpers/tokenGen.php";
$secrets = require_once __DIR__ . "/../../config/secrets.php";

if (isset($adatBazis)) {
    $felhasznalo = $data["felhasznalo"] ?? "";
    $email = $data["email"] ?? "";
    $jelszo = password_hash($data["jelszo"], PASSWORD_DEFAULT) ?? "";
    $szerep = $data["szerep"] ?? "";
    $token = tokenGen($secrets);
    $token_lejarat = date("Y-m-d H:i:s", strtotime($secrets["token_email_lejarat"]));
    $feltolt = $adatBazis->prepare("INSERT INTO felhasznalo (nev, email, jelszo_hash, szerep_id, email_token, email_token_lejarat)
    VALUES (?, ?, ?, ?, ?, ?)");

    try {
        $feltolt->execute([$felhasznalo, $email, $jelszo, $szerep, $token, $token_lejarat]);
        echo json_encode(["success" => "A regisztráció sikeres!"], JSON_UNESCAPED_UNICODE);
    } catch (Throwable $e) {
        errorLog($e);
        echo json_encode(["error" => "Az adatok feltöltése sikertelen volt!"], JSON_UNESCAPED_UNICODE);
    }
}
?>
 