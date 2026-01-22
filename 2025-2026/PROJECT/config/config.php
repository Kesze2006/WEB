<?php
$json = file_get_contents("php://input");
$data = json_decode($json, true);
return [
    "db_szerver" => "localhost",
    "db_user" => "root",
    "db_jelszo" => "",
    "db_nev" => "verzio2",
];

?>
