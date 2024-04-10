<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include('contact.php');

require __DIR__ . '/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

    //Server settings
                        //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ksahar071@gmail.com';                     //SMTP username
    $mail->Password   = 'cvso vccu xgrl ofwu';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ksahar071@gmail.com');
    $mail->addAddress($_POST["email"]); 
      

    //Attachments
    $email= $_POST['email'];
    $message = $_POST['message'];
    $subject= $_POST ['subject'];
   
    //Content
     //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    
    $mail->send();
    echo 'Message has been sent';
    //header( 'Location:index.php');
    //$mail->smtpClose();

?>