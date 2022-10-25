<?php
// session_start();
//  if(isset($_SESSION['email']))
//  {
//      echo "<script>window.open('./home.php','_self')</script>";
//  }

error_reporting(0);
include "./database/connection.php";
$database="posigraph_socialplexus";
$table="user";
    
if(isset($_POST['submit'])){
   
     $fName=$_POST['fname'];
     $lName=$_POST['lname'];
     $email=$_POST['mail'];
     $pass=$_POST['password'];
     $conPass=$_POST['conPassword'];
     $phone=$_POST['phone'];
    $gender=$_POST['gender'];

    $verStatus="unverified"; // will be verified when mail/sms(phone) is confirmed for vercode..
    $post="no";
    
    $verCode=mt_rand();/// take a random number for verification code
    
    $dp="default_male.png";
    $DOB=date('DD/MM/YYYY');
    $status="";
    
    mysqli_select_db($conn,$database);
    $check_email="select * from $table where email='$email'";
    $emails=mysqli_query($conn,$check_email);
    $total= mysqli_num_rows($emails);
    if($total>0){
        echo "<script>alert('You have already registred')</script>";
        //   echo "<script>window.open('home.php','_self')</script>";
    }else{

 //prepare sql query and insert user data
    
   $insert="insert into $table(firstName,lastName,email,gender,password,phone,regDate,verCode,verStatus,DOB,dp,status,lastLogIn,post,logInStatus) values('".$fName."','".$lName."','".$email."','".$gender."','".$pass."','".$phone."',NOW(),'".$verCode."','".$verStatus."','".$DOB."','".$dp."','".$status."',NOW(),'".$post."','Online')";        
    $ins = mysqli_query($conn, $insert);
    if($ins){


    // if (mysqli_query($conn, $insert))
    // {
    //     $query="select userId ,email,FirstName,dp from user where email='$email'";
    //     $userData=mysqli_query($conn, $query);
    //     $row=mysqli_fetch_array($userData);
    //     $id=$row['userId'];
        
    //     $query="insert into user_details(userId) values('$id')";
    //     mysqli_query($conn, $query);                
        
//      create a session variable and set user id  and  name... then redirect it to home page and  make a gate pass. here
           
        //     session_start(); 
        //    $_SESSION['id']=$id;
        //    $_SESSION['email']=$email;
        //    $_SESSION['name']=$fName;      
        //    $_SESSION['lname']=$lName;                 
        //echo "<script>window.open('home.php','_self')</script>";
    
        // $mailSent=sendMail($fName,$email,$verCode);
        // if($mailSent)
        // {            
        //    echo "<script>                       
        //     alert('A verification link has been sent to your email, please check & verify');            
        //     </script>"; 
        // }
        // else
        // {              
        //    echo "<script>            
        //      $('.msg').html('$mailSent');
        //     </script>"; 
        // }       
        
        
        require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        define('EMAIL','info@posigraph.com');
        define('PASS','Posigraph@123');
        
        $mail->isSMTP();
        $mail->Host='mail.posigraph.com';
        $mail->Port=465;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='ssl';
        
        $mail->Username='info@posigraph.com';
        $mail->Password='Posigraph@123';
        
        $mail->setFrom(EMAIL, 'info@posigraph.com');
        $mail->addAddress($email,$fName);    
        $mail->addReplyTo(EMAIL);
        
        $mail->isHTML(true);
        $mail->Subject = 'Posigraph Password';
        $mail->Body    = "<p style='color:DodgerBlue;font-family:arial;font-size:35px'>Hi $fName,</p>
        <span>Your <b>Posigraph</b> password is : <b>test</b> <br> Thank You </span>";
        $mail->AltBody = "your password : test";
        
        if(!$mail->send()){
            echo "<script>alert('messsage cannot send')</script>";
        }
        else{
            echo "<script>alert('messsage send')</script>";        
        }


   }
    else 
    {        
    echo "<script>alert('Error')</script>";
        // exit();
   }
}
}
//echo "<script>window.open('home.php','_self')</script>"
// function sendMail($name,$email,$verCode){

// }    

?>

<!DOCTYPE HTML>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     

   <style>
    body{
        background:#b5b5b5;
        padding-top: 20px;;
    }
    </style>
</head>


<body>
    <div class="container" id="reg">
        <div class="row">
           
            <div class="col-md-12">
                <div id="ui">
                    <form name="form" method="post"  class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="fname" placeholder="First Name" class="form-control"
                                    required="required" id="fnamebox">
                                <span id="nameerr" style="font-size:15; color:red; text-align:center;"></span>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="lname" placeholder="Last Name" class="form-control"
                                    id="lnamebox">
                            </div>
                        </div>
                        <br>
                        <input type="email" name="mail" class="form-control" placeholder="email@example.com"
                            required="required" id="mailbox">
                        <span id="mailerr" style="font-size:15; color:red; text-align:center;"></span>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="password" name="password" placeholder="password" class="form-control"
                                    required="required" id="passbox">
                                <span id="passerr" style="font-size:15; color:red; text-align:center;"><b>one 0-9, one
                                        A-Z,@/_</b></span>
                            </div>

                            <div class="col-sm-6">
                                <input type="password" name="conPassword" placeholder="confirm password"
                                    class="form-control" required id="conpassbox">
                                <span id="conpasserr" style="font-size:15; color:red; text-align:center;"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control" name="gender" required id="genderbox">
                                    <option>choose Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="phone" placeholder="phone" class="form-control" id="phonebox">
                                <span id="phoneerr" style="font-size:15; color:red; text-align:center;"></span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="checkbox" class="form-control" style="" required="required">
                            </div>
                            <div class="col-sm-10">
                                <p style="font-size:25;">Agree</p>
                            </div>
                        </div>
                        <br>

                        <input type="submit" value="Sign Up" name="submit" class="btn-primary btn-block btn-lg"
                            id="btn1">
                    </form>
                    <a href="/index.php" style="font-size:20">Already have an account?</a>
                    <br>
                    \
                    <h4 class="msg" style="color:#000080; text-align:center;"></h4>

                </div>              
            </div>        
        </div>
    </div>


</body>

</html>