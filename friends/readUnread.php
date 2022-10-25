<?php
include("../database/connection.php");
mysqli_select_db($conn,"posigraph_socialplexus");


//function getFriends($me)
//{ global $conn;
//    $i=0;
//      $friendId[]=0;
//    $query="select userOne,userTwo from friends where userOne=$me or userTwo=$me";// when i'am 1st col,get friend Id from userTwo
//     $friends=mysqli_query($conn,$query);
//    if($friends)
//    {
//     if(mysqli_num_rows($friends)>= 1)
//     {  
//           while($row=mysqli_fetch_array($friends))
//           {
//               
//                  if($row['userOne']==$me)
//                  {
//                     $friendId[$i]=$row['userTwo'];
//               
//                     $i++;
//                      $total=getUnreadMsg($me,$row['userTwo']);
//                      $user=$row['userTwo'];
//                      if($total!=0)
//                          echo"<script>$('#u{$user}').html('$total')</script>";
//                      else
//                          echo"<script>$('#u{$user}').html('')</script>";
//                          
//                        
//                  }
//                 else
//                 {
//                     $friendId[$i]=$row['userOne'];
//               
//                     $i++;
//                     $total=getUnreadMsg($me,$row['userOne']);
//                     if($total!=0)
//                          echo"<script>$('#u{$user}').html('$total')</script>";
//                      else
//                          echo"<script>$('#u{$user}').html('')</script>";
//                      
//                 }
//           }
//        
//     
//     $str =implode(',', $friendId);
//         return $str;
//     }
//        else
//            return 0;
//
//    }
// else
//      mysqli_error($conn);
// 
//}


 getUnreadMsg($me,$id);
 
 function getUnreadMsg($me,$id)
{
   global $conn;
    $query="select COUNT(*) from message where receiverId='$me' AND senderId='$id' AND messageStatus='0'";
    $unread=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($unread);
    echo $total[0];
}
?>