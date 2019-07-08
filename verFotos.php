<?php
//print '<br><input type="button" onClick="verHist()" value ="Ver Historia" id="seeHist">';
$selected_option=$_POST['cliente'];
				$cliente = explode("&", $selected_option)[0];
				$img = explode("&", $selected_option)[1];
				$idCli = explode("@", $cliente)[1];
				$nombreCli = explode("@", $cliente)[0];
$display;
		if($img=='s'){
			$display="table";
		}
		else{
			$display="none";
		}
print '<table class="blueTable" style="width:auto !important; display:'.$display.'" id="tableImg">';
 //print '<table class="blueTable" style="width:auto !important; display:none" id="tableImg">';
 print '<tr>';
 print '<td>';
 print 'Subir una Imagen:';
 print '</td>';
 print '<td>';
//print '<div class="input-container">';
 print '<input type="file" id="real-input" name="file">'; //estte funca
 //print '<input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />';
 //print '<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>';
 print '<textarea rows="5" cols="50" placeholder="Descripción" name="descImg" id="descImg"></textarea>';
 print '</td>';
 //print '<script>cargarInput()</script>';
 print '<td>';
 print '<input type="submit" name="subirImagen" value="Subir imagen" >';
 print '</td>';
 print '</tr>';
 print '<th>Fecha</th>';
 print '<th>Imagen</th>';
 print '<th>Descripción</th>';
	 $link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				//$selected_option=$_POST['cliente'];
				
				$query = mysqli_query($link, "Select * from imagenes where idCli='$idCli'");

					
			
			while($row = mysqli_fetch_array($query))
			{
				$fechaHora = $row['fechaHora'];
				$idImg = $row['idImg'];
				$nomArchivo = $row['rutaArchivo'];
				$rutaArchivo ="uploads/".$row['rutaArchivo'];
				$desc =$row['descripcion'];
				print '<tr><td>'.$fechaHora.'</td>';
				if(strpos(strtoupper($nomArchivo), 'PDF') !== false)
				{
					print '<td align="center"><a href="'.$rutaArchivo.'">'.$nomArchivo.'</a>';
				
				}else{
					print '<td align="center"><a href="'.$rutaArchivo.'"><img src="'.$rutaArchivo.'" style="width:100%;max-width:300px"></a>';
				
				}
				print '</td>';
				print '<td style="width:20%" id="foto'.$idImg.'">';
				$desc2 = str_replace(array("\n", "\r"), '☻', $desc);
 
				print '<pre>'.$desc.'</pre><br><a href="#!" onClick="comentarioImagen('.$idImg.', \''.$desc2.'\')"><i class="material-icons" style="font-size:15px">mode_edit</i>Editar</a></td>';
				print '</td>';
				print '</tr>';
				
			}
			print '</table>';
?>