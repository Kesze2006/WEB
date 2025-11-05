<?php
session_start();
if (!isset($oldal)) {
    if (isset($_GET["oldal"])) {
        $oldal = $_GET["oldal"];
    } else {
        $oldal = 1;
    }
}

if (!isset($_SESSION["oldal_" . $oldal])) {
    $_SESSION["oldal_" . $oldal] = 1;
} else {
    $_SESSION["oldal_" . $oldal]++;
}

$menu = "";
function menuPont($szoveg, $tartalomId, $aktivMenu, $enabled)
{
    if ($enabled) {
        return '<li class="page-item' .
            ($aktivMenu ? " active" : "") .
            '"><a class="page-link" href="' .
            $_SERVER["PHP_SELF"] .
            "?oldal=" .
            $tartalomId .
            '">' .
            $szoveg .
            "</a></li>";
    } else {
        return '<li class="page-item disable"><a class="page-link">' . $szoveg . "</a></li>";
    }
}

for ($i = 1; $i <= 4; $i++) {
    $menu .= menuPont(
        $i,
        $i,
        (isset($_GET["oldal"]) && $_GET["oldal"] == $i) || (!isset($_GET["oldal"]) && $i == 1),
        true,
    );
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["oldal_" . $oldal]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php echo $menu; ?>
                </ul>
            </nav>
            <div class="h1 text-center">
                <label for="">A lapra való rákattintások száma: <?php echo $_SESSION["oldal_" . $oldal]; ?></label>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>