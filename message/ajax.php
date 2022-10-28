  <?php
  
        session_start();
        include("../database/connection.php");
        $database="posigraph_socialplexus";
        mysqli_select_db($conn,$database);
              $me=$_POST['me'];
            if(isset($_POST['id']))
                    {
                        $id=$_POST['id'];
                        $query="select * from user where userId='$id'";
                        $users=mysqli_query($conn,$query);
                        if($users)
                        {
                            $total=mysqli_num_rows($users);
                            if($total >= 1)
                            {   
                                $validReceiver="yes";
                               
                                     
                                
//                                ORDER BY  postDate DESC LIMIT ".$postFrom.",".$postCount;
                                
                             $updateMsgStatus=mysqli_query($conn,"update message set messageStatus='1' where senderId='$id' AND receiverId='$me'");
                      
//                       select latest 5 message of $me and clicked or active chatbox's id
                           $msgQuery="(select * from message where(senderId='$me' AND receiverId='$id')OR(receiverId='$me' AND senderId='$id') ORDER BY messageDate DESC LIMIT 0,5) Order By messageDate;
";

                           $chat=mysqli_query($conn,$msgQuery);
                            if($chat)
                            {
                                    
                                while($row=mysqli_fetch_array($chat))
                                {
                                        $senderId=$row['senderId'];
                                        $receiverId=$row['receiverId'];
                                        $messageContent=$row['messageContent'];
                                   $messageDate=date('F j,Y,g:i a',strtotime($row['messageDate']));

                                     if($senderId ==$me and $receiverId==$id)
                                     {
                                         
                                         echo "
                                               <div class='chat self'>
                                                   <div class='user-photo'> 
                                                     
                                                   </div>
                                                    <p class='chat-message'>$messageContent</p>
                                                 </div>

                                                  <span style='color:blue;font-size:12px;'>$messageDate</span>
                                                 <br><br>
                                              ";
                                     }
                                     if($senderId ==$id and $receiverId==$me)
                                     {
                                         echo"
                                            <div class='chat friend'>
                                               <div class='user-photo'> 
                                                     
                                                   </div>
                                                <p class='chat-message'>$messageContent</p>
                                            </div>
                                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  
                                             <span style='color:blue;font-size:12px;'>$messageDate</span>                         <br><br>                 
                                          ";

                                     }

                           
                        
                               }   
                       }
                                
      }}}
else
      echo " <script>window.alert('no id')</script>";


?>