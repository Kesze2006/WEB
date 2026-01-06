<?php
$conn = mysqli_connect('localhost', 'root', '', 'rest_demo');
if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'DB connection failed']);
    exit;
}
