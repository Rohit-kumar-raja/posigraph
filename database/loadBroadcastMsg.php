  <?php
  
        if(isset($_POST['me']))
        {
            
        include("../database/connection.php");
        $database="posigraph_socialplexus";
        $me=$_POST['me'];
        mysqli_select_db($conn,$database);
         $msgQuery="(select * from broadcast_message where senderId='$me' ORDER BY date DESC ) Order By date;";   
            $chat=mysqli_query($conn,$msgQuery);
              if($chat)
              {
                  while($row=mysqli_fetch_array($chat))
                  {
                      $messageContent=$row['messageContent'];
                      $messageDate=date('F j,Y,g:i a',strtotime($row['date']));
                     echo"
                            <div class='chat self'>

                                <p class='chat-message'>$messageContent</p>
                             </div>
                             <p style='color:green;'><b>{$row['names']}</b></p>

                              <span style='color:blue;font-size:12px;'>$messageDate</span>
                             <br><br>"; 
                  }
              }
            else
                echo mysqli_error($conn);
        }   
?>


<!--
                                                <div class='chat self'>
                                                   <div class='user-photo'> 
                                                     
                                                   </div>
                                                    <p class='chat-message'>$messageContent</p>
                                                 </div>

                                                  <span style='color:blue;font-size:12px;'>$messageDate</span>
                                                 <br><br>
-->


<!--
 $msgQuery="(select * from message where(senderId='$me' AND receiverId='$id')OR(receiverId='$me' AND senderId='$id') ORDER BY messageDate DESC LIMIT 0,5) Order By messageDate;
";

                           $chat=mysqli_query($conn,$msgQuery);-->
<!--  $messageDate=date('F j,Y,g:i a',strtotime($row['messageDate']));-->

