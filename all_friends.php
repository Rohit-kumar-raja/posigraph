<?php

session_start();
include("./database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

include "posi_header.php";
include "./friends/friends_slider.php";
?>
