<?php

?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
   
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        text-align: center;
        display: inline-block;
        margin: 10px;
    }

    .title {
        color: grey;
        font-size: 18px;
    }

    button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    a {
        text-decoration: none;
        font-size: 22px;
        color: black;
    }

    button:hover,
    a:hover {
        opacity: 0.7;
    }
    </style>
</head>

<body>

    <div class="container-fluid">

        <div class="col-sm-12">
    
            <?php
include("database/connection.php");
$database="posigraph_socialplexus";
mysqli_select_db($conn,$database);

$a=$_GET['a'];
$a=trim($a);
//$b=str_replace(" ","%",$a);
    if(strlen($a)==0)
       header("location:./home.php");
        
if(strpos($a,'@')!==false)
{
    $query="select *  from user where email='{$a}'";
    $result=mysqli_query($conn,$query);
    if($result)
    {
     if(mysqli_num_rows($result)>= 1)
     {  
           while($row=mysqli_fetch_array($result))
           {
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
                  <div class='card'>
                  <img src='dp/{$dp}' alt='John' style='width:200px' height='200px'>
                  <h3 style='color:green'>{$fname} {$lname}</h3>
                  <p class='title'>{$job}</p>
                  <p style='color:green'>website : www.me.com</p>

                  <p style='color:green'>add: $city,$state,$country</p>
                  <a href='{$i}'><i class='fa fa-instagram'></i></a> 
                    <a href='{$t}'><i class='fa fa-twitter'></i></a> 
                  <a href='{$l}'><i class='a fa-linkedIn'></i></a> 
                  <a href='{$f}'><i class='fa fa-facebook'></i></a> 
                  <a href='./profile/profile.php?id={$id}'> <p><button>View Profile</button></p></a>
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
else{   
    $condition1='';
    $condition2='';
    $q=explode(" ",$a);
    foreach($q as $word)
    {
        $condition1.="firstName LIKE '%".mysqli_real_escape_string($conn,$word)."%' OR ";
         $condition2.="lastName LIKE '%".mysqli_real_escape_string($conn,$word)."%' OR ";
    }
    $condition1=substr($condition1,0,-4);
    $condition2=substr($condition2,0,-4);
    
    $query="select * from user where ".$condition1." OR ".$condition2;
//    echo "<script>window.alert('{$query}')</script>";
         $result=mysqli_query($conn,$query);
    if($result)
    {
     if(mysqli_num_rows($result)>= 1)
     {  
           while($row=mysqli_fetch_array($result))
           {
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
               <div class='card' style='width:400px'>
               <img class='card-img-top' src='dp/{$dp}' alt='Card image' style='width:100%'>
               <div class='card-body'>
                 <h4 class='card-title'>{$fname} {$lname}</h4>
                 <p class='card-text'>{$job}</p>
                 <a href='./profile/profile.php?id={$id}'> <p><button>View Profile</button></p></a>
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
//////////////////////////////////////////////////////////////////////////////////////
    ?>        

        </div>

        <div class="col-sm-2">

        </div>
    </div>
</body>

</html>