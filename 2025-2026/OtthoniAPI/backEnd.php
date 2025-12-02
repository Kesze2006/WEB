<?php
session_start();
include_once "../PHP/fugvenyek.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    if (isset($_FILES["file"]) && $_FILES["file"]["name"] === "tancrend.txt") {
        $fajlNev = $_FILES["file"]["tmp_name"];
        $betoltottFajl = fopen($fajlNev, "r");
        $let = 0;
        $letTomb = [];

        while (!feof($betoltottFajl)) {
            $sor = trim(fgets($betoltottFajl));

            $letTomb[] = $sor;
            $let++;

            if ($let % 3 == 0) {
                $osszesTanc[] = [
                    "tanc" => $letTomb[0],
                    "lany" => $letTomb[1],
                    "fiu" => $letTomb[2],
                ];
                $letTomb = [];
            }
        }
        $_SESSION["adatok"] = $osszesTanc;
        fclose($betoltottFajl);
    } elseif ($data["feladat"] == "2") {
        $megoldas = [
            "elsoTanc" => $_SESSION["adatok"][0]["tanc"],
            "utolsoTanc" => end($_SESSION["adatok"])["tanc"],
        ];
        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "3") {
        $megoldas = 0;
        foreach ($_SESSION["adatok"] as $elem) {
            if ($elem["tanc"] == "samba") {
                $megoldas++;
            }
        }
        echo $megoldas;
    } elseif ($data["feladat"] == "4") {
        $megoldas = "";
        foreach ($_SESSION["adatok"] as $elem) {
            if ($elem["lany"] == "Vilma") {
                $megoldas .= $elem["tanc"] . " ";
            }
        }
        echo $megoldas;
    } elseif ($data["feladat"] == "5") {
        $megoldas = "Vilma nem táncolt ilyen táncot!";
        foreach ($_SESSION["adatok"] as $elem) {
            if ($elem["tanc"] == $data["tancNeve"] && $elem["lany"] == "Vilma") {
                $megoldas = "Vilma a " . $data["tancNeve"] . " táncot " . $elem["fiu"] . " val táncolta le.";
            }
        }
        echo $megoldas;
    } elseif ($data["feladat"] == "6") {
        $lanyok = [];
        $fiuk = [];
        foreach ($_SESSION["adatok"] as $elem) {
            if (!in_array($elem["lany"], $lanyok)) {
                $lanyok[] = $elem["lany"];
            }
            if (!in_array($elem["fiu"], $fiuk)) {
                $fiuk[] = $elem["fiu"];
            }
        }
        $megoldas = [
            "lanyok" => $lanyok,
            "fiuk" => $fiuk,
        ];
        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "7") {
        $fiuk = [];
        $lanyok = [];
        foreach ($_SESSION["adatok"] as $elem) {
            if (isset($fiuk[$elem["fiu"]])) {
                $fiuk[$elem["fiu"]] = $fiuk[$elem["fiu"]] + 1;
            } else {
                $fiuk[$elem["fiu"]] = 1;
            }

            if (isset($lanyok[$elem["lany"]])) {
                $lanyok[$elem["lany"]] = $lanyok[$elem["lany"]] + 1;
            } else {
                $lanyok[$elem["lany"]] = 1;
            }
        }
        $maxFiuk = max($fiuk);
        $maxLanyok = max($lanyok);
        $megoldas =
            "A legtöbször szereplő fiú " .
            array_keys($fiuk, $maxFiuk)[0] .
            " volt és a legtöbször szereplő lány pedig " .
            array_keys($lanyok, $maxLanyok)[0] .
            " volt.";
        echo $megoldas;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
}
