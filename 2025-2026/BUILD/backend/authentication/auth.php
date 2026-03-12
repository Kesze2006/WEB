<?php
session_start();
include_once __DIR__ . "../../../src/db_con.php";

$_SESSION["user_id"] ?? "";
$sql = "SELECT * FROM felhasznalo WHERE id = ?";
$stmt = $adatBazis->prepare($sql);
$stmt->execute([$_SESSION["user_id"]]);
$felhasznalo = $stmt->fetch(PDO::FETCH_ASSOC);
$szerep_le = $adatBazis->prepare("SELECT * from szerepek where id = ?");
$szerep_le->execute([$felhasznalo["szerep_id"]]);
$szerep = $szerep_le->fetch(PDO::FETCH_ASSOC);

echo json_encode(
    [
        "success" => "Siker",
        "nev" => $felhasznalo["nev"],
        "szerep" => $szerep["szerep"],
        "email" => $felhasznalo["email"],
    ],
    JSON_UNESCAPED_UNICODE,
);
