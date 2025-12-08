<?php
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

$menu .= menuPont(
    "Előző",
    isset($_GET["oldal"]) ? $_GET["oldal"] - 1 : 1,
    false,
    isset($_GET["oldal"]) ? $_GET["oldal"] > 1 && $_GET["oldal"] <= 10 : false,
);

for ($i = 1; $i <= 10; $i++) {
    $menu .= menuPont(
        $i,
        $i,
        (isset($_GET["oldal"]) && $_GET["oldal"] == $i) || (!isset($_GET["oldal"]) && $i == 1),
        true,
    );
}

$menu .= menuPont(
    "Következő",
    isset($_GET["oldal"]) ? $_GET["oldal"] + 1 : 2,
    false,
    isset($_GET["oldal"]) ? $_GET["oldal"] < 10 && $_GET["oldal"] >= 1 : true,
);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <title>Lapozós cucc</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-2 bg-primary"></div>
      <div class="col-12 col-lg-8 container">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <?php echo $menu; ?>
          </ul>
        </nav>
        <?php if (!isset($_GET["oldal"])) {
            include "include/tartalom" . "1" . ".php";
        } else {
            include "include/tartalom" . $_GET["oldal"] . ".php";
        } ?>
      </div>
      <div class="col-12 col-lg-2 bg-primary"></div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>