
<?php
require "../config.php";
require "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$username = trim($data["username"] ?? "");
$password = $data["password"] ?? "";

if (strlen($username) < 3 || strlen($password) < 4) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid data"]);
    exit();
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$q = mysqli_prepare($conn, "INSERT INTO users(username,password) VALUES (?,?)");
mysqli_stmt_bind_param($q, "ss", $username, $hash);

if (!mysqli_stmt_execute($q)) {
    http_response_code(409);
    echo json_encode(["error" => "User exists"]);
    exit();
}

echo json_encode(["success" => true]);

