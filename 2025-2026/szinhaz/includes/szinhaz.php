<?php
$oldalCim = "Színház";
$tabla = "szinhaz";
$oldalPage = "szinhaz";

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
    $csoportAdat = ["id" => "", "nev" => "", "ertek" => "", "eloadasid" => "", "tulajdonsagnev_id" => ""];
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
                <div class="col-12">Előadás:</div>
                <div class="col-12">
                <div class="col-12">
                    ' .
        telepulesSelect($csoportAdat["eloadasid"], "eloadas", "cim") .
        '
                </div>
                </div>
                <div class="col-12">Érték:</div>
                <div class="col-12">
                    <input type="number" name="ertek" id="ertek" class="from-control" value="' .
        $csoportAdat["ertek"] .
        '">
                <div class="col-12">Tulajdonság Név:</div>
                <div class="col-12">
                    ' .
        telepulesSelect($csoportAdat["tulajdonsagnev_id"], "tulajdonsagnev") .
        '
                </div>
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

function telepulesSelect($id, $tabla, $mezo = "nev")
{
    global $adatBazis;
    if ($tabla == "eloadas") {
        $check = $adatBazis->prepare(
            "SELECT eloadas.id, CONCAT(eloadas.cim,' - ',szinhaz.nev) AS $mezo FROM $tabla
                JOIN szinhaz ON eloadas.szinhazid=szinhaz.id
                ORDER BY eloadas.cim
            ",
        );
    } else {
        $check = $adatBazis->prepare(
            "SELECT * FROM $tabla
                ORDER BY $mezo
            ",
        );
    }
    $check->execute();
    $telepulesek = $check->fetchAll(PDO::FETCH_ASSOC);

    $vissza = '<select name="' . $tabla . '_id" class="form-select">';
    foreach ($telepulesek as $telepules) {
        $vissza .=
            '<option value="' .
            $telepules["id"] .
            '"' .
            ($telepules["id"] == $id ? " selected" : "") .
            ">" .
            $telepules[$mezo] .
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
                <div class=\"col-7\">$egyCsoport[cim]</div>
                <div class=\"col-1\">$egyCsoport[ertek]</div>
                <div class=\"col-2\">$egyCsoport[nev]</div>
                <div class=\"col-2\">
                    <a class=\"text-white\" href=\"?page=$oldalPage&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil \"></i></a>
                    <a class=\"text-white\" href=\"?page=$oldalPage&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash \"></i></a>
                </div>
            </div>
            </li>";
        } else {
            $vissza .= "<li class=\"list-group-item\">
            <div class=\"row\">
                <div class=\"col-7\">$egyCsoport[cim]</div>
                <div class=\"col-1\">$egyCsoport[ertek]</div>
                <div class=\"col-2\">$egyCsoport[nev]</div>
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

function diaktListaAdat()
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "SELECT diakok.nev AS diak_nev, telepules.nev AS telepules_nev
            FROM kapcsolo
            JOIN diakok ON kapcsolo.diakid=diakok.id
            JOIN telepules ON diakok.telepules_id=telepules.id
            WHERE kapcsolo.oraid = ?
            ORDER BY diak_nev
        ",
    );
    $check->execute();
    $user = $check->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function csoportListaAdat()
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "SELECT tulajdonsag.*, eloadas.cim, tulajdonsagnev.nev
            from tulajdonsag
            join tulajdonsagnev on tulajdonsag.tulajdonsagnev_id = tulajdonsagnev.id
            join eloadas on tulajdonsag.eloadasid = eloadas.id
            order by eloadas.cim
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
        "SELECT * 
            FROM  $tabla
            WHERE id=?;
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
