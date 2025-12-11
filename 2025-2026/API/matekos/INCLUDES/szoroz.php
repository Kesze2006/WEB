
<?php
include_once "szamKeres.php";
include_once "../../PHP/fugvenyek.php";

function szoroz($szamok)
{
    $csakSzamok = szamKeres($szamok);
    $eredemny = $csakSzamok[0];
    if (sizeof($csakSzamok) <= 1) {
        return $GLOBALS["lang"]["hu"]["Nincs elég szám a művelethez!"];
    } else {
        for ($i = 1; $i < sizeof($csakSzamok); $i++) {
            if (sizeof($szamok) - 1 != sizeof($csakSzamok)) {
                return $GLOBALS["lang"]["hu"]["Valami szöveg is van a számok között!"];
            } else {
                $eredemny *= $csakSzamok[$i];
            }
        }
        return $eredemny;
    }
}
?>

