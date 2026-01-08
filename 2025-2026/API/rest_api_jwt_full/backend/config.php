
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

define('JWT_SECRET', 'tanulo_jwt_kulcs_123');
define('JWT_EXPIRE', 3600);
