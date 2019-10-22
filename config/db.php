<?php
$server = 'localhost';
$dbName = 'smartphones';
$userPass = 'admin';
$user = 'admin_phones';

$conn = mysqli_connect($server, $user, $userPass, $dbName);

if (!$conn) {
    die('Db failed');
}
mysqli_set_charset($conn, 'utf8');









?>