<?php 
$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
$sesion=explode("@",$_POST['todo'])[1];
$comentario=explode("@",$_POST['todo'])[0];
mysqli_query($link, "update sesiontrat SET comentarios='$comentario' where idSesion=$sesion"); 
?>