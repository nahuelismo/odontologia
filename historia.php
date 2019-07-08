<html lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
	
<title>Odontología</title>
<head>
  <link rel="stylesheet" href="Estilo\style.css">
<link rel="stylesheet" href="Estilo\icon.css">
  <link rel="stylesheet" href="Estilo\icon.css">
  
  <script src="Dominio\script.js"></script>

  <script src="Biblioteca\jquery-3.3.1.min.js"></script>
  <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

  <style>
	th, td {
    border: 1px solid grey;
	}
</style>
</head>
<?php
   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
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
   
 if(isset($_GET["insupddelimg"]))
{
print '<body onLoad="histYodonto(true)">';
}else{
print '<body onLoad="histYodonto(false)">';
}
?>
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

<h2>Historia Clinica</h2>
             <form action="uploadImage.php" method="post" enctype="multipart/form-data">
		<table>
		
		<?php
			print '<input type="hidden" id="clientes" name="clientes" value="'.$_SESSION['cliente'].'">';
			
			?>
			
			</table>
		
			 <?php
			if(isset($_GET["insupddelimg"]))
			{
		   print '<span style="color:red"><b>Imagen '.$_GET["insupddelimg"].' con éxito</b></span>';
		  //print '<script>$("#tableHist").hide();verFotos()</script>';
		   print '<br>';
		   print '<br>';
			}
			else	if(isset($_GET["insupdelOdo"]))
			{
		   print '<span style="color:red"><b>Odontograma '.$_GET["insupdelOdo"].' con éxito</b></span>';
		   print '<br>';
		   print '<br>';
			}
			?>
			
			<table class="blueTable" style="width:auto !important; paddig-bottom:0px !important">
			<tr style="margin-bottom:0px">
			<th style="border-radius:10px 10px 0px 0px"><a class="clickCell" style="color:white" href="javascript:void(0)" onclick="verHist()">Tratamientos</a></th>
			<th style="border-radius:10px 10px 0px 0px; background-color:#162458 !important"><a class="clickCell" style="color:white" href="javascript:void(0)" onclick="verFotos()">Imagenes</a></th>
			<th style="border-radius:10px 10px 0px 0px"><a class="clickCell" style="color:white" href="javascript:void(0)" onclick="verDatos()">Datos del Paciente</a></th>
			</tr>
			<tr>
			</table>
			<div style="margin-top=0px"id="tablaCli">
			
			
			</div>
			
			</form>
			<br>
			<br>
       <h2>Odontograma</h2>
	   <form id="odontograma" action="guardarOdontograma.php" method="POST">
	   <center>
	  
	   <?php
	   //session_start();
	
		
		print '<input type="hidden" id="clientes" name="clientes" value="'.$_SESSION['cliente'].'">';
		
		?>
			<br>
			<input type="checkbox" id="infantes" onClick="odontogramaInfantes()" style="display:none" />
			<label for="infantes" id="infantesLabel"  style="display:none" >Infante</label>
	   </center>
	   <table id="tablaOdontograma" style="border-style:hidden; background-color:#567dbc; border-radius:1rem">
	  </table>
	   <br>
	  
	   <input type="submit" name="guardarOdontograma" value="Guardar" id="submitOdontograma" style="display:none">
	   </form>
	   
	   
	   <h2>Seleccione Estado</h2>
	   <form id="estadoPieza" style="display:none">
	   <table class="blueTable" style="width:40% !important">
	   <tr>
	   <th colspan="4" align="center">
	   Por Cara
	   </th>
	   <th colspan="4" align="center">
	   Por pieza
	   </th>
	   </tr>
	   <tr>
	   <td>
	   <div align="center" style="background-color:red; width:20px; height:20px"><input type="radio" value="careado" name="estado" checked /></div>
	   </td>
	   <td>
	   Caries
	   </td>
	   <td>
	   <div align="center" style="background-color:black; width:20px; height:20px"><input type="radio" value="amalgama" name="estado" checked /></div>
	   </td>
	   <td>
	   Amalgama
	   </td>
	   <td>
	   <div align="center">
	    <img src="Recursos\clinicamenteAusente.jpg" style="width:20px; height:20px; object-fit:contain">
	   </div>
	   
	   </td>
	   
	   <td>
	   <input type="button" onClick="pieza('clinicamenteAusente')" value="Clinicamente Ausente">
	   
	   </td>
		<td>
	   <div align="center">
	    <img src="Recursos\endodoncia.jpg" style="width:20px; height:20px; object-fit:contain">
	   </div>
	   </td>
	   <td>
	   <input type="button" onClick="pieza('endodoncia')" value="Con Endodoncia">
	   </td>
	   </tr>
	   <td>
	   <div align="center"  style="background-color:blue; width:20px; height:20px"><input type="radio" value="obturado" name="estado" checked /></div>
	   </td>
	   <td>
	   Obturado
	   </td>
	   	<td>
	   <div align="center" style="background-color:green; width:20px; height:20px"><input type="radio" value="sellante" name="estado" checked /></div>
	   </td>
	   <td>
	   Sellante
	   </td>
	   <td>
	   <div align="center">
	    <img src="Recursos\protesis.jpg" style="width:20px; height:20px; object-fit:contain">
	   </div>
	   </td>
	   <td>
	   <input type="button" onClick="pieza('protesis')" value="Protesis">
	   </td>
	    <td>
	   <div align="center">
	    <img src="Recursos\necrosisPulpar.jpg" style="width:20px; height:20px; object-fit:contain">
	   </div>
	   </td>
	   <td>
	   <input type="button" onClick="pieza('necrosisPulpar')" value="Necrosis Pulpar">
	   </td>
	   <tr>
	   <td>
	   <div align="center" style="background-color:yellow ; width:20px; height:20px"><input type="radio" value="sellanteIndicado" name="estado" checked /></div>
	   </td>
	   <td>
	   Sellante Indicado
	   </td>
	   <td>
	   <div align="center"  style="background-color:#bddefc;; width:20px; height:20px"><input type="radio" value="defecto" name="estado" checked /></div>
	   </td>
	    <td>
	   Por Defecto
	   </td>
	   <td>
	   <div align="center">
	    <img src="Recursos\protesisIndicada.jpg" style="width:20px; height:20px; object-fit:contain">
	   </div>
	   </td>
	   <td>
	   <input type="button" onClick="pieza('protesisIndicada')" value="Protesis Indicada">
	   </td>
	   <td></td>
	   <td></td>
	   </tr>
	   <tr>
	   <td colspan="4"  align="center">
	   <input type="button" value="Cambiar" onClick="cambiarColor()">
	   </td>
	   <td colspan="4" align="center">
	   <input type="button" onClick="pieza('limpiar')" value="Limpiar pieza">
	   </td>
	   </tr>
	   
	   </table>
	   </form>
	   </div>
	   </html>
	   
	   </body>
	    