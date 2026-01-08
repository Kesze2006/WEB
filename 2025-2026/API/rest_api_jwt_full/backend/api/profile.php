
<?php
require "../config.php";
require "../jwt.php";

$headers = getallheaders();
if (!isset($headers["Authorization"])) {
    http_response_code(401);
    exit();
}

$payload = verify_jwt(substr($headers["Authorization"], 7));
if (!$payload) {
    http_response_code(401);
    exit();
}

echo json_encode([
    "user" => $payload["username"],
    "uid" => $payload["uid"],
]);

