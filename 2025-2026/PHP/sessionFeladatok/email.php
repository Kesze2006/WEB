<?php
session_start();
if (!isset($_SESSION["emailTipusok"])) {
    $_SESSION["emailTipusok"] = [];
}
$tipus = explode("@", $_GET["email"]);
var_dump($_SESSION["emailTipusok"]);
if (in_array($tipus[1], $_SESSION["emailTipusok"])) {
    $_SESSION["emailTipusok"][$tipus[1]]++;
    echo "van ilyen";
} else {
    $_SESSION["emailTipusok"][$tipus[1]] = 1;
}
echo $_SESSION["emailTipusok"]["gmail.com"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emailes cutsz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
                <label for="email">Email cím: </label>
                <input type="email" name="email" reguired>
                <input type="submit" value="Küldés">
            </form>
        </div>
        <div class="row">
            <h1><?php echo $_SESSION["emailTipusok"][$tipus[1]]; ?></h1>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>