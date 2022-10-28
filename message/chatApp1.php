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
    <link rel="stylesheet" href="../style/emojionearea.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="../style/emojionearea.min.js"></script>

    <style>
    .chatbox {
        width: 500px;
        max-width: 100%;
        height: 550px;
        background: #fff;
        margin-top: 20px;
        margin-left: 15px;
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
        background: #0088a9;
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
        /* margin-top: 20; */
        /* margin-left: 10px; */
        /* height: 250px; */
        background: #fff;
        padding: 20px;
        /* box-shadow: 10px 10px 100px 10px #ccc; */
        float: left;
        border-radius: 10px;
        overflow-x: hidden;
    }

    a {
        text-decoration: none !important;
    }

    .list {
        margin-top: 20px;
    margin-bottom: 50px;
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
        width: 60px;
        height: 60px;
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

<body>

    <div class="container">

        <div class="row" style=" margin-top:35px;">

            <div class="user col-sm-12 col-xs-12" id="online-div">
                <!-- <a href="#" class="w3-bar-item w3-button w3-padding-large"></a>-->
                <!-- <a href="http://localhost/posigraph_new/message/broadcastMsg.php"><button type="button"
                        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;broadcast</button></a>

                <a href="http://localhost/posigraph_new/message/chatApp.php"><button type="button"
                        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;private Message</button></a> -->
                <center>
                    <h1 class="text-left" style="font-size: 15px;
    margin-top: 20px;
    font-weight: 600;">Recent Chats</h1>
                    <!-- <hr> -->
                </center>


                <div class="list" id="all friends">
                    <!--ajax online users incllude page-->
                    <?php include("getUserData.php");?>
                </div>
            </div>



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