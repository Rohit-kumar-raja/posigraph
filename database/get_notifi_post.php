<?php
include_once("connection.php");
mysqli_select_db($conn,"posigraph_socialplexus");
$post_idd = $_GET['id'];

// function image()
// { 
    global $conn;
    global $post_idd;
    // $query="select * from  posts where userId={$_SESSION['id']}  AND type LIKE 'image%' ORDER BY postDate DESC";

    $query="SELECT * FROM `posts` where `postId`='$post_idd'";
    $image=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($image))
    {
        echo "<div class='col-6'>
                 <img src='../imagePost/{$row['postImage']}' style='width:100%; margin-bottom:20px;' class='w3-margin-bottom'>
               </div>";
    }
// }

?>