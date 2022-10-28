<?php
include "posi_header.php";
?>
<body>
<div class="container" style="margin-top:65px">
    <h3 class="text-center">Your Search Is Here</h3>
    <hr>
<div class="row">
<?php
include("database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

$a=$_GET['a'];
$a=trim($a);
//$b=str_replace(" ","%",$a);
if(strlen($a)==0)
header("location:./home.php");
        
//search by email id
if(strpos($a,'@')!==false){
    $query="select *  from user where  verStatus='verified' && email='{$a}'";
    $result=mysqli_query($conn,$query);
    if($result){
     if(mysqli_num_rows($result)>= 1){  
           while($row=mysqli_fetch_array($result)){
               $fname=$row['firstName'];
               $lname=$row['lastName'];
               $dp=$row['dp'];
               $id=$row['userId'];
               $details = mysqli_query($conn,"select * from user_details where userid='$id'");
               $row=mysqli_fetch_array($details);
               $job=$row['job'];  
               $city=$row['city'];
               $state=$row['state']; 
               $country=$row['country'];  
               $f=$row['facebook'];  
               $i=$row['insta'];
               $t=$row['twitter'];
              $l=$row['linkedIn'];                              
               
               echo "  
                
                  <div class='card' style='
                  border: 2px dashed;'>
                  <img src='dp/{$dp}' alt='John' style='width:200px' height='200px'>
                  <h3 style='color: #3a768f;
                  padding: 10px;
                  text-align: center;
                  font-weight: 600;'>{$fname} {$lname}</h3>                                                     
                  
                  <a href='./profile/profile.php?id={$id}'> <p style='text-align:center'><button class='btn btn-info'>View Profile</button></p></a>
                </div>
               ";                    
           }      

                    // <p style='color:green'>add: $city,$state,$country</p>
                        // <p class='title'>{$job}</p>
                    //  <a href='{$i}'><i class='fa fa-instagram'></i></a> 
                    //  <a href='{$t}'><i class='fa fa-twitter'></i></a> 
                    //  <a href='{$l}'><i class='a fa-linkedIn'></i></a> 
                    //  <a href='{$f}'><i class='fa fa-facebook'></i></a> 

     }        
        else
            echo "<script>window.alert('sorry no such record')</script>";
    }
 else
      mysqli_error($conn);
}    
else{ 

    $condition1='';
    $condition2='';
    $q=explode(" ",$a);
    foreach($q as $word){
    $condition1.="firstName LIKE '%".mysqli_real_escape_string($conn,$word)."%' OR ";
    $condition2.="lastName LIKE '%".mysqli_real_escape_string($conn,$word)."%' OR ";
    }
    $condition1=substr($condition1,0,-4);
    $condition2=substr($condition2,0,-4);
    
    $query="select * from user where ".$condition1." OR ".$condition2;
//    echo "<script>window.alert('{$query}')</script>";
    $result=mysqli_query($conn,$query);
    if($result){
     if(mysqli_num_rows($result)>= 1){  

           while($row=mysqli_fetch_array($result)){
               $fname=$row['firstName'];
               $lname=$row['lastName'];
               $dp=$row['dp'];
               $id=$row['userId'];
               $details=mysqli_query($conn,"select * from user_details where userid='$id'");
               $row=mysqli_fetch_array($details);
               $job=$row['job'];  
               $city=$row['city'];
               $state=$row['state']; 
               $country=$row['country'];  
               $f=$row['facebook'];  
               $i=$row['insta'];
               $t=$row['twitter'];
              $l=$row['linkedIn'];
                                             
               echo "
               <div class='col-md-3'>
               
               <div class='card' style=''>
               <img class='card-img-top' src='dp/{$dp}' alt='Card image' style=''>
               <div class='card-body'>
                 <h4 class='card-title'>{$fname} {$lname}</h4>                 
                  <a href='./profile/profile.php?id={$id}'> <p><button class='btn btn-success'>View Profile</button></p></a>
               </div>
             </div>  
             </div>                            
               ";                    
           }             
     }        
        else
            echo "<script>window.alert('sorry no such record')</script>";
    }
 else
      mysqli_error($conn);            
}
    ?>        
        </div>


</div>

</body>

</html>