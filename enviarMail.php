<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
$Dir = getcwd()."/PHPMailer/";
require $Dir.'src\Exception.php';

/* The main PHPMailer class. */
require $Dir.'src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require $Dir.'\src\SMTP.php';

$mail = new PHPMailer(TRUE);


if($_SERVER["REQUEST_METHOD"] == "POST"){
$to      = $_POST['mail'];
$subject = $_POST['subject'];
$message = $_POST['cont'];





$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Username = 'nahuelisimo@gmail.com';
/* App password. */
$mail->Password = 'hvjznovaclnwjerv';

try {
   /* Set the mail sender. */
   $mail->setFrom('nahuelisimo@gmail.com');
   $mail->setSender('nahuelisimo@gmail.com');

   /* Add a recipient. */
   $mail->addAddress($to);

   /* Set the subject. */
   $mail->Subject = $subject;

   /* Set the mail message body. */
   $mail->Body = $message;

   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}
//Print '<script>window.location.assign("envioMail.php?insupdel=Enviado");</script>';
}

?>