<?php
//user interface will be same as chatApp.php only difference is that a check box will be in all friend list div to select multiple user and when send buttin is click siply submit the form using serialize method if jqyery
?>
<?php
session_start();
include("../database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);
$me=$_SESSION['id'];
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
    <title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
    <style>
/*
    
        *{
            margin: 0;
            padding: 0;
            font-family:tahoma sans-serif;
            box-sizing: border-box;
        }
*/
        body
        {
            background:#323232;
/*            margin-top:50px;*/
            
        
        }
      
        .chatbox
        {
            width: 500px;
            max-width: 360px;
            height: 550px;
            background:gray;
            margin-top: 20px;
             margin-left:60px;
            padding: 20px;
           box-shadow: -50px 5px 100px 10px #ccc;
            border-bottom-right-radius: 50px; 
            border-top-left-radius: 50px;
           
            
        }
        .chatlogs
        {
            padding: 10px;
            width: 100%;
            height: 400px;
            background: #EEE;
            overflow-x: hidden;
            overflow-y: scroll;
        }
        .chatlogs::-webkit-scrollbar
        {
            width: 10px;
        }
         .chatlogs::-webkit-scrollbar-thumb
        {
            border-radius: 5px;
            background: rgba(0,0,0,.1);
        }
        
        .chat
        {
            display: flex;
            flex-flow: row wrap;
            align-items: flex-start;
            margin-bottom: 10px;    
        }
        .chat .user-photo
        {
            width: 60px;
            height: 60px;
            background: #AAA;
            border-radius: 50%;
            overflow: hidden;
            visibility: hidden;
        }
        .chat .user-photo img
        {
            width: 100%;
        }
        .chat .chat-message
        {
            width: 100%;
            padding: 15px;
            margin: 5px 10px 0;
            
            border-radius: 10px;
               color: white;
            font-size: 18px;
        }
        .friend .chat-message
        {
            background: #1adda4;
        }
         .self .chat-message
        {
            background:#1ddced;
            order: -1;
        }
        .chat-form
        {
            margin-top: 15px;
            display: flex;
            align-items: flex-start;
        }
        .chat-form textarea
        {
         background:#fbfbfb;
            width: 75%;
            max-height:55px;
            border: 2px solid #eee;
            border-radius: 5px;
            resize: none;
            padding: 10px;
            font-size: 17px;
            color: #333;
        }
        .chat-form textarea:focus
        {
            background: #fff;
        }
        .chat-form button
        {
            background:cadetblue;
            padding: 8px 20px;
            color:black;
            font-size: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
           margin: 0 10px;
        }
         .chat-form button:hover,#send:hover
        { background:grey;
        }
     .user
        {
            margin-top: 20;
            margin-left: 10px;
            height: 550px;
            background:cadetblue;
            padding: 20px;
            box-shadow: 10px 10px 100px 10px #ccc;
            float: left;
            border-radius: 10px;
           
             
        }
      
       .list
        {
           padding: 20px;
            height: 400px;
           
             overflow-x: hidden;
            overflow-y: scroll;
        }
          .list::-webkit-scrollbar
        {
            width: 10px;
        }
         .list::-webkit-scrollbar-thumb
        {
            border-radius: 5px;
            background: rgba(0,0,0,.1);
        }
        
        .online-user-img
        {
             width: 40px;
            height: 40px;
            background: #AAA;
            border-radius: 50%;
            overflow: hidden;
        }
        .online-user-img img
        {
           width: 100%;
        }
        .online-user-name
        {
            float: right;
        }
        .chat-with-user{
            width:100%;
/*            background:red;*/
            height:50px;
        }
       .chat-with-user .user-photo{
             width: 50px;
            height: 50px;
            background: #AAA;
            border-radius: 50%;
            overflow: hidden;
        }
       .chat-with-user .chat-name
        {
             width:80%;
            height:30px;
            margin-left:10px;
            float:left;
            overflow:hidden;
        }
    
    </style>
    
</head>
<body >
    
    
<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button  w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>
     
     </a>
   
     <a href="https://posigraph.com/app/posigraph/home.php" class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
     
     
  <input type="text" placeholder="search"  style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">
     
    <button class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
    </button>
     
     


     
  <a href="https://posigraph.com/app/posigraph/message/chatApp.php" class="w3-bar-item w3-button  w3-padding-large w3-hide-small w3-hover-white" title="Messages"><i class="fa fa-envelope"></i><span class="w3-badge w3-right w3-small w3-green">10</span></a>
     
     
         <a href="https://posigraph.com/app/posigraph/friends/friends.php" class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white" title="friends"><i class="fa fa-users" aria-hidden="true"></i>
        </a>
    
    
     
  <div class="w3-dropdown-hover">
      
    <button class="w3-button w3-padding-large" title="Notifications">
        <i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">4</span> </button>  
      
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
            
        
       </div>
      
     
  </div>
   
  <a href="https://posigraph.com/app/posigraph/myData.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
  <img src="dp/<?php echo $user['dp'];?>" class="w3-circle" style="height:23px;width:23px" alt="dp">
  </a>
     <a href="logOut.php" class="w3-bar-item w3-button w3-hide-medium  w3-hide-small w3-right w3-padding-large w3-hover-white" title="logOut"><i class="fa fa-power-off" aria-hidden="true"></i>
</a>
 </div>
</div>

<!--    ----------------------    -->
    
    
<!-- Navbar on small screens -->
<div  id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-large">
    <br>
    <br>
    <br>
  <a href="https://posigraph.com/app/posigraph/home.php" class="w3-bar-item w3-button w3-padding-large "><i class="fa fa-home" aria-hidden="true"></i></a>
    
  <a href="https://posigraph.com/app/posigraph/message/chatApp.php" class="w3-bar-item  w3-hide-medium w3-button w3-padding-large"><i class="fa fa-envelope"></i><span class="w3-badge w3-small w3-green" >10</span></a>
    
  <a href="https://posigraph.com/app/posigraph/friends/friends.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-users" aria-hidden="true"></i></a>
    
    <a href="#" class="w3-bar-item w3-button w3-padding-large">My Post</a>
    
    <a href="https://posigraph.com/app/posigraph/myData.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-cogs" aria-hidden="true"></i>
</a>
    
    <a href="https://posigraph.com/app/posigraph/logOut.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-power-off" aria-hidden="true"></i>
</a>
</div>
    
<div class="container" >
    
    
    <div class="row"style=" margin-top:35px;">
        
        <div class="user col-sm-5 col-xs-10 " id="online-div">
            <a href="https://posigraph.com/app/posigraph/message/broadcastMsg.php"><button  type="button" class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;broadcast</button></a>
            
             <a href="https://posigraph.com/app/posigraph/message/chatApp.php"><button  type="button" class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"> &nbsp;private Message</button></a>
           <center>   <h1>Online</h1> <hr>  </center>

              
            
             <div class="list" id="all friends">
<!--            ajax online users incllude page-->
<!--               php code to all user to receieve vroadcast msg-->
                 <?php include("broadcastUser.php");?>
            
            </div>   
        
       
            
            
            
        </div>
       
        
        <div class="chatbox "  style="float:right;">
            <div  class="chat-with-user" style="">
              <div  class="user-photo" style="float:left;">
                <img id="chat-photo" style='width:100%'>
                </div>
                <div class="chat-name"><h4 id="name" style="color:white"></h4></div>
            </div>
            <div class="chatlogs">
                
    <!--     presentation container that hold both chat box   -->
             
        </div>    <!-- presentation container ends here that hold both chat box   -->
        
        <div class="chat-form">   <!-- second row of chatbox div -->
        
            
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
 var empty=$("#msg").emojioneArea();

        $("#msg").emojioneArea({
            pickerPosition:"top",

            
        });
        
        var d= setTimeout(bottom, 2000);
   $(document).ready(function(){
       ajax();
   })
        function ajax()
        {
//           load broadcast messages only when document is ready i.e first
            var loadChat = new FormData();
                         loadChat.append("me",<?php echo $_SESSION['id']?>);
                          $.ajax({
                              method: 'post',
                              url :"../database/loadBroadcastMsg.php",
                              cache:false,
                              data :loadChat,
                              contentType : false,
                              processData : false,
                              success : function(result){
//                                appned chat list in div
                                  $(".chatlogs").html(result);
                                                        
                              }
                          });
                        
        }
                                          
        $("#send").click(function(){
          var message=$("#msg").val();
//            window.alert(message);
//           send only form useing serialize method
//            load only broad casted msg of my msg type='1' means broad cst in msg table(add col)
            if(message=="")
                {
                   window.alert("please wrtite msg"); 
                }
            else{
            $.ajax({
            
             
                url:"broadcastAjaxa.php",
                method:"POST",
                data:$("input,textarea").serialize(),
                    success : function(result){
                        if(result=="0")
                              window.alert("please select receivers!"); 
                        else{
                                                    
                         empty[0].emojioneArea.setText('');
                         $(".chatlogs").append(result);}
                        bottom();
                    }
                 })
          }
        });

        
        
        function bottom()
        {
//            window.alert("hello");
            document.getElementsByClassName("chatlogs")[0].scrollTo(0,9999999);
        }
       
        
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
    
    
    
    
    
    </script>
   
    
</html>

