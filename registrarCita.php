<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$cliAsignado =true;
if(isset($_POST['clientes'])){
$cli = mysqli_real_escape_string($link, explode("@",$_POST['clientes'])[0]);
$idCli = mysqli_real_escape_string($link, explode("@",$_POST['clientes'])[1]);
}
else{
$nombreCli =mysqli_real_escape_string($link, $_POST['nombre']);
$apellidoCli = mysqli_real_escape_string($link, $_POST['apellido']);
$cli = mysqli_real_escape_string($link, $nombreCli.' '.$apellidoCli);
$cliAsignado=false;
if($_POST['cedula']!=""){
$ci = mysqli_real_escape_string($link, $_POST['cedula']);
}
else{
$ci ='null';
} 
}
$comentarios = mysqli_real_escape_string($link, $_POST['info']);

//$mes = $_POST['mes'];
//$hoy = date("d-m-Y H:i:s", time());

//$año = $_POST['año'];
$fecha = $_POST['fecha'];
$horaCompleta =$_POST['hora'];
//$minutos =$_POST['minutos'];
$duracion =$_POST['duracion'];
$numHs = explode(':', $horaCompleta)[0];
$numMin = explode(':',$horaCompleta)[1];
$error = 0;
$query = mysqli_query($link, "Select A.*, (SELECT DATE_ADD((Select fechaHora from agenda A2 where A2.id = A.id) , INTERVAL (Select duracion from agenda A2 where A2.id = A.id)*30 MINUTE)) horaFin from agenda A"); // Query the users table
//$exists = mysqli_num_rows($query); //Checks if username exists
	while($row = mysqli_fetch_array($query))
	{
	$nuevoMin = $numMin;
	$nuevoHs= $numHs;
	$Hora = $horaCompleta;
	$cliInsertado = false;
	for($i=0;$i<$duracion;$i++){
	$nuevoMin+=30;
	if($nuevoMin==60){
	$nuevoMin='00';
	$nuevoHs++;
	}
	if(strlen($nuevoMin)==1){
	 $nuevoMin = '0'.$nuevoMin;
	}
	$HoraFin = $nuevoHs.':'.$nuevoMin;
	$table_fecha = $row['fechaHora'];
	
	$table_fechaFin= $row['horaFin'];
	/*
	print "-----------------------------";
	print $table_fecha;
	print "<br>";
	print $table_fechaFin;
	print "<br>";
	print strtotime($table_fecha);
	print "<br>";
	print strtotime($table_fechaFin);
	print "<br>";
	print $fecha.' '.$Hora;
	print "<br>";
	print strtotime($fecha.' '.$Hora);
	print "<br>";
	print $fecha.' '.$HoraFin;
	print "<br>";
	print strtotime($fecha.' '.$HoraFin);*/
	
	if($Hora == $HoraFin){
		$error =1;
		
	}
	if(strtotime($fecha.' '.$Hora)<strtotime($table_fechaFin) && (strtotime($fecha.' '.$Hora)>=strtotime($table_fecha))){
		$error = 2;
	}
	if(strtotime($fecha.' '.$HoraFin)<strtotime($table_fechaFin) && (strtotime($fecha.' '.$HoraFin)>strtotime($table_fecha))){
		$error = 2;
	}
	if(strtotime($fecha.' '.$Hora)==strtotime($fecha.' 22:00')){
		$error = 3;
	}
	$Hora=$HoraFin;
	
	
	}
	}
	
	if($error == 0){
	
	$nuevoMin = $numMin;
	$nuevoHs= $numHs;
	$Hora = $horaCompleta;
	
	/*for($i=0;$i<$duracion;$i++){
	$nuevoMin+=30;
	if($nuevoMin==60){
	$nuevoMin='00';
	$nuevoHs++;
	
	}
	if(strlen($nuevoMin)==1){
	 $nuevoMin = '0'.$nuevoMin;
	}
	$HoraFin = $nuevoHs.':'.$nuevoMin;*/
	if($cliInsertado==false){
		
	if($cliAsignado==false){
	$insertarCli = true;
	if($ci != 'null'){
		$query = mysqli_query($link, "Select * from cliente"); // Query the users table
	//$exists = mysqli_num_rows($query); //Checks if username exists
	while($row = mysqli_fetch_array($query))
	{
	$table_cli = $row['ciCli'];
	$table_cliId = $row['idCli'];
	if($ci == $table_cli){
		$bool= false;
		Print '<script>alert("Ese documento ya fue registrado");</script>'; // Prompts the user
		print '<script>history.back()</script>';
        $insertarCli=false;
        }
    }
	}
	if($insertarCli==true){
	//print "llegue aca, estoy por insertar cliente, creo..";
	$insertCli="INSERT INTO cliente (nombreCli, apellidoCli, ciCli, celCli, telCli, dirCli, sexoCli, fechaNac, infoCli, policlinica) VALUES ('$nombreCli', '$apellidoCli', '$ci', '000000000', '000000000', 'Sin Asignar', 'm', '01/01/1900', 'Sin Asignar', null)";
	print $insertCli;
	print "<br>";
	print $ci;
	mysqli_query($link,$insertCli); // inserts value into table users
	$cliInsertado = true;
	}
	$idCli = mysqli_insert_id($link);
	}
	}

	
	//$insert = "INSERT INTO agenda (Cli,idCli,fechaHora,fechaHoraFin,comentariosCita,tratamiento) VALUES ('$cli',$idCli, STR_TO_DATE('$fecha $Hora' , '%d-%m-%Y %H:%i:%s'), STR_TO_DATE('$fecha $HoraFin' , '%d-%m-%Y %H:%i:%s'), '$comentarios', false)";
	$insert = "INSERT INTO agenda (Cli,idCli,fechaHora,duracion,comentariosCita,tratamiento) VALUES ('$cli',$idCli, STR_TO_DATE('$fecha $Hora' , '%d-%m-%Y %H:%i:%s'),$duracion, '$comentarios', false)";
	mysqli_query($link,$insert); // inserts value into table users
	print $cliAsignado;
	if($cliAsignado==true){
	//	$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
		
		if($_POST['tipoCita']!="sinTrat"){
			
			
			$query = mysqli_query($link, "SELECT LAST_INSERT_ID()");
			$idagenda;
			while($row = mysqli_fetch_array($query)){
				$idagenda = $row['LAST_INSERT_ID()'];
				print $idagenda;
			}
			$idTrat = mysqli_real_escape_string($link, $_POST['trat']);
			//$idCita = mysqli_real_escape_string($link, $_POST['citasCli']);
			$sqlQuery = "insert into sesiontrat (idTrat, idCita, comentarios) values ($idTrat, $idagenda,'$comentarios')";
			print $sqlQuery;
			mysqli_query($link,$sqlQuery);
			mysqli_query($link, "update agenda SET tratamiento =true where id=$idagenda"); 
			mysqli_query($link, "update tratamiento SET estadoTrat='i' where idTratamiento=$idTrat"); 
		}
	}
    //print $insert;
	/*print '-------------------------------------------';
	print '<br>';
	print 'Duracion:'.$duracion;
		print '<br>';
	print 'Hora='.$Hora;
	print '<br>';
		print 'nuevoMin='.$nuevoMin;
		print '<br>';
		print 'nuevoHs='.$nuevoHs;
		print '<br>';
		print 'HoraFin='.$HoraFin;
		print '<br>';
		print '-------------------------------------------';
		print '<br>';*/
		
	 $Hora = $HoraFin;
	//}
	 //Print '<script>alert("Registrado con Exito");</script>'; // Prompts the user
	Print '<script>window.close()</script>';
	}else{
		 if($error==2){
			Print '<script>alert("La hora de la cita interfiere con otra cita agendada!");</script>'; // Prompts the user
		 }
		 if($error ==1){
			 Print '<script>alert("Hora de inicio y de fin no pueden ser la misma!");</script>'; // Prompts the user
		 }
		 if($error == 3){
			 Print '<script>alert("La duracion de la cita exede el horario de atención");</script>'; 
		 }
	print '<script>history.back()</script>';
	 }





}




?>



