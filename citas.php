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
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: index.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   ?>
<body onLoad="llamar()">

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


			</body>
			</html>