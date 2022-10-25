<?php
session_start();
include("../database/connection.php");
include("../add_battle.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

if(isset($_POST['buttonName']) && isset($_POST['userId']))
{
    $me=$_SESSION['id'];
    $myName=$_SESSION['name'];
    $userId=$_POST['userId'];
    $userName=$_POST['userName'];
    $button=$_POST['buttonName'];
    switch($button)
    {
        case "request":
            request($userId,$me,$userName,$myName);
            break;
        case "requests":
            request_battle($userId,$me,$userName,$myName);
            break;
         case "cancel":
            cancel($userId,$me,$userName,$myName);
            break;
         case "accept":
            accept($userId,$me,$userName,$myName);
            break;
         case "ignore":
            ignore($userId,$me,$userName,$myName);
            break;
         case "unfriend":
            unfriend($userId,$me,$userName,$myName);
            break;
         default :
            error();
            break;
    }
}
function request($userId,$me,$userName,$myName)
{
    global $conn;
//    just do one validation that if request is alrady sent then  do not sent give a msg that already        sent .... by the way this validation is not required becz user will not be inlisted again in          all user List (do not insert data into tables if requested)
    
    $query="insert into battle(senderId,receiverId,date) values('$me','$userId',NOW())";
    
    if(mysqli_query($conn,$query))
    {
//        if requested the insert a notification in notification for UserId  
         $notifType="battle_request";
         $notifMsg=$myName." requested you battle";//change name becoz u r sending requset so put ur name
        $query="insert into notifications(notificationFor,notificationBy,notificationType,notificationMessage,date,notificationStatus) 
        values('$userId','$me','$notifType','$notifMsg',NOW(),'new')";
        
        if(mysqli_query($conn,$query))
        {
            echo "Request sent!";
        }
        else
        {
             mysqli_error($conn); 
        }


    }
    else
    {
       mysqli_error($conn); 
    }
}

function request_battle($userId,$me,$userName,$myName)
{
    global $conn;
//    just do one validation that if request is alrady sent then  do not sent give a msg that already        sent .... by the way this validation is not required becz user will not be inlisted again in          all user List (do not insert data into tables if requested)
    $query="insert into battle_request(senderId,receiverId,date) values('$me','$userId',NOW())";
    
    if(mysqli_query($conn,$query))
    {
//        if requested the insert a notification in notification for UserId  
         $notifType="battle_request";
         $notifMsg=$myName." requested you battle";//change name becoz u r sending requset so put ur name
        $query="insert into notifications(notificationFor,notificationBy,notificationType,notificationMessage,date,notificationStatus) 
        values('$userId','$me','$notifType','$notifMsg',NOW(),'new')";
        
        if(mysqli_query($conn,$query))
        {
            echo "Request sent!";
        }
        else
        {
             mysqli_error($conn); 
        }


    }
    else
    {
       mysqli_error($conn); 
    }
}


function cancel($userId,$me,$userName,$myName)
{
//    first check is there any request made by the me where requesrt receiver is userId if yes then      cancel it otherwise do not do antything ... by the way this verification is not reqd becoz cancel button will not appear whene there is no sent request ..
      global $conn;
   
    $query="delete from battle_request where senderId='$me' AND receiverId='$userId'";
    
    if(mysqli_query($conn,$query))
    {
//        also delete notification for that reqst type='request' and noficationBy=me and                        notificationFor=userId type is compulsary becoz one me can sent may notification for                 userid eg for like comment etc so both id will be repeated .. type will be diffrent
        $notifType="request";
        $query="delete from notifications where notificationFor='$userId' AND notificationBy='$me' AND notificationType='$notifType'";
        
        if(mysqli_query($conn,$query))
        {
            echo "Battle Request Canceled";
        }
        else
        {
             mysqli_error($conn); 
        }


    }
    else
    {
       mysqli_error($conn); 
    }
}




function accept($userId,$me,$userName,$myName)
{
//    insert into friends table delete , delete request from request table  also delete old                  notification and add new notification type='requested_accepted'
     global $conn;

    $query2="select * from battle_request where `senderId`='$userId' and `receiverId`='$me'";
    $nameDp2=mysqli_query($conn,$query2);
    $battle=mysqli_fetch_array($nameDp2);
    $battle_id = $battle['requestId'];
    $query="INSERT INTO `battle`(`battle_id`, `player1_id`, `player2_id`)
                            values('$battle_id','$userId','$me')";
    
    if(mysqli_query($conn,$query))
    {
       
        $query="delete from battle_request where senderId='$userId' AND receiverId='$me'";
    
        if(mysqli_query($conn,$query))
        {
     //delete old notification for this request and insert new one for same but for type='accepted'
             $notifType="request"; 
            $query="delete from notifications where notificationFor='$me' AND notificationBy='$userId' AND notificationType='$notifType'";

            if(mysqli_query($conn,$query)) // now insert new a notif for userId for acceptance
            {
             $notifType="battle_request_accepted";
             $notifMsg=$myName." accepted your request ";
             $query="insert into notifications(notificationFor,notificationBy,notificationType,notificationMessage,date,notificationStatus)   values('$userId','$me','$notifType','$notifMsg',NOW(),'new')";
             $result=mysqli_query($conn,$query);
        
            }
            
        }
        else
        {
           mysqli_error($conn); 
        }
    }
    
}

function ignore($userId,$me,$userName,$myName)
{
//  delete request and notification of same Id and type='requested'
      global $conn;
   
    $query="delete from battle_request where senderId='$userId' AND receiverId='$me'";
    
    if(mysqli_query($conn,$query))
    {
         $notifType="request";
        $query="delete from notifications where notificationFor='$me' AND notificationBy='$userId' AND notificationType='$notifType'";
        
        if(mysqli_query($conn,$query))
        {
            echo "you ignored ".$userName." battle request";
        }
        else
        {
             mysqli_error($conn); 
        }


    }
    else
    {
       mysqli_error($conn); 
    }
    
}
function unfriend($userId,$me,$userName,$myName)
{
     global $conn;
    $query="delete from friends where (userOne='$me' AND userTwo='$userId') OR (userOne='$userId' AND userTwo='$me')";
    
    if(mysqli_query($conn,$query))
    {
        echo "you removed ".$userName." from your friend list ";
    }
    
}


function error()
{
    echo "sorry something went wrng";
}
?>