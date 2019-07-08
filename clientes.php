<html lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
	
<title>Odontología</title>
<head>
  <link rel="stylesheet" href="Estilo\style.css">
<link rel="stylesheet" href="Estilo\icon.css">
    <link rel="stylesheet" href="Estilo\icon.css">
  <script src="Dominio\script.js"></script>
  <script src="Biblioteca\jquery-3.3.1.min.js"></script>
</head>
<?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>
<body onLoad="llenar()">

<div class="cabecera">

<a href="inicio.php"><img src="Recursos\logo.png" class="logo"></a>
<span>ODONTOLOGIA</span>
<a href="logout.php" style="vertical-align:bottom";>Cerrar Sesion</a>
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
       <h2>Registro de Pacientes</h2>
	   <?php
	   if(isset($_GET["insupddel"]))
	   {
		   print '<span style="color:red"><b>Paciente '.$_GET["insupddel"].' con éxito</b></span>';
	   print '<br>';
	   print '<br>';
	   }
       
	   
	   
	   ?>
	   <center>
        <form  class="formulario" id="registro" action="registrarCli.php" method="POST">
		
		<table>
          <tr><td><input type="text" name="nombre" id="nombre" required="required" placeholder="Nombre" /></td></tr>
           <tr><td><input type="text" name="apellido" id="apellido" required="required" placeholder="Apellido" /></td></tr>
           <tr><td><input type="number" name="documento" id="ci" required="required" style="-webkit-appearance: none;" placeholder="C.I."  /></td></tr>
		   <tr><td><input type="text" name="telefono" id="tel"  placeholder="Telefono" /></td></tr>
		   <tr><td><input type="text" name="mail" id="mail" placeholder="e-Mail"  /></td></tr>
		   <tr><td><input type="text" name="celular" id="cel"  placeholder="Celular" /></td></tr>
		   <tr><td><input type="text" name="direccion" id="dir"  placeholder="Direccion" /></td></tr>
		   <tr><td>
		   <select class="select-style" name="sexo" id="sexo" placeholder="sexo" style="width:100%!important">
		    <option value="" disabled selected>Sexo</option>
		   <option value="m">Masculino</option><option value="f">Femenino</option></select></td></tr>
		   <tr><td><select class="select-style" name="año" id="año" onchange="llenarDias()" ></select><select class="select-style" name="mes" id="mes" onchange="llenarDias()">
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
		   <select class="select-style" name="dia" id="dia" required="required"></select></td></tr>
		   <tr><td><input type="text" name="poli" id="poli" placeholder="Policlinica" /></td></tr>
		   </table><table>
		   <tr><td><textarea rows="10" cols="50" placeholder="Informacion relevante" name="info" id="info"></textarea><td></tr>
		   
		   </table>
		   <input type="hidden" name="idCliente" id="idCliente" value="" />
           <input type="submit"  name="altamod" value="Registrar" id="btnAlta"/>
		   <input name="altamod" type="submit" value="Modificar" form="registro" style="display:none" id="btnMod">
		   </form>
		     </center>
</div>
<div class = "centerDiv">
<table>
<tr>
<td>
<div align="center" style="background-color:#ea4d4d; width:20px; height:20px; border-radius:0.2rem">
</td>
<td>
Paciente con datos faltantes
</td>
</tr>
<table class="blueTable">
<tr>
	<th></th>
	<th>Nombre</th>
	<th>Apellido</th>
	<th>Documento</th>
	<th>Telefono</th>
	<th>e-Mail</th>
	<th>Celular</th>
	<th>Direccion</th>
	<th>Sexo</th>
	<th>Fecha Nacimiento</th>
	<th>Policlinica</th>
	<th>Informacion</th>
	<th></th>
	</tr>
	<?php 
	$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
	$query = mysqli_query($link, "Select * from cliente order by apellidoCli");
	while($row = mysqli_fetch_array($query))
	{
		//nombreCli, apellidoCli, ciCli, celCli, telCli, dirCli
		
		$id = $row['idCli'];
		$nombre = $row['nombreCli'];
		$apellido = $row['apellidoCli'];
		$ci = $row['ciCli'];
		$cel = $row['celCli'];
		$tel = $row['telCli'];
		$mail = $row['cliMail'];
		$dir = $row['dirCli'];
		$info = $row['infoCli'];
		$poli = $row['policlinica'];
		if($dir=="Sin Asignar"){
		print '<tr class="sinAsignar"><form action="BajaModCli.php" method="POST">';
		}else{
		print '<tr><form action="BajaModCli.php" method="POST">';}
		print '<input type="hidden" name="idCli" value="'.$row['idCli'].'" />';
		
		$ci2;
		$tel2;
		$cel2;
		
		if($ci=='null'){
		$ci2 = 0;
		}
		else{
			$ci2 = $ci;
		}
		if($tel=='000000000'){
		$tel2 = "";
		}else{
		$tel2 = $tel;	
		}
		if($cel=='000000000'){
		$cel2 = "";
		}
		else{
		$cel2 = $cel;
		}
		
		
		if($poli == "" || $poli ==null){ 
		}
			$poli = "No";
		$sexo;
		if($row['sexoCli']=='m'){
		$sexo = "Masculino";
		}
		else if($row['sexoCli']=='f'){
		$sexo="Femenino";
		}
		$fecha = $row['fechaNac'];
		if($ci=='null'){
		$ci = " - ";
		}
		if($tel=='000000000'){
		$tel = " - ";
		}
		if($cel=='000000000'){
		$cel = " - ";
		}
		
		$info2 = str_replace(array("\n", "\r"), '☻', $info);
		//$info2 = str_replace(array("☻☻☻☻", "☻☻☻", "☻☻" ), '☻', $info2);
	
		
		
		
		
		
		print '<td align="center"><input type="button" onClick="llenarDatos(\''.$nombre.'\',\''.$apellido.'\','.$ci2.',\''.$cel2.'\',\''.$tel2.'\',\''.$mail.'\',\''.$dir.'\',\''.$row['sexoCli'].'\',\''.$fecha.'\','.$id.',\''.$poli.'\',\''.$info2.'\')" value="^"></td>';
		print '<td align="center">'. $nombre . "</td>";
		print '<td align="center">'. $apellido . "</td>";
		print '<td align="center">'. $ci . "</td>";
		print '<td align="center">'. $cel. "</td>";
		print '<td align="center">'. $mail . "</td>";
		print '<td align="center">'. $tel . "</td>";
		print '<td align="center">'. $dir . "</td>";
		print '<td align="center">'. $sexo . "</td>";
		print '<td align="center">'. $fecha . "</td>";
		print '<td align="center">'. $poli . "</td>";
		if($info==""){
			
		$info="No hay información que mostrar";	
		}
		print '<td align="center"> <a href="#" onClick=\'alert("'.$info.'")\' >Ver</td>';
		print '<td align="center"><input type="submit" value="X"></td>';
		print "</form>";
		//print '<td align="center"><input name="altamod" type="submit" value="Modificar" form="registro"></td></tr>';
		
	}
	?>
</table>
</div>
</body>

</html>