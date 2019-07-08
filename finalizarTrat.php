<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$idTrat = mysqli_real_escape_string($link, $_POST['idTrat']);
mysqli_query($link, "update tratamiento SET estadoTrat='f' where idTratamiento=$idTrat"); 
//Print '<script>alert("Tratamiento Finalizado");</script>'; // Prompts the user
Print '<script>window.location.assign("planificacion.php?insupddel=finalizado");</script>';
}
?>