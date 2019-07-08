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
<body onLoad="llenarCita()">

<div class="cabecera">

<a href="inicio.php"><img src="Recursos\logo.png" class="logo"></a>
<span>ODONTOLOGIA</span>
</div>

<ul id="menu" class="menu">              
    <li><a href="clientes.php" >Reg. Paciente</a></li>
     
    <li><a href="historia.php" >Historia Clinica</a></li>
    <li><a href="planificacion.php" >Planificacion</a></li>
    
    <li><a href="finanzas.php" >Finanzas</a></li>
  
 
</ul>

<div class="centerDiv">
       <h2>Agenda</h2>
       
        <form id="registro" action="registrarCita.php" method="POST">
		<table >
		<tr><td>Paciente:</td><td>
		<select id="clientes" name="clientes">
		<?php
			$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			$query = mysqli_query($link, "Select * from cliente");
			while($row = mysqli_fetch_array($query))
			{
				$id = $row['idCli'];
				$nombre = $row['nombreCli'];
				$apellido = $row['apellidoCli'];
				$nombreCompleto = $nombre." ".$apellido;
				print '<option value="'.$nombreCompleto.'@'.$id.'">'.$nombre.' '.$apellido.'</option>';
			}
			?>
			</select>
			</td></tr><tr>
			<td>Fecha:</td><td><select name="año" id="año" onchange="llenarMeses()"></select><select name="mes" id="mes" onchange="llenarDiasCita()">
		   
		   </select>
		   <select name="dia" id="dia" required="required"></select>
			</td></tr><tr><td>Hora Incio:</td><td><input type="number" name="hora" id="hora" class="fechaHora" >:<input type="number" name="minutos" id="minutos" class="fechaHora"></td></tr>
			<tr><td>Hora Fin:</td><td><input type="number" name="horaFin" id="horaFin" class="fechaHora" >:<input type="number" name="minutosFin" id="minutosFin" class="fechaHora"></td></tr>
			</table><table>
			<tr><td><textarea rows="10" cols="50" placeholder="Comentarios" name="info" id="info"></textarea><td></tr>
		
			</table>
			<input type="submit" name="altaCita" value="Agendar" />
			</form>
			</div>
			<br>
			<br>
			<div class="centerDiv">
			<table>
		<tr><td>Filtrar por Paciente:</td><td>
		<select id="clientesFiltro" name="clientesFiltro" onchange="FiltrarAgenda()" >
		<?php
			$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			$query = mysqli_query($link, "Select * from cliente");
			while($row = mysqli_fetch_array($query))
			{
				//$ci = $row['ciCli'];
				$nombre = $row['nombreCli'];
				$apellido = $row['apellidoCli'];
				$nombreCompleto = $nombre." ".$apellido;
				print '<option value="'.$nombreCompleto.'">'.$nombre.' '.$apellido.'</option>';
			}
			?>
			</select>
			</td><td><input type="button" value="Quitar Filtro" onclick="location.reload(true)"></td></tr><tr>
			<tr><td>Filtrar por Fecha: </td><td><select name="añoFiltro" id="añoFiltro" onchange="llenarDiasFiltro()"></select><select name="mesFiltro" id="mesFiltro" onchange="llenarDiasFiltro()">
		   <option value="01">Enero</option>
		   <option value="02">Febrero</option>
		   <option value="03">Marzo</option>
		   <option value="04">Abril</option>
		   <option value="05">Mayo</option>
		   <option value="06">Junio</option>
		   <option value="07">Julio</option>
		   <option value="08">Agosto</option>
		   <option value="09">Septiembre</option>
		   <option value="10">Octubre</option>
		   <option value="11">Noviembre</option>
		   <option value="12">Diciembre</option>
		   </select>
		   <select name="diaFiltro" id="diaFiltro" required="required"></select></td><td><input type="button" onclick="FiltrarAgendaPorFecha()" value="Fltrar"></td></tr>
			</table>
			<table border="1px" width="100%" id="tablaAgenda" class="blueTable">
			<tr>
			<th>Paciente</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Hora Fin</th>
			<th>Comentarios</th>
			</tr>
			<?php
			$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			$query = mysqli_query($link, "Select * from agenda order by fechaHora");
			while($row = mysqli_fetch_array($query))
			{
				$cli = $row['Cli'];
				$fechaHora =$row['fechaHora'];
				$fechaYhora = explode(" ", $fechaHora);
				$fechaHoraFin =$row['fechaHoraFin'];
				$fechaYhoraFin = explode(" ", $fechaHoraFin);
				$com = $row['comentariosCita'];
				
				print '<tr>';
				print '<td align="center">'.$cli.'</td>';
				print '<td align="center">'.$fechaYhora[0].'</td>';
				print '<td align="center">'.$fechaYhora[1].'</td>';
				print '<td align="center">'.$fechaYhoraFin[1].'</td>';
				print '<td align="center"> <a href="#" onClick=\'alert("'.$com.'")\' >Ver</td>';
				print '</tr>';
			}
			?>
			</table>
			</body>
			</html>