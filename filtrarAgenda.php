<?php
     
	 
	 $link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			if(!isset($_POST['fecha'])){
				$selected_option=$_POST['option_value'];
	 
				$query = mysqli_query($link, "Select * from agenda where Cli='$selected_option' order by fechaHora");
			}
			else{
				$fecha =$_POST['fecha'];
				
				$select = "Select * from agenda where fechaHora > STR_TO_DATE('$fecha 0:0:0' , '%d-%m-%Y %H:%i:%s') and fechaHora < STR_TO_DATE('$fecha 23:59:59' , '%d-%m-%Y %H:%i:%s')";
				
				
				$query = mysqli_query($link, $select );			
			}
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
				print '<td align="center" title="'.$com.'"> Ver </td>';
				print '</tr>';
			}
?>
     