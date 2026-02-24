<?php
$oldalCim = "Diákok";
$tabla = "diakok";
$oldalPage = "diakok";

if (isset($_POST)) {
    $postId = $_POST["id"] ?? "";
    $postNev = $_POST["name"] ?? "";
    $postEmail = $_POST["email"] ?? "";
    $postTelefon = $_POST["telefon"] ?? "";
    $postTelepulesId = $_POST["telepules_id"] ?? "";
    $postSend = $_POST["save"] ?? "default";
    $postNew = $_POST["new"] ?? "default";

    if ($postSend == "") {
        csoportUpdate($postNev, $postId, $postEmail, $postTelefon, $postTelepulesId);
    } elseif ($postNew == "") {
        csoportInsert($postNev, $postEmail, $postTelefon, $postTelepulesId);
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    csoportDelete($_GET["id"]);
}
$tartalom = szerkezet();
function cim($cim)
{
    return "<h2>$cim</h2>";
}

function szerkezet()
{
    global $oldalCim;
    return '
    <div class="container">
        <div class="row">' .
        cim($oldalCim) .
        '</div>
        <div class="row">
            <div class="col-6">
            ' .
        csoportForm() .
        '
            </div>
            <div class="col-6">
            ' .
        csoportLista() .
        '
            </div>
        </div>
    </div>
    ';
}

function csoportForm()
{
    $csoportAdat = ["id" => "", "nev" => "", "email" => "", "telefon" => "", "telepules_id" => ""];
    if (isset($_GET["action"]) && $_GET["action"] == "edit") {
        $csoportAdat = csoportAdat($_GET["id"]);
    }

    return '
    <form method="post" action="">
        <input type="hidden" name="id" id="id" value="' .
        $csoportAdat["id"] .
        '">
        <div class="container">
            <div class="row">
                <div class="col-12">Név:</div>
                <div class="col-12">
                    <input type="text" name="name" id="name" class="from-control" value="' .
        $csoportAdat["nev"] .
        '">
                </div>
                <div class="col-12">E-mail:</div>
                <div class="col-12">
                    <input type="text" name="email" id="email" class="from-control" value="' .
        $csoportAdat["email"] .
        '">
                </div>
                <div class="col-12">Telefon:</div>
                <div class="col-12">
                    <input type="text" name="telefon" id="telefon" class="from-control" value="' .
        $csoportAdat["telefon"] .
        '">
                </div>
                <div class="col-12">Település:</div>
                <div class="col-12">
                    ' .
        telepulesSelect($csoportAdat["telepules_id"]) .
        '
                </div>' .
        ($csoportAdat["id"] != ""
            ? '
                <div class="col-12">
                    <button type="submit" class="btn btn-primary m-2" name="save">Mentés</button>'
            : "") .
        '
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary ms-2" name="new">Mentés újként</button>
                </div>
            </div>
        </div>
    </form>';
}

function telepulesSelect($id)
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "SELECT * from telepules
        ",
    );
    $check->execute();
    $telepulesek = $check->fetchAll(PDO::FETCH_ASSOC);
    $vissza = '<select name="telepules_id">';
    foreach ($telepulesek as $telepules) {
        $vissza .=
            '<option value="' .
            $telepules["id"] .
            '"' .
            ($telepules["id"] == $id ? " selected" : "") .
            ">" .
            $telepules["nev"] .
            "</option>";
    }
    $vissza .= "</select>";
    return $vissza;
}

function csoportLista()
{
    global $oldalPage;
    $csoportListaAdat = csoportListaAdat();
    $vissza = "";
    $id = $_GET["id"] ?? "";
    foreach ($csoportListaAdat as $egyCsoport) {
        if ($id == $egyCsoport["id"]) {
            $vissza .= "<li class=\"list-group-item active\">
            <div class=\"row\">
                <div class=\"col-6\">$egyCsoport[nev]</div>
                <div class=\"col-4\">$egyCsoport[telepulesNev]</div>
                <div class=\"col-2\">
                    <a class=\"text-white\" href=\"?page=$oldalPage&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil \"></i></a>
                    <a class=\"text-white\" href=\"?page=$oldalPage&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash \"></i></a>
                </div>
            </div>
            </li>";
        } else {
            $vissza .= "<li class=\"list-group-item\">
            <div class=\"row\">
                <div class=\"col-6\">$egyCsoport[nev]</div>
                <div class=\"col-4\">$egyCsoport[telepulesNev]</div>
                <div class=\"col-2\">
                    <a href=\"?page=$oldalPage&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil \"></i></a>
                    <a href=\"?page=$oldalPage&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash \"></i></a>
                </div>
            </div>
            </li>";
        }
    }
    return '
    <ul class="list-group container">
        ' .
        $vissza .
        '
    </ul>';
}

function csoportListaAdat()
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "SELECT diakok.*, telepules.nev as telepulesNev
    FROM  $tabla, telepules WHERE diakok.telepules_id = telepules.id
        ",
    );
    $check->execute();
    $user = $check->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function csoportAdat($id)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "SELECT diakok.*, telepules.nev as telepulesNev
    FROM  $tabla, telepules WHERE diakok.telepules_id = telepules.id and diakok.id = ?
        ",
    );
    $check->execute([$id]);
    $user = $check->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function csoportInsert($name, $email, $telefon, $telepules_id)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "INSERT INTO $tabla (nev,email,telefon,telepules_id) VALUES (?, ?, ?, ?)
        ",
    );
    $check->execute([$name, $email, $telefon, $telepules_id]);
}

function csoportUpdate($name, $id, $email, $telefon, $telepules_id)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "UPDATE $tabla SET nev=?, email=?, telefon=?, telepules_id=? WHERE id=?;
        ",
    );
    $check->execute([$name, $email, $telefon, $telepules_id, $id]);
}

function csoportDelete($id)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "DELETE FROM $tabla WHERE id=?;
        ",
    );
    $check->execute([$id]);
}
?>
