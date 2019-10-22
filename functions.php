<?php 
function showArray($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function redirect($data) {
header('Location: ' . $data . '.php');
}
?>