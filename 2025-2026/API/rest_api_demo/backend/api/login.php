<?php
require '../config.php';
require '../db.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'] ?? '';
$password = hash('sha256', $data['password'] ?? '');

$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($result) === 1) {
    $token = bin2hex(random_bytes(32));
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    mysqli_query($conn, "UPDATE users SET token='$token', token_expiry='$expiry' WHERE username='$username'");

    echo json_encode(['token' => $token, 'expires' => $expiry]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid login']);
}
