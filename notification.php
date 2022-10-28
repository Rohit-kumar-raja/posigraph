<?php
 session_start();
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
else
{
    include "./database/connection.php";
    include "./database/getMsgNotif.php";

    // include_once("database/connection.php");  
    // include("database/getMsgNotif.php");   
    include "posi_header.php";  
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
    <!-- <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">

            <div class="w3-dropdown-hover">

                <button id="notif" class="w3-button w3-padding-large" title="Notifications">
                    <i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">
                        <?php
              //  $n=getTotalUnseenNotif($_SESSION['id']);
               // if($n>0)
                 //   echo $n;
               // ?>
                </span></button>               
            </div>
        </div>
    </div> -->

    <div style="
    margin-top: 75px;
    margin-bottom: 90px;
">
        <?php getAllNotif($_SESSION['id']); ?>
    </div>

</body>

</html>

<?php
    
}
?>