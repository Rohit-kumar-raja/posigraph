<?php
include("connection.php");
mysqli_select_db($conn,"posigraph_socialplexus");

function getUnreadMsg($id){
   global $conn;
    $query="select COUNT(*) from message where receiverId='$id' AND messageStatus='0'";
    $unread=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($unread);
    return $total[0];
}

function getTotalUnseenNotif($id){        
    global $conn;
    $query="select COUNT(*) from notifications where notificationFor='$id' AND notificationStatus='new'";
    $new=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($new);
    return $total[0];        
}

function changeNotifStatus($id){
//when user first click or click on notification button then change all new notification to old
     global $conn;
    $query="update notifications set notificationStatus='old' where notificationFor='$id' AND notificationStatus='new'";
    $update=mysqli_query($conn,$query);
    echo getTotalUnseenNotif($id); // will be called from ajxa
}

function getAllNotif($id){
//  when loading whither it is seen or not if not the change color if seen then change its color    
     global $conn;
    //  echo $id;
     $get_noti_img = mysqli_fetch_assoc(mysqli_query($conn , "select * from notifications where notificationFor='$id'"));
     $get_noti_img_id = $get_noti_img['notificationFor'];

    $get_noti_img_img1 = mysqli_fetch_assoc(mysqli_query($conn , "SELECT * FROM `user` WHERE `userId` = '$get_noti_img_id'" ));
    $my_img = $get_noti_img_img1["dp"];
    
    $query="select * from notifications where notificationFor='$id' ORDER BY date DESC";
    $all=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($all)){
      $post_idd = $row['postId'];
    //   $get_post_id = mysqli_fetch_assoc(mysqli_query($conn , "SELECT * FROM `posts` where `postId`='$post_idd'"));

      
       
        if(($row['notificationType']=='like')||($row['notificationType']=='comment')||($row['notificationType']=='dislike'))
        {
            //echo "hello1";
        // attached post id also check notif seen or not        
            if(isNotifSeen($id,$row['notificationId']))
            {
               
                echo" <a href='./database/seePost.php?notifId={$row['notificationId']}&postId={$row['postId']}' class='w3-bar-item w3-button' data-notifId='{$row['notificationId']}' data-postId='{$row['postId']}' style='background:darkGray'>{$row['notificationMessage']}</a>";
            }
            else
            {  
                echo " <div class='alert alert-success alert-dismissible show'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <img src='./dp/$my_img' style='width: 40px;
                border-radius: 100px;' />
                <a href='./database/get_notifi_post.php?id=$post_idd' class='w3-bar-item w3-button ' >{$row['notificationMessage']}</a>
              </div>";

            // this is the url
            //   <a href='./database/seePost.php?notifId={$row['notificationId']}&postId={$row['postId']}' class='w3-bar-item w3-button' data-notifId='{$row['notificationId']}' data-postId='{$row['postId']}' >{$row['notificationMessage']}</a>

                //echo" <a href='./database/seePost.php?notifId={$row['notificationId']}&postId={$row['postId']}' class='w3-bar-item w3-button' data-notifId='{$row['notificationId']}' data-postId='{$row['postId']}' style='background:gray'>{$row['notificationMessage']}</a>";
            }           
        }
        else
        {   //echo "hello2";
             if(isNotifSeen($id,$row['notificationId']))
            {
               echo" <a href='./database/get_notifi_post.php?id=$post_idd' class='w3-bar-item w3-button ' data-notifId='{$row['notificationId']}' style='background:darkGray'>{$row['notificationMessage']}</a>";
            }
            else
            {
                //echo" <a href='#' class='w3-bar-item w3-button ' data-notifId='{$row['notificationId']}' style='background:gray'>{$row['notificationMessage']}</a>";
                echo " <div class='alert alert-success alert-dismissible show'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <img src='./dp/$my_img' style='width: 40px;
                border-radius: 100px;' />
                <a href='./database/get_notifi_post.php?id=$post_idd' class='w3-bar-item w3-button ' >{$row['notificationMessage']}</a>
              </div>";
            }       
        }                
    }           
}

function insertNotifIntoSeen($id,$notifId){
//   Ajax 
//    before inserting notification check already inserted or not call is notifSeeen ii it returns true means already inserted , do not insert more
}


function isNotifSeen($id,$notifId){
    global $conn;
    $query="select COUNT(*) from notifications_seen where seenBy='$id' AND notificationId='$notifId'";
    $result=mysqli_query($conn,$query);
    $total=mysqli_fetch_array($result);
    if($total[0]>=1)
        return true;
    else
        return false;
}




//function getUnreadMsgOfAFriend($id,$freind)
//{
//    // define this fucntion in chatApp.php and count how many msg of a friend is unred then show it on online div
//}

//function changeMsgToRead($id,$friendId)
//{
////    change all msg of friendId to read when userClick on send button or namebutton to load the msg into chatDiv
//}
//first insertion then redirection in notif seen case and check point

?>