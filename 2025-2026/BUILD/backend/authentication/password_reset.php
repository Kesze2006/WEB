<?php
require_once __DIR__ . "/../../src/helpers/tokenGen.php";
require_once __DIR__ . "/../../src/email_sender_vendor.php";
require_once __DIR__ . "/../../src/db_con.php";
$email_feltoltes = $adatBazis->prepare("INSERT INTO felhasznalo_tokenek
    (felhasznalo_id, token, tipus, lejarat, letrehozva)
    VALUES (
        (SELECT id FROM felhasznalo WHERE email = ?),
        ?,
        'jelszo_megerosites',
        ?,
        NOW()
        )
    ");
emailSend();
?>
