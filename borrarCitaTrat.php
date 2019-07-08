<?php
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$idTrat = explode("@", $_POST['vars'])[1];
$idCita = explode("@", $_POST['vars'])[0];
print $_POST['vars'];
print $idCita."<br>";
print $idTrat."<br>";
$query = "DELETE from sesiontrat where idCita=".$idCita." and idTrat=".$idTrat."";
$queryMod = "Update agenda set tratamiento=false where idCita=$idCita";
$querySelect= "Select idCita from sesiontrat where idTrat<>$idTrat";

			
			
print $query;
$query = mysqli_query($link, $query); // Query the users table
$filas = mysqli_num_rows($queryselect);
		if($filas!=0){
$query = mysqli_query($link, $queryMod); // Query the users table
		}
Print '<script>alert("La cita ha sido eliminada del tratamiento!");</script>';



?>