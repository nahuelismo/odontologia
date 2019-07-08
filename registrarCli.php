<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$id = $_POST['idCliente'];
$nombre = mysqli_real_escape_string($link, $_POST['nombre']);
$apellido = mysqli_real_escape_string($link, $_POST['apellido']);
$ci = mysqli_real_escape_string($link, $_POST['documento']);
$tel = mysqli_real_escape_string($link, $_POST['telefono']);
$cel = mysqli_real_escape_string($link, $_POST['celular']);
$dir = mysqli_real_escape_string($link, $_POST['direccion']);
$sexo = mysqli_real_escape_string($link, $_POST['sexo']);
$info = mysqli_real_escape_string($link, $_POST['info']);
$poli = mysqli_real_escape_string($link, $_POST['poli']);
$mail = mysqli_real_escape_string($link, $_POST['mail']);

$dia = $_POST['dia'];
if($dia==''){
Print '<script>alert("Ingrese fecha de nacimiento");</script>'; // Prompts the user
print '<script>history.back()</script>'; // redirects to register.php
}else{
$mes = $_POST['mes'];
$año = $_POST['año'];

$nac = mysqli_real_escape_string($link, $dia."/".$mes."/".$año);

$bool = true;

    //mysqli_select_db("odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to database
$query = mysqli_query($link, "Select * from cliente"); // Query the users table
//$exists = mysqli_num_rows($query); //Checks if username exists
	while($row = mysqli_fetch_array($query))
	{
	$table_cli = $row['ciCli'];
	$table_cliId = $row['idCli'];
	if(($_POST['altamod']=='Modificar' && $ci == $table_cli && $id!=$table_cliId) || ($_POST['altamod']=='Registrar' && $ci == $table_cli)){
		$bool= false;
		Print '<script>alert("Ese documento ya fue registrado");</script>'; // Prompts the user
        print '<script>history.back()</script>'; // redirects to register.php
        }
    }

    if($bool)
    {
		if($_POST['altamod']=='Registrar'){
        mysqli_query($link,"INSERT INTO cliente (nombreCli, apellidoCli, ciCli, celCli, telCli, cliMail, dirCli, sexoCli, fechaNac, infoCli, policlinica) VALUES ('$nombre', '$apellido', $ci, '$cel','$tel', '$mail', '$dir', '$sexo', '$nac', '$info', '$poli')"); // inserts value into table users
		$query = mysqli_query($link, "SELECT LAST_INSERT_ID()");
			$idcli;
			while($row = mysqli_fetch_array($query)){
				$idcli = $row['LAST_INSERT_ID()'];
				mysqli_query($link,"INSERT INTO cpos VALUES ($idcli, 0,0,0,0)"); // inserts value into table users
		
			}
		// print "INSERT INTO cliente (nombreCli, apellidoCli, ciCli, celCli, telCli, cliMail, dirCli, sexoCli, fechaNac, infoCli, policlinica) VALUES ('$nombre', '$apellido', $ci, '$cel','$tel', '$mail', '$dir', '$sexo', '$nac', '$info', '$poli')";
        //terminar de arreglar, no inserta mail, tengo sueño
		//Print '<script>alert("Registrado con Exito");</script>'; // Prompts the user
		Print '<script>window.location.assign("clientes.php?insupddel=agregado");</script>';
		}
		else if($_POST['altamod']=='Modificar'){
		mysqli_query($link,"UPDATE cliente SET nombreCli='$nombre', apellidoCli='$apellido', ciCli=$ci, celCli='$cel', telCli='$tel', cliMail='$mail', dirCli='$dir', sexoCli='$sexo', fechaNac='$nac', infoCli='$info', policlinica='$poli' where idCli=$id"); // inserts value into table users
        //Print '<script>alert("Modificado con Exito");</script>'; // Prompts the user
		Print '<script>window.location.assign("clientes.php?insupddel=modificado");</script>';
		}
         // redirects to register.php
    }
}
}

?>