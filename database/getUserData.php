<?php
 include("connection.php");
$database="posigraph_socialplexus";
 mysqli_select_db($conn,$database);
if(isset($_POST["userId"]) &&isset($_POST["fun"]))
{
    $fun=$_POST["fun"];
    $id=$_POST["userId"];
    
      switch($fun)
      {
          case "fetch":
            fetch($id);
              break;
        case "fetchSocial":
            fetchSocial($id);
              break;  
         case "fetchDp":
          fetchDp($id);
              break;
        case "updateDetalis":
            updateDetalis($id);
              break;
        case "updateSocial":
            updateSocial($id);
              break;
        case "updateDp":
            updateDp($id);
              break;      
        default :
              echo" error";
              break;

      

      }
}


function fetch($id)
{
    global $conn;
    $response=array();
   
     $query="select firstName,lastName,email,password,gender,phone,DOB,status from user where userId='$id'";
        $data=mysqli_query($conn,$query);
         if($data)
         {
            $row=mysqli_fetch_array($data);
             $response=$row;
             echo json_encode($response);
         } 
}
 function updateDetalis($id)
 {
     global $conn;
        $fName =$_POST["fName"];
        $lName =$_POST["lName"];
        $email =$_POST["email"];
        $pass =$_POST["pass"];
        $phone =$_POST["phone"];
        $dob =$_POST["dob"];
        $gen =$_POST["gen"];
        $about =$_POST["about"];
    
     
//     echo $fName."  ".$lName."  ".$email."  ".$pass." ".$phone." ".$dob." ".$about." ".$gen;
      $query="update user set firstName='$fName',lastName='$lName',email='$email',password='$pass',phone='$phone',gender='$gen',status='$about',DOB='$dob' where userId='$id'";
         $result=mysqli_query($conn,$query);
     
 }

function fetchSocial($id)
{
   global $conn;
    $response=array();
     $query="select job,city,state,pinCode,country,facebook,insta,linkedIn,twitter,website from user_details where userId='$id'";
        $data=mysqli_query($conn,$query);
         if($data)
         {
            $row=mysqli_fetch_array($data);
             $response=$row;
             echo json_encode($response);
         } 
    else
        echo "err";
}
function  updateSocial($id)
{
       global $conn;
        $job =$_POST["job"];
        $city =$_POST["city"];
        $pinCode =$_POST["pinCode"];
        $state =$_POST["state"];
        $country =$_POST["country"];
        $facebook =$_POST["facebook"];
        $insta =$_POST["insta"];
        $linkedIn =$_POST["linkedIn"];
        $twitter =$_POST["twitter"];
        $website =$_POST["website"];
//    echo $job." ".$city." ".$pinCode." ".$state." ".$country;
    $query="update user_details set job='$job',city='$city',pinCode='$pinCode',state='$state',country='$country',
 facebook='$facebook',insta='$insta',linkedIn='$linkedIn',twitter='$twitter',website='$website' where userId='$id'";
     if(!mysqli_query($conn,$query))
         echo " err";
    
  }
function updateDp($id)
{
    global $conn;
    $img=$_FILES['dp']['name'];
    $ext=pathinfo($img,PATHINFO_EXTENSION);
    $imgData=$_FILES['dp']['tmp_name'];
    $rnd=rand(1,100);
    $imgName=$rnd."user".$id.".".$ext;     
     $query="select dp from  user where userId='$id'";
     $data=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($data);
    $dp=$row['dp'];
    if($dp=="default_male.png"||$dp=="default_female.png")
    {
          $query="update user set dp='$imgName' where userId='$id'";
         if(mysqli_query($conn,$query)){
            
              move_uploaded_file($imgData,"../dp/".$imgName);
               fetchDp($id);
         }
        else
            echo "err";
    }
    else
    {
       
            $query="update user set dp='$imgName' where userId='$id'";
         if(mysqli_query($conn,$query)){

             unlink("../dp/$dp");// delete old dp and insert newone
              move_uploaded_file($imgData,"../dp/".$imgName);
             fetchDp($id);
         }
        else
            echo "err";
   
    }
    
    
  
}

function fetchDp($id)
{
    global $conn;
     $query="select dp from  user where userId='$id'";
     $data=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($data);
    $dp=$row['dp'];
    
      echo " <img src='dp/$dp' style='width:100%; height:200px;'>";
}

?>