<?php 
 session_start();
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
 include_once("database/connection.php");
  include_once("database/getMyPost.php");
include("database/getMsgNotif.php");
 
?>
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
    
    <style>
        html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
     #pop-up-div
           {
               background:brown;
               display: none;
               position: fixed;
               height:95vh;
               overflow: hidden;
                top: 52%;
                left: 50%;
               transform: translate(-50%,-50%);
               z-index: 1;
               border-radius: 10px;
               box-shadow: 0 0 10px 10px black;
              
           }
           
           #comment-like-div
           {
            background-color:white;
               height:60vh ;
               overflow-x:hidden; 
               overflow-y:scroll; 
               padding: 10px;
               box-sizing: border-box;
           }
           #comment-text
           {
               width: 300px;
               padding-top: 13px;
                padding-left:10px;
               box-sizing: border-box;
               margin-right: 5px;
                margin-bottom: 10px;
               border: none;
               border-radius: 5px;
           }
    
    </style>
</head>
    
    <body>
        <!-- Navbar -->
<!--    ------------------------   -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button  w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i>
     
     </a>
   
     <a href="./home.php" class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
     
     
  <input type="text" placeholder="search"  style="width:200px;border-radius:5px;outline:none;border:none; padding:5px; ; margin-left:10px;margin-top:5px;color:black">
     
    <button class="btn" style="width:50px;"><i class="fa fa-search" aria-hidden="true"></i>
    </button>
     
     


     
  <a id="msg" href="./message/chatApp.php" class="w3-bar-item w3-button  w3-padding-large w3-hide-small w3-hover-white" title="Messages"><i class="fa fa-envelope"></i><span class="w3-badge w3-right w3-small w3-green">
      <?php
                $n=getUnreadMsg($_SESSION['id']);
                if($n>0)
                    echo $n;
                ?>
      </span></a>
 
     
         <a href="./friends/friends.php" class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white" title="friends"><i class="fa fa-users" aria-hidden="true"></i>
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
     
  <a href="./myData.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
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
  <a href="./home.php" class="w3-bar-item w3-button w3-padding-large "><i class="fa fa-home" aria-hidden="true"></i></a>
    
  <a href="./message/chatApp.php" class="w3-bar-item  w3-hide-medium w3-button w3-padding-large"><i class="fa fa-envelope"></i><span class="w3-badge w3-small w3-green" >10</span></a>
    
  <a href="./friends/friends.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-users" aria-hidden="true"></i></a>
    
    <a href="#" class="w3-bar-item w3-button w3-padding-large">My Post</a>
    
    <a href="./myData.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-cogs" aria-hidden="true"></i>
</a>
    
    <a href="./logOut.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-power-off" aria-hidden="true"></i>
</a>
</div>

    
<!--    complete menubar ends here-->
  
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
             
      <div class="container">
          
      <div  class="row" >
          
        <div  id='pop-up-div' class="col-sm-10 col-xs-11 "><br>
           
<!--            append  dynamic comment div here-->
        </div>
        </div>
          <!--pop up div closse here        -->
   </div>
    <!-- Left Column -->
    <div class="w3-col m3">
<!--     for space-->
    &nbsp;
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
<!--    dynamic load and delete btn-->
        
       
        <?php 
        
        if(isset($_GET['pn']))  // when pagination started
        {    $pn=$_GET['pn'];
                if($pn=="" || $pn=="1")
            {
                getMyPost(0,10) ;// for 
            }
            else
            {
                $from=($pn*10)-10;
                 getMyPost($from,10) ;
            }
        }
        else
        getMyPost(0,10) ; // for the very first time when pagination is not started
       
        
        
        ?>

      
    <!-- End Middle Column -->
    </div>
    
      <div class="w3-col m7" style="float:right;margin-right:30px;padding:10px 20px;" id="pagination">
    
           <?php
            $database="plexus";
            $table="posts";
            mysqli_select_db($conn,$database);
        //here not only my post byt friends post as well so letter on we will use in operator
      
         $query="select * from posts  where userId IN({$_SESSION['id']})";
            $posts=mysqli_query($conn,$query);
           $total=mysqli_num_rows($posts);
          $pages=$total/ 10;
          $pages=ceil($pages);

        ?>


        <nav area-label="post pages">

                   <ul class="pagination">
                       <?php for($page=1;$page<=$pages;$page++){?>
                       <li class="page-item"><a href="?pn=<?php echo $page ?>" class="page-link"><?php echo $page ?></a> </li>
                       <?php }?>


                    </ul>

         </nav>
          
          
      </div>
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
    
    </body>
    
    <script>
         $(".comment-btn").click(function(){
             
             //             prepare  a jaxa call and load all like and comment of id (pid) and appen/write it comment div of pup-up-div and add pid data as data-pid for inert-comment btn and like btn of pup-up div
                 var $this=$(this);
                pid=$this.data("pid");
                 window.alert(pid);
               postId=new FormData();
              postId.append("pid",pid);
              postId.append("comment-btn","comment");

                         $.ajax({
                              method: 'post',
                              url :"database/loadComments.php",
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){
                                $("#pop-up-div").html(loadData);
                              }
                          });

             
              
              $("#pop-up-div").css("display","block");
             
//             first wirte in pop div then show it
             
             
            });
    
    
    
      $("#close-popUp").click(function(){
          $("#pop-up-div").css("display","none");
           
       });
        
     $(".remove-btn").click(function(){
         var $this=$(this);
                pid=$this.data("pid");
                        postId=new FormData();
                      postId.append("pid",pid);
                      postId.append("remove","remove");
         
                      postId.append("userId","<?php echo $_SESSION['id'] ?>");
                         $.ajax({
                              method: 'post',
                              url :"database/removePost.php",
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){
                               location.reload();
                              }
                          });

         
      });
      
        
    
// Accordion
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



<?




?>