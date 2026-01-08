
<?php
require '../config.php';
require '../db.php';
require '../jwt.php';

$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

$q = mysqli_prepare($conn, "SELECT * FROM users WHERE username=?");
mysqli_stmt_bind_param($q, 's', $username);
mysqli_stmt_execute($q);
$res = mysqli_stmt_get_result($q);
$user = mysqli_fetch_assoc($res);

if(!$user || !password_verify($password, $user['password'])){
 http_response_code(401);
 echo json_encode(['error'=>'Invalid login']);
 exit;
}

$token = create_jwt([
 'uid'=>$user['id'],
 'username'=>$user['username'],
 'exp'=>time()+JWT_EXPIRE
]);

echo json_encode(['token'=>$token]);
