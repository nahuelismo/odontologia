<html lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
	
<title>Odontología</title>
<head>
  <link rel="stylesheet" href="Estilo\style.css">
<link rel="stylesheet" href="Estilo\icon.css">

  <script src="Biblioteca\jquery-3.3.1.min.js"></script>
    <script src="Dominio\script.js"></script>
</head>
<?php
   session_start(); //starts the session
   if(isset($_SESSION['user'])){ // checks if the user is logged in  
   
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value

   
   ?>
<body onLoad="llamar()">

<div class="cabecera">
<table style="width:100%">
<tr style="width:100%"><td>
<a href="inicio.php"><img src="Recursos\logo.png" class="logo"></a>
<span>ODONTOLOGIA</span>
</td></tr>
<tr style="text-align: right" style="width:100%"><td>
<?php
if(isset($_session['cliente'])){
print 'Cliente Seleccionado: ';
$idCli = explode('@', $_SESSION['cliente'])[1];
$nombreCliente = explode('@', $_SESSION['cliente'])[0];
print '<a href="seleccionarPaciente.php?cli='.$idCli.'&paciente='.$nombreCliente.'">'.$nombreCliente.'</a>';
print '   -   ';
}
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
	<h2><?php print("Bienvenido ".$user)?></h2>
       <br/>
      
       
		<center>
		<div class="formulario">
        <h2 style="color:white">Seleccion de paciente</h2>
		<form id="registro" action="seleccionarPaciente.php" method="POST">
		<input type="hidden" name="clienteId" id="clienteId" value="">
		<input list="clientes" name="paciente" id="lstClis" list="clis" onChange="cambiarId()">
		<datalist class="select-style" id="clientes">
	   <!--<select id="clientes" name="paciente" onChange="seleccionarCliente()">-->
		<?php
			$selectedId = " ";
			if(isset($_SESSION['cliente'])){
				$selectedId = explode('@', $_SESSION['cliente'])[1];
				
			}
			$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			$query = mysqli_query($link, "Select * from cliente");
			
			/*VERSION VIEJA FUNCIONAL
			while($row = mysqli_fetch_array($query))
			{
				$id = $row['idCli'];
				$ci = $row['ciCli'];
				$nombre = $row['nombreCli'];
				$apellido = $row['apellidoCli'];
				$nombreCompleto = $nombre." ".$apellido;
				print '<option data-value="'.$nombreCompleto.'@'.$id.'" ';
				if($id==$selectedId){
					print 'selected="selected"';
					
				}
				$str = substr($ci, 0, 7) . '-' . substr($ci, 7);
				print '>'.$str.' - '.$nombre.' '.$apellido.'</option>';
				//print '<option value="'.$nombreCompleto.@'.$id.'">'.$nombre.' '.$apellido.'</option>';
			}*/
			while($row = mysqli_fetch_array($query))
			{
				$id = $row['idCli'];
				$ci = $row['ciCli'];
				$nombre = $row['nombreCli'];
				$apellido = $row['apellidoCli'];
				$nombreCompleto = $nombre." ".$apellido;
				print '<option value="'.$nombreCompleto.'" data-id="'.$id.'"';
				if($id==$selectedId){
					print 'selected="selected"';
					
				}
				$str = substr($ci, 0, 7) . '-' . substr($ci, 7);
				print '>'.$str.'</option>';
				//print '<option value="'.$nombreCompleto.@'.$id.'">'.$nombre.' '.$apellido.'</option>';
			}
			?>
			<!--</select>-->
			</datalist>
			
			<input type="submit" name="selectPaciente" value="Seleccionar" />
			</form>
			
			<?php
			if(isset($_SESSION['cliente'])){
				print '<h3 style="color:white">Paciente actual: '.explode('@',$_SESSION['cliente'])[0].'&nbsp<input type="button" class="buttonRed" onclick="deselectClient()" value="X"></h3>';
			
			}
			?>
			</div>
			
			</center>
			
			
			<div class="centerDiv">
			
			<br>
			
			
       <h2>Agenda</h2>
       
       
			<div class="centerDiv">
			<table>
		
			<tr><td>Fecha: </td><td><select class="select-style" name="añoFiltro" id="añoFiltro" onchange="llenarDiasFiltro()"></select><select class="select-style" name="mesFiltro" id="mesFiltro" onchange="llenarDiasFiltro()">
		   <option value="01">Enero</option>
		   <option value="02">Febrero</option>
		   <option value="03">Marzo</option>
		   <option value="04">Abril</option>
		   <option value="05">Mayo</option>
		   <option value="06">Junio</option>
		   <option value="07">Julio</option>
		   <option value="08">Agosto</option>
		   <option value="09">Septiembre</option>
		   <option value="10">Octubre</option>
		   <option value="11">Noviembre</option>
		   <option value="12">Diciembre</option>
		   </select>
		   <select class="select-style" name="diaFiltro" id="diaFiltro" required="required"></select></td><td>
		   <input type="button" onclick="FechaAgenda()" value="Fltrar"></td></tr>
			</table>
			<input type="hidden" id="fechaSeleccionada" value="">
			<input type="button" id="antSemana" value="<<">
			<input type="button"  id="antDia" value="<">
			&nbsp
			&nbsp
			&nbsp
			&nbsp
			
			<input type="button" id="sigDia" value=">">
			<input type="button" id="sigSemana" value=">>">
			<table border="1px" width="100%" id="tablaAgenda" class="blueTable">
			
			
			</table>

        
		
		</div>
		
		
</body>
</html>