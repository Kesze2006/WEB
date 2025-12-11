
<?php
include_once "szamKeres.php";
include_once "../../PHP/fugvenyek.php";
function kivon($szamok)
{
    $csakSzamok = szamKeres($szamok);
    $eredemny = $csakSzamok[0];
    if (sizeof($csakSzamok) <= 1) {
        return $GLOBALS["lang"]["hu"]["Nincs elég szám a művelethez!"];
    } else {
        for ($i = 1; $i < sizeof($csakSzamok); $i++) {
            $eredemny -= $csakSzamok[$i];
        }
        return $eredemny;
    }
}
?>

