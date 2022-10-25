<?php
//these fucntion woul be called throuhj ajaxa and can also be included in two placess get post and getmore post page for checking my post and als total getting total likes

include_once("connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

if(isset($_POST['dislike-btn'])&&isset($_POST['me'])&&isset($_POST['pid']))
{
    $me=$_POST['me'];
    $name=$_POST['name'];
    $pid=$_POST['pid'];
    $check=mydisLike($pid,$me);
    if($check)
    {
//        if alreay liked the remove like echo yes for changing the color of like icon in output
        
        deletedisLike($pid,$me);
         echo "yes";// for jquesry becoz return statement of php wont reflect in javascript(ajax) only   echo reflect the result in jaxa
    }
      
    else
    {
//     if user dint like then add a like & echo no for changing the color of like icon in output
        insertdisLike($pid,$me,$name);
         echo "no";
    }
       
}

if(isset($_POST['totaldisLikes'])&&isset($_POST['pid']))
{
    $pid=$_POST['pid'];
    totaldisLike($pid);
}





function mydisLike($pid,$userId)
{

  global $conn;
    $query="select dislikeId from dislikes where postId='$pid' AND dislikeBy='$userId'";
    $mydislike=mysqli_query($conn,$query);
   if($mydislike)
   {
       if(mysqli_num_rows($mydislike)>=1)
       {
           return true;
           
       }
       else
           return false;
       
       
   }
    else
    {
      mysqli_error($conn);
    }
        
}


function totaldisLike($pid)
{
  global $conn;
    $query="select COUNT(*) from dislikes where postId='$pid'";
    $dislikes=mysqli_query($conn,$query);
   if($dislikes)
   {
       $total=mysqli_fetch_array($dislikes);
       echo $total[0];

       return $total[0];
   }
    else
        echo"err";
}


function deletedisLike($pid,$userId)
{
    global $conn;
    $query="delete from dislikes where postId='$pid' AND dislikeBy='$userId'";
    $likes=mysqli_query($conn,$query);
    $notifFor=getdisUserId($pid);
    deletedisNotification($notifFor,$userId,"dislike",$pid);
}


function insertdisLike($pid,$userId,$name)
{
     global $conn;
    $query="insert into dislikes(postId,dislikeBy,dislikeDate) values('$pid','$userId',NOW())";
    $likes=mysqli_query($conn,$query);
    $notifFor=getdisUserId($pid);
    $msg=$name."  disliked your post";
    insertdisNotification($notifFor,$userId,"dislike",$msg,$pid);
    
     
}

function getdisUserId($pid)
{
     global $conn;
    $query="select userId from posts where postId='$pid'";
    $userId=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($userId);
    return $row['userId'];
    
}
function insertdisNotification($for,$by,$type,$msg,$pid)
{  global $conn;
    $query="insert into notifications(notificationFor,notificationBy,notificationType,notificationMessage,postId,date,notificationStatus) values('$for','$by','$type','$msg','$pid',NOW(),'new')";
    $likes=mysqli_query($conn,$query);
}


function deletedisNotification($for,$by,$type,$pid)
{  global $conn;
 
    $query="delete from notifications where notificationFor='$for' AND notificationBy='$by' AND notificationType='$type' AND postId='$pid'";
    $likes=mysqli_query($conn,$query);
}

?>