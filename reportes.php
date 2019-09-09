<html lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
	
<title>Odontología</title>
<head>
  <link rel="stylesheet" href="Estilo\style.css">
<link rel="stylesheet" href="Estilo\icon.css">
  <script src="Dominio\script.js"></script>
  <script src="Biblioteca\jquery-3.3.1.min.js"></script>
</head>
<?php
    session_start(); //starts the session
   if($_SESSION['user']){
	   // checks if the user is logged in  
   }
   else{

     header("location: index.php"); // redirects if user is not logged in
   }
   if(!isset($_SESSION['cliente'])){
	    Print '<script>alert("Debe seleccionar un Paciente!");</script>'; // Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
	  // header("location: index.php"); 
   }
   ?>
<body>

<div class="cabecera">
<table style="width:100%">
<tr style="width:100%"><td>
<a href="inicio.php"><img src="Recursos\logo.png" class="logo"></a>
<span>ODONTOLOGIA</span>
</td></tr>
<tr style="text-align: right" style="width:100%"><td>
<?php
print 'Cliente Seleccionado: ';
$idCli = explode('@', $_SESSION['cliente'])[1];
$nombreCliente = explode('@', $_SESSION['cliente'])[0];
print '<a href="seleccionarPaciente.php?cli='.$idCli.'&paciente='.$nombreCliente.'">'.$nombreCliente.'</a>';
print '   -   ';
?>
<a href="logout.php" style="vertical-align:bottom">Cerrar Sesion</a>
</td></tr></table>
</div>

<ul id="menu" class="menu">              
<li><a href="inicio.php" ><i class="material-icons" style="font-size:15px">calendar_today</i>&nbsp Agenda</a></li>          
    <li><a href="clientes.php" ><i class="material-icons" style="font-size:15px">person_outline</i>&nbsp Reg. Paciente</a></li>
     
    <li><a href="historia.php" ><i class="material-icons" style="font-size:15px">calendar_today</i>&nbsp Historia Clinica</a></li>
    <li><a href="planificacion.php" ><i class="material-icons" style="font-size:15px">assignment</i>&nbsp Planificacion</a></li>
    
    <li><a href="finanzas.php" ><i class="material-icons" style="font-size:15px">attach_money</i>&nbsp Finanzas</a></li>
	    <li><a href="reportes.php" ><i class="material-icons" style="font-size:15px">library_books</i>&nbsp Reportes</a></li>
<li><a href="seccionAdmin.php" ><i class="material-icons" style="font-size:15px">settings</i>&nbsp Ajustes</a></li>
  
 
</ul>
<div class="centerDiv">
       <h2>Reportes</h2>
       <h3>Deuda por Tratamientos Finalizados <a href="#" class="clickCell" onClick="deudasFinalizado()">▼</a></h3>
		<?php
			
			
			$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				//$selected_option=$_POST['cliente'];
				
				$query = mysqli_query($link, "Select * from tratamiento where estadoTrat='f' and montoPago<>costo order by idCli");

			
			print '<table class="blueTable" style="display:none" id="tblDeudaFin" >';
			while($row = mysqli_fetch_array($query))
			{
				$idTrat = $row['idTratamiento'];
				$idCli = $row['idCli'];
				$nombreCliente = "";
				$telCliente = "";
				$celCliente = "";
				$query2 = mysqli_query($link, "Select nombreCli, apellidoCli, telCli, celCli from cliente where idCli=$idCli");
				while($row2=mysqli_fetch_array($query2)){
					$nombreCliente = $row2['nombreCli'].' '.$row2['apellidoCli'];
					$telCliente = $row2['telCli'];
					$celCliente = $row2['celCli'];
					if($telCliente=='000000000'){
		$telCliente = " - ";
		}
		if($celCliente=='000000000'){
		$celCliente = " - ";
		}
				}
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
				
					
						print '<tr>';
							print '<th>Paciente</th>';
							print '<th>Telefono</th>';
							print '<th>Celular</th>';
							print '<th>Tratamiento</th>';
							print '<th>Pieza/s</th>';
							print '<th>Cara/s</th>';
							print '<th>Diagnostico</th>';
							print '<th>Costo</th>';
							print '<th>Estado</th>';
							print '<th>Monto Pago</th>';
							print '<th>Deuda</th>';
							//print '<th>Deuda</th>';
						print '</tr>';
						print '<tr>';
							print '<td align="center"><a href="seleccionarPaciente.php?cli='.$idCli.'&paciente='.$nombreCliente.'">'.$nombreCliente.'</a></td>';
							print '<td align="center">'.$telCliente.'</td>';
							print '<td align="center">'.$celCliente.'</td>';
							print '<td align="center" ><a href="#" onClick=\'alert("'.$tratamiento.'")\' >'.$trat.'</a></td>';
							print '<td align="center">'.$piezas.'</td>';
							print '<td align="center">'.$stringCaras.'</td>';
			
							print '<td align="center"> <a href="#" onClick=\'alert("'.$diag.'")\' >Ver</td>';
							print '<td align="center">$'.$costo.'</td>';
							print '<td align="center">'.$estado.'</td>';
							//print '<td align="center"><a href="verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'" target="popup" onClick="window.open(\'verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'\', \'popup\', \'width=800,height=600\'); return false;">Ver Sesiones</td>';
							print '<td align="center">'.$pago.'</td>';
							$deuda = $costo-$pago;
							print '<td align="center" style="color:red"><b>$'.$deuda.'</b></td>';
							//print '<td align="center">'.$costo-$pago.'</td>'; PONER MONTO DEUDA
			print '</tr>';
						
			}
			print '</table>';
			$query = mysqli_query($link, "Select sum(costo-montoPago) deuda from tratamiento where estadoTrat='f'");
			while($row = mysqli_fetch_array($query))
			{
				print '<center style="display:none" id="deudaFinTotal">';
				print '<span ><b>DEUDA TOTAL:</b></span>';
				print '<span style="color:red"><b>$'.$row['deuda'].'</b></span>';
				print '</center>';
			}
			
			?>
			
		
       <h3>Pacientes con 3 meses desde ultima Cita <a href="#" class="clickCell" onClick="mesesCitas3()">▼</a></h3>	
			<?php
				print '<table class="blueTable" style="display:none" id="tbl3meses" >';
					print '<tr>';
					print '<th>Paciente</th>';
					//print '<th>Paciente</th>';
					print '<th>C.I.</th>';
					print '<th>Fecha ultima cita</th>';
					print '</tr>';
				$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				//$selected_option=$_POST['cliente'];
					
				$query = mysqli_query($link, "Select C.idCli, C.nombreCli, C.apellidoCli, C.ciCli, max(A.fechaHora) as 'ult' from cliente C, agenda A where A.idCli=C.idCli  group by C.idCli having TIMESTAMPDIFF(MONTH, max(A.fechaHora), CURRENT_TIMESTAMP)>=3");
				
				while($row = mysqli_fetch_array($query))
				{
					
					$idCli = $row['idCli'];
					$nombreCliente = $row['nombreCli'].' '.$row['apellidoCli'];
					print '<tr>';
					print '<td align="center"><a href="seleccionarPaciente.php?cli='.$idCli.'&paciente='.$nombreCliente.'">'.$nombreCliente.'</a></td>';		
					print '<td align="center">'.$row['ciCli'].'</td>';
					print '<td align="center">'.$row['ult'].'</td>';
					//print '<td>'..'</td>';
					print '</tr>';
				}
				print '</table>';
					
			?>
	   
	   <h3>Pacientes con 6 meses desde ultima Cita <a href="#" class="clickCell" onClick="mesesCitas6()">▼</a></h3>	
			<?php
				print '<table class="blueTable" style="display:none" id="tbl6meses" >';
					print '<tr>';
					print '<th>Paciente</th>';
					//print '<th>Paciente</th>';
					print '<th>C.I.</th>';
					print '<th>Fecha ultima cita</th>';
					print '</tr>';
				$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				//$selected_option=$_POST['cliente'];
					
				$query = mysqli_query($link, "Select C.idCli, C.nombreCli, C.apellidoCli, C.ciCli, max(A.fechaHora) as 'ult' from cliente C, agenda A where A.idCli=C.idCli  group by C.idCli having TIMESTAMPDIFF(MONTH, max(A.fechaHora), CURRENT_TIMESTAMP)>=6");
				
				while($row = mysqli_fetch_array($query))
				{
					
					$idCli = $row['idCli'];
					$nombreCliente = $row['nombreCli'].' '.$row['apellidoCli'];
					print '<tr>';
					print '<td align="center"><a href="seleccionarPaciente.php?cli='.$idCli.'&paciente='.$nombreCliente.'">'.$nombreCliente.'</a></td>';		
					print '<td align="center">'.$row['ciCli'].'</td>';
					print '<td align="center">'.$row['ult'].'</td>';
					//print '<td>'..'</td>';
					print '</tr>';
				}
				print '</table>';
					
			?>
	   
	   <h3>Pacientes con 1 año desde ultima Cita <a href="#" class="clickCell" onClick="añoCitas1()">▼</a></h3>	
			<?php
				print '<table class="blueTable" style="display:none" id="tbl1año" >';
					print '<tr>';
					print '<th>Paciente</th>';
					//print '<th>Paciente</th>';
					print '<th>C.I.</th>';
					print '<th>Fecha ultima cita</th>';
					print '</tr>';
				$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				//$selected_option=$_POST['cliente'];
					
				$query = mysqli_query($link, "Select C.idCli, C.nombreCli, C.apellidoCli, C.ciCli, max(A.fechaHora) as 'ult' from cliente C, agenda A where A.idCli=C.idCli  group by C.idCli having TIMESTAMPDIFF(YEAR, max(A.fechaHora), CURRENT_TIMESTAMP)>=31");
				
				while($row = mysqli_fetch_array($query))
				{
					
					$idCli = $row['idCli'];
					$nombreCliente = $row['nombreCli'].' '.$row['apellidoCli'];
					print '<tr>';
					print '<td align="center"><a href="seleccionarPaciente.php?cli='.$idCli.'&paciente='.$nombreCliente.'">'.$nombreCliente.'</a></td>';		
					print '<td align="center">'.$row['ciCli'].'</td>';
					print '<td align="center">'.$row['ult'].'</td>';
					//print '<td>'..'</td>';
					print '</tr>';
				}
				print '</table>';
					
			?>
	   
</div>
</body>
</html>