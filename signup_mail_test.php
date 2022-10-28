<?php

function sendMail(){
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host='mail.posigraph.com';
$mail->Port=465;
$mail->SMTPAuth=true;
$mail->SMTPSecure='ssl';

$mail->Username='info@posigraph.com';
$mail->Password='Posigraph@123';

$mail->setFrom('info@posigraph.com','ajit');
$mail->addAddress('in.ajitgupta9639@gmail.com');
$mail->addReplyTo('in.ajitgupta9639@gmail.com');

$mail->isHTML(true);
$mail->Subject='php mailer subject';
$mail->Body='<h1>this mail is from php mailer</h1>';

if(!$mail->send()){
    echo "<script>alert('messsage cannot send')</script>";
}
else{
    echo "<script>alert('messsage send')</script>";

}
}

?>