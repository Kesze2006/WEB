<?php
require '../db.php';

$headers = getallheaders();
$auth = $headers['Authorization'] ?? '';

if (!str_starts_with($auth, 'Bearer ')) {
    http_response_code(401);
    echo json_encode(['error' => 'No token']);
    exit;
}

$token = substr($auth, 7);
$result = mysqli_query($conn, "SELECT * FROM users WHERE token='$token' AND token_expiry > NOW()");

if (mysqli_num_rows($result) !== 1) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid token']);
    exit;
}

$user = mysqli_fetch_assoc($result);
