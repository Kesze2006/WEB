<?php
include "../fugvenyek.php";
function randomNev()
{
    $characters = "abcdefghijklmnopqrstuvwxyz";
    $mappaNev = "";
    for ($k = 0; $k < rand(2, 8); $k++) {
        $mappaNev .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $mappaNev;
}
$mappaMelyseg = rand(1, 4);
$structure = "";
for ($i = 0; $i < $mappaMelyseg; $i++) {
    $structure .= randomNev() . "/";
}
if (mkdir($structure, 0777, true)) {
}
?>
