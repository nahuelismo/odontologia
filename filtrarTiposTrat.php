<?php
     
	 print '<option value="-1">Seleccione un tratamiento...</option>';
	 $link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				$selected_option=$_POST['option_value'];
	 
				$query = mysqli_query($link, "Select * from tiposTrat where categoria='$selected_option'");

					
			
			while($row = mysqli_fetch_array($query))
			{
				$id = $row['id'];
				$nombre = $row['nombre'];
				$precio = $row['precio'];
				print '<option value="'.$id.'-'.$precio.'">'.$nombre.'</option>';
				
				/*print '<tr>';
				print '<td align="center">'.$cli.'</td>';
				print '<td align="center">'.$fechaYhora[0].'</td>';
				print '<td align="center">'.$fechaYhora[1].'</td>';
				print '<td align="center">'.$fechaYhoraFin[1].'</td>';
				print '<td align="center" title="'.$com.'"> Ver </td>';
				print '</tr>';*/
			}
?>