<?php

function szerepDb($adatBazis, $szerep)
{
    $szerepLe = $adatBazis->prepare("SELECT COUNT(*) 
    FROM felhasznalo
    JOIN szerepek ON felhasznalo.szerep_id = szerepek.id
    WHERE szerepek.szerep = ? AND email_megerositve = 1");
    $szerepLe->execute([$szerep]);

    return $szerepLe->fetchColumn();
}

?>
