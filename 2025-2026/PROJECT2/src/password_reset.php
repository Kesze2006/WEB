<?php
require_once __DIR__ . "/db_con.php";
require_once __DIR__ . "/helpers/tokenGen.php";
require_once __DIR__ . "/email_sender_vendor.php";
$secrets = require_once __DIR__ . "/../config/secrets.php";

$token = tokenGen($secrets);
$token_lejarat = date("Y-m-d H:i:s", strtotime($secrets["token_email_lejarat"]));
$email = $data["email"] ?? "";

$jelszo_feltoltes = $adatBazis->prepare("INSERT INTO felhasznalo_tokenek
            (felhasznalo_id, token, tipus, lejarat, letrehozva)
            VALUES (
                (SELECT id FROM felhasznalo WHERE email = ?),
                ?,
                'jelszo_reset',
                ?,
                NOW()
                )
            ");
if (!$jelszo_feltoltes->execute([$email, $token, $token_lejarat])) {
    print_r($jelszo_feltoltes->errorInfo());
}
emailSend($token, $email, "jelszo_reset");
?>
