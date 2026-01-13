<?php
require_once __DIR__ . "/init.php";
require_once __DIR__ . "/../../SRC/HELPERS/formazotKi.php";
require_once __DIR__ . "/../../SRC/db_con.php";

if (isset($adatBazis)) {
    $felhasznalo = $data["felhasznalo"] ?? "";
    $email = $data["email"] ?? "";
    $jelszo = hash("sha256", $data["jelszo"] ?? "");
    $szerep = $data["szerep"] ?? "";

    $feltolt = $adatBazis->prepare("INSERT INTO felhasznalo (nev, email, jelszo_hash, szerep_id)
    VALUES (?, ?, ?, ?)");
    if ($feltolt->execute([$felhasznalo, $email, $jelszo, $szerep])) {
        echo json_encode(["success" => "A regisztráció sikeres!"], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["error" => ""], JSON_UNESCAPED_UNICODE);
    }
}
?>
 