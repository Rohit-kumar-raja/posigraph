<?php
session_start();
include("../database/connection.php");
include("../database/getMsgNotif.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
$me=$_SESSION['id'];
$user=mysqli_query($conn,"select * from user where userId='$me'");
$user=mysqli_fetch_array($user);
?>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/w3.css">
    <link rel="stylesheet" href="../style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/emojionearea.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="../style/emojionearea.min.js"></script>






    <title> message </title>
    <style>
    /*
    
        *{
            margin: 0;
            padding: 0;
            font-family:tahoma sans-serif;
            box-sizing: border-box;
        }
*/
    body {
        background: #323232;
        /*            margin-top:50px;*/


    }

    .chatbox {
        width: 500px;
        max-width: 360px;
        height: 550px;
        background: gray;
        margin-top: 20px;
        margin-left: 60px;
        padding: 20px;
        box-shadow: -50px 5px 100px 10px #ccc;
        border-bottom-right-radius: 50px;
        border-top-left-radius: 50px;


    }

    .chatlogs {
        padding: 10px;
        width: 100%;
        height: 400px;
        background: #EEE;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .chatlogs::-webkit-scrollbar {
        width: 10px;
    }

    .chatlogs::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background: rgba(0, 0, 0, .1);
    }

    .chat {
        display: flex;
        flex-flow: row wrap;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .chat .user-photo {
        width: 60px;
        height: 60px;
        background: #AAA;
        border-radius: 50%;
        overflow: hidden;
        visibility: hidden;
    }

    .chat .user-photo img {
        width: 100%;
    }

    .chat .chat-message {
        width: 70%;
        padding: 15px;
        margin: 5px 10px 0;

        border-radius: 10px;
        color: white;
        font-size: 18px;
    }

    .friend .chat-message {
        background: #1adda4;
    }

    .self .chat-message {
        background: #1ddced;
        order: -1;
    }

    .chat-form {
        margin-top: 15px;
        display: flex;
        align-items: flex-start;
    }

    .chat-form textarea {
        background: #fbfbfb;
        width: 75%;
        max-height: 55px;
        border: 2px solid #eee;
        border-radius: 5px;
        resize: none;
        padding: 10px;
        font-size: 17px;
        color: #333;
    }

    .chat-form textarea:focus {
        background: #fff;
    }

    .chat-form button {
        background: cadetblue;
        padding: 8px 20px;
        color: black;
        font-size: 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 0 10px;
    }

    .chat-form button:hover,
    #send:hover {
        background: grey;
    }

    .user {
        margin-top: 20;
        margin-left: 10px;
        height: 550px;
        background: cadetblue;
        padding: 20px;
        box-shadow: 10px 10px 100px 10px #ccc;
        float: left;
        border-radius: 10px;


    }

    .list {
        padding: 20px;
        height: 400px;

        overflow-x: hidden;
        overflow-y: scroll;
    }

    .list::-webkit-scrollbar {
        width: 10px;
    }

    .list::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background: rgba(0, 0, 0, .1);
    }

    .online-user-img {
        width: 40px;
        height: 40px;
        background: #AAA;
        border-radius: 50%;
        overflow: hidden;
    }

    .online-user-img img {
        width: 100%;
    }

    .online-user-name {
        float: right;
    }

    .chat-with-user {
        width: 100%;
        /*            background:red;*/
        height: 50px;
    }

    .chat-with-user .user-photo {
        width: 50px;
        height: 50px;
        background: #AAA;
        border-radius: 50%;
        overflow: hidden;
    }

    .chat-with-user .chat-name {
        width: 80%;
        height: 30px;
        margin-left: 10px;
        float: left;
        overflow: hidden;
    }
    </style>

</head>

<body>


    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button  w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
                href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>

            </a>

            <a href="http://localhost/posigraph_new/home.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i
                    class="fa fa-home w3-margin-right"></i>Logo</a>


            <input type="text" placeholder="search" id="srch_input"
                style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">

            <button id="srch" class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
            </button>




            <a href="http://localhost/posigraph_new/message/chatApp.php"
                class="w3-bar-item w3-button  w3-padding-large w3-hide-small w3-hover-white" title="Messages"><i
                    class="fa fa-envelope"></i><span class="w3-badge w3-right w3-small w3-green">

                    <?php
                $n=getUnreadMsg($_SESSION['id']);
                if($n>0)
                    echo $n;
                ?>

                </span></a>


            <a href="http://localhost/posigraph_new/friends/friends.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white"
                title="friends"><i class="fa fa-users" aria-hidden="true"></i>
            </a>



            <div class="w3-dropdown-hover">

                <button class="w3-button w3-padding-large" title="Notifications">
                    <i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">
                        <?php
                $n=getTotalUnseenNotif($_SESSION['id']);
                if($n>0)
                    echo $n;
                ?>
                    </span>
                </button>

                <!--      notification drop down-->

                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="overflow:scroll;height:300px;">

                    <?php getAllNotif($_SESSION['id']); ?>


                </div>


            </div>

            <a href="http://localhost/posigraph_new/myData.php"
                class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
                <img src="../dp/<?php echo $user['dp'];?>" class="w3-circle" style="height:23px;width:23px" alt="dp">
            </a>
            <a href="http://localhost/posigraph_new/logOut.php"
                class="w3-bar-item w3-button w3-hide-medium  w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="logOut"><i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <!--    ----------------------    -->


    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-large">
        <br>
        <br>
        <br>
        <a href="http://localhost/posigraph_new/home.php" class="w3-bar-item w3-button w3-padding-large "><i
                class="fa fa-home" aria-hidden="true"></i></a>

        <a href="http://localhost/posigraph_new/message/chatApp.php"
            class="w3-bar-item  w3-hide-medium w3-button w3-padding-large"><i class="fa fa-envelope"></i><span
                class="w3-badge w3-small w3-green">10</span></a>

        <a href="http://localhost/posigraph_new/friends/friends.php" class="w3-bar-item w3-button w3-padding-large"><i
                class="fa fa-users" aria-hidden="true"></i></a>

        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Post</a>

        <a href="http://localhost/posigraph_new/myData.php" class="w3-bar-item w3-button w3-padding-large"><i
                class="fa fa-cogs" aria-hidden="true"></i>
        </a>

        <a href="http://localhost/posigraph_new/logOut.php" class="w3-bar-item w3-button w3-padding-large"><i
                class="fa fa-power-off" aria-hidden="true"></i>
        </a>
    </div>

    <div class="container">


        <div class="row" style=" margin-top:35px;">

            <div class="user col-sm-5 col-xs-10 " id="online-div">
                <!-- <a href="#" class="w3-bar-item w3-button w3-padding-large"></a>-->
                <a href="http://localhost/posigraph_new/message/broadcastMsg.php"><button type="button"
                        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;broadcast</button></a>

                <a href="http://localhost/posigraph_new/message/chatApp.php"><button type="button"
                        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;private Message</button></a>
                <center>
                    <h1>Online</h1>
                    <hr>
                </center>


                <div class="list" id="all friends">
                    <!--            ajax online users incllude page-->
                    <?php include("getUserData.php");?>

                </div>





            </div>


            <div class="chatbox " style="float:right;">
                <div class="chat-with-user" style="">
                    <div class="user-photo" style="float:left;">
                        <img id="chat-photo" style='width:100%'>
                    </div>
                    <div class="chat-name">
                        <h4 id="name" style="color:white"></h4>
                    </div>
                </div>
                <div class="chatlogs">

                    <!--     presentation container that hold both chat box   -->
                    <?php
//                this php code is just for msg insertion rightly
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
                                $userId=$id;
                                $dp_Name=mysqli_fetch_array($users);
                                                               
                              echo "<script>$('#name').html('{$dp_Name['firstName']}')</script>";
                              echo"<script>$('#chat-photo').attr('src','../dp/{$dp_Name['dp']}')</script>";
                                
                            }
                            else
                            {
                                 $validReceiver="no";
                                 $userId=0;
                            }
                               
                        }}
                else
                {
                     $validReceiver="no";
                       $userId=0;
                }
                    

      ?>
                </div> <!-- presentation container ends here that hold both chat box   -->

                <div class="chat-form">
                    <!-- second row of chatbox div -->


                    <!--            <form method="post">-->
                    <!--            <textarea id="msg" name="msg"></textarea>-->
                    <textarea id="msg" name="msg"></textarea>
                    <button id="send" name="sumbit" value="send" style="float:right">send</button>
                    <!--           </form>-->

                </div>

            </div>
            <!--    row close-->
        </div>

        <!--    container close-->
    </div>


</body>


<script>
var empty = $("#msg").emojioneArea();

$("#msg").emojioneArea({
    pickerPosition: "top",


});

var d = setTimeout(bottom, 2000);

function ajax() {
    var userId = "<?php echo $userId ?>";
    if (userId != 0) {
        var loadChat = new FormData();
        loadChat.append("me", <?php echo $_SESSION['id']?>);
        loadChat.append("id", userId);
        $.ajax({
            method: 'post',
            url: "ajax.php",
            cache: false,
            data: loadChat,
            contentType: false,
            processData: false,
            success: function(result) {
                //                                appned chat list in div
                $(".chatlogs").html(result);
                $("#" + "unreadOf" + userId).html(""); // empty unread msg span

            }
        });

    }
}

$("#send").click(function() {

    var v = "<?php echo $validReceiver ?>"; // very important
    var userId = "<?php echo $userId ?>";
    if (v == "yes") {
        // prepare ajax code for msg insertion


        var msg = $("#msg").val();

        if (msg == '') {
            window.alert("write ur msg");
        } else {

            //                  $v=$("#msg").val();
            $("#disp").html(msg);
            var insertMsg = new FormData();
            insertMsg.append("me", <?php echo $_SESSION['id']?>);
            insertMsg.append("receiverId", userId);
            insertMsg.append("msg", msg);
            insertMsg.append("validReceiver", "yes");
            $.ajax({
                method: 'post',
                url: "insertMessage.php",
                cache: false,
                data: insertMsg,
                contentType: false,
                processData: false,
                success: function(result) {
                    result;


                }
            });
        }

        bottom();
        empty[0].emojioneArea.setText('');

    }
});



function bottom() {
    //            window.alert("hello");
    document.getElementsByClassName("chatlogs")[0].scrollTo(0, 9999999);
}


$(document).ready(function() {
    setInterval(function() {
        ajax()
    }, 1000);


});


function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<script>
$("#srch").click(function() {

    v = $("#srch_input").val();
    if (v == "")
        window.alert("please enter name or email")
    else
        window.open('http://localhost/posigraph_new/search.php?a=' + v, '_self')

});
</script>


</html>


<?php
    
//
//    if(isset($validReceiver))
//    {
//        
//        global $id,$validReceiver;
//        if($validReceiver=="yes")
//        {
//            
//            $msg= htmlentities($_POST['msg']);
//            
//            if($msg=="")
//            {
////                echo "<script>window.alert('type msg')</script>";
//            }
//            else
//            {
//
//                
//                $nsertMsg="insert into message(senderId,receiverId,messageContent,messageDate,messageStatus) values('$me','$id','$msg',NOW(),'0')";
//                 if(mysqli_query($conn,$nsertMsg)){
//                     
//                 }
//                else
//                    echo mysqli_error($conn);
//                
//                
//             
//              }
//            }
//        else
//            echo "<script>window.alert('sorry')</script>";
//            
//
//        
//    }
//    else
//         echo "<script>window.alert('not')</script>";
?>