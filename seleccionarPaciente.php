<?php
session_start();
if(!isset($_POST['clienteId'])){
	$id = $_GET['cli'];
	$_SESSION['cliente'] = $_GET['paciente']."@".$id;
	Print '<script>alert("Cliente seleccionado");</script>'; // Prompts the user
	header("location: inicio.php");	
}else{


$id = $_POST['clienteId'];
if($id==""){
	Print '<script>alert("Seleccione un paciente de la lista");</script>'; // Prompts the user
	print '<script>history.back()</script>';
	$_SESSION['cliente'] = null;
	
}
else{
$_SESSION['cliente'] = $_POST['paciente']."@".$id;
header("location: inicio.php");
}
}



?>