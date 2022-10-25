<?php
session_start();
include "chat_header.php";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">

   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href="../style.css">

    <link rel="stylesheet" href="../style/emojionearea.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="../style/emojionearea.min.js"></script>
    <title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
    <style>       
    .chatbox {
        width: 500px;
        max-width: 100%;
        height: 550px;
        background: #fff;
        margin-top: 20px;
        margin-left: 60px;
        padding: 20px;
        box-shadow: -50px 5px 100px 10px #ccc;       
    }

    .chatlogs {
        padding: 10px;
        width: 100%;
        height: 290px;
        background: #fdfdfd;
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
        background: #1874fb;
    }

    .self .chat-message {
        background: red ;
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
       
        padding: 8px 20px;

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
        height: 250px;
        background: #fff;
        padding: 20px;
        box-shadow: 10px 10px 100px 10px #ccc;
        float: left;
        border-radius: 10px;
        overflow-x: hidden;
    }
    a{text-decoration:none!important;}
    .list {
        padding: 0px 20px;
        height: 250px;

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
        width: 70px;
        height: 70px;
        background: #AAA;
        border-radius: 50%;
        overflow: hidden;
    }

    .online-user-img img {
        width: 100%;
    }

    .online-user-name {
        /* float: right; */
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

  </head>
  <body>


<?php include "chat_header.php" ?>

<!-- popup modal -->
<?php //include "../posi_header.php" ?>
<!-- Modal -->
<div class="modal fade popup-modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog popup-modal-body" role="document">
    <div class="modal-content sidebar-popup-section">
      <div class="modal-header">

        <!-- <h5 class="modal-title text-center" id="exampleModalLabel">Setting</h5> -->
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->

      </div>
      <div class="modal-body">
        <a href="myData.php" class="text-center modal-links">Edit Profile</a>
        <a href="#" class="text-center modal-links">Push Notifications</a>
        <a href="friends/friends.php" class="text-center modal-links">Search For Friend</a>
        <a href="#" class="text-center modal-links">Terms of use</a>
        <a href="#" class="text-center modal-links">Help</a>
      </div>
      
      <div class="modal-footer">
        <a href="logOut.php" type="button" class="text-center">Logout</a>
        <a type="button" class="text-center" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>
<!-- end popup modal -->




    <link rel="stylesheet" href="../style/emojionearea.min.css">    
    <script src="../style/emojionearea.min.js"></script>
<body>
    <!-- Navbar on small screens -->
    <div class="container">

        <div class="" style="margin-top: 60px;margin-bottom:80px;">

            <div class="user col-sm-5 col-xs-10 " id="online-div">
                <!-- <a href="#" class="w3-bar-item w3-button w3-padding-large"></a>-->
                <!-- <a href="https://posigraph.com/app/posigraph/message/broadcastMsg.php"><button type="button"
                        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;Group Message</button></a> -->

                <!-- <a href="https://posigraph.com/app/posigraph/message/chatApp.php"><button type="button"
                        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;Private Message</button></a> -->
                <center>
                    <h3>People in your Posigraph</h3>
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
                        <h4 id="name" style="color:black;"></h4>
                    </div>
                </div>
                <div class="chatlogs">

                    <!--  presentation container that hold both chat box   -->
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
                    <textarea id="msg" name="msg" placeholder="Chat with us"></textarea>
                    <button id="send" name="sumbit" value="send" style="float:right" class="btn btn-danger">Send</button>
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
        window.open('https://posigraph.com/app/posigraph/search.php?a=' + v, '_self')

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