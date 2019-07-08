<html lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
	
<title>Odontología</title>
<head>
  <link rel="stylesheet" href="Estilo\style.css">
<link rel="stylesheet" href="Estilo\icon.css">
  <script src="Dominio\script.js"></script>
  <script src="Biblioteca\jquery-3.3.1.min.js"></script>
</head>
<?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>
<body>

<div class="cabecera">

<a href="inicio.php"><img src="Recursos\logo.png" class="logo"></a>
<span>ODONTOLOGIA</span>
</div>

<ul id="menu" class="menu"> 
<li><a href="inicio.php" ><i class="material-icons" style="font-size:15px">calendar_today</i>&nbsp Agenda</a></li>          
    <li><a href="clientes.php" ><i class="material-icons" style="font-size:15px">person_outline</i>&nbsp Reg. Paciente</a></li>
     
    <li><a href="historia.php" ><i class="material-icons" style="font-size:15px">calendar_today</i>&nbsp Historia Clinica</a></li>
    <li><a href="planificacion.php" ><i class="material-icons" style="font-size:15px">assignment</i>&nbsp Planificacion</a></li>
    
    <li><a href="finanzas.php" ><i class="material-icons" style="font-size:15px">attach_money</i>&nbsp Finanzas</a></li>
	    <li><a href="reportes.php" ><i class="material-icons" style="font-size:15px">library_books</i>&nbsp Reportes</a></li>
<li><a href="seccionAdmin.php" ><i class="material-icons" style="font-size:15px">settings</i>&nbsp Ajustes</a></li>
  
 
</ul>



  
	<div class="centerDiv">
        <h2>Administración</h2>
        <span>En esta sección podrá modificar algunos parametros necesarios para el funcionamiento
		</span>
		<br>
		<span>del programa al igual que restaurar respaldos de la base de datos.</span>
		<br>
		<br>
		<br>
		<h3>Cambio de ubicacion de respaldos</h3>
		<h5 style="color:red">Recuerde crear una carpeta llamada "backups" dentro de la unidad deseada, o no se realizaran respaldos</h5>
		<form id="cambioLetra"  method="POST" action="backupDB.php" >
		<table>
		<tr><td title="Con esto cambia la ubicación de los respaldos, debe seleccionar la letra que le corresponde a la unidad extraible donde los guardará">
		Letra de la unidad</td><td><select id="letra" name="letra">
		<?php
		$letras = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P","Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
		$query = mysqli_query($link, "Select * from backuppath");
		$letra;
		while($row = mysqli_fetch_array($query))
		{
		$letra = $row['letra'];
		}
		foreach($letras as $l){
			if($letra==$l){
				print '<option value="'.$l.'" selected="selected">'.$l.':</option>';
			}
			else{
			print '<option value="'.$l.'" >'.$l.':</option>';
			}
		}
		?>
		</select></td></tr>
		</table>
		<input type="submit" value="Guardar"/>
		</form>
		<br>
		<br>
		<br>
		
		<h3>Restaurar version anterior de la base de datos:</h3>
		
		<form id="restaurarBackup"  method="POST" action="restaurarBackup.php" onsubmit="submitBackup();">
		
		<input type="file" id="backup" name="backup"><br>
	
		<input type="submit" id="subBack"value="Restaurar"/>
		</form>
		<center id="label">
		
		</center>
		<br>
		<br>
		
		<h3>Ajustar precios de tratamientos</h3>
		<a href="ajustarPrecios.php">Ir a ajustar precios >></a>
		</div>
		
		
		
		
		
</body>
</html>