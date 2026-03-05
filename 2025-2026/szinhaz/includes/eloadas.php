<?php
$oldalCim = "Előadás";
$tabla = "eloadas";
$oldalPage = "eloadas";

if (isset($_POST)) {
    $postId = $_POST["id"] ?? "";
    $postCim = $_POST["cim"] ?? "";
    $postNyelvId = $_POST["nyelv_id"] ?? "";
    $postMufajId = $_POST["mufaj_id"] ?? "";
    $postSzinhazId = $_POST["szinhaz_id"] ?? "";
    $postDatum = $_POST["datum"] ?? "";

    $postSend = $_POST["save"] ?? "default";
    $postNew = $_POST["new"] ?? "default";

    if ($postSend == "") {
        csoportUpdate($postId, $postCim, $postNyelvId, $postMufajId, $postSzinhazId, $postDatum);
    } elseif ($postNew == "") {
        csoportInsert($postCim, $postNyelvId, $postMufajId, $postSzinhazId, $postDatum);
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
    $csoportAdat = ["id" => "", "cim" => "", "szinhazid" => "", "datum" => "", "nyelv_id" => "", "mufaj_id" => ""];
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

            <div class="col-12">Cím:</div>
            <div class="col-12">
                <input type="text" 
                       name="cim" 
                       id="cim" 
                       class="form-control" 
                       value="' .
        $csoportAdat["cim"] .
        '">
            </div>

            <div class="col-12">Színház:</div>
            <div class="col-12">
                ' .
        telepulesSelect($csoportAdat["szinhazid"], "szinhaz") .
        '
            </div>
            
            <div class="col-12">Műfaj:</div>
            <div class="col-12">
                ' .
        telepulesSelect($csoportAdat["mufaj_id"], "mufaj") .
        '
            </div>
            
            <div class="col-12">Nyelv:</div>
            <div class="col-12">
                ' .
        telepulesSelect($csoportAdat["nyelv_id"], "nyelv") .
        '
            </div>
                        <div class="col-12">Dátum:</div>
            <div class="col-12">
                <input type="date" 
                       name="datum" 
                       id="datum" 
                       class="form-control" 
                       value="' .
        $csoportAdat["datum"] .
        '">
            </div>
            ' .
        ($csoportAdat["id"] != ""
            ? '
                <div class="col-12">
                    <button type="submit" 
                            class="btn btn-primary m-2" 
                            name="save">
                        Mentés
                    </button>
                </div>'
            : "") .
        '

            <div class="col-12">
                <button type="submit" 
                        class="btn btn-primary ms-2" 
                        name="new">
                    Mentés újként
                </button>
            </div>

        </div>
    </div>
</form>
';
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
                <div class=\"col-3\">$egyCsoport[mufaj]</div>
                <div class=\"col-2\">$egyCsoport[nyelv]</div>
                <div class=\"col-7\">$egyCsoport[szinhaz]</div>
                <div class=\"col-3\">$egyCsoport[datum]</div>
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
                <div class=\"col-3\">$egyCsoport[mufaj]</div>
                <div class=\"col-2\">$egyCsoport[nyelv]</div>
                <div class=\"col-7\">$egyCsoport[szinhaz]</div>
                <div class=\"col-3\">$egyCsoport[datum]</div>
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
        "SELECT eloadas.*, szinhaz.nev AS szinhaz, mufaj.nev AS mufaj, nyelv.nev AS nyelv
            FROM eloadas
            JOIN szinhaz ON szinhazid = szinhaz.id
            JOIN mufaj ON mufaj_id = mufaj.id
            JOIN nyelv ON nyelv_id = nyelv.id
            ORDER BY szinhaz.nev
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

function csoportInsert($cim, $nyelv_id, $mufaj_id, $szinhaz_id, $datum)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "INSERT INTO $tabla (cim, nyelv_id, mufaj_id, szinhazid, datum) VALUES (?, ?, ?, ?, ?)
        ",
    );
    $check->execute([$cim, $nyelv_id, $mufaj_id, $szinhaz_id, $datum]);
}

function csoportUpdate($id, $cim, $nyelv_id, $mufaj_id, $szinhaz_id, $datum)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "UPDATE $tabla SET cim=?, nyelv_id=?, mufaj_id=?, szinhazid=?, datum=? WHERE id=?;
        ",
    );
    $check->execute([$cim, $nyelv_id, $mufaj_id, $szinhaz_id, $datum, $id]);
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
