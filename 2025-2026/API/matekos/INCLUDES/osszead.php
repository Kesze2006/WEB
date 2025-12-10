<?php
include_once "szamKeres.php";
function osszead($szamok)
{
    $csakSzamok = szamKeres($szamok);
    if (sizeof($csakSzamok) <= 1) {
        return "Nincs elég szám a művelethez!";
    } else {
        return array_sum($csakSzamok);
    }
}
?>
