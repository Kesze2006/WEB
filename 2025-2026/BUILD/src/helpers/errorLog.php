<?php
function errorLog($e)
{
    $fajl = fopen(__DIR__ . "/../../logs/error.log", "a");
    fwrite($fajl, "[" . date("Y-m-d H:i:s") . "] " . $e->getMessage() . "\n");
    fclose($fajl);
}
?>
