    
<?php
session_start();
include_once("connection.php");
include_once("like.php");

$database="posigraph_socialplexus";
$table="posts";
mysqli_select_db($conn,$database);

$actionName=$_POST['action'];
if($actionName=="showPost")
{
    $postFrom=$_POST['postFrom'];
    $postCount=$_POST['postCount'];
    
    $posts="select * from posts  where userId ='".$_SESSION['id']."' ORDER BY  postDate DESC LIMIT ".$postFrom.",".$postCount;
    
    $morePost=mysqli_query($conn,$posts);
    $count=mysqli_num_rows($morePost);
    if($count>0)
    {
          while($list=mysqli_fetch_array($morePost))
                {   
                    $like=myLike($list['postId'],$_SESSION['id']);
                    if($like)
                        $color="blue";
                    else
                        $color="";
//                    check post type text or img
//                    <!--         post area start-->
                    if($list['type']=="text")
                    {?>
        
                          <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                            <img src="proImg/pro.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                            <span class="w3-right w3-opacity">32 min</span>
                            <a href="profile.php?id=<?php echo $list['userId']?>">   <h4>A.b</h4><br></a>
                            <hr class="w3-clear">
                            <p>Have you seen this?</p>
                            
                           <p><?php echo $list['postContent']?></p>
                           <button type="button"  data-pid="<?php echo $list['postId']?>"  class="more-like w3-button w3-theme-d1 w3-margin-bottom">
                               <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
                               <span id="like<?php echo $list['postId']?>">
                               <?php totalLike($list['postId']);?></span></button> 
                              
                            <button type="button" data-pid="<?php echo $list['postId']?>"  class="more-comment w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>

                           </div> 
            
                    <?php
                    }
                    else
                    { ?>
                    
        
                       <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                            <img src="proImg/pro.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                            <span class="w3-right w3-opacity">32 min</span>
                             <a href="profile.php?id=<?php echo $list['userId']?>">   <h4>A.b</h4><br></a>
                            <hr class="w3-clear">
                            <p>Have you seen this?</p>
                            <img src="<?php echo 'imagePost/'.$list['postImage']?>" style="width:100%" class="w3-margin-bottom">
                           <p>img desc</p>
                           <button type="button" data-pid="<?php echo $list['postId']?>" 
                            class="more-like w3-button w3-theme-d1 w3-margin-bottom">
                               <i style="color:<?php echo $color?>" id="<?php echo $list['postId']?>" class="fa fa-thumbs-up"></i> &nbsp;
                               <span id="like<?php echo $list['postId']?>">
                               <?php totalLike($list['postId']);?></span></button> 
                           
                           <button  type="button" data-pid="<?php echo $list['postId']?>"  class="more-comment w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>

                       </div> 

        
                 <?php   
                    }
              
//                    else close post type
                    ?>        
        
         <!--        post area ends here-->
        <?php
                }
        
    }
}


?>
<script>




$(".more-comment").click(function(){
               var $this=$(this);
                pid=$this.data("pid");
                  window.alert(pid);
//          put inttial  ajax code for loadcomment.php page 
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
         });
    
     $(".more-like").click(function(){
                   var $this=$(this);
                pid=$this.data("pid");
               $("#"+pid).css("color","blue");
                 postId=new FormData();
                  postId.append("pid",pid);
                  postId.append("me","<?php echo $_SESSION['id']?>");
                  postId.append("like-btn","like");

                         $.ajax({
                              method: 'post',
                              url :"database/like.php",
                              cache:false,
                               data:postId,
                              contentType : false,
                              processData : false,
                              success : function(loadData){
                                 if(loadData=="yes")
                                 {
                                      $("#"+pid).css("color","");// remove icon color
//                                     get total like after deletion
                                     postId=new FormData();
                                      postId.append("pid",pid);
                                      postId.append("totalLikes","totalLikes");

                                     $.ajax({
                                          method: 'post',
                                          url :"database/like.php",
                                          cache:false,
                                           data:postId,
                                          contentType : false,
                                          processData : false,
                                          success : function(loadData){
                                            $("#like"+pid).html(loadData);
                                          }});

                                                                          
                                 }
                                else{
                                     
                                       $("#"+pid).css("color","blue");
                                //           get total like after insertion of like
                                        postId=new FormData();
                                        postId.append("pid",pid);
                                      postId.append("totalLikes","totalLikes");

                                         $.ajax({
                                              method: 'post',
                                              url :"database/like.php",
                                              cache:false,
                                               data:postId,
                                              contentType : false,
                                              processData : false,
                                              success : function(loadData){
                                                 $("#like"+pid).html(loadData);
                                              }});
                                  }
                              }
                          });
         
     });


</script>

