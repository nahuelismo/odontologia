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
   $user = $_SESSION['user']; //assigns user value
   ?>
<body >
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
 <h2>Plan de tratamiento</h2>
       <?php
	   if(isset($_GET["insupddel"]))
	   {
		   print '<span style="color:red"><b>Tratamiento '.$_GET["insupddel"].' con éxito</b></span>';
	   print '<br>';
	   print '<br>';
	   }
	   ?>
	   <center>
        <form id="registro" class="formulario" action="altaTratamiento.php" method="POST">
		<table>
		<tr><td>
		<?php
		
		print '<span style="color:white">'.explode('@', $_SESSION['cliente'])[0].'</span>';
		print '<input type="hidden" id="clientes" name="clientes" value="'.$_SESSION['cliente'].'">';
		?></td></tr></td>
			<tr><td>
			<select id="catTrat" class="select-style" onChange="tratPorTipo()" name="catTrat">
			<option value="-1">Categoria del tratamiento...</option>
			<option value = "Consultas"> Consultas </option >
			<option value = "Odontologia Preventiva"> Odontologia Preventiva </option>
			<option value = "Odontopediatria"> Odontopediatria </option>
			<option value = "Cirugia"> Cirugia </option>
			<option value = "Endodoncia"> Endodoncia </option>
			<option value = "Operatoria"> Operatoria </option>
			<option value = "Ortodoncia"> Ortodoncia </option>
			<option value = "Periodoncia"> Periodoncia </option>
			<option value = "Prostodoncia fija y removible"> Prostodoncia fija y removible </option>
			<option value = "Radiologia"> Radiologia </option>
			<option value = "Otros"> Otros </option>
			</select></td></tr><tr><td>
			<select  class="select-style" id="tipoTrat" name="tipoTrat" onChange="costoTrat()">
			
			</select>
			</td></tr>
			<tr>
			<td>
			<select class="select-style" id="piezas" name="piezas">
			<option value="11-18">11 a 18</option>
			<option value="21-28">21 a 28</option>
			<option value="41-48">41 a 48</option>
			<option value="31-38">31 a 38</option>
			<option value="11-48">11 a 48</option>
			<option value="51-55" name="piezaInf" style="display:none">51 a 55</option>
			<option value="61-65" name="piezaInf" style="display:none">61 a 65</option>
			<option value="71-75" name="piezaInf" style="display:none">71 a 75</option>
			<option value="81-85" name="piezaInf" style="display:none">81 a 85</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="31">31</option>
			<option value="32">32</option>
			<option value="33">33</option>
			<option value="34">34</option>
			<option value="35">35</option>
			<option value="36">36</option>
			<option value="37">37</option>
			<option value="38">38</option>
			<option value="41">41</option>
			<option value="42">42</option>
			<option value="43">43</option>
			<option value="44">44</option>
			<option value="45">45</option>
			<option value="46">46</option>
			<option value="47">47</option>
			<option value="48">48</option>
			<option value="51" name="piezaInf" style="display:none">51</option>
			<option value="52" name="piezaInf" style="display:none">52</option>
			<option value="53" name="piezaInf" style="display:none">53</option>
			<option value="54" name="piezaInf" style="display:none">54</option>
			<option value="55" name="piezaInf" style="display:none">55</option>
			<option value="61" name="piezaInf" style="display:none">61</option>
			<option value="62" name="piezaInf" style="display:none">62</option>
			<option value="63" name="piezaInf" style="display:none">63</option>
			<option value="64" name="piezaInf" style="display:none">64</option>
			<option value="65" name="piezaInf" style="display:none">65</option>
			<option value="71" name="piezaInf" style="display:none">71</option>
			<option value="72" name="piezaInf" style="display:none">72</option>
			<option value="73" name="piezaInf" style="display:none">73</option>
			<option value="74" name="piezaInf" style="display:none">74</option>
			<option value="75" name="piezaInf" style="display:none">75</option>
			<option value="81" name="piezaInf" style="display:none">81</option>
			<option value="82" name="piezaInf" style="display:none">82</option>
			<option value="83" name="piezaInf" style="display:none">83</option>
			<option value="84" name="piezaInf" style="display:none">84</option>
			<option value="85" name="piezaInf" style="display:none">85</option>

			</select><input type="checkbox" id="infantes" onClick="tratamientoInfantes()"  />
			<label for="infantes">Infante</label>
			</td></tr>
			<tr><td>
			<div class="divCaras">
			<table>
			
			<tr>
			<td>
			Caras
			</td>
			</tr>
			<tr>
			
			<td>
			<label class="container">Distal
			<input type="checkbox" id="distal" name="cara[]" value="d"  />
			<span class="checkmark"></span>
			</label>
			</td></tr>
			<tr><td>
			<label class="container">Mesial
			<input type="checkbox" id="mesial" name="cara[]" value="m"  />
			<span class="checkmark"></span>
</label>
			</td></tr>
			<tr><td>
<label class="container">Palatino
			<input type="checkbox" id="palatino" name="cara[]" value="p"  />
			<span class="checkmark"></span>
</label>
			</td></tr>
			<tr><td>
<label class="container">Lingual
			<input type="checkbox" id="lingual" name="cara[]" value="l"  />
			<span class="checkmark"></span>
</label>
			</td></tr>
			<tr><td>
<label class="container">Oclusal
			<input type="checkbox" id="oclusal" name="cara[]" value="o"  />
			<span class="checkmark"></span>
</label>
			</td></tr>
			<tr><td>
<label class="container">Incisal
			<input type="checkbox" id="incisal" name="cara[]" value="i"  />
			<span class="checkmark"></span>
</label>
			</td></tr></table></div></tr><td>
			
			<tr><td><textarea rows="8" cols="30" placeholder="Diágnostico" name="diag" id="diag"></textarea></td></tr>
			<tr><td><input type="text" name="costo" required="required" id="costo" placeholder="$ Costo tratamiento"></td></tr>
			
			
			
			</table>
			<input type="submit" name="altaTratamiento" value="Guardar" />
			<table>
			
			</table>
			</form>
			</center>
			<!--<tr><td>Fecha y Hora:</td><td>
		<select id="citasCli" name="citasCli">
		
			</select>
			</td></tr>-->
			
			
			<table class="blueTable">
			<th>Paciente</th>
			<th>Tratamiento</th>
			<th>Pieza/s</th>
			<th>Cara/s</th>
			<th>Diagnostico</th>
			<th>Costo</th>
			<th>Estado</th>
			<th>Sesiones</th>
			<th>Finalizar</th>
			<th>Eliminar</th>
			<?php
			 
				$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
			
				
				$idCli = explode('@',$_SESSION['cliente'])[1];
				$query = mysqli_query($link, "Select * from tratamiento where idCli=$idCli");

					
			
			while($row = mysqli_fetch_array($query))
			{
				$idTratamiento = $row['idTratamiento'];
				//$idCli = $row['idCli'];
				$cli = "";
					$query2 = mysqli_query($link, "select nombreCli, apellidoCli from Cliente where idCli=$idCli");
					while($row2 = mysqli_fetch_array($query2)){
					$nombre =$row2['nombreCli'];
					$apellido =$row2['apellidoCli'];
				
					$cli = $nombre." ".$apellido;
					}
				$piezas = $row['piezas'];
				$caras = $row['caras'];
				$diag = $row['diagnostico'];
				$trat = $row['idTipoTrat'];
				$tratamiento ="Sin Asignar";
					if(!$idTratamiento=="0"){
					$query3 =mysqli_query($link, "select nombre from tiposTrat where id=$trat");
					while($row3 = mysqli_fetch_array($query3)){
						$tratamiento = $row3['nombre'];
					}
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
						if($i=='i')
						{
							$cara="Incisal";
						}
				
					if($cara != ""){
					$stringCaras = $stringCaras.$cara.", ";
					}
					}
				}else{
				$stringCaras = "-";
				}
					
				
				print '<tr>';
				print '<td align="center">'.$cli.'</td>';
				if($tratamiento=="Sin Asignar"){
					print '<td align="center" >Sin Asignar</td>';
				}else
				{
				print '<td align="center" >'.$tratamiento.'</td>';
				}
				print '<td align="center">'.$piezas.'</td>';
				print '<td align="center">'.$stringCaras.'</td>';
			
				print '<td align="center"> <a href="#" onClick=\'alert("'.$diag.'")\' >Ver</td>';
				print '<td align="center">$'.$costo.'</td>';
				if($estado=="Iniciado"){
					print '<td align="center"><b style="color:green">'.$estado.'</b></td>';
				}
				else if($estado=="Pendiente"){
					print '<td align="center"> <b style="color:blue">'.$estado.'</b></td>';
				}
				else{
					print '<td align="center"><b style="color:red">'.$estado.'</b></td>';
				}
				
				
				print '<td align="center"><a href="verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'" target="popup" onClick="window.open(\'verSesiones.php?cli='.$idCli.'&trat='.$idTratamiento.'&nCli='.$cli.'\', \'popup\', \'width=800,height=600, screenX=(window.screen.width / 2) - ((800 / 2) + 10),screenY=(window.screen.height / 2) - 30)\'); return false;">Ver Sesiones</td>';
				if($estado == "Iniciado"){
				print '<td align="center">';
				print '<form action="finalizarTrat.php" method="POST" id="finalizarTrat'.$idTratamiento.'">';
				print '<input type="hidden" name="idTrat" value="'.$idTratamiento.'">';
				print '<input type="submit" value="Finalizar Tratamiento" ></form></td>';
				}
				else{
					print '<td></td>';
					}
					if($estado == "Pendiente"){
					print '<td><button onClick="borrarPlan('.$idTratamiento.')"><i class="material-icons" style="font-size:15px">close</i></button></td>';
					}
						else{
					print '<td></td>';
					}
				print '</tr>';
				
				
			}
			?>
			
			</div>
</body>
</html>