<?php
session_start();
$letra = $_POST['letra'];
$toDay = $letra.':/backups/'.date('d-m-Y-H-i-s');
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'odontologo';
$command = "C:/xampp/mysql/bin/mysqldump --opt -u $dbuser -h $dbhost $dbname -R > ".$toDay.".sql";
exec($command);
//print $command;
//Print '<script>alert(Respaldo creado con exito en: '.$toDay.'.sql");</script>';
//Print '<script>window.location.assign("inicio.php");</script>';
$_SESSION['backup']=date('d-m-Y');
Print '<script>alert("Se ha respaldado la base de datos!");</script>';
header("location: seccionAdmin.php");

?>