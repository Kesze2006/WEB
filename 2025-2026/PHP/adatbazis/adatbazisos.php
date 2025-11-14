<?php
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

$query = "SELECT adat1,adat4 from adatok";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["adat1"] . " " . $row["adat4"] . "<br>";
    }
}
$conn->close();
?>
