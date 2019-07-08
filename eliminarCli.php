<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
if($_POST['bajamod'] == 'Eliminar')
{
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$id = $_POST['idCli'];
$query = mysqli_query($link, "DELETE from cliente where idCli=".$id.""); // Query the users table
Print '<script>alert("El paciente ha sido eliminado!");</script>';
Print '<script>window.location.assign("clientes.php");</script>'; // redirects to register.php
}
}
else if($_POST['bajamod'] == 'modificar')
{
  $id = $_POST['idCli'];
  Print '<script>alert("quisite modificar al paciente id:'.$id.'!");</script>';
}

?>