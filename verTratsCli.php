<?php

	 $link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				$selected_option=$_POST['cliente'];
				
				$query = mysqli_query($link, "Select * from tratamiento where idCli='$selected_option' and montoPago<>costo");
				$queryNomCli = mysqli_query($link, "Select nombreCli, apellidoCli from cliente where idCli='$selected_option'");
				while($row = mysqli_fetch_array($queryNomCli))
				{
					$nombreCliente = $row['nombreCli'].' '.$row['apellidoCli'];
				}
			print '<table class="blueTable">';
			while($row = mysqli_fetch_array($query))
			{
				$idTrat = $row['idTratamiento'];
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
				$pago = $row['montoPago'];
				$deuda = $row['costo']-$row['montoPago'];
				
					
						print '<tr>';
							print '<th>Paciente</th>';
							print '<th>Tratamiento</th>';
							print '<th>Pieza/s</th>';
							print '<th>Cara/s</th>';
							print '<th>Diagnostico</th>';
							print '<th>Costo</th>';
							print '<th>Estado</th>';
							
							print '<th>Monto Pago</th>';
							print '<th>Deuda</th>';
						print '</tr>';
						print '<tr>';
						print '<td align="center">'.$nombreCliente.'</td>';
							if($trat=="0"){
							print '<td align="center" >'.$tratamiento.'</td>';
							}
							else{
							print '<td align="center" ><a href="#" onClick=\'alert("'.$tratamiento.'")\' >'.$trat.'</a></td>';
							}
							print '<td align="center">'.$piezas.'</td>';
							print '<td align="center">'.$stringCaras.'</td>';
			
							print '<td align="center"> <a href="#" onClick=\'alert("'.$diag.'")\' >Ver</td>';
							print '<td align="center">$'.$costo.'</td>';
							print '<td align="center">'.$estado.'</td>';
							//print '<td align="center"><a href="verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'" target="popup" onClick="window.open(\'verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'\', \'popup\', \'width=800,height=600\'); return false;">Ver Sesiones</td>';
							print '<td align="center">'.$pago.'</td>';
							print '<td align="center" style="color:red"><b>$'.$deuda.'</b></td>';
						print '</tr>';
					
				print '<tr>';
				print '<td align="center" colspan="7">';
				print '<form id="registro" action="realizarPago.php?trat='.$idTrat.'&cli='.$selected_option.'" method="POST">';
				print 'Monto a pagar:<input type="number" name="monto" id="monto"><input type="submit" name="pagar" value="Pagar">';
				print '</form>';
				print '</td>';
				
				print '</tr>';
				print '<tr><td colspan="7"><br> </td>';
				
				print '</tr>';
			
				
			}
			print '</table>';
			
			$query = mysqli_query($link, "Select sum(costo-montoPago) deuda from tratamiento where idCli='$selected_option'");
			while($row = mysqli_fetch_array($query))
			{
				
					
					$query2 = mysqli_query($link, "Select saldoFavor from cliente where idCli='$selected_option'");
					while($row2 = mysqli_fetch_array($query2))
						{
							$saldoFavor = $row2['saldoFavor'];
							
						}
						
							
							print '<center>';
				print '<span ><b>Saldo a Favor:</b></span>';
				print '<span style="color:blue"><b>$'.$saldoFavor.'</b></span>';
				print '<br>';
						
				
				
				print '<center>';
				print '<span ><b>DEUDA TOTAL:</b></span>';
				print '<span style="color:red"><b>$'.$row['deuda'].'</b></span>';
				print '<br>';
				
				print '<form action="pagarDeuda.php?deuda='.$row['deuda'].'" method="POST">';
				print 'Monto a pagar:<input type="number" name="montoPagar" id="montoPagar" style="width:7%"><input type="submit" name="pagar" value="Pagar">';
				print '<input type="hidden" name="idCliente" value="'.$selected_option.'">';
				print '</form>';
				print '</center>';
			}
			print '<center>';
			print '<h3>Tratamientos Pagos</h3>';
			print '<form method="get">';
			
			
			$query = mysqli_query($link, "Select *  from tratamiento where idCli='$selected_option' and costo=montoPago");
			
			
			print '<table class="blueTable">';
						while($row = mysqli_fetch_array($query))
			{
				$idTrat = $row['idTratamiento'];
				$piezas = $row['piezas'];
				$caras = $row['caras'];
				$diag = $row['diagnostico'];
				$trat = $row['idTipoTrat'];
				$tratamiento ="";
					$query3 =mysqli_query($link, "select nombre from tiposTrat where id=$trat");
					while($row3 = mysqli_fetch_array($query3)){
						$tratamiento = $row3['nombre'];
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
				
					if($cara != ""){
					$stringCaras = $stringCaras.$cara.", ";
					}
					}
				}else{
				$stringCaras = "-";
				}
				$pago = $row['montoPago'];
				
					
						print '<tr>';
							print '<th>Tratamiento</th>';
							print '<th>Pieza/s</th>';
							print '<th>Cara/s</th>';
							print '<th>Diagnostico</th>';
							print '<th>Costo</th>';
							print '<th>Estado</th>';
							
							//print '<th>Monto Pago</th>';
						print '</tr>';
						print '<tr>';
							print '<td align="center" ><a href="#" onClick=\'alert("'.$tratamiento.'")\' >'.$trat.'</a></td>';
							print '<td align="center">'.$piezas.'</td>';
							print '<td align="center">'.$stringCaras.'</td>';
			
							print '<td align="center"> <a href="#" onClick=\'alert("'.$diag.'")\' >Ver</td>';
							print '<td align="center">$'.$costo.'</td>';
							print '<td align="center">'.$estado.'</td>';
							//print '<td align="center"><a href="verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'" target="popup" onClick="window.open(\'verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'\', \'popup\', \'width=800,height=600\'); return false;">Ver Sesiones</td>';
							//print '<td align="center">'.$pago.'</td>';
						print '</tr>';
					
				
				print '<tr><td colspan="7"><br> </td>';
				
				print '</tr>';
			
				
			}
			print '</table>';
?>