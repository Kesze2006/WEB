<?php
include "../fugvenyek.php";

//$_FILES["fajl"] Csak POST-al van + kell a enctype="multipart/form-data from-ba
if (isset($_FILES["fajl"])) {
    $check = getimagesize($_FILES["fajl"]["tmp_name"]);
    if ($check !== false) {
        $mappa = "Kepek/";
        if (is_dir($mappa)) {
            d($mappa);
            move_uploaded_file($_FILES["fajl"]["tmp_name"], $mappa . basename($_FILES["fajl"]["name"]));
        } else {
            mkdir($mappa);
            move_uploaded_file($_FILES["fajl"]["tmp_name"], $mappa . basename($_FILES["fajl"]["name"]));
        }
    } else {
        $mappa = "Egyeb/";
        if (is_dir($mappa)) {
            d($mappa);
            move_uploaded_file($_FILES["fajl"]["tmp_name"], $mappa . basename($_FILES["fajl"]["name"])); //basename kell mert azzal működik csak + az vágja le az elérési útvonalat így csak a fájlt kapod vissza
        } else {
            mkdir($mappa);
            move_uploaded_file($_FILES["fajl"]["tmp_name"], $mappa . basename($_FILES["fajl"]["name"]));
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
</head>
<body>
    <form action="fajlFeltoltes.php" method="post" enctype="multipart/form-data">
        Fájl kiválasztása: 
        <input type="file" name="fajl">
        <input type="submit" value="Feltöltés">
    </form>
</body>
</html>
