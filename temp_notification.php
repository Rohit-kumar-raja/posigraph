<?php
 session_start();
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
else
{
    include "posi_header.php";
    include_once("database/connection.php");
//    include_once("database/getPost.php");
//     include("database/getMyImagePost.php");
    include("database/getMsgNotif.php");        
    ?>

<!--// html code-->


<!DOCTYPE html>
<html>

<body class="w3-theme-l5">

    <div class="container-fluid">
        <h3 class="display-6" style="margin-top:65px;">Notifications</h3>
        <a href="" id="notif">
            <?php getAllNotif($_SESSION['id']); ?>
        </a>
    </div>

</body>

</html>


<?php
    
}
?>