<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
define("JWT_SECRET", "nagyon_titkos_kulcs_123");

function create_jwt($payload)
{
    $header = base64_encode(json_encode(["alg" => "HS256", "typ" => "JWT"]));
    $body = base64_encode(json_encode($payload));

    $signature = hash_hmac("sha256", "$header.$body", JWT_SECRET, true);

    return "$header.$body" . base64_encode($signature);
}
