<?php
require_once __DIR__ . "/init.php";
require_once __DIR__ . "/../../src/helpers/formazotKi.php";
require_once __DIR__ . "/../../src/db_con.php";
require_once __DIR__ . "/../../src/helpers/errorLog.php";

if (isset($adatBazis)) {
    $felhasznalo = $data["felhasznalo"] ?? "";
    $email = $data["email"] ?? "";
    $jelszo = password_hash($data["jelszo"], PASSWORD_DEFAULT) ?? ""; //ehez van még valami auto frissítés de az már sok nekem is
    $szerep = $data["szerep"] ?? "";

    $feltolt = $adatBazis->prepare("INSERT INTO felhasznalo (nev, email, jelszo_hash, szerep_id)
    VALUES (?, ?, ?, ?)");

    try {
        $feltolt->execute([$felhasznalo, $email, $jelszo, $szerep]);
        echo json_encode(["success" => "A regisztráció sikeres!"], JSON_UNESCAPED_UNICODE);
    } catch (Throwable $e) {
        errorLog($e);
        echo json_encode(["error" => "Az adatok feltöltése sikertelen volt!"], JSON_UNESCAPED_UNICODE);
    }
}
?>
 