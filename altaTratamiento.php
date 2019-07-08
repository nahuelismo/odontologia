<?php
//PONER VALIDACIONES
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server

//$idCita = mysqli_real_escape_string($link, $_POST['citasCli']);
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
$trat ="";
if(isset($_POST['tipoTrat'])){
$trat = mysqli_real_escape_string($link, explode("-",$_POST['tipoTrat'])[0]);}
else{$trat=="-1";}
$costo = mysqli_real_escape_string($link, $_POST['costo']);
$cliente = mysqli_real_escape_string($link, explode("@", $_POST['clientes'])[1]);
if($_POST['catTrat'] =="-1"){
	$trat = "";
}else if($_POST['tipoTrat']=="-1"){
	$trat = "";
}
if($cliente =="-1"){
	Print '<script>alert("Seleccione un paciente!");</script>'; // Prompts the user
	 print '<script>history.back()</script>';
}
else if(strlen($piezas)==2&&$caras==null){
	Print '<script>alert("Seleccione al menos una cara");</script>'; // Prompts the user
	 print '<script>history.back()</script>';
}
else{
$sqlQuery = "INSERT INTO  tratamiento(idCli,estadoTrat, piezas, caras, diagnostico, idTipoTrat, costo) VALUES ($cliente, 'p', '$piezas',";
if($caras !=null){
	$sqlQuery = $sqlQuery."'$caras', '$diag', '$trat', $costo)";
}else{
$sqlQuery = $sqlQuery."null, '$diag', '$trat', $costo)";
}
//print $sqlQuery;

mysqli_query($link,$sqlQuery); // inserts value into table users

//mysqli_query($link, "update agenda SET tratamiento =true where id=$idCita"); 
//print $sqlQuery;
// Print '<script>alert("Tratamiento Registrado!");</script>'; // Prompts the use
Print '<script>window.location.assign("planificacion.php?insupddel=agregado");</script>';
}
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