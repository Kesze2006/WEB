<?php
session_start();
function d($elem)
{
    echo "<pre>";
    echo var_dump($elem);
    echo "</pre>";
}
function kiir()
{
    $vissza = "<ul>";
    foreach ($_SESSION["users"] as $kulcs => $ertek) {
        $vissza .=
            "<li>Felhasználónév: " . $kulcs . " Jelszó: " . $ertek[0] . " Admin jogosultság: " . $ertek[1] . "</li>";
    }
    $vissza .= "</ul>";
    return $vissza;
}

if (!isset($_SESSION["belepes"])) {
    $_SESSION["belepes"] = true;
}
if (!isset($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
}
if (!isset($_SESSION["nev"])) {
    $_SESSION["nev"] = "";
}
if (!isset($_SESSION["users"])) {
    $_SESSION["users"] = [];
}
if (!isset($_SESSION["simaProfil"])) {
    $_SESSION["simaProfil"] = false;
}
if (!isset($_SESSION["userek"])) {
    $_SESSION["userek"] = "";
}

if (isset($_GET)) {
    if (
        isset($_GET["userName"]) &&
        isset($_GET["jelszo"]) &&
        $_GET["userName"] == "admin" &&
        $_GET["jelszo"] == "admin"
    ) {
        $_SESSION["nev"] = $_GET["userName"];
        $_SESSION["belepes"] = false;
        $_SESSION["admin"] = true;
        $_SESSION["userek"] = kiir();
    }
    if (isset($_GET["newUser"]) && isset($_GET["ujJelszo"]) && isset($_GET["jogosult"])) {
        $_SESSION["belepes"] = false;
        $_SESSION["admin"] = true;
        $_SESSION["users"][$_GET["newUser"]] = [$_GET["ujJelszo"], $_GET["jogosult"]];
        $_SESSION["userek"] = kiir();
    }
    if (isset($_GET["logout"]) && $_GET["logout"] == "Kilépés") {
        $_SESSION["belepes"] = true;
    }
    if (
        isset($_GET["userName"]) &&
        isset($_GET["jelszo"]) &&
        $_GET["userName"] != "admin" &&
        $_GET["jelszo"] != "admin"
    ) {
        if (array_key_exists($_GET["userName"], $_SESSION["users"])) {
            if (
                $_SESSION["users"][$_GET["userName"]][0] == $_GET["jelszo"] &&
                $_SESSION["users"][$_GET["userName"]][1] == "true"
            ) {
                $_SESSION["nev"] = $_GET["userName"];
                $_SESSION["belepes"] = false;
                $_SESSION["admin"] = true;
                $userek = kiir();
            } elseif (
                $_SESSION["users"][$_GET["userName"]][0] == $_GET["jelszo"] &&
                $_SESSION["users"][$_GET["userName"]][1] == "false"
            ) {
                $_SESSION["nev"] = $_GET["userName"];
                $_SESSION["belepes"] = false;
                $_SESSION["simaProfil"] = true;
                $_SESSION["admin"] = false;
            }
        }
    }
    if (isset($_GET["torol"])) {
        foreach ($_SESSION["users"] as $kulcs => $ertek) {
            if ($kulcs == $_GET["torol"]) {
                unset($_SESSION["users"][$_GET["torol"]]);
            }
        }
        $_SESSION["userek"] = kiir();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolgozat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #kulso{
            margin: auto;
            text-align: center;
            border: 2px solid black;
        }
    </style>
</head>
<body>
    <?php if ($_SESSION["belepes"]) { ?>
    <div class="container">
        <div class="row col-2" id="kulso">
            <h1>Belépés</h1>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                <label>Felhasználónév: </label><input type="text" name="userName" id="userName"><br>
                <label>Jelszó: </label><input type="password" name="jelszo" id="jelszo" ><br>
                <input type="submit" value="Küldés">
            </form>
        </div>
    </div>
    <?php } elseif (!$_SESSION["belepes"] && $_SESSION["admin"]) { ?>
    <div class="container">
        <div class="row">
            <h1>Belépett felhasználó: <?php echo $_SESSION["nev"]; ?></h1>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                <input type="submit" value="Kilépés" name="logout">
            </form>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                <input type="text" name="newUser" id="newUser" placeholder="Felhasználónév" required>
                <input type="password" name="ujJelszo" id="ujJelszo" placeholder="Jelszó" required>
                <input type="hidden" name="jogosult" value="false">
                <input type="checkbox" name="jogosult" id="jogosult" value="true"><label>Admin jogosúltság</label>
                <input type="submit" value="Felvétel/Szerkeztés">
            </form>
            <?php echo $_SESSION["userek"]; ?>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                <input type="text" name="torol" id="torol" placeholder="Felhasználónév">
                <input type="submit" value="Töröl">
            </form>
        </div>
    </div>
    <?php } elseif ($_SESSION["simaProfil"]) { ?>
    <div class="container">
        <div class="row">
            <h1>Belépett felhasználó: <?php echo $_SESSION["nev"]; ?></h1>
            <strong><p>Üdvözöllek az oldalon kedves <?php echo $_SESSION["nev"]; ?>!</p></strong>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                <input type="submit" value="Kilépés" name="logout">
            </form>
        </div>
    </div>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>