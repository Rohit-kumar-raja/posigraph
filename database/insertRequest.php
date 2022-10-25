<?php

include("connection.php");
$database="posigraph_socialplexus";
$table="posts";
mysqli_select_db($conn,$database);
if(isset($_FILES['file']['name'])&&(strlen($_POST['text'])>0))
{
    $id=$_POST['id'];
    $cont=$_POST['text'];
    $img=$_FILES['file']['name'];
    $imgData=$_FILES['file']['tmp_name'];
    $type=$_FILES['file']['type'];
    $unq=rand(1,10000000);
    $imgName=$id.$unq.$img;
    move_uploaded_file($imgData,"../imagePost/".$imgName);
//   echo $_POST['text']."  ".$_FILES['file']['name'];    
    $insert="insert into battle(userId,postContent,postImage,type,postDate)values('".$id."','".$cont."','".$imgName."','".$type."',NOW())";    
         if (mysqli_query($conn, $insert))
        {   
             $update="update user set post='yes' where userId='$id'";
             $sqlresult=mysqli_query($conn, $update);
//              echo "<script>window.open('dashboard.php','_self')</script>";
//             header("location:http://localhost/plexus/dashboard.php");

        }
        else 
        {
        echo "Error:  <br>" . mysqli_error($conn);            
        }    
}
else if(isset($_FILES['file']['name'])&&($_POST['text']==''))
{
//    insert only image
    $id=$_POST['id'];
    $cont="";
    $img=$_FILES['file']['name'];
    $imgData=$_FILES['file']['tmp_name'];
    $type=$_FILES['file']['type'];
    $unq=rand(1,10000000);
    $imgName=$id.$unq.$img;
    move_uploaded_file($imgData,"../imagePost/".$imgName);
//   echo $_POST['text']."  ".$_FILES['file']['name'];
    
    $insert="insert into posts(userId,postContent,postImage,type,postDate)values('".$id."','".$cont."','".$imgName."','".$type."',NOW())";    
         if (mysqli_query($conn, $insert))
        {   
             $update="update user set post='yes' where userId='$id'";
             $sqlresult=mysqli_query($conn, $update);
              echo "<script>window.open('dashboard.php','_self')</script>";
        }
        else 
        {
        echo "Error:  <br>" . mysqli_error($conn);            
        }    
}
else if(!isset($_FILES['file']['name']) && (strlen($_POST['text'])>0) )
{
//    insert only text
    $id=$_POST['id'];
    $cont=$_POST['text'];
    $type="text";
//   echo $_POST['text']."  ".$_FILES['file']['name'];
    
    $insert="insert into posts(userId,postContent,type,postDate)values('".$id."','".$cont."','".$type."',NOW())";    
         if (mysqli_query($conn, $insert))
        {   
             $update="update user set post='yes' where userId='$id'";
             $sqlresult=mysqli_query($conn, $update);
              echo "<script>window.open('dashboard.php','_self')</script>";
        }
        else 
        {
        echo "Error:  <br>" . mysqli_error($conn);            
        }    
}
else
    echo "please insert some data";
    

//    if(!isset($_FILES['file']['name']))
//    {
//        if($_POST['text'].length>0)
//         echo $_POST['text'];
//        else
//          echo "no content in data";  
//    }
//              
//else
//{
//    echo $_POST['text']."  ".$_FILES['file']['name'];
//}
//    

?>