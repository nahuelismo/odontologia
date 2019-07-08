<?php 
$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
$plan=$_POST['plan'];
mysqli_query($link, "delete from tratamiento where idTratamiento=$plan");
//print "<script>delete tratamiento where idTratamiento=$plan</script>";
?>