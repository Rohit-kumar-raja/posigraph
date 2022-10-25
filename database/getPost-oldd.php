<?php 
$like_post_num=0;
//include("connection.php");
//$database="plexus";
      include("database/connection.php");
       include("database/like.php");
       include("database/dislike.php");
       include("database/p1like.php");
       include("database/p2like.php");
       $database="posigraph_socialplexus";
        $table="posts";
        mysqli_select_db($conn,$database);


        // graph percentange       
    ?>
<style>
.like-graph,
.dislike-graph {
    height: 30px;
    color: #fff;
    text-align: center;
    font-weight: 900;
    font-size: 12px;
    padding: 5px;
}

.like-graph {
    border-radius: 20px 0px 0px 20px;
    background: #fd012f;
    margin-left: 10px;
}


.dislike-graph {
    border-radius: 0px 20px 20px 0px;
    background: #000;
    margin-right: 10px;
}

.dislike_base-graph {
    position: absolute;
    bottom: 32px;
    width: 100%;
    display: flex;
    background: #fff;
    padding: 5px;
}

.heart-graph {
    font-size: 26px !important;
    margin: 0 5px;
}

/* user comment css */
.comment-section {
    display: flex;
}

.comment-section .user-profile img {
    border-radius: 50%;
}

.comment-section .user-comment button {
    border-radius: 100px;
    width: 100% !important;
    border: 1px solid #a4a4a4;
    padding: 7px;
    text-align: left;
    color: #979797;
}

/* .comment-section .user-comment input::placeholder {
        color: #959595;
    } */

.comment-section .user-comment {
    width: 95% !important;
    margin: 10px auto;
}

@media(max-width:576px) {
    .post_image {
        height: 280px;
    }
}

button:focus {
    border: none !important;
    outline: none !important;
}

p{
    padding-top: 10px;
}
</style>
<?php 
    
function getPost($from,$count) 
{
       global $conn;  
    
        $checkPost="select * from user where userId='".$_SESSION['id']."'";
        $result=mysqli_query($conn,$checkPost);
         if($result)
         {
            $row=mysqli_fetch_array($result);
             $post=$row['post'];
             
              // battle post start here
            $friends=getFriends($_SESSION['id']);
            $me=$_SESSION['id'];
            $battle="select * from battle where player1_id IN($friends,$me) OR player2_id IN($friends,$me) ORDER BY date_of_creation LIMIT $from,$count";
            $battleList=mysqli_query($conn,$battle);
            $totalbattle=mysqli_num_rows($battleList);
                 
                if($totalbattle>0 )  
                {
                    while($batlist=mysqli_fetch_array($battleList))
                      {  
                        if($batlist['player1_post']!='' && $batlist['player2_post']!='')    {
                       ?>
    
    
    <div class="row">
        <div class="col-6">
    
            <?php
                        $batid1 = $batlist['player1_id'];
                        $bu1="select * from user where userId = $batid1";
                        $buList1=mysqli_query($conn,$bu1);
                        $dbu1=mysqli_fetch_array($buList1);
                        ?>
            <img src="dp/<?php echo $dbu1['dp']; ?>" alt="Avatar4" class="w3-left w3-circle w3-margin-right"  style="width:37px;border-radius:50%;">
            <a href="./profile/profile.php?id=84" style="line-height: 30px;">
                <span class="font-weight-bold"><?php echo $dbu1['firstName'].' '.$dbu1['lastName']; ?></span></a>
            <hr class="w3-clear" style="margin-top: 25px;">
            <!-- <img src="imagePost/844490865profile3.jpg" style="width:100%;" class="w3-margin-bottom post_image"> -->
            <?php if($batlist['player1_post'] != ''){ ?>
            <img width="100%" <?php echo ' src="data:image/jpeg;base64,' . base64_encode($batlist['player1_post']) . '"' ?>  class="w3-margin-bottom post_image" />
            <?php } 
        else {
        ?>
            <span class="font-weight-bold text-success">Player1 Image not uploaded yet!</span>
            <?php } ?>
        </div>
    
        <div class="col-6">
    
            <?php
                        $batid2 = $batlist['player2_id'];
                        $bu2="select * from user where userId = $batid2";
                        $buList2=mysqli_query($conn,$bu2);
                        $dbu2=mysqli_fetch_array($buList2);
                        ?>
            <img src="dp/<?php echo $dbu2['dp']; ?>" alt="Avatar4" class="w3-left w3-circle w3-margin-right"
                style="width:37px;border-radius:50%;">
            <a href="./profile/profile.php?id=84" style="line-height: 30px;">
                <span class="font-weight-bold"><?php echo $dbu2['firstName'].' '.$dbu2['lastName']; ?></span></a>
            <hr class="w3-clear" style="margin-top: 25px;">
            <!-- <img src="imagePost/7454192751904775.jpg" style="width:100%;" class="w3-margin-bottom post_image"> -->
            <?php if($batlist['player2_post'] != ''){ ?>
            <img width="100%" <?php echo ' src="data:image/jpeg;base64,' . base64_encode($batlist['player2_post']) . '"' ?>
                class="w3-margin-bottom post_image" />
            <?php } 
        else {
        ?>
            <span class="font-weight-bold text-success">Player2 Image not uploaded yet!</span>
            <?php } ?>
        </div>
    </div>
    
    <!-- like dislike graph for battle start here-->
    
    <?php
        $p1_battle_num = totalp1Like($batlist['player1_id']);
        $p2_battle_num = totalp2Like($batlist['player2_id']);
    
        $battle_sum = $p1_battle_num + $p2_battle_num;
    
    if(( $p1_battle_num + $p2_battle_num)==0){
        $p1_battle_num = 1;
         $p2_battle_num = 1;
         $battle_sum=1;
    }
    $p1_percent = round($p1_battle_num / $battle_sum * 100);
    $p2_percent = round($p2_battle_num / $battle_sum * 100);
    
    ?>
    <div style="position:relative">
        <div class="dislike_base-graph">
            <span>
                <button type="button" data-pid="<?php echo $batlist['player1_id']?>"  class="p1batlike w3-theme-d1 w3-margin-bottom" style="border: none;
        background: #fff;"><i style="color:<?php echo $color?>" id="<?php echo $batlist['player1_id']?>"
                        class="fa fa-heart-o heart-graph text-danger"></i> &nbsp;<span id="p1batlike<?php echo $batlist['player1_id']?>"
                        style="color:#000;"><?php totalLike($batlist['player1_id']);?></span></button>
            </span>
    
            <div class="like-graph" style="width:<?php echo $p1_percent; ?>%"><?php echo $p1_percent; ?>%</div>
            <div class="dislike-graph" style="width:<?php echo $p2_percent; ?>%"><?php echo $p2_percent; ?>%</div>
    
            <button type="button" data-pid="<?php echo $batlist['player2_id']?>" class="p2batlike w3-theme-d1 w3-margin-bottom" style="border: none;
        background: #fff;"><i style="color:<?php echo $color?>" id="<?php echo $batlist['player2_id']?>"
                    class="fa fa-heart heart-graph text-danger"></i> &nbsp;<span
                    id="p2batlike<?php echo $batlist['player2_id']?>"
                    style="color:#000;"><?php totaldisLike($batlist['player2_id']);?></span></button>
        </div>
    </div>
    <!-- // like dislike graph for battle ended-->
    <?php 
    }
                }
            }
            
            
     
            // battle post ends here
             
             
             if($post=="yes")
             {
//          fetch all post of id and his/her friend and show it 
//          get all friends id                 
            $friends=getFriends($_SESSION['id']);
            $me=$_SESSION['id'];
            $posts="select * from posts  where userId IN($friends,$me) ORDER BY  postDate DESC LIMIT $from,$count";
            $postList=mysqli_query($conn,$posts);
            $total=mysqli_num_rows($postList);
             
            if($total>0)  
            {
                while($list=mysqli_fetch_array($postList))
                {   
                $like=myLike($list['postId'],$_SESSION['id']);
                
                if($like)
                $color="blue";
                else
                $color="red";
//              check post type text or img
                $query="select userId,firstName,lastName,dp from user where userId='{$list['userId']}'";
                $result=mysqli_query($conn,$query);
                $user=mysqli_fetch_assoc($result); 
               
                $postDate=date('F j,Y,g:i a',strtotime($list['postDate']));
//               <!--post area start-->
               if($list['type']=="text")                        
              {?>

<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <img src="dp/<?php echo $user['dp']?>" alt="Avatar3" class="w3-left w3-circle w3-margin-right"
        style="border-radius:50%;width:100px;">
    <span class="w3-right w3-opacity"><?php echo $postDate?></span>
    <a href="./profile/profile.php?id=<?php echo $list['userId']?>">
        <h4><?php echo $user['firstName']?></h4><br>
    </a>
    <hr class="w3-clear">

    <p><?php echo $list['postContent']?></p>

    <button type="button" data-pid="<?php echo $list['postId']?>"
        class="like-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
        <span id="like<?php echo $list['postId']?>">
            <?php totalLike($list['postId']);?></span></button>


<!-- ajit aaded -->
            <button type="button" data-pid="<?php echo $list['postId']?>"
        class="dislike-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>"  id="dislike1<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
        <span id="dislike<?php echo $list['postId']?>">
            <?php totaldisLike($list['postId']);?><?php totaldisLike($list['postId']);?></span></button>
<!-- // ajit added -->


    <button type="button" data-pid="<?php echo $list['postId']?>"
        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>

</div>

<?php
                    }
                    else
                    { ?>


<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <img src="dp/<?php echo $user['dp']?>" alt="Avatar4" class="w3-left w3-circle w3-margin-right"
        style="width:37px;border-radius:50%;">
    <a href="./profile/profile.php?id=<?php echo $list['userId']?>" style="line-height: 30px;">
        <span class="font-weight-bold"><?php echo  $user['firstName'].' ' .$user['lastName']?></span></a>
    <!-- <span class="w3-right w3-opacity font-weight-bold">Posted Date : <?php echo $postDate?></span> -->

    
    <hr class="w3-clear" style="margin-top: 25px;">
    <!-- <p><?php echo $list['postContent']?></p> -->
    <img src="<?php echo 'imagePost/'.$list['postImage']?>" style="width:100%;" class="w3-margin-bottom post_image">
    <!-- <span class="w3-right w3-opacity font-weight-bold">Posted Date : <?php // echo $postDate?></span> -->

    <p><?php echo $list['postContent']?></p>

    <!-- like dislike graph -->

    <?php
 $like_post_num = totalLike($list['postId']);
// $like1 = totalLike($list['postId']);
 $hate_post_num = totaldisLike($list['postId']);
//print_r($list['postId']);

// $like_post_num = 5;
// $hate_post_num = 6;

$sum = $like_post_num + $hate_post_num;

if(( $like_post_num + $hate_post_num)==0){
    $like_post_num = 1;
     $hate_post_num = 1;
     $sum=1;
}
$like_percent = round($like_post_num / $sum * 100);
$hate_percent = round($hate_post_num / $sum * 100);

//  echo totalLike($list['postId']);
// get user data
$query="select * from user where userId=".$_SESSION['id'];
$result=mysqli_query($conn,$query);
$user=mysqli_fetch_array($result);


?>
    <div style="position:relative">
        <div class="dislike_base-graph">
            <span>
                <button type="button" data-pid="<?php echo $list['postId']?>"
                    class="like-btn w3-theme-d1 w3-margin-bottom" style="border: none;
    background: #fff;"><i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>"
                        class="fa fa-heart-o heart-graph text-danger"></i> &nbsp;<span
                        id="like<?php echo $list['postId']?>"
                        style="color:#000;"><?php totalLike($list['postId']);?></span></button>
                <!-- <i class="fa fa-heart-o heart-graph"></i> -->
            </span>

            <div class="like-graph" style="width: <?php echo $like_percent; ?>%"><?php echo $like_percent; ?> %</div>
            <div class="dislike-graph" style="width: <?php echo $hate_percent; ?>%"><?php echo $hate_percent; ?> %</div>

            <button type="button" data-pid="<?php echo $list['postId']?>"
                class="dislike-btn w3-theme-d1 w3-margin-bottom" style="border: none;
    background: #fff;"><i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>"
                    class="fa fa-heart heart-graph text-danger"></i> &nbsp;<span id="dislike<?php echo $list['postId']?>"
                    style="color:#000;"><?php totaldisLike($list['postId']);?></span></button>

            <!-- <span><i class="fa fa-heart heart-graph"></i></span> -->
        </div>
    </div>
    <!-- // like dislike graph -->

    <!-- comment button -->
    <div class="comment-section">
        <div class="user-profile"><img src="dp/<?php echo $user['dp'];?>"
                style="width: 40px;height: 40px;margin: 5px;" /></div>
        <div class="user-comment">
            <button type="button" class="comment-btn" data-pid="<?php echo $list['postId']?>">comment</button>
        </div>
    </div>
    <!-- //comment button -->

    
</div>

<?php   
                    }
//                    else close post type
                    ?>
<!--        post area ends here-->
<?php
                }
            } 
//                 if(total) and while close
                 else
                     echo mysqli_error($conn);
         ?>
<!--      inner php tag  "above result" is close  -->



<!--    bellow pair of inner if 'post=yes' close '}' start else '{' and close with php tag-->
<?php
        }         
         else
         {  // if no post is there  then .load only friends post..it default post welcom post                 
            
            
            
            
            
            $friends=getFriends($_SESSION['id']);
             if($friends!=0)
             {
                getFriendPost($from,$count); 
             }
             else
             {
//                 if user has no friend and no post
              echo '<div class="w3-container w3-card w3-white w3-round w3-margin">
                  <br><h2> You have no posts </h2></div> ';   
             }                                
             }   
             
           
         }
//query if ends here
}

// ////////////////////////////////////////////////////////////////////////////////////////


function getFriendPost($from,$count)
{ global $conn;
        
            $friends=getFriends($_SESSION['id']);
            $posts="select * from posts  where userId IN($friends) ORDER BY  postDate DESC LIMIT $from,$count";
            $postList=mysqli_query($conn,$posts);
            $total=mysqli_num_rows($postList);
        if($total>0)
        {
          while($list=mysqli_fetch_array($postList)) 
          {
              $like=myLike($list['postId'],$_SESSION['id']);
                    if($like)
                        $color="blue";
                    else
                        $color="red";
               $query="select userId,firstName,dp from user where userId='{$list['userId']}'";
              $result=mysqli_query($conn,$query);
                $user=mysqli_fetch_array($result); 
                $postDate=date('F j,Y,g:i a',strtotime($list['postDate']));
               if($list['type']=="text")
               {?>
<!--                  html area-->
<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <img src="dp/<?php echo $user['dp']?>" alt="Avatar1" class="w3-left w3-circle w3-margin-right"
        style="border-radius:50%;width:100px;">
    <span class="w3-right w3-opacity"><?php echo $postDate?></span>
    <a href="./profile/profile.php?id=<?php echo $list['userId']?>">
        <h4><?php echo $user['firstName']?></h4><br>
    </a>
    <hr class="w3-clear">

    <p><?php echo $list['postContent']?></p>

    <button type="button" data-pid="<?php echo $list['postId']?>"
        class="  like-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
        <span id="like<?php echo $list['postId']?>">
            <?php totalLike($list['postId']);?></span></button>

                <!-- ajit added -->
            <button type="button" data-pid="<?php echo $list['postId']?>"
        class="  dislike-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
        <span id="dislike<?php echo $list['postId']?>">
            <?php totaldisLike($list['postId']);?></span></button>
            <!--// ajit added -->

    <button type="button" data-pid="<?php echo $list['postId']?>"
        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>

</div>

<?php 
               }
              else
              { ?>
<!--                html area  -->
<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <img src="dp/<?php echo $user['dp']?>" alt="Avatar2" class="w3-left w3-circle w3-margin-right"
        style="border-radius:50%;width:100px;">
    <span class="w3-right w3-opacity"><?php echo $postDate?></span>
    <a href="./profile/profile.php?id=<?php echo $list['userId']?>">
        <h4><?php echo  $user['firstName']?></h4><br>
    </a>
    <hr class="w3-clear">
    <p><?php echo $list['postContent']?></p>
    <img src="<?php echo 'imagePost/'.$list['postImage']?>" style="width:100%" class="w3-margin-bottom">


    <button type="button" data-pid="<?php echo $list['postId']?>"
        class="like-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
        <span id="like<?php echo $list['postId']?>">
            <?php totalLike($list['postId']);?></span></button>

<!-- ajit added -->
            <button type="button" data-pid="<?php echo $list['postId']?>"
        class="dislike-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
        <span id="dislike<?php echo $list['postId']?>">
            <?php totaldisLike($list['postId']);?></span></button>
<!-- // ajit added -->

    <button type="button" data-pid="<?php echo $list['postId']?>"
        class="comment-btn w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>
</div>

<?php }              
          }
        }  
}
// ////////////////////////////////////////////////////////////////////////////////////////////

function getFriends($id)
{ global $conn;
    $i=0;
      $friendId[]=0;
    $query="select userOne,userTwo from friends where userOne=$id or userTwo=$id";// when i'am 1st col,get friend Id from userTwo
     $friends=mysqli_query($conn,$query);
    if($friends)
    {
     if(mysqli_num_rows($friends)>= 1)
     {  
           while($row=mysqli_fetch_array($friends))
           {
               
                  if($row['userOne']==$id)
                  {
                     $friendId[$i]=$row['userTwo'];
               
                     $i++;                       
                  }
                 else
                 {
                     $friendId[$i]=$row['userOne'];
               
                     $i++;
                      
                 }
           }
        
     
     $str =implode(',', $friendId);
         return $str;
     }
        else
            return 0;
    }
 else
      mysqli_error($conn); 
}
    //  ////////////////////////////////////////////////////////////////  
        ?>