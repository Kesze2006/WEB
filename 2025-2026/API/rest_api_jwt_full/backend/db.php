
<?php
$conn = mysqli_connect('localhost','root','','rest_jwt');
if(!$conn){
 http_response_code(500);
 echo json_encode(['error'=>'Database error']);
 exit;
}
