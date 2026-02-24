<?php
require_once __DIR__ . "/db_con.php";

$update_jelszo = $adatBazis->prepare("UPDATE felhasznalo SET jelszo_hash = ?  WHERE email = ? ");
$update_jelszo->execute([password_hash($data["jelszo"], PASSWORD_DEFAULT), $data["email"]]);
?>
