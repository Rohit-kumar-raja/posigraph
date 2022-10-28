<?php
include "profile_header.php";
include("../database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

$id=$_GET['id'];


// echo "<script>window.alert({$id})</script>";
$query="select *  from user where userId='$id'";
         $user_t=mysqli_query($conn,$query);

    if($user_t)
    {
     if(mysqli_num_rows($user_t) >= 1)
     {
         
        $r= mysqli_num_rows($user_t);
             

         $query="select *  from user_details where userId='$id'";
          $user_details_t=mysqli_query($conn,$query);
         
       $u_row=mysqli_fetch_array($user_t);
        $ud_row=mysqli_fetch_array($user_details_t);
        $fname=$u_row['firstName'];
         $lname=$u_row['lastName'];
         $email=$u_row['email'];
         $dp=$u_row['dp'];
         $phone=$u_row['phone'];
         $DOB=$u_row['DOB'];
         
         $job=$ud_row['job'];
         $city=$ud_row['city'];
         $state=$ud_row['state'];
         $country=$ud_row['country'];
         $facebook=$ud_row['facebook'];
         $twitter=$ud_row['twitter'];
         $insta=$ud_row['insta'];
         $linkedIn=$ud_row['linkedIn'];

               
     
         
         
     }
        else
        {
          $fname='';
         $lname='';
         $email='';
         $dp='';
         $phone='';
         $DOB='';
         
         $job='';
         $city='';
         $state='';
         $country='';
         $facebook='';
         $twitter='';
         $insta='';
         $linkedIn='';
           echo "
           
           <div>
           <h1>No such Profile <a  href='http://localhost/posigraph_new/home.php'>Go To Home</a></h1>
           
           
           </div>
             ";
     exit();
            
        }       
    }
else
{
    echo "<script>window.alert('Sorry something went wrong.')</script>";
     exit();
}
   
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Posigraph</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
		
	<!-- Font -->
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700%7CAllura" rel="stylesheet">
	
	<!-- Stylesheets -->
	
	<link href="common-css/bootstrap.css" rel="stylesheet">
	
	<link href="common-css/ionicons.css" rel="stylesheet">
	
	<link href="common-css/fluidbox.min.css" rel="stylesheet">
	
	<link href="01-cv-portfolio/css/styles.css" rel="stylesheet">
	
	<link href="01-cv-portfolio/css/responsive.css" rel="stylesheet">
	
</head>
<body>
	
	<header>
		<div class="container-fluid">
			<div class="heading-wrapper">
				<div class="row">
										
					<div class="col-sm-6 col-md-6 col-lg-4">
						<div class="info">
							<i class="icon ion-ios-telephone-outline"></i>
							<div class="right-area">
								<h5><?php echo $phone?></h5>

							</div>
						</div>
					</div>
					
					<div class="col-sm-6 col-md-6 col-lg-4">
						<div class="info">
							<i class="icon ion-ios-chatboxes-outline"></i>
							<div class="right-area">
								<h5><?php echo $email?></h5>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<a class="downlad-btn" href="http://localhost/posigraph_new/home.php">Go To Home</a>
		</div>
	</header>
	
	<section class="intro-section">
		<div class="container">
			<div class="row">
				<div class="col-md-1 col-lg-2"></div>
				<div class="col-md-10 col-lg-8">
					<div class="intro">
						<div class="profile-img"><img src="../dp/<?php echo $dp?>" alt=""></div>
						<h2><b><?php echo $fname .' '.$lname?></b></h2>
						<h4 class="font-yellow"><?php echo $job?></h4>
						<ul class="information margin-tb-30">
							<li><b>DOB : </b><?php echo $DOB?></li>
							<li><b>CONTACT : </b><?php echo $phone?></li>
							<li><b>EMAIL : </b><?php echo $email?></li>
							
						</ul>
						<!-- <ul class="social-icons">
						
							<li><a href="<?php echo $linkedIn ?>"><i class="ion-social-linkedin"></i></a></li>
							<li><a href="<?php echo $insta ?>"><i class="ion-social-instagram"></i></a></li>
							<li><a href="<?php echo $facebook ?>"><i class="ion-social-facebook"></i></a></li>
							<li><a href="<?php echo $twitter ?>"><i class="ion-social-twitter"></i></a></li>
						</ul> -->
					</div>
				</div>
			</div>
		</div>
	</section>
    
	<?php
// include "../posi_header.php";
	?>
<!--////////////////////////////////////////////////////////////////////////////////////////	-->
    <?php
       $query="select *  from posts where userId='$id' AND type!='text'";
         $posts=mysqli_query($conn,$query);
        if($posts)
        {
            $tp=mysqli_num_rows($posts);
            
        }
    ?>
	<section>
	<section class="portfolio-section section">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="heading">
						<h3><b></b>posts (<?php echo $tp ?>)</h3>
                           <hr>
						<h6 class="font-lite-black"><b></b></h6>
					</div>
				</div><!-- col-sm-4 -->
				<div class="col-sm-8">
					<div class="portfolioFilter clearfix margin-b-80">
						
                     
					</div><!-- portfolioFilter -->
                    
				</div><!-- col-sm-8 -->
                
			</div><!-- row -->
		</div><!-- container -->
		
		<div class="portfolioContainer">
  <?php 
    
 
         if($posts)
        {
             if(mysqli_num_rows($posts)>= 1)
             {
                 while($row=mysqli_fetch_array($posts))
                     {
                       $img=$row['postImage'];
                       
                          echo "

                               
                <div class='p-item web-design'>
                    <a href='../imagePost/$img' data-fluidbox>
                        <img src='../imagePost/$img' alt=''></a>
                </div>";
                 }                           
             }
             else
             {
                  echo "                               
                <div class='p-item web-design'>
                  <center> <h2>No posts</h2></center>
                   <br>
                </div>
			
                            ";
             }
     }                                                                                    
?>          
            					
		</div><!-- portfolioContainer -->
		
	</section><!-- portfolio-section -->
	
<!--	//////////////////////////////////////////////////////////////////////////-->
	
	<!-- SCIPTS -->
	
	<script src="common-js/jquery-3.2.1.min.js"></script>
	
	<script src="common-js/tether.min.js"></script>
	
	<script src="common-js/bootstrap.js"></script>
	
	<script src="common-js/isotope.pkgd.min.js"></script>
	
	<script src="common-js/jquery.waypoints.min.js"></script>
	
	<script src="common-js/progressbar.min.js"></script>
	
	<script src="common-js/jquery.fluidbox.min.js"></script>
	
	<script src="common-js/scripts.js"></script>
	
</body>
</html>
