
<?php 
// session_start();
// include("./database/getMsgNotif.php");
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="style/w3.css">
    <link rel="stylesheet" href="style/w3-theme-blue-grey.css">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
<!-- google font end -->


 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  
<!--Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
    
  </head>
  <body>

    <div class="fixed-header">
    <header id="header" class="header-items profile-header">
     <div class="container-fluid">
       <div class="row">
         <div class="col-6 col-xs-6 header-contents">
          <div class="row">
            <div class="col-lg-2 col-2 col-xs-2 go-back">
              <a href="dashboard.php" title="">
                <!-- <i class="fa-solid fa-arrow-left"></i> -->
                <img src="posigraph_text_logo.png" />
              </a>
            </div>
            <div class="col-lg-7 col-7 col-xs-7 user-name">
              <!-- <h4><?php echo $user['firstName'].' '.$user['lastName']?></h4> -->
            </div>
          </div>
         </div>


         <div class="col-2 col-xs-2 header-chat-icons">         
           <!-- <a href="search-form.php"  title="">
             <i class="fa fa-search" aria-hidden="true"></i>
           </a> -->
         </div>


         <div class="col-2 col-xs-2 header-chat-icons">         
           <a href="https://posigraph.com/app/posigraph/message/chatApp.php"  title="">
             <!-- <i class="fa-solid fa-align-justify"></i> -->
             <i class="fa fa-envelope-o" aria-hidden="true"></i>
           </a>
         </div>


         <div class="col-2 col-xs-2 header-chat-icons">         
           <a href="#"  data-toggle="modal" data-target="#exampleModal" title="">
             <!-- <i class="fa-solid fa-align-justify"></i> -->
             <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
           </a>
         </div>

       </div>
     </div> 
    </header>
    <!-- /header -->
    </div>
<!-- popup modal -->
<!-- Modal -->
<div class="modal fade popup-modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog popup-modal-body" role="document">
    <div class="modal-content sidebar-popup-section">
     
      <div class="modal-body">
        <a href="./myData.php" class="text-center modal-links">Edit Profile</a>
        
        <a href="./friends/friends.php" class="text-center modal-links">Search For Friend</a>
        <a href="./battle/battle.php" class="text-center modal-links">Battle With Friend</a>
        <a href="terms.php" class="text-center modal-links">Terms of use</a>

      </div>
      
      <div class="modal-footer">
        <a href="logOut.php" type="button" class="text-center">Logout</a>
        <a type="button" class="text-center" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>
<!-- end popup modal -->

   <!-- fixed footer start -->
   <div class="footer">
      <div class="container-fluid">
        <div class="row" id="myDIV">
          <div class="col-3 col-xs-3 footer-icons">
            <a href="dashboard.php" class="footer-single-icon btn active" title="">
              <i class="fa-solid fa-house"></i>             
              <!-- <div class="hover-display">
                <span>Home</span>
              </div>     -->
            </a>
          </div>
          <div class="col-3 col-xs-3 footer-icons">
            <a href="add_post.php" class="footer-single-icon btn" title="">
              <i class="fa-solid fa-camera"></i>
              <!-- <div class="hover-display">
                <span>Post</span>
              </div> -->
            </a>
          </div>
          <div class="col-3 col-xs-3 footer-icons">
            <a href="notification.php" class="footer-single-icon btn" title="">
              <i class="fa-solid fa-heart"></i>
              <span class="notification_alert">
              <?php
                // $n=getUnreadMsg($_SESSION['id']);
                // if($n>0)
                //     echo $n;
                ?>
                </span>
              <!-- <div class="hover-display">
                <span>notify</span>
              </div> -->
            </a>
          </div>
          <div class="col-3 col-xs-3 footer-icons">
            <a href="home.php" class="footer-single-icon btn" title="">
              <i class="fa-solid fa-user"></i>
              <!-- <div class="hover-display">
                <span>notify</span>
              </div> -->
            </a>
          </div>
        </div>
      </div>
    </div>
<!-- fixed footer end -->