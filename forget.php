<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>Posigraph </title>
    <link rel="icon" type="image/x-icon" href="https://posigraph.com/posi_favicon.png">
    <style>
    body {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    .logo-brand {
        text-align: center;
    }

    .logo-brand .brand-logo {
    width: 140px;
    margin-top:40px;
}

    .form {
        background-image: linear-gradient(325deg, #d11e7a, #5059a8);
        border-radius: 0px;
        height: 60vh;
        padding: 20px;
        width: 100%;
        border-radius: 39% 79% 100% 0% / 8% 42% 0% 85%;
    }

    .title {
        color: #eee;
        font-family: sans-serif;
        font-size: 24px;
        font-weight: 400;
        margin-top: 30px;
        margin-left: 20px;
    }

    .subtitle {
        color: #eee;
        font-family: sans-serif;
        font-size: 16px;
        font-weight: 600;
        margin-top: 10px;
    }

    .input-container {
        height: 35px;
        position: relative;
        width: 100%;
        margin: 10px 0;
    }

    .btn {
        border-radius: 25px;
        padding: 10px 40px;
        font-weight: 800;
    }

    .input,
    .form-select {
        background-color: #ffffff;
        border-radius: 25px;
        border: 0;
        box-sizing: border-box;
        color: #5d6570;
        font-size: 18px;
        height: 100%;
        outline: 0;
        padding: 0px 20px 0;
        width: 90%;
        height: 40px;
        margin-left: 20px;
    }

    .cut {
        background-color: #15172b;
        border-radius: 10px;
        height: 20px;
        left: 20px;
        position: absolute;
        top: -20px;
        transform: translateY(0);
        transition: transform 200ms;
        width: 76px;
    }

    .cut-short {
        width: 50px;
    }

    .input:focus~.cut,
    .input:not(:placeholder-shown)~.cut {
        transform: translateY(8px);
    }

    .placeholder {
        color: #65657b;
        font-family: sans-serif;
        left: 20px;
        line-height: 14px;
        pointer-events: none;
        position: absolute;
        transform-origin: 0 50%;
        transition: transform 200ms, color 200ms;
        top: 20px;
        
    }

    .input:focus~.placeholder,
    .input:not(:placeholder-shown)~.placeholder {
        transform: translateY(-30px) translateX(10px) scale(0.75);
    }

    .input:not(:placeholder-shown)~.placeholder {
        color: #808097;
    }

    .input:focus~.placeholder {
        color: #dc2f55;
    }

    .submit {
        background-color: #fff;
        border-radius: 25px;
        border: 0;
        box-sizing: border-box;
        color: #095f89;
        cursor: pointer;
        font-size: 18px;
        height: 35px;
        font-weight: 700;
        margin-top: 38px;
        outline: 0;
        text-align: center;
        width: 90%;
    }

    .submit:active {
        background-color: #06b;
    }

    .other-links {
        /* text-align: center; */
    }

    .other-links a {
        color: #fff;
        text-align: center;
        font-size: 14px;
        text-decoration: none;
        /* text-transform: uppercase; */
        font-weight: 800;
    }

    #switch-links {
        margin-top: 30px;
    }
    .posigraph_back{       
    position: absolute!important;
    bottom: 0px!important;
    width: 100%!important;
        }
        .btn-frgt{
            width: 90%;
            margin-top: 20px;
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="logo-brand">
        <img class="brand-logo" src="posigraph_logo.png" alt="" />
        <!-- <img class="brand-name" src="brand name png.png" alt="" /> -->
    </div>
    <div class="posigraph_back">
        <form class="form form-group" method="post">
            <div class="title">Forget Password</div>
            <div class="input-container ic1">
                <input class="input" name="email" type="email" placeholder="Enter Email" required="required"
                    id="fnamebox" />               
            </div>
            <input type="submit" value="Send" name="submit" class="btn btn-primary btn-block btn-md btn-frgt" />
            <!-- <button type="submit"  class="btn form-control btn-success">Send</button> -->
            <p id="msg"></p>
        </form>
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
            alert('password is sent to your registered email id');
            window.location.replace('index.php');
            </script>";
        
        else
            echo  "<script>
             $('#msg').html('sorry,something went wrong');
            </script>";
    }
    else
    {
       echo "invlaid account or email";
    }
}


function sendMail($name,$email,$pass)
{
    
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;
define('EMAIL','info@posigraph.com');
define('PASS','Posigraph@123');

$mail->SMTPDebug = 4;                                      // Enable verbose debug output

$mail->isSMTP();                                         // Set mailer to use SMTP
$mail->Host='mail.posigraph.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                // Enable SMTP authentication
$mail->Username = EMAIL;                              // SMTP username
$mail->Password = PASS;                              // SMTP password
$mail->SMTPSecure='ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port=465;                                   // TCP port to connect to

$mail->setFrom(EMAIL, 'info@posigraph.com');
$mail->addAddress($email,$name);                 // Add a recipient
$mail->addReplyTo(EMAIL);

$mail->Subject = 'Posigraph Password';
$mail->Body    = "<p style='color:DodgerBlue;font-family:arial;font-size:35px'>Hi $name,</p>
<span>Your <b>Posigraph</b> password is : <b>$pass</b> <br> Thank You </span>";
$mail->AltBody = "your password : $pass";

if(!$mail->send()) {
    
    return false;
} else {
    return true;
//    echo 'Message has been sent';
    
}
    
}
?>