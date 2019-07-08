<?php
     
	 
	 $link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				$selected_option=$_POST['option_value'];
	 
				$query = mysqli_query($link, "Select * from agenda where Cli='$selected_option' and fechaHora > CURRENT_TIMESTAMP and tratamiento=false order by fechaHora");

					
			
			while($row = mysqli_fetch_array($query))
			{
				$id = $row['id'];
				//$nombre = $row['Cli'];
				$fechaInicio =$row['fechaHora'];
				$fechaFin =$row['fechaHoraFin'];
				$fecha = explode(" ", $fechaInicio)[0];
				$horaInicio = explode(" ", $fechaInicio)[1];
				$HoraFin = explode(" ", $fechaFin)[1];
				print '<option value="'.$id.'">'.$fecha.' - '.substr($horaInicio,0,5).' a '.substr($HoraFin, 0,5).'</option>';
				
				/*print '<tr>';
				print '<td align="center">'.$cli.'</td>';
				print '<td align="center">'.$fechaYhora[0].'</td>';
				print '<td align="center">'.$fechaYhora[1].'</td>';
				print '<td align="center">'.$fechaYhoraFin[1].'</td>';
				print '<td align="center" title="'.$com.'"> Ver </td>';
				print '</tr>';*/
			}
?>