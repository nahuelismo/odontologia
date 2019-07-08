<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server

//$idCita = mysqli_real_escape_string($link, $_POST['citasCli']);
$id = mysqli_real_escape_string($link, $_GET['id']);
$precio = mysqli_real_escape_string($link, $_POST['precio']);
mysqli_query($link, "update tipostrat SET precio=$precio where id=$id"); 
Print '<script>alert("Se ha modificado el precio");</script>'; // Prompts the user
Print '<script>window.location.assign("ajustarPrecios.php");</script>';
}
?>