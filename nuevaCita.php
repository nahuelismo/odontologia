<html>
<title>Agendar</title>
<head>
  
  <script src="Dominio\script.js"></script>
  <script src="Biblioteca\jquery-3.3.1.min.js"></script>
  <script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>
</head>
<body onload="llenarCita()">
<center>
<form id="registro" action="registrarCita.php" method="POST">
		<table >
		
		<?php
		session_start();
		if(isset($_SESSION['cliente'])){
		print '<tr><td>Paciente:</td><td>';
		print explode('@', $_SESSION['cliente'])[0];
		print '<input type="hidden" id="clientes" name="clientes" value="'.$_SESSION['cliente'].'">';
		}
		else{
		print '<tr><td>Nombre:</td><td><input type="text" name="nombre" id="nomberCli" required></td><td>';
		print '<tr><td>Apellido:</td><td><input type="text" name="apellido" id="apellidoCLi" required></td><td>';
		print '<tr><td>Ci:</td><td><input type="text" name="cedula" id="cedulaCli"></td><td>';
		}
		?>
		
			</td></tr><tr>
			<td>Fecha:</td><td>
			<?php
			print $_GET['fecha'];
			print '<input type="hidden" name="fecha" value="'.$_GET['fecha'].'">';
			?>
			</td></tr><tr>
			<td>Hora:</td><td>
			<?php
			print $_GET['hora'];
			print '<input type="hidden" name="hora" value="'.$_GET['hora'].'">';
			?>
			
			</td>
			<tr><td>Duracion:</td><td><select name="duracion" id="duracion">
			<option value="1">30 min</option>
			<option value="2">1 Hora</option>
			<option value="3">1 Hora y media</option>
			<option value="4">2 Horas</option>
			<option value="5">2 Horas y media</option>
			<option value="6">3 Horas</option>
			<option value="7">3 Horas y media</option>
			<option value="8">4 Horas</option>
			</select>
			</td></tr>
			</table><table>
			<tr>
			<?php
			//session_start();
			if(isset($_SESSION['cliente'])){
			print '<td><input type="radio" name="tipoCita" value="sinTrat" onClick="selectTratsVacio(-1)" checked="checked" >Sin tratamiento</td>';
			print '<td><input type="radio" name="tipoCita" value="tratPend" onClick="selectTratsPend(-1)">Tratamiento pendiente</td>';
			print '<td><input type="radio" name="tipoCita" value="tratIniciado" onClick="selectTratsIni(-1)">Tratamiento Iniciado<td></tr>';
			}
			?>
			<tr><td  align="center" colspan="3" id="tdSelect"></td>
			</table>
			
			<table>
			<tr><td><textarea rows="10" cols="50" placeholder="Comentarios" name="info" id="info"></textarea><td></tr>
		
			</table>
			<input type="submit" name="altaCita" value="Agendar" />
			</form>
			</center>
			</body>
			</html>