<?php
require_once __DIR__ . "/../../PHP/fugvenyek.php";

function versLe($adatBazis, $id)
{
    $leKer = $adatBazis->prepare("SELECT 
                                    v.id AS vers_id,
                                    v.cim,
                                    v.megjelenes_eve,
                                    k.nev AS kolto_nev,
                                    m.megnevezes AS mufaj,
                                    GROUP_CONCAT(vs.tartalom ORDER BY vs.sorszam SEPARATOR '\n') AS versszakok
                                FROM versek v
                                JOIN koltok k ON v.kolto_id = k.id
                                LEFT JOIN mufajok m ON v.mufaj_id = m.id
                                LEFT JOIN versszakok vs ON vs.vers_id = v.id
                                WHERE v.id = ?
                                GROUP BY v.id
                                ");
    $leKer->execute([$id]);
    return $leKer->fetchAll(PDO::FETCH_ASSOC);
}
function koltoLe($adatBazis, $id)
{
    $leKer = $adatBazis->prepare("SELECT 
                                    k.id,
                                    k.nev,
                                    k.szuletesi_datum,
                                    k.szuletesi_hely,
                                    k.halalozi_datum,
                                    k.halalozi_hely,
                                    k.eletrajz,
                                    GROUP_CONCAT(v.cim SEPARATOR '\n') AS versek_cime
                                FROM koltok k
                                LEFT JOIN versek v ON v.kolto_id = k.id
                                WHERE k.id = ?
                                GROUP BY k.id;
                                ");
    $leKer->execute([$id]);
    return $leKer->fetchAll(PDO::FETCH_ASSOC);
}
function koltoOsszes($adatBazis)
{
    $leKer = $adatBazis->prepare("SELECT 
                                    k.id,
                                    k.nev,
                                    k.szuletesi_datum,
                                    k.szuletesi_hely,
                                    k.halalozi_datum,
                                    k.halalozi_hely,
                                    k.eletrajz,
                                    GROUP_CONCAT(v.id SEPARATOR '\n') AS versek_id,
                                    GROUP_CONCAT(v.cim SEPARATOR '\n') AS versek_cime
                                FROM koltok k
                                LEFT JOIN versek v ON v.kolto_id = k.id
                                GROUP BY k.id;
                                ");
    $leKer->execute();
    return $leKer->fetchAll(PDO::FETCH_ASSOC);
}

$adatBazis = new PDO("mysql:host=localhost; dbname=magyar_irodalom;charset=utf8", "root", "");
$json = file_get_contents("php://input");
$data = json_decode($json, true);
$versekDb = $adatBazis->query("SELECT COUNT(*) FROM versek")->fetchColumn();

$path = $_GET["path"] ?? "";
$apiParts = array_values(array_filter(explode("/", $path))) ?? "";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    switch ($apiParts[0]) {
        case "versek":
            if (count($apiParts) == 2) {
                $adatok = [];
                for ($i = 0; $i < (int) $apiParts[1]; $i++) {
                    $adatok = array_merge($adatok, versLe($adatBazis, rand(1, $versekDb)));
                }
                echo json_encode(["sok" => $adatok, "egy" => versLe($adatBazis, (int) $apiParts[1])]);
            } elseif (count($apiParts) == 1) {
                echo json_encode(versLe($adatBazis, rand(1, $versekDb)));
            }
            break;
        case "vers":
            echo json_encode(versLe($adatBazis, (int) $apiParts[1]));
            break;
        case "kolto":
            if (count($apiParts) == 2) {
                echo json_encode(array_merge(koltoLe($adatBazis, (int) $apiParts[1])));
            } elseif (count($apiParts) == 1) {
                $adatok = [];
                $adatok = array_merge($adatok, koltoOsszes($adatBazis));
                echo json_encode($adatok);
            }
            break;
    }
}

?>
