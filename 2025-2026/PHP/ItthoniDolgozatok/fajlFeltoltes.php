<?php
include "../fugvenyek.php";
function meretezes($forras, $magassag, $szelesseg, $celMappa, $sorSzam)
{
    $kepForras = imagecreatefromstring(file_get_contents($forras));
    $ujKep = imagecreatetruecolor($szelesseg, $magassag);
    imagecopyresampled($ujKep, $kepForras, 0, 0, 0, 0, $szelesseg, $magassag, imagesx($kepForras), imagesy($kepForras));
    imagejpeg($ujKep, "Kepek/" . $celMappa . "/kep" . $sorSzam . ".jpeg");
    $sorSzam++;
}
function mappaKeszit($mappa)
{
    $sorSzam = 0;
    $mappaNev = explode("/", $mappa)[1];
    if ($mappaNev == "Nagy") {
        $magassag = 600;
        $szelesseg = 800;
    } else {
        $magassag = 100;
        $szelesseg = 100;
    }
    if (is_dir($mappa)) {
        meretezes($_FILES["fajl"]["tmp_name"], $magassag, $szelesseg, $mappaNev, $sorSzam);
    } else {
        mkdir($mappa, 0777, true);
        meretezes($_FILES["fajl"]["tmp_name"], $magassag, $szelesseg, $mappaNev, $sorSzam);
    }
}
//$_FILES["fajl"] Csak POST-al van + kell a enctype="multipart/form-data from-ba

if (isset($_FILES["fajl"])) {
    $tipus = explode(".", $_FILES["fajl"]["name"])[1];
    if (!($tipus == "php" || $tipus == "html" || $tipus == "js")) {
        if ($tipus == "png" || $tipus == "jpeg") {
            $check = getimagesize($_FILES["fajl"]["tmp_name"]);
            if (is_dir("Kepek/")) {
                mappaKeszit("Kepek/Kicsi");
                mappaKeszit("Kepek/Nagy");
            } else {
                mkdir("Kepek/");
                mappaKeszit("Kepek/Kicsi");
                mappaKeszit("Kepek/Nagy");
            }
        } else {
            if (is_dir("Doksi/")) {
                move_uploaded_file($_FILES["fajl"]["tmp_name"], "Doksi/" . $_FILES["fajl"]["name"]);
            } else {
                mkdir("Doksi/");
                move_uploaded_file($_FILES["fajl"]["tmp_name"], "Doksi/" . $_FILES["fajl"]["name"]);
            }
        }
    } else {
        echo "A fájl típusa nem fogadható el.";
    }
    $kepekKicsi = "";
    $dir = "Kepek/Kicsi/";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $kepekKicsi .= '<img src="' . $dir . $file . '">';
                }
            }
            closedir($dh);
        }
    }
    $kepekNagy = "";
    $dir = "Kepek/Nagy/";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $kepekNagy .= '<img src="' . $dir . $file . '">';
                }
            }
            closedir($dh);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fájl feltöltés gyakorlás</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <form action="fajlFeltoltes.php" method="post" enctype="multipart/form-data">
        Fájl kiválasztása: 
        <input type="file" name="fajl">
        <input type="submit" value="Feltöltés">
    </form>
    <button id="gomb">Nagy képek</button>
    <div id="kepekHelye"></div>
    <?php if (isset($kepekKicsi)) {
        echo $kepekKicsi;
    } ?>
    <script>
    document.getElementById('gomb').addEventListener('click', function() {
    const kepekHTML = <?php echo json_encode($kepekNagy); ?>;
    document.getElementById('kepekHelye').innerHTML = kepekHTML;
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
