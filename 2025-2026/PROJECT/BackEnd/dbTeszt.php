<?php
include_once "config.php";
include_once "../../PHP/fugvenyek.php";

$adatBazis = new mysqli("localhost", "root", "", "verzio1");
if (!$adatBazis) {
    echo json_encode(["error" => "Nem lehet kapcsolódni az adatbázishoz!"]);
} else {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    $felhasznalo = $data["felhasznalo"] ?? "";
    $email = $data["email"] ?? "";
    $jelszo = hash("sha256", $data["jelszo"] ?? "");
    switch ($data["szerep"]) {
        case "diak":
            $szerep = 1;
            break;
        case "tanar":
            $szerep = 2;
            break;
        case "admin":
            $szerep = 3;
            break;
        default:
            break;
    }
    $adatBazis->query("INSERT INTO felhasznalo (nev, email, jelszo_hash, szerep_id)
    VALUES ('$felhasznalo', '$email', '$jelszo', '$szerep')");
}
?>
