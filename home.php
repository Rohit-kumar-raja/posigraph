<style>
   
.image-grid {
  --gap: 2px;
  --num-cols: 4;
  --row-height: 300px;

  box-sizing: border-box;
  padding: var(--gap);

  display: grid;
  grid-template-columns: repeat(var(--num-cols), 1fr);
  grid-auto-rows: var(--row-height);
  gap: var(--gap);
}

.image-grid > img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.image-grid-col-2 {
  grid-column: span 2;
}

.image-grid-row-2 {
  grid-row: span 2;
}

/* Anything udner 1024px */
@media screen and (max-width: 1024px) {
  .image-grid {
    --num-cols: 2;
    --row-height: 200px;
  }
}

</style>

<?php
 session_start();
 
 if(!isset($_SESSION['email']))
 {
     header("location:index.php");
  }
else
{
    include_once("database/connection.php");
   include_once("database/getPost.php");
    include("database/getMyImagePost.php");
    include("database/getMsgNotif.php");
    
    $query="select * from user where userId=".$_SESSION['id'];
    $result=mysqli_query($conn,$query);
    $user=mysqli_fetch_array($result);
    
     $query="select * from user_details where userId='".$_SESSION['id']."'";
    $result=mysqli_query($conn,$query);
    $userDetail=mysqli_fetch_array($result);

    include "posi_header.php";
    include "posi.php";

    

    // ajit
   

    // //ajit
    ?>
<style>

</style>

<!-- profile section started -->
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 profile-section">

            <div>

                <div class="col-md-12">
                    <div class="profile-card text-center">

                        <img class="img-responsive img-fluid" src="./bg.jpg">
                        <div class="profile-info">
                            <img class="profile-pic" src="dp/<?php echo $user['dp'];?>">
                            <h2 class="hvr-underline-from-center">
                                <?php echo $user['firstName'].' ' .$user['lastName'];?></h2>
                            <?php 
                      $one = $user['userId'];
                     
                      $get_following = mysqli_num_rows(mysqli_query($conn , "SELECT * FROM `friends` WHERE `userOne`='$one' || `userTwo`='$one'"));
                      $get_follower = mysqli_num_rows(mysqli_query($conn,"select receiverId from friend_request where senderId='$one'"));
                      ?>
                            <!-- <div>
                                <?php echo "<a class='btn btn-info text-light mr-2'>Following $get_following</a>"."<a class='btn btn-info text-light'>Followers $get_follower</a>"?>
                            </div> -->
                            <div style="
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-top: 20px;
">
                                <div><a class="btn  text-light mr-2 text-dark"> <b><?php echo $get_following ?></b>
                                        <br>Following</a></div>
                                <div><a class="btn  text-light text-dark"> <b><?php echo $get_follower ?></b> <br>
                                        Followers</a></div>
                            </div>
                            <!-- <span>Digital / Design Consultant</span> -->

                        </div>
                        <p style="font-size: 16px;">Uploads</p>
                        <div class="profile-gallery-images">

                            <div class="row">

                                

                            </div>

                        </div>


                        <!-- added test -->
                        <!-- <ul class="img-list">
                        </ul> -->

                        <div class="image-grid">
                            <?php image();?>
                        </div>
                            <!-- // added test -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end profile section -->
</body>

</html>


<?php
    
}
?>