<?php
include("connection.php");
$database="posigraph_socialplexus";

$table="user";
$email=$_POST['mail'];
$pass=$_POST['pass'];
$ver="verified";

mysqli_select_db($conn,$database);
$logInQuery="select * from user where email='".$email."'";
   $emails=mysqli_query($conn,$logInQuery);
   if($emails)
   {
       $user=mysqli_num_rows($emails);
       $row=mysqli_fetch_array($emails);
      
        if($user>0)
        {
            if(passwordVerfied($row['password'],$pass))
            {
                if($row['verStatus']=='unverified')
                {
                    echo"please verify your email";
                }
                else
                {
                session_start();
                $_SESSION['id']=$row['userId'];
                 $_SESSION['dp']=$row['dp'];
                $_SESSION['email']= $email; 
                $_SESSION['name']=$row['firstName']; 
                $_SESSION['lname']=$row['lastName']; 
            
                mysqli_query($conn,"update user set logInStatus='Online' where userId=".$_SESSION['id']);
            
            
            echo "<script>
            alert('You Have Successfully Logged In');
            window.open('./dashboard.php','_self')</script>";
                }
            }
            else
            { 
                 echo"invalid user name and password..";
             }                       
        }
            else
            {
                echo"your account is not avaliable,please create an account first !";
            }
       
   }
    else
    {
        echo "Error". mysqli_error($conn);
        exit();
    }

function passwordVerfied($dbPass,$enterPass)
{
    if($dbPass===$enterPass)
        return true;
    else
        return false;
}
