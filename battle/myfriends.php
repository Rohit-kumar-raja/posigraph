<link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
        }
        
        * {
            box-sizing: border-box;
        }
        
        .slider {
            width: 90%;
            margin: 10px auto;
        }
        
        .slick-slide {
            margin: 0px 20px;
            height:auto!important;
        }
        
        .slick-slide img {
            width: 100%;
        }
        
        @media(max-width:576px){
            .slick-slide img {
                width: 78px!important;
                margin: 10px!important;
        } 
        .slick-slide{
            height:17%!important;
        }
        }


        .slick-prev:before,
        .slick-next:before {
            color: black;
        }
        
        .slick-slide {
            transition: all ease-in-out .3s;
            /* opacity: .2; */
        }
        
        .slick-active {
            /* opacity: .5; */
        }
        
        .slick-current {
            /* opacity: 1; */
        }
   
.user-detail {
    
    text-align:center;
    padding: 30px;
    position: relative;
    display: block;
    background: #fff;
    color: #000;
    box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
    margin: 15px 0;
}

.name-tilte {
    font-size: 16px;
    font-weight: 700;
    color: #0a69ed;
    /* margin-top: 30px; */
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
</style>

<?php
// session_start();
include("connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

$me=$_SESSION['id'];
// get my all friends in index

global $conn,$me;
    
  $query="select userOne,userTwo from friends where userOne=$me or userTwo=$me";// when i'am 1st col,get friend Id from userTwo
     $friends=mysqli_query($conn,$query);
    if($friends)
    {
     if(mysqli_num_rows($friends)>= 1)
     {  
         ?>
 <section class="center slider">
         <?php
           while($row=mysqli_fetch_array($friends))
           {               
                  if($row['userOne']==$me)
                  {
                     $query="select userId,firstName ,dp from user where userId={$row['userTwo']}";
                      $nameDp=mysqli_query($conn,$query);
                      $friend=mysqli_fetch_array($nameDp);
                      
                      echo"
                     
                      <div>
                      <img src=./dp/{$friend['dp']}> 
                      <h1 style='font-weight: 800;
                      text-align: center;
                      font-size: 26px;
                      width: 100%;
                      text-transform: capitalize;'>{$friend['firstName']}</h1>
                      </div>
                                                                                                                           
                ";                      
                  }
                 
           }   ?>
           </section>   
           <?php       
     }

    }
 else
      mysqli_error($conn);
?>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).on('ready', function() {

            $(".center").slick({
                dots: true,
                infinite: true,
                centerMode: true,
                slidesToShow: 3,
                slidesToScroll: 3,

            });

        });
    </script>
