<?php
$oldalCim = "Órák";
$tabla = "orak";
$oldalPage = "orak";

if (isset($_POST)) {
    $postAdat = [
        "id" => $_POST["id"] ?? "",
        "datum" => $_POST["datum"] ?? "",
        "orasorszam" => $_POST["orasorszam"] ?? "",
        "targy_id" => $_POST["targy_id"] ?? "",
        "terem_id" => $_POST["terem_id"] ?? "",
        "ferohely" => $_POST["ferohely"] ?? "",
        "tanar_id" => $_POST["tanar_id"] ?? "",
        "csoport_id" => $_POST["csoport_id"] ?? "",
    ];
    /*
    $postId = $_POST["id"] ?? "";
    $postNev = $_POST["name"] ?? "";
    $postEmail = $_POST["email"] ?? "";
    $postTelefon = $_POST["telefon"] ?? "";
    $postTelepulesId = $_POST["telepules_id"] ?? "";
    */
    $postSend = $_POST["save"] ?? "default";
    $postNew = $_POST["new"] ?? "default";

    if ($postSend == "") {
        csoportUpdate($postAdat);
    } elseif ($postNew == "") {
        csoportInsert($postAdat);
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
    $csoportAdat = [
        "id" => "",
        "nev" => "",
        "email" => "",
        "datum" => "",
        "terem_id" => "",
        "orasorszam" => "",
        "tanar_id" => "",
        "targy_id" => "",
        "csoport_id" => "",
        "ferohely" => "",
    ];
    $diakAdat = [["diak_nev" => "", "telepules_nev" => ""]];
    if (isset($_GET["action"]) && $_GET["action"] == "edit") {
        $csoportAdat = csoportAdat($_GET["id"]);
        $diakAdat = diaktListaAdat($_GET["id"]);
    }
    $szoveg = "";
    if ($diakAdat[0]["diak_nev"] != "") {
        foreach ($diakAdat as $diak) {
            $szoveg .= '<div class="col-6 p-2">' . $diak["diak_nev"] . '"(' . $diak["telepules_nev"] . ")</div>";
        }
    }
    return '
    <form method="post" action="">
        <input type="hidden" name="id" id="id" value="' .
        $csoportAdat["id"] .
        '">
        <div class="container">
            <div class="row">
                <div class="col-12">Dátum:</div>
                <div class="col-12">
                    <input type="date" name="datum" id="datum" class="from-control" value="' .
        $csoportAdat["datum"] .
        '">
                </div>
                <div class="col-12">Óra sorszáma:</div>
                <div class="col-12">
                    <input type="number" name="orasorszam" id="orasorszam" class="from-control" value="' .
        $csoportAdat["orasorszam"] .
        '">
         </div>
                <div class="col-12">Férőhely:</div>
                <div class="col-12">
                    <input type="number" name="ferohely" id="ferohely" class="from-control" value="' .
        $csoportAdat["ferohely"] .
        '">
        </div>
                <div class="col-12">Tanár:</div>
                <div class="col-12">
                    ' .
        telepulesSelect($csoportAdat["tanar_id"], "tanar") .
        '
        </div>
                <div class="col-12">Tárgy:</div>
                <div class="col-12">
                    ' .
        telepulesSelect($csoportAdat["targy_id"], "targy") .
        '
        </div>
                <div class="col-12">Terem:</div>
                <div class="col-12">
                    ' .
        telepulesSelect($csoportAdat["terem_id"], "terem") .
        '
        </div>
                <div class="col-12">Csoport:</div>
                <div class="col-12">
                ' .
        telepulesSelect($csoportAdat["csoport_id"], "csoport") .
        $szoveg .
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

function telepulesSelect($id, $tabla)
{
    global $adatBazis;
    $check = $adatBazis->prepare(
        "SELECT * from $tabla
        ",
    );
    $check->execute();
    $telepulesek = $check->fetchAll(PDO::FETCH_ASSOC);
    $vissza = '<select name="' . $tabla . '_id">';
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
                <div class\"col-12 container\">
                    <div class=\"row\">
                        <div class=\"col-8\">Időpont: $egyCsoport[datum] ˇ $egyCsoport[orasorszam]. óra</div>
                        <div class=\"col-4\">Csoport: $egyCsoport[csoportNev]</div>
                        <div class=\"col-4\">Tárgy: $egyCsoport[targyNev]</div>
                        <div class=\"col-3\">Terem: $egyCsoport[teremNev]</div>
                        <div class=\"col-5\">Tanár: $egyCsoport[tanarNev]</div>
                        <div class=\"col-3\">Férőhely: $egyCsoport[ferohely]</div>
                        <div class=\"col-3\">Jelentkező: $egyCsoport[diak_darab] fő</div>
                        <div class=\"col-7\"></div>
                        <div class=\"col-2\">
                            <a class=\"text-white\" href=\"?page=$oldalPage&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil \"></i></a>
                            <a class=\"text-white\" href=\"?page=$oldalPage&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash \"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            </li>";
        } else {
            $vissza .= "<li class=\"list-group-item\">
            <div class=\"row\">
                <div class\"col-12 container\">
                    <div class=\"row\">
                        <div class=\"col-8\">Időpont: $egyCsoport[datum] ˇ $egyCsoport[orasorszam]. óra</div>
                        <div class=\"col-4\">Csoport: $egyCsoport[csoportNev]</div>
                        <div class=\"col-4\">Tárgy: $egyCsoport[targyNev]</div>
                        <div class=\"col-3\">Terem: $egyCsoport[teremNev]</div>
                        <div class=\"col-5\">Tanár: $egyCsoport[tanarNev]</div>
                        <div class=\"col-3\">Férőhely: $egyCsoport[ferohely]</div>
                        <div class=\"col-3\">Jelentkező: $egyCsoport[diak_darab] fő</div>
                        <div class=\"col-7\"></div>
                        <div class=\"col-2\">
                            <a href=\"?page=$oldalPage&action=edit&id=$egyCsoport[id]\"><i class=\"bi bi-pencil \"></i></a>
                            <a href=\"?page=$oldalPage&action=delete&id=$egyCsoport[id]\"><i class=\"bi bi-trash \"></i></a>
                        </div>
                    </div>
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
        "SELECT orak.*,
            tanar.nev as tanarNev,
            terem.nev as teremNev,
            csoport.nev as csoportNev,
            targy.nev as targyNev,
            COUNT(kapcsolo.diakid) AS diak_darab
            FROM  $tabla
            JOIN tanar ON orak.tanar_id=tanar.id
            JOIN terem ON orak.terem_id=terem.id
            JOIN csoport ON orak.csoport_id=csoport.id
            JOIN targy ON orak.targy_id=targy.id
            JOIN kapcsolo ON orak.id=kapcsolo.oraid
            GROUP BY orak.id
            ORDER BY datum
        ",
    );
    $check->execute();
    $user = $check->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function diaktListaAdat($oraID)
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
    $check->execute([$oraID]);
    $user = $check->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function csoportAdat($id)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "SELECT orak.*,
            tanar.nev as tanarNev,
            terem.nev as teremNev,
            csoport.nev as csoportNev,
            targy.nev as targyNev
            FROM  $tabla
            JOIN tanar ON orak.tanar_id=tanar.id
            JOIN terem ON orak.terem_id=terem.id
            JOIN csoport ON orak.csoport_id=csoport.id
            JOIN targy ON orak.targy_id=targy.id
            WHERE orak.id=?
        ",
    );
    $check->execute([$id]);
    $user = $check->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function csoportInsert($postAdat)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "INSERT INTO $tabla (datum, tanar_id, terem_id, csoport_id, targy_id, ferohely, orasorszam) VALUES (?, ?, ?, ?, ?, ?, ?)
        ",
    );
    $check->execute([
        $postAdat["datum"],
        $postAdat["tanar_id"],
        $postAdat["terem_id"],
        $postAdat["csoport_id"],
        $postAdat["targy_id"],
        $postAdat["ferohely"],
        $postAdat["orasorszam"],
    ]);
}

function csoportUpdate($postAdat)
{
    global $adatBazis;
    global $tabla;
    $check = $adatBazis->prepare(
        "UPDATE $tabla SET datum=?, tanar_id=?, terem_id=?, csoport_id=?, targy_id=?, ferohely=?, orasorszam=? WHERE id=?;
        ",
    );
    $check->execute([
        $postAdat["datum"],
        $postAdat["tanar_id"],
        $postAdat["terem_id"],
        $postAdat["csoport_id"],
        $postAdat["targy_id"],
        $postAdat["ferohely"],
        $postAdat["orasorszam"],
        $postAdat["id"],
    ]);
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
