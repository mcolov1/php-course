<?php 
session_start([
    'cookie_httponly' => true,
]);
$count = 0;
$count += 1;
echo $count;
echo "<br />";
$_SESSION['user'] = [
    'id' => 10,
    'username' => 'Miro',
    'first_name' => 'Miroslav',
    'last_name' => 'Tsolov'
];

?>