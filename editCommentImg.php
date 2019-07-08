<?php 
$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
$id=explode("@",$_POST['todo'])[1];
$comentario=explode("@",$_POST['todo'])[0];
mysqli_query($link, "update imagenes SET descripcion='$comentario' where idImg=$id"); 
?>