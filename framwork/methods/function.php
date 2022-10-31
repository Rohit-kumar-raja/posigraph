<?php

function url($url)
{
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        return '127.0.0.1' . "/asha_admin/" . $url;
    } else {
        return $_SERVER['HTTP_HOST'] . $url;
    }
}
// added new
?>

