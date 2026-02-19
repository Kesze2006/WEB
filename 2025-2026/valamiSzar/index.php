<?php
include_once __DIR__ . "/includes/config.php";
$navbar = [
    0 => ["url" => "?page=csoport", "text" => "Csoport"],
    1 => ["url" => "?page=diakok", "text" => "Diakok"],
    2 => ["url" => "?page=orak", "text" => "Órák"],
    3 => ["url" => "?page=tanar", "text" => "Tanár"],
    4 => ["url" => "?page=targy", "text" => "Tárgy"],
    5 => ["url" => "?page=telepules", "text" => "Település"],
    6 => ["url" => "?page=terem", "text" => "Terem"],
];
$pages = $_GET["pages"] ?? "";

switch ($pages) {
    case "csoport":
        include_once __DIR__ . "/includes/csoport.php";
        break;
    case "diakok":
        break;
    case "orak":
        break;
    case "tanar":
        break;
    case "targy":
        break;
    case "telepules":
        break;
    case "terem":
        break;
    default:
        break;
}

include_once __DIR__ . "/includes/sablon.php";
?>
