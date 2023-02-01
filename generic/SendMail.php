<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "phpmailer/src/Exception.php";
include "phpmailer/src/PHPMailer.php";
include "phpmailer/src/SMTP.php"; 

function sendMail($EMAILTO,$subject,$message)
{
    $headers = "From: Tufail Gulzar" . "\r\n";
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tufielgulzar20@gmail.com';
    $mail->Password = 'xtqsisrkqtoqcpmi';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('tufielgulzar20@gmail.com');
    $mail->addAddress($EMAILTO);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->send();
}

?>