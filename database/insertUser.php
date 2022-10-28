<?php
include("connection.php");

$database="posigraph_socialplexus";
$table="user";
    
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
    // $DOB=date('DD/MM/YYYY');
    $DOB=date("Y/m/d");
    $comm_nm = "ajit";    
    $status="";
   
        //echo "<br>".$fName."<br>".$lName."<br>".$email."<br>".$pass."<br>".$conPass."<br>".$phone."<br>".$gender."<br>";
    
        mysqli_select_db($conn,$database);
        $check_email="select * from $table where email='$email'";
        $emails=mysqli_query($conn,$check_email);
        $total= mysqli_num_rows($emails);

    
//     password validation....
        if(strlen($pass) > 3)
        {          
            echo "<script>            
             $('#passbox').css('border-color','red');
             $('#passerr').html('al least 8 characters !');
            </script>"; 
         exit();
        }

     if (strcmp($pass, $conPass) !== 0) {          
          echo "<script>            
             $('#conpassbox').css('border-color','red');
             $('#conpasserr').html('din\'t match ! ');
            </script>";          
          exit();
      }     
        if($total >= 1)
        {
            echo "<script>
            
             $('#mailbox').css('border-color','red');
             $('#mailerr').html('Please try with another email ! ');
            </script>";                   
            exit();
        }

 //prepare sql query and insert user data
    
    $insert="insert into $table(common_name,firstName,lastName,email,gender,password,phone,regDate,verCode,verStatus,DOB,dp,status,lastLogIn,post,logInStatus) values('".$comm_nm."','".$fName."','".$lName."','".$email."','".$gender."','".$pass."','".$phone."',NOW(),'".$verCode."','".$verStatus."','".$DOB."','".$dp."','".$status."',NOW(),'".$post."','Online')";        
   
    if (mysqli_query($conn, $insert))
    {
        $query="select userId ,email,FirstName,dp from user where email='$email'";
        $userData=mysqli_query($conn, $query);
        $row=mysqli_fetch_array($userData);
        $id=$row['userId'];
        
        $query="insert into user_details(userId) values('$id')";
        mysqli_query($conn, $query);                
        
//      create a session variable and set user id  and  name... then redirect it to home page and  make a gate pass. here
           
            session_start(); 
           $_SESSION['id']=$id;
           $_SESSION['email']=$email;
           $_SESSION['name']=$fName;      
           $_SESSION['lname']=$lName;      
           
        //    $_SESSION['name']=$fName;      
        //    $_SESSION['name']=$fName;      
        //    $_SESSION['name']=$fName;      
        //    $_SESSION['name']=$fName;      
        //echo "<script>window.open('home.php','_self')</script>";
    
        $mailSent=sendMail($fName,$email,$verCode);
        if($mailSent)
        {            
           echo "<script>                       
            alert('A verification link has been sent to your email, please check & verify');  
            window.location.replace('index.php');
            </script>"; 
        }
        else
        {              
           echo "<script>            
             $('.msg').html('$mailSent');
            </script>"; 
        }        
   }
    else 
    {        
    echo "Error:  <br>" . mysqli_error($conn);
        exit();
   }
     
//echo "<script>window.open('home.php','_self')</script>"
function sendMail($name,$email,$verCode)
{    
require '../PHPMailerAutoload.php';

$mail = new PHPMailer;
define('EMAIL','info@posigraph.com');
define('PASS','Posigraph@123');

$mail->SMTPDebug = 4;                                      // Enable verbose debug output

$mail->isSMTP();                                         // Set mailer to use SMTP
$mail->Host='mail.posigraph.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                // Enable SMTP authentication
$mail->Username = EMAIL;                              // SMTP username
$mail->Password = PASS;                              // SMTP password
$mail->SMTPSecure='ssl';                          // Enable TLS encryption, `ssl` also accepted
$mail->Port=465;                               // TCP port to connect to

$mail->setFrom(EMAIL, 'info@posigraph.com');
$mail->addAddress($email,$name);     // Add a recipient
$mail->addReplyTo(EMAIL);

$mail->Subject = 'verification code';
$mail->Body    = "<p style='color:DodgerBlue;font-family:arial;font-size:35px'>Hi $name,</p>
<span>Verify your Posigraph account , come togather and enjoy sharing <b>photo,video and have  some fun & chit chat through messanger and live video chat </b></span>
<p style='font-family:arial;font-size:15px'> <a href='https://posigraph.com/app/posigraph/verify.php?email=$email&code=$verCode'>click here to verify and Sign In</a></p>
 ";
$mail->AltBody = "Hi $name";

if(!$mail->send()) {
    
    return 'Message could  not be sent ' .' Mailer Error: ' . $mail->ErrorInfo;
} else {
    return true;
//    echo 'Message has been sent';    
}    
}
?>
