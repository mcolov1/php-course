<?php
    echo time();
    $date = '2029-08-17';
    echo "<br />";
    $dateToTimestamp = strtotime($date);
    if ($dateToTimestamp < time()) {
        echo "датата е преминала";
    } else {
        echo "датата е в бъдещето";
    }
    echo "<br />";
    echo date('Y-m-d H:i:s:', time());
?>