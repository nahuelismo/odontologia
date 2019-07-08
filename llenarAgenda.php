<?php
			//Print '<script>alert("estoy aca");</script>'; 
			$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			$horaActual = date("H:i");
			if(isset($_GET['fecha'])){
				$fecha =date('d-m-Y', strtotime($_POST['fecha']));
			}
			else{
			$fecha =date('d-m-Y', strtotime($_POST['date']));
			}
			//print $fecha;
			$sqls="";
			
			print '<tr>';
			print '<th></th>';
			for($h=0; $h<8;$h++)
			{
				$diasemana = date('w', strtotime($fecha));
				$days = array('Domingo', 'Lunes', 'Martes', 'Miércoles','Jueves','Viernes', 'Sabado');
				print '<th><center>'.$fecha.'<br>'.$days[$diasemana].'</center></th>';
				$fecha = date('d-m-Y', strtotime(''.$fecha. ' + 1 day'));
				
				
				
			}
				$fecha = date('d-m-Y', strtotime($_POST['date']));
				for($i=8;$i<=21;$i++){
				for($j=0;$j<60;$j=$j+30){
					$minutos = $j;
					if($j==0){
					$minutos = '00';
					}
					$minSig = $j+30;
					$horaSig = $i;
					if($minSig==60){
						$minSig='00';
						$horaSig = $i+1;
					}
					$hora = $i.':'.$minutos;
					if(strlen($i)==1){
						$hora = '0'.$hora;
					}
					
					print '<tr><th>'.$hora.' - '.$horaSig.':'.$minSig.'</th>';
					$fecha =date('d-m-Y', strtotime($_POST['date']));
					for($h=0; $h<8;$h++)
					{
					$sql = "Select A.* from agenda A where STR_TO_DATE('$fecha $hora' , '%d-%m-%Y %H:%i:%s') >= A.fechaHora  and STR_TO_DATE('$fecha $hora' , '%d-%m-%Y %H:%i:%s') < (SELECT DATE_ADD((Select fechaHora from agenda A2 where A2.id = A.id), INTERVAL (Select duracion from agenda A2 where A2.id = A.id)*30 MINUTE))";
					
					$query = mysqli_query($link, $sql);
					$sqls = $sqls.' '.$sql.'<br>';
					$filas = mysqli_num_rows($query);
					if($filas==0){
						if(strtotime($fecha.' '.$hora.':00') < strtotime(date('d-m-Y H:i:s'))){
						print '<td> </td>';
						}
						else{
					print '<td width="80px" style="padding:0px!important" bgcolor="lightGrey" class="celdaVacia" id="tdAgenda.'.$fecha.$hora.'"> <a href="nuevaCita.php?hora='.$hora.'&fecha='.$fecha.'"  target="popup" onClick="window.open(\'nuevaCita.php?hora='.$hora.'&fecha='.$fecha.'\', \'popup\', \'width=800, height=600\'); return false;" class="clickCell"> &nbsp </a></td>';
						}
					}
					
					while($row = mysqli_fetch_array($query))
					{
						print $sql;
						$idCita = $row['id'];
						$cli = $row['Cli'];
						$fechaHora =$row['fechaHora'];
						$fechaYhora = explode(" ", $fechaHora);
						$fechaHoraFin =$row['fechaHoraFin'];
						$fechaYhoraFin = explode(" ", $fechaHoraFin);
						$com = $row['comentariosCita'];
						//print '<tr>';
						
						print '<td align="center" style="background-color:#edca61"><a href="verCita.php?'.$idCita.'" target="popup" onClick="window.open(\'verCita.php?cli='.$idCita.'\', \'popup\', \'width=800,height=600\'); return false;">'.$cli.'</td></td>';
						//print '<td align="center">'.$fechaYhora[0].'</td>';
						//print '<td align="center">'.$fechaYhora[1].'</td>';
						//print '<td align="center">'.$fechaYhoraFin[1].'</td>';
						//print '<td align="center"> <a href="#" onClick=\'alert("'.$com.'")\' >Ver</td>';
						//print '</tr>';
					}
					$fecha = date('d-m-Y', strtotime(''.$fecha. ' + 1 day'));
					
				}
				}
				
			
			}
			//print '<tr><td colspan="9">'.$sqls.'</td>';
			
			?>