<?php
include_once "../PHP/fugvenyek.php";
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
        }
        $json = json_encode($jsonTomb);
        echo $json;
    }
} else {
     ?>
<h3>API help</h3>
<?php
} ?>
