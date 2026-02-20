<?php

use App\Models\User;

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
    if (isset($_GET["action"]) && $_GET["action"] == "") {
    }

    return '
    <form method="post" action="">
        <input type="hidden" name="id" id="id" value="">
        <div class="container">
            <div class="row">
                <div class="col-12">Név:</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="text" name="name" id="name" class="from-control">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="save">Mentés</button>
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
    foreach ($csoportListaAdat as $egyCsoport) {
        $vissza .= "<li class=\"list-group-item\">
        $egyCsoport[nev]
        <a href=\"page=csoport&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil\"></i></a>
        <a href=\"page=csoport&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash\"></i></a>
        </li>";
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
?>
