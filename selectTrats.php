<?php
$tipo=explode('@',$_POST['tipo'])[0];
$idCita=explode('@',$_POST['tipo'])[1];
session_start();
$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
$cli;
if(!isset($_SESSION['cliente'])){
	$sql = "Select idCli from agenda where id=$idCita";
	$query = mysqli_query($link, $sql);
	while($row = mysqli_fetch_array($query))
    {
		
		$cli = $row['idCli'];
	}
}else{
$cli = explode('@', $_SESSION['cliente'])[1];
}
$sql = "Select * from tratamiento where idCli=$cli";
if($idCita!='-1'){
	$sql .= ' and idTratamiento not in (select idTrat from sesiontrat where idCita='.$idCita.')';
}
if($tipo=="citaPend"){
					$sql = $sql.' and estadoTrat="p"';
				}else{
					$sql = $sql.' and estadoTrat="i"';
				}
			//print $sql;
				

print '<select id="trat" name="trat">';
		print '<option>Seleccione un Tratamiento</option>';
		
				
				
				//print $sql;
				$query = mysqli_query($link, $sql);
				$trat;
				$tratamiento;
				while($row = mysqli_fetch_array($query))
				{
					$trat = $row['idTipoTrat'];
					if(!$trat=="0"){
					$query3 =mysqli_query($link, "select nombre from tiposTrat where id=$trat");
					while($row3 = mysqli_fetch_array($query3)){
						$tratamiento = $row3['nombre'];
					}
					}
					else{
						
					$tratamiento = "No asignado";
					}
					print '<option name ="idTrat" value="'.$row['idTratamiento'].'">Pieza/s:'.$row['piezas'].' - '.$tratamiento.'</option>';
				}
			
			
		print '</Select>';

?>