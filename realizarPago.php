<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$idTrat = mysqli_real_escape_string($link, $_GET['trat']);
$idCli = $_GET['cli'];
$pago = mysqli_real_escape_string($link, $_POST['monto']);
$query = mysqli_query($link, "Select costo-montoPago deuda from tratamiento where idTratamiento = $idTrat");
//print "Select costo-montoPago deuda from tratamiento where idTratamiento = $idTrat";
$deuda = 0;
while($row = mysqli_fetch_array($query))
{
	$deuda = $row['deuda'];
}
if($pago>$deuda){
Print '<script>alert("No puede pagar mas de lo que debe en el tratamiento!");</script>'; // Prompts the user
//print $pago.'<br>'.$deuda;
 print '<script>history.back()</script>';
}
else{
$query = mysqli_query($link, "Select saldoFavor from cliente where idCli = $idCli");
//print "Select costo-montoPago deuda from tratamiento where idTratamiento = $idTrat";
$saldoFavor = 0;
while($row = mysqli_fetch_array($query))
{
	$saldoFavor = $row['saldoFavor'];
	
}
if($saldoFavor>0){
if($pago<=$saldoFavor){
mysqli_query($link, "update cliente SET saldoFavor=saldoFavor-$pago where idCli=$idCli"); 
}
else{
mysqli_query($link, "update cliente SET saldoFavor=0 where idCli=$idCli"); 
}
}
mysqli_query($link, "update tratamiento SET montoPago=montoPago+$pago where idTratamiento=$idTrat"); 
//Print '<script>alert("Pago Realizado");</script>'; // Prompts the user
Print '<script>window.location.assign("finanzas.php?insupdel=realizado");</script>';
}
}
?>