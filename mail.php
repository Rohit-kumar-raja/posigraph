<?php
sendMail("Ajit","in.ajitgupta9639@gmail.com","987");
function sendMail($name,$email,$code)
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

$mail->setFrom(EMAIL, 'posigraph');
$mail->addAddress($email,$name);     // Add a recipient
$mail->addReplyTo(EMAIL);

    $var=rand(1,1000000);
$mail->Subject = 'verificatoin code';
$mail->Body    = "<p style='color:DodgerBlue;font-family:arial;font-size:35px'>Hi $name,</p>
<span>Verify your Uphold Ally account , come togather and enjoy sharing <b>photo,video and have  some fun & chit chat through messanger and live video chat </b></span>
<p style='font-family:arial;font-size:20px'>verification code : <b>$var</b> </p>
 ";
$mail->AltBody = "Hi $name";

if(!$mail->send()) {
    echo 'Message could  not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    
}
    
}