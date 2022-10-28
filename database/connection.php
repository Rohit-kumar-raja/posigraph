<?php



if($_SERVER['SERVER_NAME']=="localhost"){
    $conn = mysqli_connect("localhost", "root", "", "posigraph_socialplexus");
}else{
    $conn = mysqli_connect("localhost", "posigraph_socialplexus", "Posigraph@123", "posigraph_socialplexus");
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>