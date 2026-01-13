<?php
require_once __DIR__ . "/init.php";
require_once __DIR__ . "/../../SRC/HELPERS/formazotKi.php";
require_once __DIR__ . "/../../SRC/db_con.php";

$json = file_get_contents("php://input");
$data = json_decode($json, true);
$felhasznalo = $data["felhasznalo"] ?? "";
$email = $data["email"] ?? "";
$jelszo = hash("sha256", $data["jelszo"] ?? "");
$szerep = $data["szerep"] ?? "";

if ($adatBazis != "") {
    $feltolt = $adatBazis->prepare("INSERT INTO felhasznalo (nev, email, jelszo_hash, szerep_id)
    VALUES (?, ?, ?, ?)");
    $feltolt->execute([$felhasznalo, $email, $jelszo, $szerep]);
}

echo json_encode(["success" => "A regisztráció sikeres!"], JSON_UNESCAPED_UNICODE);
?>
 