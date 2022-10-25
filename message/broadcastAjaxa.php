<?php


//print_r($_POST['l']);
if(isset($_POST['brdcstRL']))
{
    include("../database/connection.php");
       mysqli_select_db($conn,"posigraph_socialplexus");
    
    $receivers[]=0;
    $names[]="";$j=0;
    $total=sizeof($_POST["brdcstRL"]);
    echo " selected \n";
//    print_r($_POST['brdcstRL']);
    for($i=0;$i<$total;$i++)
        $receivers[$i]=$_POST["brdcstRL"][$i];
    
   $allRe=implode(',', $receivers);
    $msg= $_POST["msg"];
    
    $query="select firstName from user where userId IN($allRe)";
    $result=mysqli_query($conn,$query);
    if($result)
    {
      while($row=mysqli_fetch_array($result))
      {
          $names[$j]=$row["firstName"];
          $j++;
      }
        
    }
    else
        echo mysqli_error($conn);
    
    $Names=implode(',', $names);
//    insert message,names, receivers ids  into broadcast_message  and alos inset same message into message table where receivers id =$receivers[$i] one by one ...only message type='B'(broadcats) 
    $query="insert into broadcast_message(senderId,receiverIds,messageContent,names,date) values('1','$allRe','$msg','$Names',NOW())";
    if(mysqli_query($conn,$query))
    {
         thisMessage($msg,$Names); // to dsiplya that msg is sent in chatlog <div> append
        //        now insert the same msg to all receiversId ony by one
         for($i=0;$i<$total;$i++)
         {
             sendMsg(1, $receivers[$i],$msg);
         }

       
    }
    else
         echo mysqli_error($conn);
}
else
    echo "0";


function sendMsg($sender,$receiver,$msg)
{
    global $conn;
     $nsertMsg="insert into message(senderId,receiverId,messageContent,messageDate,messageStatus,messageType) values('$sender','$receiver','$msg',NOW(),'0','B')";
                 if(mysqli_query($conn,$nsertMsg)){
                    
                 }
                else
                    echo mysqli_error($conn);
}
function thisMessage($msg,$Names)
{
    $date = date_default_timezone_set('Asia/Kolkata');

   $today = date("F j, Y, g:i a");
     echo"
            <div class='chat self'>

                <p class='chat-message'>$msg</p>
             </div>
             <p style='color:green;'><b>$Names</b></p>

              <span style='color:blue;font-size:12px;'>$today</span>
             <br><br>"; 
}
?>