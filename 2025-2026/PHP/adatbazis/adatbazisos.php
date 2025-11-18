<?php
include_once "../fugvenyek.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql);

/*$query = "INSERT INTO `adatok` (`adat1`, `adat2`, `adat3`, `adat4`) VALUES ('12', 'qweerwq', '2025-11-28', '1212')";
 $conn->query($query);*/

$query = "SELECT adatok.adat1,t2.adat1*-1 as k,t2.adat4,2*adatok.adat1 as szorzas from adatok,adatok as t2";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        d($row);
        //echo $row["adat1"] . " " . $row["adat4"] . " " . $row["szorzas"] . "<br>";
    }
}
$conn->close();
?>
