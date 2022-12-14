<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';

function sendApprovedEmail($transId, $fullname, $email) {


  $mail = new PHPMailer(true);

  $body ="<p>Dear $fullname,</p>
<p>Greetings of peace!</p>
<p>Your transaction <b>$transId</b> has been fully approved. To download a PDF copy of the transaction please return to the CoCo Portal Dashboard.</p>
<p>This is an auto generated email please do not reply.</p>";
try {
  //Server settings
  //Server settings
   $mail->SMTPDebug = SMTP::DEBUG_SERVER;
   $mail->isSMTP();
   $mail->Host       = 'smtp.gmail.com';     //platform
   $mail->SMTPAuth   = true;
   $mail->Username   = 'cocoportal.ceumls@gmail.com';   //email
   $mail->Password   = 'nimluwxvmqpflhxl';                                //password
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   $mail->Port       = 587;

   //Recipients
   $mail->setFrom($mail->Username);       //sender
   $mail->addAddress($email);

   //Content
   $mail->isHTML(true);
   $mail->Subject = "Transaction has been approved - $transId" ;
   $mail->Body    = $body;             //content

   $mail->SMTPDebug  = SMTP::DEBUG_OFF;
   $mail->send();
  //  echo '<script>alert("message has been sent")</script>';
  //  echo "message has been sent";
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}


function sendDeniedEmail($transId, $fullname, $email, $remarks) {
  $mail = new PHPMailer(true);

  $body ="<p>Dear $fullname,</p>
<p>Greetings of peace!</p>
<p>Your transaction <b>$transId</b> has been rejected</p>
<p>Reason: $remarks</p>
<p>To get more details on the rejection, please check your CoCo Portal Dashboard.</p>
<p>This is an auto generated email please do not reply.</p>";
  try {
    //Server settings
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = 'cocoportal.ceumls@gmail.com';   //email
     $mail->Password   = 'nimluwxvmqpflhxl';                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = 587;

     //Recipients
     $mail->setFrom($mail->Username);       //sender
     $mail->addAddress($email);

     //Content
     $mail->isHTML(true);
     $mail->Subject = "Transaction has been rejected - $transId";
     $mail->Body    = $body;             //content

     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
        // echo '<script>alert("message has been sent")</script>';
    //  echo "message has been sent";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}


function sendNewAcc($username, $password, $email) {
  $mail = new PHPMailer(true);

  $body ="<p>Greetings of peace!</p>
<p>We have successfully registered your CoCo Account</p>
<p>Please Login using this credentials through our CoCo Portal</p>
<p><b>Username: $username</b></p>
<p><b>Password: $password</b></p>
<p>This is an auto generated email please do not reply.</p>
<p>Thank you and stay safe.</p>";
  try {
    //Server settings
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = 'cocoportal.ceumls@gmail.com';   //email
     $mail->Password   = 'nimluwxvmqpflhxl';                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = 587;

     //Recipients
     $mail->setFrom($mail->Username);       //sender
     $mail->addAddress($email);

     //Content
     $mail->isHTML(true);
     $mail->Subject = 'Your CoCo Portal Account has been successfully registered';
     $mail->Body    = $body;             //content


     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
    //header
