<?php
include_once "szamKeres.php";
include_once "../../PHP/fugvenyek.php";

function osszead($szamok)
{
    $csakSzamok = szamKeres($szamok);
    if (sizeof($csakSzamok) <= 1) {
        return $GLOBALS["lang"]["hu"]["Nincs elég szám a művelethez!"];
    } else {
        return array_sum($csakSzamok);
    }
}
?>
