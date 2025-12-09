<?php
function osszead($szamok) {}

function szamKerses($szamok)
{
    $vissza = [];
    for ($i = 0; $i < sizeof($szamok); $i++) {
        if (is_numeric($szamok[i])) {
            $vissza[] = $szamok[i];
        }
    }
    return $vissza;
}
?>
