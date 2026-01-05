<?php
include_once "../../PHP/fugvenyek.php";
include_once "szamKeres.php";
if (isset($_SERVER["PATH_INFO"])) {
    $apiParts = explode("/", $_SERVER["PATH_INFO"]);
    array_shift($apiParts);
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $szam = szamKeres($apiParts);
        switch ($apiParts[0]) {
            case "fakt":
                if (count($szam) == 1 && count($szam) != 0 && $szam[0] <= 20) {
                    $megoldas = 1;
                    for ($i = 1; $i <= $szam[0]; $i++) {
                        $megoldas *= $i;
                    }
                    echo $megoldas;
                } else {
                    echo "Valami gond van a megadással!";
                }
                break;
            case "szorzat":
                if (count($szam) >= 2 && count($szam) != 0) {
                    echo array_product($szam);
                } else {
                    echo "Valami gond van a megadással!";
                }
                break;
            case "haromszog":
                if (count($szam) == 3 && count($szam) != 0) {
                    $s = array_sum($szam) / 2;
                    $terulet = sqrt($s * ($s - $szam[0]) * ($s - $szam[1]) * ($s - $szam[2]));
                    echo $terulet;
                } else {
                    echo "Valami gond van a megadással!";
                }
                break;
            case "random":
                if (count($szam) == 1) {
                    echo rand(0, $szam[0]);
                } elseif (count($szam) == 2) {
                    echo rand($szam[0], $szam[1]);
                } elseif (count($szam) == 3) {
                    $random = rand($szam[0] / $szam[2], $szam[1] / $szam[2]) * $szam[2];
                    echo $random;
                } else {
                    echo "Valami gond van a megadással!";
                }
                break;
            case "lorem":
                if (count($szam) == 1 && count($szam) != 0) {
                    $szavak = [
                        "lorem",
                        "ipsum",
                        "dolor",
                        "sit",
                        "amet",
                        "consectetur",
                        "adipiscing",
                        "elit",
                        "sed",
                        "do",
                        "eiusmod",
                        "tempor",
                        "incididunt",
                        "ut",
                        "labore",
                        "et",
                        "dolore",
                        "magna",
                        "aliqua",
                    ];
                    $mondatok = "";
                    for ($k = 0; $k < $szam[0]; $k++) {
                        $mondat = "";
                        for ($i = 0; $i < 6; $i++) {
                            $mondat .= $szavak[array_rand($szavak)] . " ";
                        }
                        $mondatok .= $mondat . " . ";
                    }
                    echo $mondatok;
                } else {
                    echo "Valami gond van a megadással!";
                }
                break;
            default:
                d($apiParts);
        }
    }
}
?>
