<?php
include_once "includes/config.php";
include_once "includes/database.php";
$navbar = [
    0 => ["url" => "?page=eloadas", "text" => "Előadás"],
    1 => ["url" => "?page=mufaj", "text" => "Műfaj"],
    2 => ["url" => "?page=nyelv", "text" => "Nyelv"],
    3 => ["url" => "?page=szekhely", "text" => "Székhely"],
    4 => ["url" => "?page=szinhaz", "text" => "Szinház"],
    5 => ["url" => "?page=tulajdonsag", "text" => "Tulajdonság"],
    6 => ["url" => "?page=tulajdonsagnev", "text" => "Tulajdonságnév"],
];
$pages = $_GET["page"] ?? "";
$tartalom = "";
switch ($pages) {
    case "eloadas":
        include_once __DIR__ . "/includes/eloadas.php";
        break;
    case "mufaj":
        include_once __DIR__ . "/includes/mufaj.php";
        break;
    case "nyelv":
        include_once __DIR__ . "/includes/nyelv.php";
        break;
    case "szekhely":
        include_once __DIR__ . "/includes/szekhely.php";
        break;
    case "szinhaz":
        include_once __DIR__ . "/includes/szinhaz.php";
        break;
    case "tulajdonsag":
        include_once __DIR__ . "/includes/tulajdonsag.php";
        break;
    case "tulajdonsagnev":
        include_once __DIR__ . "/includes/tulajdonsagnev.php";
        break;
    default:
        break;
}
include_once __DIR__ . "/includes/sablon.php";
?>
