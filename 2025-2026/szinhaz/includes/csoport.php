<?php

if (isset($_POST)) {
    $postId = $_POST["id"] ?? "";
    $postNev = $_POST["name"] ?? "";
    $postSend = $_POST["save"] ?? "default";
    $postNew = $_POST["new"] ?? "default";

    if ($postSend == "") {
        csoportUpdate($postNev, $postId);
    } elseif ($postNew == "") {
        csoportInsert($postNev);
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
    return '
    <div class="container">
        <div class="row">' .
        cim("Csoportok") .
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
    $csoportAdat = ["id" => "", "nev" => ""];
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
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="text" name="name" id="name" class="from-control" value="' .
        $csoportAdat["nev"] .
        '">
                </div>
            </div>
            <div class="row">' .
        ($csoportAdat["id"] != ""
            ? '
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="save">Mentés</button>'
            : "") .
        '
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="new">Mentés újként</button>
                </div>
            </div>
        </div>
    </form>';
}

function csoportLista()
{
    $csoportListaAdat = csoportListaAdat();
    $vissza = "";
    $id = $_GET["id"] ?? "";
    foreach ($csoportListaAdat as $egyCsoport) {
        if ($id == $egyCsoport["id"]) {
            $vissza .= "<li class=\"list-group-item active \">
            $egyCsoport[nev]
            <a class=\"text-white\" href=\"?page=csoport&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil \"></i></a>
            <a class=\"text-white\" href=\"?page=csoport&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash \"></i></a>
            </li>";
        } else {
            $vissza .= "<li class=\"list-group-item\">
            $egyCsoport[nev]
            <a href=\"?page=csoport&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil\"></i></a>
            <a href=\"?page=csoport&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash\"></i></a>
            </li>";
        }
    }
    return '
    <ul class="list-group">
        ' .
        $vissza .
        '
    </ul>';
}

function csoportListaAdat()
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "SELECT *
    FROM  csoport
        ",
    );
    $check->execute();
    $user = $check->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function csoportAdat($id)
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "SELECT *
    FROM  csoport WHERE id=?
        ",
    );
    $check->execute([$id]);
    $user = $check->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function csoportInsert($name)
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "INSERT INTO csoport (nev) VALUES (?);
        ",
    );
    $check->execute([$name]);
}

function csoportUpdate($name, $id)
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "UPDATE csoport SET nev=? WHERE id=?;
        ",
    );
    $check->execute([$name, $id]);
}

function csoportDelete($id)
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "DELETE FROM csoport WHERE id=?;
        ",
    );
    $check->execute([$id]);
}
?>
