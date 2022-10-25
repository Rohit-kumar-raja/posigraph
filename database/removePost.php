<?php

if(isset($_POST['remove']))
{
    include("connection.php");
     $database="posigraph_socialplexus";
        mysqli_select_db($conn,$database);
       
    removePost($_POST['pid'],$_POST['userId']);
}
else
    echo "not deleted";
function removePost($pid,$userId)
{
    global $conn;
    
    $query="delete from posts where postId='$pid' AND userId='$userId'";
    if(mysqli_query($conn,$query))
    {
          removeLike($pid);
         removeComment($pid);
         removeNotif($pid);
    }
}
function removeLike($pid)
{
     global $conn;
    
    $query="delete from likes where postId='$pid'";
    mysqli_query($conn,$query);
   
}
function removeComment($pid)
{
     global $conn;
    
    $query="delete from comments where postId='$pid'";
    mysqli_query($conn,$query);
   
}
function removeNotif($pid)
{
     global $conn;
    
    $query="delete from notifications where postId='$pid'";
    mysqli_query($conn,$query);
    
}

?>