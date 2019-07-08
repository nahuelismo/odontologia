<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

$file = $_POST['backup'];	

$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
	$query = mysqli_query($link, "Select * from backuppath");
	$letra;
	while($row = mysqli_fetch_array($query))
	{
		//nombreCli, apellidoCli, ciCli, celCli, telCli, dirCli
		//print '<tr><form action="BajaModCli.php" method="POST">';	
		$letra = $row['letra'];
	}
/*$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
	$query = mysqli_query($link, "Select * from backuppath");
	$letra;
	while($row = mysqli_fetch_array($query))
	{
		//nombreCli, apellidoCli, ciCli, celCli, telCli, dirCli
		//print '<tr><form action="BajaModCli.php" method="POST">';	
		$letra = $row['letra'];
	}*/

$toDay = $letra.':/backups/'.$file;
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'odontologo';
$command = "C:/xampp/mysql/bin/mysql -u $dbuser -h $dbhost $dbname < ".$toDay;
exec($command);
Print '<script>window.location.assign("seccionAdmin.php");</script>';
}
?>