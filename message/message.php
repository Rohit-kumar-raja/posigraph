<?php
session_start();
include("../database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
?>
<!DOCTYPE html>
<html>

<head>

<title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
html,
body,
h1,
h2,
h3,
h4,
h5 {
    font-family: "Open Sans", sans-serif
}

.main-section {
    border: 1px solid #000;
    width: 100%;
}

.left-sidebar {
    background-color: #323232;
    padding: 0px;
}

.chat-left-img,
.chat-left-detail {
    float: left;
}

.left-chat {
    overflow: scroll;
    height: 90vh;
}

.left-chat ul {
    overflow: hidden;
    padding: 0px;


}

.left-chat ul li {
    list-style: none;
    width: 100%;
    float: left;
    margin: 10px 0px 8px 15px;
}

.chat-left-img img {
    widows: 15px;
    height: 50px;
    border-radius: 50%;
    text-align: left;
    float: fixed;
    border: 3px solid #686F79;
}

.chat-left-details {
    margin-left: 10px;
}

.chat-left-details p {
    margin: 0px;
    color: #fff;
    padding: 7px 0px 0px;
}


.right-sidebar {
    border-left: 2px solid #000;
}

.right-header {
    border-bottom: 2px solid #000;
    padding: 0px;
    margin: 0px;
}

.right-header-img img {
    width: 50px;
    height: 50px;
    float: left;
    border-radius: 50%;
    border: 3px solid #61BC71;
    margin-right: 10px;

}

.right-header {

    padding: 20px;
    height: 80px;
    background-color: #3A3A3A;
}

.right-header-detail p {
    margin: 0px;
    color: #fff;
    font-weight: bold;
    padding-top: 5px;
}

.right-header-detail span {
    color: #9FA5AF;
    font-size: 12px;
}

.rightside-left-chat,
.rightside-right-chat {
    float: left;
    width: 80%;
    position: relative;
}

.rightside-right-chat {
    float: right;
    margin-right: 35px;
}

.right-header-contentChat {
    overflow-y: scroll;
    background-color: #FFFFFF;
    position: relative;

}

.right-header-contentChat ul li {
    list-style: none;
    margin-top: 20px;
}

.right-header-contentChat .rightside-left-chat p,
.right-header-contentChat .rightside-right-chat p {
    background-color: #86BB71;
    padding: 15px;
    border-radius: 10px;
    color: #fff;
}

.right-header-contentChat .rightside-right-chat p {
    background-color: #94C2ED;
}

.right-chat-textbox {
    padding: 15px 30px;
    width: 100%;
    background-color: aquamarine;

}

.right-chat-textbox input {
    width: 80%;
    height: 40px;
    border-radius: 5px;
    padding: 0px 10px;
    outline: none;

}

.right-chat-textbox button {
    height: 40px;
    width: 70px;

}
</style>

<body class="w3-theme-l5">

    <!-- Navbar -->
    <!--    ------------------------   -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
                href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>

            </a>

            <a href="#" class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i
                    class="fa fa-home w3-margin-right"></i>Logo</a>


            <input type="text" placeholder="search"
                style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">

            <button class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
            </button>


            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i
                    class="fa fa-globe"></i></a>

            <a href="logOut.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white"
                title="Account Settings"><i class="fa fa-id-card" aria-hidden="true"></i>
            </a>

            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i
                    class="fa fa-envelope"></i><span class="w3-badge w3-right w3-small w3-green">10</span></a>


            <a href="#" class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white"
                title="friends"><i class="fa fa-users" aria-hidden="true"></i>
            </a>


            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
                title="Messages">live</a>

            <div class="w3-dropdown-hover w3-hide-small">

                <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span
                        class="w3-badge w3-right w3-small w3-green">4</span></button>

                <!--      notification drop down-->

                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="overflow:scroll;height:300px;">

                    <a href="#" class="w3-bar-item w3-button">One new friend request</a>
                    <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
                    <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
                    <a href="#" class="w3-bar-item w3-button">me</a>
                    <a href="#" class="w3-bar-item w3-button">One new friend request</a>
                    <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
                    <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
                    <a href="#" class="w3-bar-item w3-button">me</a>
                    <a href="#" class="w3-bar-item w3-button">rahul</a>

                    <a href="#" class="w3-bar-item w3-button">One new friend request</a>
                    <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
                    <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
                    <a href="#" class="w3-bar-item w3-button">me</a>

                    <a href="#" class="w3-bar-item w3-button">One new friend request</a>
                    <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
                    <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
                    <a href="#" class="w3-bar-item w3-button">me</a>
                </div>


            </div>

            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="My Account">
                <!--   right corner of menubar <img src="/w3images/avatar2.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">-->
                <?php echo $_SESSION['name']?>
            </a>
        </div>
    </div>

    <!--    ----------------------    -->


    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
    </div>




    <div class="container main-section" style="margin-top:50px">

        <div class="row">

            <!--left div -->
            <div class="col-md-4 col-sm-4 col-xs-12 left-sidebar">


                <div class="left-chat">
                    <!--online user list-->
                    <ul>
                        <?php include("getUserData.php");?>

                    </ul>
                </div>
            </div>
            <!--         lef div ends here   -->

            <!--            right col for chat data-->
            <div class="col-md-8 col-sm-8 col-xs-12 right-sidebar">

                <div id="r1" class="row">
                    <!--              loged In user data  or user session data   its enough  profile pic -->
                    <?php
                         $me=$_SESSION['id'];
                         $myName=$_SESSION['name'];
                       


                       ?>

                    <!--                   1st col of right  row col-->
                    <div class="col-md-12 right-header">

                        <div class="right-header-img">

                            <img src="../proImg/user.png">

                        </div>

                        <div class="right-header-detail">
                            <!--                              fetch username dp and total unread msg-->
                            <p><?php echo $_GET['id']?></p>
                            <span>total unread 5</span>

                        </div>

                        <!--                   close div of  1st col of right  row col-->
                    </div>






                    <!--            ensd of right col "row"-->

                </div>

                <!--                second row-->
                <div id="row r2" class="col-md-12 right-header-msg">




                    <div id="scroll_to_bottom" class="col-md-12 right-header-contentChat">


                        <?php
                      
                    // get user details when a button is clicked on online or 'on list name'  based on userId in url
                    if(isset($_GET['id']))
                    {
                        $id=$_GET['id'];
                        $query="select * from user where userId='$id'";
                        $users=mysqli_query($conn,$query);
                        if($users)
                        {
                            $total=mysqli_num_rows($users);
                            if($total >= 1)
                            {   
                                $validReceiver="yes";
                                $row=mysqli_fetch_array($users);
                                 $dp=$row['dp'];
                                 $name=$row['firstName'];
                                
                             $updateMsgStatus=mysqli_query($conn,"update message set messageStatus='1' where senderId='$id' AND receiverId='$me'");
                      
//                       select all message of $me and clicked or active chatbox's id
                           $msgQuery="select * from message where(senderId='$me' AND receiverId='$id')OR(receiverId='$me' AND senderId='$id') ORDER BY messageDate ASC";

                               $chat=mysqli_query($conn,$msgQuery);
                                if($chat)
                                {
//                                    
                                    while($row=mysqli_fetch_array($chat))
                                    {
                                        $senderId=$row['senderId'];
                                        $receiverId=$row['receiverId'];
                                        $messageContent=$row['messageContent'];
                                        $messageDate=$row['messageDate'];
//                                        echo " ".$senderId." ".$receiverId." ". $messageContent." ".$messageDate ."<br>";
                                        
                          ?>
                        <ul>
                            <!--                       pmg present start            -->
                            <?php
                                 if($senderId ==$me and $receiverId==$id)
                                 {
                                     echo "
                                     <li>
                                        <div class='rightside-right-chat sent'>
                                          <span>$myName <small>$messageDate</small></span>
                                          <br>
                                          <p>$messageContent</p>
                                          
                                        </div>
                                     </li>
                                      ";
//                         echo " ".$senderId." ".$receiverId." ". $messageContent." ".$messageDate;
                                 }
                                 if($senderId ==$id and $receiverId==$me)
                                 {
                                     echo"
                                     <li>
                                        <div class='rightside-left-chat received'>
                                          <span>$name <small>$messageDate</small></span>
                                        
                                          <br>
                                          <p>$messageContent</p>
                                          
                                        </div>
                                     </li>
                                      ";
                                     
                                 }

                              ?>
                        </ul>

                        <!--                      msg present ends here-->

                        <?php
                                }// while clise
                                    
                                } // if of $chat close
                                else  // else of if(chat)
                                    echo mysqli_error($conn);
                                             
                                
                            }
                            
//                            send or fecth msg from text box nd insert into database from here only
                        }
                        else
                            echo mysqli_error($conn);
                        
                    }
                              
                            
                      
                      ?>


                    </div>



                    <!--                  second row ends here-->
                </div>

                <!--                3rd row start here for msg write  text box-->
                <div class="row">

                    <div class="col-md-12 right-chat-textbox">

                        <form method="post">

                            <input type="text" autocomplete="off" name="msg" placeholder=" send..">
                            <button class="btn" name="submit">Send</button>

                        </form>

                    </div>̥

                    <!--                3rd row ends here-->
                </div>



                <!--            right col ends here-->
            </div>





            <!--        end of most outer row    -->
        </div>


        <!--    end of container-->
    </div>

    <?php
    
    if(isset($_POST['submit']))
    {
        global $id,$validReceiver;
        if($validReceiver=="yes")
        {
            
            $msg= htmlentities($_POST['msg']);
            
            if($msg=="")
            {
                echo "<script>window.alert('type msg')</script>";
    //            set focous on text box to type msg
            }
            else
            {
    //            use ajax to inser msg 
                 echo " <script>window.alert('$validReceiver')</script>";
                
                $nsertMsg="insert into message(senderId,receiverId,messageContent,messageDate,messageStatus) values('$me','$id','$msg',NOW(),'0')";
                 if(mysqli_query($conn,$nsertMsg)){
                      echo "<script>window.alert('msg inserted')</script>";
                 }
                else
                    echo mysqli_error($conn);
                
                
             
              }
            }
        else
            echo "<script>window.alert('sorry')</script>";
            
    }
    ?>
</body>
<script>
// Accordion
</script>

</html>