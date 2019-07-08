<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server

$idCita = mysqli_real_escape_string($link, $_POST['citasCli']);
$piezas = mysqli_real_escape_string($link, $_POST['piezas']);
$caras = "";
if(isset($_POST['cara']))
{
$arrayCaras = $_POST['cara'];
 foreach($arrayCaras as $cara){
	$caras = $caras.$cara.",";
 }
 
}else{
	$caras=null;
}
$diag = mysqli_real_escape_string($link, $_POST['diag']);	
$trat = mysqli_real_escape_string($link, $_POST['tratamiento']);

$sqlQuery = "INSERT INTO  tratamiento(idCita, piezas, caras, diagnostico, tratamiento) VALUES ($idCita, '$piezas', ";
if($caras !=null){
	$sqlQuery = $sqlQuery."'$caras', '$diag', '$trat')";
}else{
$sqlQuery = $sqlQuery."null, '$diag', '$trat')";
}
print $sqlQuery;

mysqli_query($link,$sqlQuery); // inserts value into table users
mysqli_query($link, "update agenda SET tratamiento =true where id=$idCita"); 
Print '<script>alert("Tratamiento Registrado!");</script>'; // Prompts the user
Print '<script>window.location.assign("planificacion.php");</script>';
}

/*print "<br> --- id Cita: ";
print $idCita;
print "<br> --- Piezas: ";
print $piezas;
print "<br> --- Caras seleccionadas: ";
print $caras;
print "<br> --- diagnostico: ";
print $diag;
print "<br> --- tratamiento: ";
print $trat;*/




?>