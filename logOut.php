<?php
session_start();
include "database/connection.php";
$database = "posigraph_socialplexus";


// echo($_SESSION);

$upd = "update user set logInStatus='Offline' where userId=".$_SESSION['id'];
if(mysqli_query($conn,$upd))
{
     session_destroy();
    header("location:index.php");
}
else
    echo mysqli_error($conn);
    echo "hello";
?>