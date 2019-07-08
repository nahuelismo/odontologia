<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$montoPagar =$_POST['montoPagar'];
$idCli = $_POST['idCliente'];
$deuda = $_GET['deuda'];
$query = mysqli_query($link, "Select saldoFavor from cliente where idCli = $idCli");
			$saldoFavor = 0;
			while($row = mysqli_fetch_array($query))
			{
			$saldoFavor = $row['saldoFavor'];
			//print 'Saldo a favor ='.$saldoFavor;
			}
			if($deuda==0){
				mysqli_query($link, "update cliente SET saldoFavor=saldoFavor+$montoPagar where idCli=$idCli"); 
			}
			else{
			if($saldoFavor>0){
			if($montoPagar<=$saldoFavor){
				mysqli_query($link, "update cliente SET saldoFavor=saldoFavor-$montoPagar where idCli=$idCli"); 
				//print 'entre al if <br>';
				//print "update cliente SET saldoFavor=saldoFavor-$montoPagar where idCli=$idCli";
			}	
			else{
			mysqli_query($link, "update cliente SET saldoFavor=0 where idCli=$idCli"); 
			//print 'entre al else';
			}
			}
			}
			$query = mysqli_query($link, "Select * from tratamiento where idCli='$idCli' and montoPago<>costo");
			while($row = mysqli_fetch_array($query))
			{
				if($montoPagar!=0){
				$idTrat = $row['idTratamiento'];
				
				$costo = $row['costo'];
				$montoPago = $row['montoPago'];
				$pagar =$costo-$montoPago;
				if($pagar <= $montoPagar){
					mysqli_query($link, "update tratamiento SET montoPago=$costo where idTratamiento=$idTrat"); 
					$montoPagar -=$pagar;
				}
				else{
					mysqli_query($link, "update tratamiento SET montoPago=montoPago+$montoPagar where idTratamiento=$idTrat"); 
					$montoPagar =0;
					
				}
				
				}
			}
			//print $montoPagar;
			if($montoPagar>0){
				mysqli_query($link, "update cliente SET saldoFavor=saldoFavor+$montoPagar where idCli=$idCli"); 
			}
			
			Print '<script>window.location.assign("finanzas.php?insupdel=realizado");</script>';

}

?>