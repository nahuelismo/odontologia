<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$letra = $_POST['letra'];
$update ="UPDATE backuppath SET letra='$letra'";
$query = mysqli_query($link, $update); // Query the users table
Print '<script>alert("Ha cambiado la unidad");</script>';
Print '<script>window.location.assign("seccionAdmin.php");</script>'; // redirects to register.php
//print($update);
}



?>