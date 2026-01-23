<?php
require_once __DIR__ . "/../init.php";
require_once __DIR__ . "/../../src/helpers/formazotKi.php";
require_once __DIR__ . "/../../src/db_con.php";
require_once __DIR__ . "/../../src/helpers/errorLog.php";
require_once __DIR__ . "/../../src/helpers/tokenGen.php";
require_once __DIR__ . "/../../src/email_sender_vendor.php";
$secrets = require_once __DIR__ . "/../../config/secrets.php";

if (isset($adatBazis)) {
    $felhasznalo = $data["felhasznalo"] ?? "";
    $email = $data["email"] ?? "";
    $jelszo = password_hash($data["jelszo"], PASSWORD_DEFAULT) ?? "";
    $szerep = $data["szerep"] ?? "";
    $token = tokenGen($secrets);
    $token_lejarat = date("Y-m-d H:i:s", strtotime($secrets["token_email_lejarat"]));

    $feltolt = $adatBazis->prepare("INSERT INTO felhasznalo (nev, email, jelszo_hash, szerep_id)
    VALUES (?, ?, ?, ?, ?, ?)");

    $eamil_feltoltes = $adatBazis->prepare("INSERT INTO felhasznalo_tokenek (felhasznalo_id, token, tipus, lejarat, letrehozva)
    VALUES ((SELECT id FROM felhasznalo WHERE email = ?),?,'email_megerosites',? ,DATE_ADD(NOW()");
    try {
        $feltolt->execute([$felhasznalo, $email, $jelszo, $szerep]);
        emailSend($token, $email);
        echo json_encode(["success" => "Felvettük az adatokat!", "email" => $email], JSON_UNESCAPED_UNICODE);
    } catch (Throwable $e) {
        errorLog($e);
        echo json_encode(["error" => "Az adatok feltöltése sikertelen volt!"], JSON_UNESCAPED_UNICODE);
    }
}
?>
 