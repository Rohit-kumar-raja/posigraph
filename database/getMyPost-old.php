<?php 

      include("connection.php");
       include("like.php");
        $database="posigraph_socialplexus";
        $table="posts";
        mysqli_select_db($conn,$database);
     
function getMyPost($from,$count) 
{
       global $conn;      
        $checkPost="select * from user where userId='".$_SESSION['id']."'";
        $result=mysqli_query($conn,$checkPost);
         if($result)
         {
            $user=mysqli_fetch_array($result);
             $post=$user['post'];
             if($post=="yes")
             {
//                 fetch all post of id and his/her friend and show it 
//                 get all friends id                             
            $me=$_SESSION['id'];
            $posts="select * from posts  where userId IN($me) ORDER BY  postDate DESC LIMIT $from,$count";
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
                        $color="";
                    $postDate=date('F j,Y,g:i a',strtotime($list['postDate']));
//                    <!--         post area start-->
                    if($list['type']=="text")                        
                    {?>        
                          <div class="w3-container w3-card w3-white w3-round w3-margin" id="pid<?php echo $list['postId']?>" >
                              <br>
                            <img src="dp/<?php echo $user['dp']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:100%">
                         <span class="w3-right w3-opacity"><?php echo $postDate?></span>
                            <a href="profile.php?id=<?php echo $list['userId']?>"> 
                                <h4><?php echo $user['firstName']?></h4><br></a>
                            <hr class="w3-clear">
                            
                           <p><?php echo $list['postContent']?></p>
                              
                            <button type="button" data-pid="<?php echo $list['postId']?>"  class="like-btn w3-button w3-theme-d1 w3-margin-bottom">
                               <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
                              <span id="like<?php echo $list['postId']?>">
                                <?php totalLike($list['postId']);?></span></button>
                           
                            <button  type="button" data-pid="<?php echo $list['postId']?>" class="comment-btn w3-button w3-theme-d2 w3-margin-bottom" ><i class="fa fa-comment"></i> &nbsp;Comment</button>                                                                             
                                <button  type="button" data-pid="<?php echo $list['postId']?>" class="remove-btn w3-button w3-theme-d2 w3-margin-bottom" ><i class="fa fa-comment"></i> &nbsp;Remove</button>
                           </div>             
                    <?php
                    }
                    else
                    { ?>                            
                       <div class="w3-container w3-card w3-white w3-round w3-margin" id="pid<?php echo $list['postId']?>"><br>
                            <img src="dp/<?php echo $user['dp']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                         <span class="w3-right w3-opacity"><?php echo $postDate?></span>
                             <a href="profile.php?id=<?php echo $list['userId']?>">   
                             <h4><?php echo  $user['firstName']?></h4><br></a>
                            <hr class="w3-clear">
                            <p><?php echo $list['postContent']?></p>
                            <img src="<?php echo 'imagePost/'.$list['postImage']?>" style="width:100%" class="w3-margin-bottom">
                                                      
                           <button type="button" data-pid="<?php echo $list['postId']?>"  class="like-btn w3-button w3-theme-d1 w3-margin-bottom">
                               <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
                              <span id="like<?php echo $list['postId']?>">
                                <?php totalLike($list['postId']);?></span></button>                           
                            <button  type="button" data-pid="<?php echo $list['postId']?>" class="comment-btn w3-button w3-theme-d2 w3-margin-bottom" ><i class="fa fa-comment"></i> &nbsp;Comment</button>                                                                                 
                                <button  type="button" data-pid="<?php echo $list['postId']?>" class="remove-btn w3-button w3-theme-d2 w3-margin-bottom" ><i class="fa fa-comment"></i> &nbsp;Remove</button>                           
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
         {  // if no post is there  then            
//                 if user has no friend and no post
              echo '<div class="w3-container w3-card w3-white w3-round w3-margin">
                  <br><h2> You have no posts </h2></div> ';                                                
             }             
         }
//query if ends here
}?>
