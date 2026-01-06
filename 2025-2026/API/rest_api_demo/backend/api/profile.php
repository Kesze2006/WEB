<?php
require 'auth.php';

echo json_encode([
    'username' => $user['username'],
    'message' => 'Sikeres tokenes elérés'
]);
