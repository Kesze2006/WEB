<?php
//nem hasznáható mert máshogyan működik nekem!
if (isset($_POST)) {
    $postId = $_POST["id"] ?? "";
    $postNev = $_POST["name"] ?? "";
    $postSend = $_POST["save"] ?? "default";
    $postNew = $_POST["new"] ?? "default";
    if ($postSend == "") {
        tablaUpdate($postId, $postNev);
    } elseif ($postNew == "") {
        tablaInsert($postNev);
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    tablaDelete($_GET["id"]);
}

$tartalom = "";

$tartalom = szerkezet();

function cim($cim)
{
    return "<h2>$cim</h2>";
}

function szerkezet()
{
    global $oldalData;

    return '
<div class="container">
	<div class="row">' .
        cim($oldalData["cim"]) .
        '</div>
	<div class="row">
		<div class="col-6">
			' .
        tablaForm() .
        '
		</div>
		<div class="col-6">
			' .
        tablaLista() .
        '
		</div>
	</div>
</div>	
	';
}

function tablaForm()
{
    global $oldalData;

    $tablaAdat = ["id" => "", "nev" => ""];
    if (isset($_GET["action"]) && $_GET["action"] == "edit") {
        $tablaAdat = tablaAdat($_GET["id"]);
    }

    return '
	<form method="post" action="?page=' .
        $oldalData["page"] .
        '">
		<input type="hidden" name="id" id="id" value="' .
        $tablaAdat["id"] .
        '">
		<div class="container">
			<div class="row">
				<div class="col-12">Név:</div>
			</div>
			<div class="row">
				<div class="col-12"><input type="text" name="name" id="name" class="form-control" value="' .
        $tablaAdat["nev"] .
        '"></div>
			</div>
			<div class="row">
				' .
        ($tablaAdat["id"] != ""
            ? '<div class="col-6 text-center"><button type="submit" class="btn btn-primary" name="save">Mentés</button></div>'
            : "") .
        '
				<div class="col-6 text-center"><button type="submit" class="btn btn-primary" name="new">Mentés újként</button></div>
			</div>
		</div>
	</form>';
}
function tablaLista()
{
    global $oldalData;

    $tablaListaAdat = tablaListaAdat();
    $aktualisId = $_GET["id"] ?? "";

    $vissza = "";
    foreach ($tablaListaAdat as $egyAdat) {
        if ($aktualisId == $egyAdat["id"]) {
            $elemClass = " active";
            $linkColor = " text-white";
        } else {
            $elemClass = "";
            $linkColor = "";
        }
        $vissza .=
            "
			<li class=\"list-group-item$elemClass\">
				$egyAdat[nev]
				<a href=\"?page=" .
            $oldalData["page"] .
            "&action=edit&id=$egyAdat[id]\" class=\"$linkColor\"><i class=\"bi bi-pencil\"></i></a>
				<a href=\"?page=" .
            $oldalData["page"] .
            "&action=delete&id=$egyAdat[id]\" class=\"$linkColor\"><i class=\"bi bi-trash\"></i></a>
			</li>";
    }

    return '
	<ul class="list-group">
		' .
        $vissza .
        '
	</ul>';
}

function tablaListaAdat()
{
    global $conn, $oldalData;

    $query = "SELECT * FROM " . $oldalData["tabla"] . " WHERE ?";
    $vissza = [];
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $szam);
        $szam = 1;

        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $vissza[] = $row;
        }
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $stmt->close();

    return $vissza;
}

function tablaAdat($id)
{
    global $conn, $oldalData;

    $query = "SELECT * FROM " . $oldalData["tabla"] . " WHERE id=?";
    $vissza = [];
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $vissza[] = $row;
        }
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $stmt->close();

    return $vissza[0];
}

function tablaInsert($nev)
{
    global $conn, $oldalData;

    $query = "INSERT INTO " . $oldalData["tabla"] . " (nev) VALUES (?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $nev);
        $stmt->execute();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $stmt->close();
}

function tablaUpdate($id, $nev)
{
    global $conn, $oldalData;

    $query = "UPDATE " . $oldalData["tabla"] . " SET nev=? WHERE id=?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("si", $nev, $id);
        $stmt->execute();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $stmt->close();
}

function tablaDelete($id)
{
    global $conn, $oldalData;

    $query = "DELETE FROM " . $oldalData["tabla"] . " WHERE id=?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    $stmt->close();
}
?>

