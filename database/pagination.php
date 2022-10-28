<?php
   include("database/connection.php");
   include_once("database/getPost.php");
    $database="posigraph_socialplexus";
    $table="posts";
    mysqli_select_db($conn,$database);
//here not only my post byt friends post as well so letter on we will use in operator
$friends=getFriends($_SESSION['id']);
 $query="select * from posts  where userId IN($friends,{$_SESSION['id']})";
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