<?php
 session_start();
include("../database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
//fetch receiver Id ,session id, content, confirmation button/ attrib to insert
// print_r($_POST);
// exit();
// echo "<script>alert('Welcome Ajit')</script>";
    if(isset($_POST['validReceiver']))
    {
         $id=$_POST['receiverId'];
         $me=$_POST['me'];
         $msg=$_POST['msg'];            
            if($msg == "")
            {
                echo "<script>window.alert('type msg')</script>";
            }
            else
            {
//0 means unread        
$nsertMsg="INSERT INTO `message`(`messageContent`, `senderId`, `receiverId`, `messageDate`, `messageStatus`, `messageType`) VALUES('$msg','$me','$id',date('Y-m-d H:i:s'),'0','B')";      
// $nsertMsg="insert into message(senderId,receiverId,messageContent,messageDate,messageStatus) values('$me','$id','$msg',NOW(),'0')";
                 if(mysqli_query($conn,$nsertMsg)){
                    echo "<script>alert('Inserted')</script>";
                 }
                else{
                    echo mysqli_error($conn);                               
              }               
    }
}
    else{
         echo "sorry somthing went wrong";}

?>