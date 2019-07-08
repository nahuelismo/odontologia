<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
$uri = $_POST['uri'];
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$idTrat = mysqli_real_escape_string($link, $_POST['trat']);
$idCita = mysqli_real_escape_string($link, $_POST['idCita']);
$comentario = mysqli_real_escape_string($link, $_POST['info']);
$sqlQuery = "insert into sesiontrat (idTrat, idCita, comentarios) values ($idTrat, $idCita, '')";
mysqli_query($link,$sqlQuery);
mysqli_query($link, "update agenda SET tratamiento = true where id=$idCita"); 
mysqli_query($link, "update tratamiento SET estadoTrat='i' where idTratamiento=$idTrat"); 
mysqli_query($link, "update agenda SET comentariosCita='$comentario' where id=$idCita"); 

///Print '<script>alert("Sesion Añadida");</script>'; // Prompts the user
Print '<script>window.location.assign("'.$uri.'.&insupddel=añadida");</script>';
}
?>  



