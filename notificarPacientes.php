<?php 

print 'NO CERRAR LA PËSTAÑA';   

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		
	
	$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
	$query = mysqli_query($link, "Select C.*, A.fechaHora from cliente C, agenda A where C.idCli=A.idCli and DATEDIFF(DATE_FORMAT(A.fechaHora, '%Y-%m-%d'),CURDATE())=1 ");
	while($row = mysqli_fetch_array($query))
	{
		$correo = $row['cliMail'];
		$sexo = $row['sexoCli'];
		$nombre = $row['nombreCli'];
		$apellido = $row['apellidoCli'];
	
		$hora = substr(explode(" ", $row['fechaHora'])[1], 0, 5);
		//print $hora;
		enviarMail($correo, $nombre, $apellido, $sexo, $hora);
	}


function enviarMail($correo, $nombre, $apellido, $sexo, $hora){
		$Dir = getcwd()."/PHPMailer/";
		require $Dir.'src\Exception.php';
		require $Dir.'src\PHPMailer.php';
		require $Dir.'\src\SMTP.php';
		$mail = new PHPMailer(TRUE);
		$mail->Mailer = "smtp";
		//$mail->isSMTP();
		$mail->SMTPDebug = 1;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Username = 'odontologiaeula@gmail.com';
		$mail->Password = 'ufzcjkudixhojzlg';
		$message = $nombre.' '.$apellido.', se le informa que tiene una cita pendiende el dia de mañana a las '.$hora;
		if($sexo=='m'){
			$message = 'Sr. '.$message;
		}else{
			$message = 'Sra.'.$message;
		}
			//print $message.'<br>';
	try {
   /* Set the mail sender. */
   $mail->setFrom('odontologiaeula@gmail.com');
   //$mail->setSender('nahuelisimo@gmail.com');

   /* Add a recipient. */
   $mail->addAddress($correo);

   /* Set the subject. */
   $mail->Subject ='Cita proxima con Odonotolgo';

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