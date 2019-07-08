<?php
print '<head><script src="Dominio\script.js"></script><script src="Biblioteca\jquery-3.3.1.min.js"></script>';
print '<link rel="stylesheet" href="Estilo\icon.css"';
print '</head>';
print '<center><table><tr><td colspan="2"><H2>Datos de la Cita</h2></td></tr>';

$id = $_GET['cli'];
$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
$sql = "Select * from agenda where id=$id";
$query = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($query))
					{
						
						$cli = $row['Cli'];
						$fechaHora =$row['fechaHora'];
						$fechaYhora = explode(" ", $fechaHora);
						$duracion =$row['duracion'];
						$segMas = 30*$duracion*60;
						//print $fechaYhora[1].'<br>';
						$horaInicio = date('H:i:s', strtotime($fechaYhora[1]));
						//print $horaInicio.'<br>';
						$HoraFin = date('H:i:s', strtotime($horaInicio)+$segMas);
						//print $HoraFin;
						//$fechaYhoraFin = explode(" ", $fechaHoraFin);
						$com = $row['comentariosCita'];
						print '<tr><td>Paciente:</td><td><b>';
						print $cli;
						print '</b></td></tr>';
						print '<tr><td>Fecha:</td><td><b>';
						print $fechaYhora[0];
						print '</b></td></tr>';
						print '<tr><td>Hora de inicio:</td><td><b>';
						print $fechaYhora[1];
						print '</b></td></tr>';	
						print '<tr><td>Hora de Finalizacion:</td><td><b>';
						print $HoraFin;
						print '</b></td></tr>';;
						/*print '<tr><td>Comentarios:</td><td><b>';
						print $com;
						print '</b></td></tr>';*/
						print '</table>';
						
					print '<form id="sesion" action="agregarSesion.php" method="POST">';
					print '<input type="hidden" value="'.$id.'" name="idCita">';
					$uri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					print '<input type="hidden" value="'."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'" name="uri">';
					
					print '<table>';
					print '<tr>';
					//print '<td><input type="radio" name="tipoCita" value="sinTrat" onClick="selectTratsVacio()" checked="checked" >Sin tratamiento</td>';
					print '<td><input type="radio" name="tipoCita" value="tratPend" onClick="selectTratsPend('.$id.')">Tratamiento pendiente</td>';
					print '<td><input type="radio" name="tipoCita" value="tratIniciado" onClick="selectTratsIni('.$id.')">Tratamiento Iniciado<td></tr>';
					print '<tr><td  align="center" colspan="3" id="tdSelect"></td>';
					print '</table>';
					print '<table>';
					print '<tr><td>Observaciones:<td></tr>';
					print '<tr><td>';
					print '<textarea rows="10" cols="50" placeholder="Comentarios" name="info" id="info">'.$com.'</textarea>';
					print '<td></tr>';
					print '</table>';
					print '<input type="submit" name="altaCita" value="Agendar" />';
					print '</form>';
					
					}
					
					$sql = "Select * from tratamiento where idTratamiento in (select idTrat from sesionTrat where idCita=$id)";
					//print $sql;
					$query = mysqli_query($link, $sql);
					
					print '<table border="1">';
					print '<tr><td colspan="7" align="center"> Tratamientos ya asignados</td></td>';
						print '<tr>';
				print '<th>Tratamiento</th>';
				print '<th>Pieza/s</th>';
				print '<th>Cara/s</th>';
				print '<th>Eliminar</th>';
				print '</tr>';
					while($row = mysqli_fetch_array($query))
					{
						$idTratamiento = $row['idTratamiento'];
						$piezas = $row['piezas'];
						$caras = $row['caras'];
						$diag = $row['diagnostico'];
				$trat = $row['idTipoTrat'];
				$tratamiento ="Sin Asignar";
					if(!$idTratamiento=="0"){
					$query3 =mysqli_query($link, "select nombre from tiposTrat where id=$trat");
					while($row3 = mysqli_fetch_array($query3)){
						$tratamiento = $row3['nombre'];
					}
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
						if($i=='i')
						{
							$cara="Incisal";
						}
				
					if($cara != ""){
					$stringCaras = $stringCaras.$cara.", ";
					}
					}
				}else{
				$stringCaras = "-";
				}
					
				
			
				print '<tr>';
				
				if($tratamiento=="Sin Asignar"){
					print '<td align="center" >Sin Asignar</td>';
				}else
				{
				print '<td align="center" >'.$tratamiento.'</td>';
				}
				print '<td align="center">'.$piezas.'</td>';
				print '<td align="center">'.$stringCaras.'</td>';
				$dateTime = date("d-m-y H:i", strtotime($fechaYhora[0].$horaInicio));
				if($dateTime<getdate())
				{
				print '<td align="center"><button id="borrarCita'.$id.'" onClick="borrarCitaTrat('.$id.', '.$idTratamiento.')"><i class="material-icons" style="font-size:15px">close</i></button></td>';
				}
				
					}
					print '</table>';

?>
			