<?php
$apiParts = explode("/", $_GET["path"]);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    switch ($apiParts[0]) {
        case "osszead":
            break;
        case "kivon":
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
