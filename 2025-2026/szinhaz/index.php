<?php
include_once "includes/config.php";
include_once "includes/database.php";
$navbar = [
    0 => ["url" => "?page=csoport", "text" => "Csoport"],
    1 => ["url" => "?page=diakok", "text" => "Diakok"],
    2 => ["url" => "?page=orak", "text" => "Órák"],
    3 => ["url" => "?page=tanar", "text" => "Tanár"],
    4 => ["url" => "?page=targy", "text" => "Tárgy"],
    5 => ["url" => "?page=telepules", "text" => "Település"],
    6 => ["url" => "?page=terem", "text" => "Terem"],
];
$pages = $_GET["page"] ?? "";
$tartalom = "";
switch ($pages) {
    case "csoport":
        include_once __DIR__ . "/includes/csoport.php";
        break;
    case "diakok":
        include_once __DIR__ . "/includes/diakok.php";
        break;
    case "orak":
        include_once __DIR__ . "/includes/orak.php";
        break;
    case "tanar":
        include_once __DIR__ . "/includes/tanar.php";
        break;
    case "targy":
        include_once __DIR__ . "/includes/targy.php";
        break;
    case "telepules":
        include_once __DIR__ . "/includes/telepules.php";
        break;
    case "terem":
        include_once __DIR__ . "/includes/terem.php";
        break;
    default:
        break;
}
include_once __DIR__ . "/includes/sablon.php";
?>
