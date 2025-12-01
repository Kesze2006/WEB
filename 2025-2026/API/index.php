<?php
include_once "../PHP/fugvenyek.php";
mysqli_report(MYSQLI_REPORT_OFF);
if (isset($_GET["path"])) {
    $apiParts = explode("/", $_GET["path"]);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "todolist";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($apiParts[0] == "todo") {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $query = "SELECT id, szoveg, datum, vege FROM todo";
            $result = $conn->query($query);
            $jsonTomb = [];
            while ($row = $result->fetch_assoc()) {
                $jsonTomb[] = $row;
            }
            $conn->close();
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);
            if (isset($data["memberid"])) {
                $query =
                    "INSERT INTO todo (szoveg, datum) VALUES ('" .
                    $conn->real_escape_string($data["feladat"]) .
                    "',now());";
                $jsonTomb = [];
                if ($conn->query($query) === false) {
                    $jsonTomb["statusz"] = "error";
                    $jsonTomb["errorMessage"] = $conn->error;
                } else {
                    $jsonTomb["statusz"] = "succes";
                }
                //echo $query;
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);
            if (isset($data["memberid"])) {
                $query = "DELETE FROM todo WHERE id='" . $conn->real_escape_string($data["id"]) . "'";
                $jsonTomb = [];
                if ($conn->query($query) === false) {
                    $jsonTomb["statusz"] = "error";
                    $jsonTomb["errorMessage"] = $conn->error;
                } else {
                    $jsonTomb["statusz"] = "succes";
                }
            }
        }
        $json = json_encode($jsonTomb);
        echo $json;
    }
} else {
     ?> 
<h3>API help</h3>
<?php
} ?>
