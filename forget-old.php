<html>

<head>
   
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        
</head>
    
    <body>
    <div class="container" style="margin:100 auto">
        <div class="row">
        
        <div class="col-sm-3"></div>
         <div class="col-sm-6">
            
            <div class="row">
             <form method="post">
             <div class="col-sm-7">
                 <input required name="email" type="email" class="form-control" ></div>
                 
             <div class="col-sm-3"> 
                 <button type="submit"  class="form-control btn-success">send</button>
                 </div>
                </form>
               
             </div>
             <br>
              <p id="msg"></p>
            </div> 
         <div class="col-sm-3"></div>    
        </div>
        
    </div>
   

    </body>


</html>

<?php


function redirect()
{
    header("location:./index.php");
    exit();
}

if(isset($_POST['email']))
{
      include("database/connection.php");
   mysqli_select_db($conn,"posigraph_socialplexus");
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    
    $query="select firstName,password from user where email='$email'";
    $result=mysqli_query($conn,$query);
    $total= mysqli_num_rows($result);
    if($total>0)
    {
        $row=mysqli_fetch_array($result);
//        send password in email
       
        $result=sendMail($row['firstName'],$email,$row['password']);
        if($result)
            echo "<script>
             $('#msg').html('password is sent to your registered email id');
            </script>";
        
        else
            echo  "<script>
             $('#msg').html('sorry,something went wrong');
            </script>";
    }
    else
    {
       echo "ivlaid account or email";
    }
}


function sendMail($name,$email,$pass)
{
    

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;
define('EMAIL','in.ajitgupta9639@gmail.com');
define('PASS','Pulsar180');

//$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(EMAIL, 'plexus');
$mail->addAddress($email,$name);     // Add a recipient
$mail->addReplyTo(EMAIL);

$mail->Subject = 'Posigraph Password';
$mail->Body    = "<p style='color:DodgerBlue;font-family:arial;font-size:35px'>Hi $name,</p>
<span>Your <b>Ally</b> password is : <b>$pass</b> <br> please change the password to keep your accounrt safe </span>";
$mail->AltBody = "your password : $pass";

if(!$mail->send()) {
    
    return false;
} else {
    return true;
//    echo 'Message has been sent';
    
}
    
}
?>