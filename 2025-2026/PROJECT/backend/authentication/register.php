<?php
//require_once "init.php";
require_once __DIR__ . "/../../SRC/HELPERS/formazotKi.php";
require_once __DIR__ . "/../../SRC/db_con.php";
if (!$adatBazis) {
    echo json_encode(["error" => "Nem lehet kapcsolódni az adatbázishoz!"]);
} else {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    $felhasznalo = $data["felhasznalo"] ?? "";
    $email = $data["email"] ?? "";
    $jelszo = hash("sha256", $data["jelszo"] ?? "");
    $szerep = $data["szerep"] ?? "";

    $feltolt = $adatBazis->prepare("INSERT INTO felhasznalo (nev, email, jelszo_hash, szerep_id)
    VALUES (?, ?, ?, ?)");
    $feltolt->execute([$felhasznalo, $email, $jelszo, $szerep]);
    echo json_encode(["success" => "A regisztráció sikeres!"]);
}
?>
