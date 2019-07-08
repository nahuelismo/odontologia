<HTML>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sesiones</title>
<head>

  <script src="Dominio\script.js"></script>
  <script src="Biblioteca\jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="Estilo\icon.css">
<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>
</head>
<?php
print "<body>";//onload=FiltrarCitas(".$_GET['trat'].")>";
?>

<!--<center>
<h2>
Administrar Sesiones
</h2>-->
<?php
	   if(isset($_GET["insupddel"]))
	   {
		   print '<span style="color:red"><b>Sesion '.$_GET["insupddel"].' con éxito</b></span>';
	   print '<br>';
	   print '<br>';
	   }
	   ?>
<table style="width:100%">
<?php

$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				
				
				$query = mysqli_query($link, "Select * from tratamiento where idTratamiento=".$_GET['trat']);
				$estado;
					
			
			while($row = mysqli_fetch_array($query))
			{
				$idTratamiento = $row['idTratamiento'];
				$idCli = $row['idCli'];
				$cli = "";
					$query2 = mysqli_query($link, "select nombreCli, apellidoCli from Cliente where idCli=$idCli");
					while($row2 = mysqli_fetch_array($query2)){
					$nombre =$row2['nombreCli'];
					$apellido =$row2['apellidoCli'];
				
					$cli = $nombre." ".$apellido;
					}
				$piezas = $row['piezas'];
				$caras = $row['caras'];
				$diag = $row['diagnostico'];
				$trat = $row['idTipoTrat'];
				$tratamiento ="";
				if($trat!="0"){
				
					$query3 =mysqli_query($link, "select nombre from tiposTrat where id=$trat");
					while($row3 = mysqli_fetch_array($query3)){
						$tratamiento = $row3['nombre'];
					}
				}else{
					$tratamiento="Sin Asignar";
				}
				$costo = $row['costo'];
				$estado = $row['estadoTrat'];
				if($estado=="p"){
				 $estado = "Pendiente";
				}else if($estado=="f"){
					$estado ="Finalizado";
				}
				else{
					
					$estado="Iniciado";
				}
				$stringCaras ="";
				if($caras!=null){
					$letras = explode(",", $caras);
					foreach($letras as $i){
						$cara ="";
						if($i=='p'){
						$cara = "Palatino";
						}
						if($i=='d'){
						$cara = "Distal";
						}
						if($i=='o'){
						$cara = "Oclusal";
						}
						if($i=='l'){
						$cara = "Lingual";
						}
						if($i=='m'){
						$cara = "Mesial";
						}
						if($i=='i'){
						$cara = "Incisal";
						}
				
					if($cara != ""){
					$stringCaras = $stringCaras.$cara.", ";
					}
					}
				}else{
				$stringCaras = "-";
				}
					
				
				print '<tr>';
				print '<td ><b>Paciente:</b>'.$cli.'</td>';
				if($trat=="0"){
							print '<td ><b>Tratamiento:</b>'.$tratamiento.'</td>';
							}
							else{
							print '<td ><b>Tratamiento:</b>:<a href="#" onClick=\'alert("'.$tratamiento.'")\' >'.$trat.'</a></td>';
							}
				print '<td ><b>Piezas:</b>'.$piezas.'</td></tr>';
				
				print '<tr><td ><b>Caras:</b>'.$stringCaras.'</td>';	
				print '<td ><b>Costo:</b>$'.$costo.'</td>';
				print '<td ><b>Estado:</b>'.$estado.'</td></tr>';
				//print '<td align="center"><a href="verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'" target="popup" onClick="window.open(\'verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'\', \'popup\', \'width=800,height=600\'); return false;">Ver Sesiones</td>';
				print '<tr ><td colspan="3" align="center"><b>Diagnostico:</b><br>'.$diag.'</td></tr>';
				/*if($estado == "Pendiente"){
				print '<td align="center"><input type="button" value="Finalizar Tratamiento" onClick="finalizarTrat('.$idTratamiento.')"></td>';
				}*/
				//print '</tr>';
				
					
					
				}
				print '</table>';
				
				print '<br>';
				if($estado=="Finalizado"){
					//print '<H2>Tratamiento Finalizado<h2>';
				}
				
				///'2019-05-18 12:00:00'  '2019-05-21 16:38:00'
				/*
				else{
					print '<form id="sesion" action="agregarSesion.php" method="POST">';
					$trat = $_GET['trat'];
					$cli = $_GET['cli'];

					print '<input type="hidden" name="cliente" value="'.$cli.'">';
					print '<input type="hidden" name="trat" value="'.$trat.'">';
					print '<input type="hidden" name="uri" value="'.$_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'">';
					print 'Añadir Sesion:<br>';
					print '<select id="citasCli" name="citasCli">';
					print '<option>Seleccione una cita</option>';
				
				$selected_option=$_GET['cli'];
				$sql = "Select * from agenda where idCli=$selected_option and fechaHora > CURRENT_TIMESTAMP  order by fechaHora";
				//print $sql;
				$query = mysqli_query($link, $sql);

					
			
			while($row = mysqli_fetch_array($query))
			{
				$id = $row['id'];
				//$nombre = $row['Cli'];
				print $id;
				
						
						
				$fechaInicio =$row['fechaHora'];
				
				//print $fechInicio;
				//print $fechFin;
				$fecha = explode(" ", $fechaInicio)[0];
				//print $fecha;
				$horaInicio = explode(" ", $fechaInicio)[1];
				//print $horaInicio;
				$duracion =$row['duracion'];
						$segMas = 30*$duracion*60;
						//print $fechaYhora[1].'<br>';
						$inicio = date('H:i:s', $horaInicio);
						//print $horaInicio.'<br>';
						$HoraFin = date('H:i:s', strtotime($horaInicio)+$segMas);
				//print $HoraFin;
				$conTrat = $row['tratamiento'];
				$txtTrat ="";
				if($conTrat == true){
					$txtTrat = "(*)";
				}
				print '<option value="'.$id.'">'.$txtTrat.' '.$fecha.' - '.substr($horaInicio,0,5).' a '.substr($HoraFin, 0,5).'</option>';
				
				
			}
			print '</Select>';
			print '<p id="txtRef"><i>"(*)":Con tratamiento ya asigando</i></p>';
			print '<br>';
			print '<br>';
			print '<input type="submit" name="agregarSesion" value="Agregar Sesion">';
			print '</form>';
			print '</center>';
				}
			
*/?>
<center>
<h2>Sesiones del Tratamiento:</h2>
</center>
<table border="1" style="width:100%">
<th>Fecha</th>
<th>Hora Inicio</th>
<th>Hora Fin</th>
<th>Comentarios</th>
<th>Borrar</th>
<?php
$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				$selected_option=$_GET['trat'];
				$sql = "Select * from sesiontrat where idTrat=$selected_option";
				//print $sql;
				$query = mysqli_query($link, $sql);
				$idSesion;
				while($row = mysqli_fetch_array($query))
				{
					$idSesion=$row['idSesion'];
					print "<tr>";
				$idCita = $row['idCita'];
				$sql2 ="Select * from agenda where id=$idCita";
				$query2 = mysqli_query($link, $sql2);
				$dateTime ="";
				while($row2=mysqli_fetch_array($query2))
				{
					$fechaInicio =$row2['fechaHora'];
					$duracion =$row2['duracion'];
					$segMas = 30*$duracion*60;
					$fecha = explode(" ", $fechaInicio)[0];
					$horaInicio = substr(explode(" ", $fechaInicio)[1],0,5);
					$HoraFin = date('H:i', strtotime($horaInicio)+$segMas);;
					print "<td>$fecha</td>";
					print "<td>$horaInicio</td>";
					print "<td>$HoraFin</td>";
					$dateTime = date("d-m-y H:i", strtotime($fecha.$horaInicio));
					
				}
				
				$comentarios = $row['comentarios'];
				if($comentarios ==""){
				print '<td><input type="button" id="comentario'.$idSesion.'" onClick="addComment('.$idSesion.')" value="Añadir Comentarios"></td>';
				}else{
				print '<td>'.$comentarios.'<button id="comentario'.$idSesion.'" onClick="addComment('.$idSesion.', \''.$comentarios.'\')" ><i style="font-size:15px" class="material-icons">border_color</i></button></td></td>';
				}
				if($dateTime<getdate())
				{
				print '<td align="center"><button id="borrarCita'.$idCita.'" onClick="borrarCitaTrat('.$idCita.', '.$selected_option.')"><i class="material-icons" style="font-size:15px">close</i></button></td>';
				}
				print "</tr>";
				}
?>
</table>
</body>