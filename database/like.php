<?php
//these fucntion woul be called throuhj ajaxa and can also be included in two placess get post and getmore post page for checking my post and als total getting total likes

include_once("connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

if(isset($_POST['like-btn'])&&isset($_POST['me'])&&isset($_POST['pid']))
{
    // echo "<script>alert('welcome')</script>";exit();
    $me=$_POST['me'];
    $name=$_POST['name'];
    $pid=$_POST['pid'];
    $check=myLike($pid,$me);
    if($check)
    {
//        if alreay liked the remove like echo yes for changing the color of like icon in output
        
        deleteLike($pid,$me);
         echo "yes";// for jquesry becoz return statement of php wont reflect in javascript(ajax) only   echo reflect the result in jaxa
    }
      
    else
    {
//     if user dint like then add a like & echo no for changing the color of like icon in output
        insertLike($pid,$me,$name);
         echo "no";
    }
       
}

if(isset($_POST['totalLikes'])&&isset($_POST['pid']))
{
    $pid=$_POST['pid'];
    totalLike($pid);
}





function myLike($pid,$userId)
{

  global $conn;
    $query="select likeId from likes where postId='$pid' AND likeBy='$userId'";
    $mylike=mysqli_query($conn,$query);
   if($mylike)
   {
       if(mysqli_num_rows($mylike)>=1)
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


function totalLike($pid)
{
    
  global $conn;
    $query="select COUNT(*) from likes where postId='$pid'";
    $likes=mysqli_query($conn,$query);
   if($likes)
   {
       $total=mysqli_fetch_array($likes);
       echo $total[0];
      return $total[0];
   }
    else
        return "err";
}

function deleteLike($pid,$userId)
{
    global $conn;
    $query="delete from likes where postId='$pid' AND likeBy='$userId'";
    $likes=mysqli_query($conn,$query);
    $notifFor=getUserId($pid);
    deleteNotification($notifFor,$userId,"like",$pid);
    
}
function insertLike($pid,$userId,$name)
{
     global $conn;
    $query="insert into likes(postId,likeBy,likeDate) values('$pid','$userId',NOW())";
    $likes=mysqli_query($conn,$query);
    $notifFor=getUserId($pid);
    $msg=$name."  liked your post";
    insertNotification($notifFor,$userId,"like",$msg,$pid);
    
     
}

function getUserId($pid)
{
     global $conn;
    $query="select userId from posts where postId='$pid'";
    $userId=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($userId);
    return $row['userId'];
    
}
function insertNotification($for,$by,$type,$msg,$pid)
{  global $conn;
    $query="insert into notifications(notificationFor,notificationBy,notificationType,notificationMessage,postId,date,notificationStatus) values('$for','$by','$type','$msg','$pid',NOW(),'new')";
    $likes=mysqli_query($conn,$query);
}


function deleteNotification($for,$by,$type,$pid)
{  global $conn;
 
    $query="delete from notifications where notificationFor='$for' AND notificationBy='$by' AND notificationType='$type' AND postId='$pid'";
    $likes=mysqli_query($conn,$query);
}

?>