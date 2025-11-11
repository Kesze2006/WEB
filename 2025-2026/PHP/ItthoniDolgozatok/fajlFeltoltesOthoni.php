<?php
session_start();
include "../fugvenyek.php";
function mappaRendszer($mappa, $forras)
{
    if (explode("/", $mappa)[1] == "Kicsi") {
        $magassag = rand(100, 200);
        $szelesseg = 100;
    } elseif (explode("/", $mappa)[1] == "Nagy") {
        $magassag = rand(200, 600);
        $szelesseg = rand(200, 800);
    }
    if (is_dir($mappa)) {
        kepFajl($forras, $szelesseg, $magassag, $mappa);
    } else {
        mkdir($mappa);
        kepFajl($forras, $szelesseg, $magassag, $mappa);
    }
}
function kepFajl($forras, $szelesseg, $magassag, $celMappa)
{
    $kepForras = imagecreatefromstring(file_get_contents($forras));
    $ujKep = imagecreatetruecolor($szelesseg, $magassag);
    imagecopyresampled($ujKep, $kepForras, 0, 0, 0, 0, $szelesseg, $magassag, imagesx($kepForras), imagesy($kepForras));
    imagejpeg($ujKep, $celMappa . "/kep" . $_SESSION["kepSzam"] . ".jpeg");
    $_SESSION["kepSzam"]++;
}
if (isset($_FILES["fajl"])) {
    $hiba = "";
    $fajl = $_FILES["fajl"];
    $tiltottDolgok = ["text/html", "application/javascript", "text/x-php", "application/x-php", "text/javascript"];

    if ($fajl["size"] > 0 && $fajl["size"] < 1048576) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type aka mimetype extension
        if (
            finfo_file($finfo, $fajl["tmp_name"]) == "image/png" ||
            finfo_file($finfo, $fajl["tmp_name"]) == "image/jpeg" ||
            finfo_file($finfo, $fajl["tmp_name"]) == "image/jpg"
        ) {
            if (is_dir("Kepek/")) {
                mappaRendszer("Kepek/Kicsi", $fajl["tmp_name"]);
                mappaRendszer("Kepek/Nagy", $fajl["tmp_name"]);
            } else {
                mkdir("Kepek/");
                mappaRendszer("Kepek/Kicsi", $fajl["tmp_name"]);
                mappaRendszer("Kepek/Nagy", $fajl["tmp_name"]);
            }
        } elseif (!in_array(finfo_file($finfo, $fajl["tmp_name"]), $tiltottDolgok)) {
            if (is_dir("Doksik/")) {
                move_uploaded_file($fajl["tmp_name"], "Doksik/" . $fajl["name"]);
            } else {
                mkdir("Doksik/");
                move_uploaded_file($fajl["tmp_name"], "Doksik/" . $fajl["name"]);
            }
        } else {
            $hiba = "Ilyen típusu fájlok nem engedélyezettek!";
        }
    } else {
        $hiba = "A fájl mérete 0 byte vagy meghaladja a megengedett 1 megabytos maximális méretet";
    }
    $kepek = "";
    $dir = "Kepek/Kicsi/";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $kepek .= '<img src="' . $dir . $file . '">';
                }
            }
            closedir($dh);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hu"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fájl feltöltés dolgozat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1><?php if (isset($hiba)) {
        echo $hiba;
    } ?></h1>
    <form action="fajlFeltoltesOthoni.php" method="post" enctype="multipart/form-data">
        Fájl kiválasztása: 
        <input type="file" name="fajl">
        <input type="submit" value="Feltöltés">
    </form>
    <?php if (isset($kepek)) {
        echo $kepek;
    } ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
