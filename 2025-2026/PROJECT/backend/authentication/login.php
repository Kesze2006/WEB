<?php
require_once __DIR__ . "/init.php";
require_once __DIR__ . "/../../src/helpers/formazotKi.php";
require_once __DIR__ . "/../../src/db_con.php";
require_once __DIR__ . "/../../src/helpers/errorLog.php";
require_once __DIR__ . "/../../src/helpers/tokenGen.php";

if (isset($adatBazis)) {
    $email = trim($data["email"]) ?? "";
    $jelszo = trim($data["jelszo"]) ?? "";

    $check = $adatBazis->prepare("SELECT * FROM felhasznalo WHERE email=?");
    try {
        $check->execute([$email]);
        $felhasznalo = $check->fetch(PDO::FETCH_ASSOC);
        if ($felhasznalo && password_verify($jelszo, $felhasznalo["jelszo_hash"])) {
            $token = tokenGen(32);
            $token_lejarat = date("Y-m-d H:i:s", strtotime("+10 second"));
            $token_insert = $adatBazis->prepare(
                "INSERT INTO session (felhasznalo_id, token, lejarat) VALUES (?, ?, ?)",
            );
            $token_insert->execute([$felhasznalo["id"], $token, $token_lejarat]);
            echo json_encode(["success" => "Sikeres bejelentkezés!"], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => "Hibás email vagy jelszó!"], JSON_UNESCAPED_UNICODE);
        }
    } catch (Throwable $e) {
        errorLog($e);
        echo json_encode(["error" => "Nem lehetett ellenőrizni az adatokat belépéskor!"], JSON_UNESCAPED_UNICODE);
    }
}
?>
