<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	


$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$id = $_POST['idCli'];
$query = mysqli_query($link, "DELETE from cliente where idCli=".$id.""); // Query the users table
Print '<script>window.location.assign("clientes.php?insupddel=eliminado");</script>';
// Print '<script>window.location.assign("clientes.php");</script>'; // redirects to register.php



}



?>