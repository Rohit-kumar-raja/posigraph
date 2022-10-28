<?php 
    session_start();

     include("showUsers-old.php");

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

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <style>
    .all-user {
        height: 590px;
        /* background: red; */
    }

    .new-user {
        height: 280px;
        /* background: cyan; */
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .requested-user {
        height: 300px;
        /* background: green; */
        overflow-x: hidden;
        overflow-y: scroll;
        margin-top: 5px;
        box-shadow: -1px 10px 100px 5px green;
        border-radius: 15px;
    }

    .known-user {
        height: 590px;
        /*            background:green;*/
    }

    .known-user .request-list {
        height: 275px;
        /*            background: pink;*/
        overflow-x: hidden;
        overflow-y: scroll;
        box-shadow: -1px 10px 100px 5px gray;
    }

    .known-user .friend-list {
        height: 300px;
        background: gray;
        overflow-x: hidden;
        overflow-y: scroll;
        margin-top: 10px;
        box-shadow: -1px 10px 100px 5px green;
        border-radius: 10px;
    }

    .user-detail {
        height: auto;
        /*        background:aqua;*/
        margin: 5px;
        padding: 0;
    }

    .user-pic img {
        height: 90px;
        width: 90px;
    }

    .user-detail .user-name-buttons {
        margin-top: 5px;
    }

    .user-detail .user-name-buttons p {
        font-size: 20px;
        font-family: cursive;
    }

    .user-detail .user-name-buttons button {
        width: 100px;
        padding: 4 10px;
        font-size: 15px;
        outline: none;
        border: none;
        border-radius: 5px;
    }

    .friend-pic {
        height: 90px;
        width: 90px;
        overflow: hidden;
        border-radius: 50%;
    }

    .friend-pic img {
        width: 100%;
    }
    
    </style>
</head>

<body>


    <!---------------------------->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button  w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
                href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>

            </a>

            <a href="./home.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i
                    class="fa fa-home w3-margin-right"></i>Logo</a>


            <input type="text" placeholder="search"
                style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">

            <button class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
            </button>





            <a href="./message/chatApp.php" class="w3-bar-item w3-button  w3-padding-large w3-hide-small w3-hover-white"
                title="Messages"><i class="fa fa-envelope"></i><span
                    class="w3-badge w3-right w3-small w3-green">10</span></a>


            <a href="./friends/friends.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white"
                title="friends"><i class="fa fa-users" aria-hidden="true"></i>
            </a>



            <div class="w3-dropdown-hover">

                <button class="w3-button w3-padding-large" title="Notifications">
                    <i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">4</span> </button>

                <!--notification drop down-->

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

            <a href="./myData.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="My Account">
                <img src="dp/<?php echo $user['dp'];?>" class="w3-circle" style="height:23px;width:23px" alt="dp">
            </a>
            <a href="logOut.php"
                class="w3-bar-item w3-button w3-hide-medium  w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="logOut"><i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
        </div>
    </div>


    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-large">
        <br>
        <br>
        <br>
        <a href="./home.php" class="w3-bar-item w3-button w3-padding-large "><i class="fa fa-home"
                aria-hidden="true"></i></a>

        <a href="./message/chatApp.php" class="w3-bar-item  w3-hide-medium w3-button w3-padding-large"><i
                class="fa fa-envelope"></i><span class="w3-badge w3-small w3-green">10</span></a>

        <a href="./friends/friends.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-users"
                aria-hidden="true"></i></a>

        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Post</a>

        <a href="./myData.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-cogs"
                aria-hidden="true"></i>
        </a>

        <a href="./logOut.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-power-off"
                aria-hidden="true"></i>
        </a>
    </div>


    <div class="container" style="max-width:1400px;margin-top:50px">
        <div class="row">
            <div class="col-sm-5 col-xs-6 all-user">

                <div class="row new-user">
                    <?php friendsOfFriend($_SESSION['id']); 
                           moreSugg();?>
                </div>
                <div class="row requested-user">
                    <?php meToUsers();?>
                </div>
            </div>


            <div class="col-sm-6  col-xs-6 known-user">

                <div class="row request-list">
                    <?php usersToMe();?>
                </div>
                <div class="row friend-list">
                    <?php  myFriends();?>
                </div>
            </div>
        </div>
    </div>



</body>

<script>
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


$(".request-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "request";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    window.alert(userId);
    callFun.append("userName", userName);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error t");
        }
    });


});

$(".cancel-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "cancel";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error t");
        }
    });
});

$(".ignore-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "ignore";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);
    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');

        },
        error: function(result) {
            window.alert(" sorrry error t");
        }
    });
});

$(".accept-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "accept";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error t");
        }
    });
});

$(".unfriend-btn").click(function() {
    var $this = $(this);
    userId = $this.data("id");
    userName = $this.data("name");
    buttonName = "unfriend";
    callFun = new FormData();
    callFun.append("buttonName", buttonName);
    callFun.append("userId", userId);
    callFun.append("userName", userName);
    window.alert(userId);

    $.ajax({
        method: 'post',
        url: "functions.php",
        cache: false,
        data: callFun,
        contentType: false, // error if both are absent in ajax code 
        processData: false,

        success: function(result) {
            //                                                     window.open('home.php','_self');
            window.alert(result);
            window.open('friends.php', '_self');
        },
        error: function(result) {
            window.alert(" sorrry error t");
        }
    });
});
</script>
<style>

</style>
<!--
request butn can only be shown when  user has not send reqst .. cancel vice virsa
so use data base for checkin reqst table for the first time

so there would  be a check fucntion/or php page  call both time


     <div class='col-sm-12 user-detail'>
                    
                       <div class='col-sm-4 user-pic'> 
                             <img src='../proImg/pro.jpg'>    
                        </div>

                        <div class='col-sm-7 user-name-buttons'> 
                            <div class=" row name"><a href="#"><p style="margin:10px 10px;">Abul Hasan</p></a></div>
                           <div class="row btn">
                               
                               <a id="request" href="#"><button id="request-btn" >Request</button></a>
                                <a  id="cancel" href="#"><button style="display: none;" id="cancel-btn">Cancel</button></a>
                            
                            </div>
                            
                        </div>
                   
                  </div>
                  



knowl
                  <div class='col-sm-12 user-detail'>

                             <div class="col-sm-5">
                                   <div class='friend-pic round-pic'> 
                                         <img src='../proImg/pro.jpg'>    
                                    </div>
                             </div>

                            <div class='col-sm-7 user-name-buttons'> 
                                <div class=" row name"><a href="#"><p style="color:white;margin:10px 10px;">Abul Hasan</p></a></div>
                               <div class="row btn"> <a href="#"><button>Unfriend</button></a></div>

                            </div>

                          </div>
    
    
-->


<!--    

                        <button class="test" data-id="new"> 0</button>
                        <button class="test" data-id="has">1</button>


                 $(".test").click(function(){
                    var $this=$(this)
                    v=$this.data("id");  // data receive use this id for verification or ajax(crud)
                    window.alert(v);
                });

-->

</html>