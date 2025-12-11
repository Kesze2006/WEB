<?php
include_once "../../PHP/fugvenyek.php";
include_once "INCLUDES/osszead.php";
include_once "INCLUDES/kivon.php";
include_once "INCLUDES/szoroz.php";
include_once "INCLUDES/oszt.php";

if (isset($_GET["lang"]) && $_GET["lang"] == "hu") {
    include_once "LANG/hu.php";
} else {
    include_once "LANG/en.php";
}
echo "<h1>Az URL-ben kell megadni a dolgokat!</h1>";
if (isset($_GET["path"])) {
    $apiParts = explode("/", $_GET["path"]);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (sizeof($apiParts) >= 1) {
            switch ($apiParts[0]) {
                case "osszead":
                    echo osszead($apiParts);
                    break;
                case "kivon":
                    echo kivon($apiParts);
                    break;
                case "szoroz":
                    echo szoroz($apiParts);
                    break;
                case "oszt":
                    echo oszt($apiParts);
                    break;
                default:
                    echo sprintf($GLOBALS["lang"]["hu"]["Ismeretlen művelet: %s 🚒"], $apiParts[0]);
            }
        }
    } else {
        echo $GLOBALS["lang"]["hu"]["Liba van a rendszerben! 😒"];
    }
}

?>
