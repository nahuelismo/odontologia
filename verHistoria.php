<?php
   
	 $link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				$selected_option=$_POST['cliente'];
				$cliente = explode("&", $selected_option)[0];
				//print $selected_option;
				$img = explode("&", $selected_option)[1];
				$idCli = explode("@", $cliente)[1];
				$nombreCli = explode("@", $cliente)[0];
				$query = mysqli_query($link, "Select * from cliente where idCli='$idCli'");

					
			
			while($row = mysqli_fetch_array($query))
			{
				$nombre = $row['nombreCli'];
		$apellido = $row['apellidoCli'];
		$ci = $row['ciCli'];
		$cel = $row['celCli'];
		$tel = $row['telCli'];
		$dir = $row['dirCli'];
		$info = $row['infoCli'];
		$poli = $row['policlinica'];
		if($poli == "" || $poli ==null){ 
			$poli = "No";
		}
		$sexo;
		if($row['sexoCli']=='m'){
		$sexo = "Masculino";
		}
		else if($row['sexoCli']=='f'){
		$sexo="Femenino";
		}
		$fecha = $row['fechaNac'];
		  
		
			}
			
		
		
			//print '<input type="button" onClick="verFotos()" value = "Ver Imagenes" id="seeImg">';
			/* print '<table class="blueTable" style="width:auto !important">';
			print '<tr>';
			print '<th style="border-radius:10px 10px 0px 0px"><a class="clickCell" style="color:white" href="javascript:void(0)" onclick="verHist()">Tratamientos</a></th>';
			print '<th style="border-radius:10px 10px 0px 0px; background-color:#162458 !important"><a class="clickCell" style="color:white" href="javascript:void(0)" onclick="verFotos()">Imagenes</a></th>';
			print '<th style="border-radius:10px 10px 0px 0px"><a class="clickCell" style="color:white" href="javascript:void(0)" onclick="verDatos()">Datos del Paciente</a></th>';

			
			print '</tr>';
			print '</table>'; */
			print '<table class="blueTable" style="width:42%; display:none" id="tableDatos" >';
		print '<th colspan="3">Datos del paciente</th>';
		print '<tr><td ><b>Nombre:</b>'. $nombre . "</td>";
		print '<td ><b>Apellido:</b>'. $apellido . "</td>";
		print '<td ><b>C.I.:</b>'. $ci . "</td></tr>";
		print '<tr><td ><b>Celular:</b>'. $cel. "</td>";
		print '<td ><b>Telefono:</b>'. $tel . "</td>";
		print '<td ><b>Dirección:</b>'. $dir . "</td></tr>";
		print '<tr><td ><b>Sexo:</b>'. $sexo . "</td>";
		print '<td><b>Fecha de Nacimiento:</b>'. $fecha . "</td>";
		print '<td><b>Policlinica:</b>'. $poli . "</td></tr>";
		print '<tr><td width="20%" colspan="3"><b>Observaciones:</b></td>';
		
		print '<tr><td width="20%" colspan="3"><div style="overflow-y: scroll; height:150px;">'.$info."</div></td>";
			
		print '</tr>';
		print '</table>';	
		$display;
		if($img=='s'){
			$display="none";
		}
		else{
			$display="table";
		}
		print '<table class="blueTable" style="display:'.$display.';" id="tableHist">';
			
			
			print '<tr>';
				print '<th>Fecha y Hora</th>';
				print '<th>Pieza/s</th>';
				print '<th>Cara/s</th>';
				print '<th>Observaciones</th>';
				print '<th>Sesion de Tratamiento</th>';
				print '</tr>';
			$query2 = mysqli_query($link, "Select * from sesiontrat, agenda A, tratamiento where idCita=id and idTrat=idTratamiento and A.idCli=$idCli order by fechaHora");
			
					
			
			while($row2 = mysqli_fetch_array($query2))		
			{ 
		
				$fechaYhora ="";
				$cli = "";
					$idAgenda = $row2['id'];
					$fechaInicio =$row2['fechaHora'];
					//$fechaFin =$row2['fechaHoraFin'];
					$fecha = explode(" ", $fechaInicio)[0];
					$horaInicio = explode(" ", $fechaInicio)[1];
					//print $horaInicio;
					$duracion =$row2['duracion'];
									$segMas = 30*$duracion*60;
						
						//print $fechaYhora[1].'<br>';
						$horaInicio = date('H:i:s', strtotime(explode(" ", $fechaInicio)[1]));
						//print $horaInicio;
						//print $horaInicio.'<br>';
						$HoraFin = date('H:i:s', strtotime($horaInicio)+$segMas);
					$fechaYhora = $fecha.' - '.substr($horaInicio,0,5).' a '.substr($HoraFin, 0,5);
					$cli = $row2['Cli'];
					
				$piezas = $row2['piezas'];
				$caras = $row2['caras'];
				$diag = $row2['comentariosCita'];
				$trat = $row2['idTipoTrat'];
				$tratamiento = "";
				
					$query3 =mysqli_query($link, "select nombre from tiposTrat where id=$trat");
					while($row3 = mysqli_fetch_array($query3)){
						$tratamiento = $row3['nombre'];
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
				
				print '<td align="center" style="width:1px !important;white-space:nowrap !important">'.$fechaYhora.'</td>';
				print '<td align="center" style="width:1px !important;white-space:nowrap !important">'.$piezas.'</td>';
				print '<td align="center" style="width:1px !important;white-space:nowrap !important">'.$stringCaras.'</td>';
				$diag2 = str_replace(array("\n", "\r"), '☻', $diag);
				print '<td width="15%" id="Agenda'.$idAgenda.'"><div style="overflow-y: scroll; max-height:150px;">'.$diag.'</div><a href="#!" onClick="editarObs('.$idAgenda.',\''.$diag2.'\')"><i class="material-icons" style="font-size:15px">mode_edit</i>Editar</a></td>';
				//print '<td align="center"> <a href="#" onClick=\'alert("'.$diag.'")\' >Ver</td>';
				print '<td align="center" >'.$tratamiento.'</td>';
				print '</tr>';
			}
			print '</table>'; 
			if($img=="s"){
				print '<script>verFotos();</script>';
			}
			?>