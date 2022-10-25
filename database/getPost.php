<?php 
$like_post_num=0;
//include("connection.php");
//$database="plexus";
      include("database/connection.php");
       include("database/like.php");
       include("database/dislike.php");
        $database="posigraph_socialplexus";
        $table="posts";
        mysqli_select_db($conn,$database);


        // graph percentange       
    ?>
<style>
.like-graph,
.dislike-graph {
    height: 25px;
    color: #fff;
    text-align: center;
    font-weight: 200;
    font-size: 12px;
    padding: 3px 30px 5px 14px;
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
    /* position: absolute; */
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
    margin: 0px 8px 15px 0px!important;
}

.comment-section .user-profile img {
    border-radius: 50%;
}

.comment-section .user-comment button {
    border-radius: 100px;
    width: 100% !important;
    border: 1px solid #dcdcdc;
    padding: 7px;
    text-align: left;
    color: #dcdcdc;
    background:#fff!important;
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
        height: auto;
    }
}

button:focus {
    border: none !important;
    outline: none !important;
}

p {
    padding-top: 10px;
}

.w3-white .bios {
    margin: 0 12px !important;
    font-size: 14px;
    padding-top: 0px!important;
}

.dislike_base-graph .graph-heart{
    font-size: 22px!important;
}

a{
    color:#000000!important;
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
        class="  like-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
        <span id="like<?php echo $list['postId']?>">
            <?php totalLike($list['postId']);?></span></button>


    <!-- ajit aaded -->
    <button type="button" data-pid="<?php echo $list['postId']?>"
        class="dislike-btn w3-button w3-theme-d1 w3-margin-bottom">
        <i style="color:<?php echo $color?>" id="dislike1<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i>
        &nbsp;
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


<div class="w3-container w3-card w3-white w3-round w3-margin">
    <img src="dp/<?php echo $user['dp']?>" alt="Avatar4" class="w3-left w3-circle w3-margin-right"
        style="width:37px;border-radius:50%;margin-bottom:8px;margin-left:12px!important;">
    <a href="./profile/profile.php?id=<?php echo $list['userId']?>" style="line-height: 37px;">
        <span class="font-weight-bold"><?php echo  $user['firstName'].' ' .$user['lastName']?></span></a>
    <!-- <span class="w3-right w3-opacity font-weight-bold">Posted Date : <?php echo $postDate?></span> -->


    <!-- <hr class="w3-clear" style="margin-top: 25px;"> -->
    <!-- <p><?php echo $list['postContent']?></p> -->
    <img src="<?php echo 'imagePost/'.$list['postImage']?>" style="width:100%;" class="post_image">
    <!-- <span class="w3-right w3-opacity font-weight-bold">Posted Date : <?php // echo $postDate; ?></span> -->


    
    

<div style="position:relative;">
<div style="position: absolute;
    top: 5px;
    width: 100%;
    background: #fff;
    color: #fff;
    height: 11px;">
hello world
</div></div>

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
                    class="like-btn w3-theme-d1 " style="border: none;height:2px;
    background: #fff;"><i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>"
                        class="fa fa-heart-o heart-graph text-danger graph-heart"></i> &nbsp;<span
                        id="like<?php echo $list['postId']?>"
                        style="color:#000;">
                        <?php // totalLike($list['postId']);?>
                    </span></button>
                <!-- <i class="fa fa-heart-o heart-graph"></i> -->
            </span>

            <div class="like-graph" style="width:<?php echo $like_percent; ?>%"><?php echo $like_percent; ?>%</div>
            <div class="dislike-graph" style="width:<?php echo $hate_percent; ?>%"><?php echo $hate_percent; ?>%</div>

            <button type="button" data-pid="<?php echo $list['postId']?>"
                class="dislike-btn w3-theme-d1 " style="border: none;height:2px;
    background: #fff;"><i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>"
                    class="fa fa-heart heart-graph text-danger graph-heart"></i> &nbsp;<span
                    id="dislike<?php echo $list['postId']?>"
                    style="color:#000;">
                    <?php // totaldisLike($list['postId']);?>
                </span></button>

            <!-- <span><i class="fa fa-heart heart-graph"></i></span> -->
        </div>
    </div>
    <!-- // like dislike graph -->

<h6 style="font-size: 12px;text-align:center;color:#7c7c7c;margin-top:10px;">100 votes 20 comment </h6>
    <p class="bios"><?php echo $list['postContent']?></p>

    <!-- like dislike graph -->
<!-- comment button -->
<div class="comment-section">
        <div class="user-profile"><img src="dp/<?php echo $user['dp'];?>"
                style="width: 30px;
    height: 30px;
    margin: 5px;
    margin-top: 12px;
    margin-left: 14px;" /></div>
        <div class="user-comment">
            <button type="button" class="comment-btn" data-pid="<?php echo $list['postId']?>">comment</button>
        </div>
    </div>
    <!-- //comment button -->


    <!-- <div class="mt-2">
        <button type="button" data-pid="<?php echo $list['postId']?>"
            class="like-btn w3-button w3-theme-d1 w3-margin-bottom btn btn-success"><i style="color:<?php echo $color?>"
                id="<?php // echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;<span
                id="like<?php // echo $list['postId']?>"><?php totalLike($list['postId']);?></span></button>
        <button type="button" data-pid="<?php echo $list['postId']?>"
            class="comment-btn w3-button w3-theme-d2 w3-margin-bottom btn btn-info"><i class="fa fa-comment"></i>
            &nbsp;Comment</button>
    </div> -->
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
    //////////////////////////////////////////////////////////////////  
        ?>