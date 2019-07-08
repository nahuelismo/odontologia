<?php
	session_start();
	
    $bool = true;
	
	$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
    //mysqli_select_db("odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to database
	$username = mysqli_real_escape_string($link ,$_POST['username']);
    $password = mysqli_real_escape_string($link ,$_POST['password']);
    $query = mysqli_query($link, "Select * from usuario WHERE nombreUsuario='$username'"); // Query the users table
    $exists = mysqli_num_rows($query); //Checks if username exists
    $table_users = "";
    $table_password = "";
    if($exists > 0) //IF there are no returning rows or no existing username
    {
       while($row = mysqli_fetch_assoc($query)) // display all rows from query
       {
          $table_users = $row['nombreUsuario']; // the first username row is passed on to $table_users, and so on until the query is finished
          $table_password = $row['passUsuario']; // the first password row is passed on to $table_password, and so on until the query is finished
       }
       if(($username == $table_users) && ($password == $table_password))// checks if there are any matching fields
       {
          //if($password == $table_password)
          //{
             $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
             header("location: inicio.php"); // redirects the user to the authenticated home page
             //header("location: backupDB.php"); // redirects the user to the authenticated home page
          //}
       }
       else
       {
        Print '<script>alert("Contraseña Incorrecta");</script>'; // Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
       }
    }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("index.php");</script>'; // redirects to login.php
    }
?>