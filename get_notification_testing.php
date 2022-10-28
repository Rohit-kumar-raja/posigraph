<?php
 session_start();
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
else
{
    include_once("database/connection.php");  
    include("database/getMsgNotif.php");     
    ?>

<!--// html code-->


<!DOCTYPE html>
<html>

<head>

<title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body class="w3-theme-l5">

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button  w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
                href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>
            </a>

            <a href="./home.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i
                    class="fa fa-home w3-margin-right"></i>Logo</a>


            <input id="srch_input" type="text" placeholder="search"
                style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">

            <button id="srch" class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
            </button>

            <a id="msg" href="./message/chatApp.php"
                class="w3-bar-item w3-button  w3-padding-large w3-hide-small w3-hover-white" title="Messages"><i
                    class="fa fa-envelope"></i><span class="w3-badge w3-right w3-small w3-green">
                    <?php
                $n=getUnreadMsg($_SESSION['id']);
                if($n>0)
                    echo $n;
                ?>
                </span></a>


            <a href="./friends/friends.php"
                class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white"
                title="friends"><i class="fa fa-users" aria-hidden="true"></i>
            </a>

            
            <div class="w3-dropdown-hover">

                <button id="notif" class="w3-button w3-padding-large" title="Notifications">
                    <i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">
                        <?php
                $n=getTotalUnseenNotif($_SESSION['id']);
                if($n>0)
                    echo $n;
                ?>
                    </span> </button>

                <!--      notification drop down-->

                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="overflow:scroll;height:300px;">
                    <?php getAllNotif($_SESSION['id']); ?>
                </div>
            </div>


            <a href="./myData.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="My Account">
                <img src="dp/<?php echo $user['dp'];?>" class="w3-circle" style="height:23px;width:23px" alt="dp">
            </a>
            <a href="./logOut.php"
                class="w3-bar-item w3-button w3-hide-medium  w3-hide-small w3-right w3-padding-large w3-hover-white"
                title="logOut"><i class="fa fa-power-off" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
        <!-- The Grid -->
        <div class="w3-row">
            <!--        pop up div initially didden-->
            <div class="container">
                <div class="row">
                    <div id='pop-up-div' class="col-sm-10 col-xs-11 "><br>
                        <!--            append  dynamic comment div here-->
                    </div>
                </div>
                <!--pop up div closse here        -->
            </div>

            <!-- End Grid -->
        </div>
        <!-- End Page Container -->
    </div>


</body>

</html>

<?php
    
}
?>