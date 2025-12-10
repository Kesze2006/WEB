<?php
include_once "INCLUDES/osszead.php";
include_once "INCLUDES/kivon.php";
$apiParts = explode("/", $_GET["path"]);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    switch ($apiParts[0]) {
        case "osszead":
            echo osszead($apiParts);
            break;
        case "kivon":
            echo kivon($apiParts);
            break;
        case "szoroz":
            break;
        case "oszt":
            break;
        default:
            echo "Ismeretlen művelet: " . $apiParts[0] . "🚒";
    }
} else {
    echo "Liba van a rendszerben! 😒";
}
?>
