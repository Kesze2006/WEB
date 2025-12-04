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
        $adatok = [];
        $tancok = [];
        $lanyok = [];
        $fiuk = [];
        foreach ($_SESSION["adatok"] as $elem) {
            if (!in_array($elem["tanc"], $tancok)) {
                $tancok[] = $elem["tanc"];
            }
        }
        foreach ($_SESSION["adatok"] as $elem) {
            if (!in_array($elem["lany"], $lanyok)) {
                $lanyok[] = $elem["lany"];
            }
            if (!in_array($elem["fiu"], $fiuk)) {
                $fiuk[] = $elem["fiu"];
            }
        }
        $adatok[] = $tancok;
        $adatok[] = $lanyok;
        $adatok[] = $fiuk;
        $json = json_encode($adatok);
        echo $json;
    } elseif ($data["feladat"] == "2") {
        $megoldas = [
            "elsoTanc" => $_SESSION["adatok"][0]["tanc"],
            "utolsoTanc" => end($_SESSION["adatok"])["tanc"],
        ];
        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "3" && isset($data["tanc"])) {
        $db = 0;
        foreach ($_SESSION["adatok"] as $elem) {
            if ($elem["tanc"] == $data["tanc"]) {
                $db++;
            }
        }
        $json = json_encode($db);
        echo $json;
    } elseif ($data["feladat"] == "4" && isset($data["tancos"])) {
        $tancok = [];
        foreach ($_SESSION["adatok"] as $elem) {
            if (
                ($elem["lany"] == $data["tancos"] || $elem["fiu"] == $data["tancos"]) &&
                !in_array($elem["tanc"], $tancok)
            ) {
                $tancok[] = $elem["tanc"];
            }
        }
        $json = json_encode($tancok);
        echo $json;
    } elseif ($data["feladat"] == "5") {
        $megoldas = "";
        foreach ($_SESSION["adatok"] as $elem) {
            if ($elem["tanc"] == $data["tanc"]) {
                if ($elem["lany"] == $data["tancos"]) {
                    $megoldas = $elem["fiu"];
                }
                if ($elem["fiu"] == $data["tancos"]) {
                    $megoldas = $elem["lany"];
                }
            }
        }
        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "6") {
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
        $megoldas = [];
        $megoldas[] = array_keys($fiuk, $maxFiuk);
        $megoldas[] = array_keys($lanyok, $maxLanyok);
        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "7") {
        $tancok = [];
        foreach ($_SESSION["adatok"] as $elem) {
            if (isset($tancok[$elem["tanc"]])) {
                $tancok[$elem["tanc"]] = $tancok[$elem["tanc"]] + 1;
            } else {
                $tancok[$elem["tanc"]] = 1;
            }
        }
        $legtobbTanc = array_keys($tancok, max($tancok))[0];
        $megoldas = [];
        $megoldas["tanc"] = $legtobbTanc;
        foreach ($_SESSION["adatok"] as $elem) {
            if ($elem["tanc"] == $legtobbTanc) {
                $megoldas["parok"][] = [
                    "lany" => $elem["lany"],
                    "fiu" => $elem["fiu"],
                ];
            }
        }
        $json = json_encode($megoldas);
        echo $json;
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
    }
}
