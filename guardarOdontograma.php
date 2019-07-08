<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$link = mysqli_connect("localhost", "root", "", "odontologo") or die ("Error: No se pudo contectar con la base de datos"); //Connect to server
$cliente = $_POST["clientes"];
$idCli = explode("@", $cliente)[1];
$C = $_POST["C"];
$P = $_POST["P"];
$O = $_POST["O"];
$S = $_POST["S"];

$sql ="Update CPOS set C=$C, P=$P, O=$O, S=$S where idCli=".$idCli;
			//print $sql;
			mysqli_query($link, $sql);

for($i=1;$i<=8;$i++){
	$j=0;
	if($i>=5 && $i<=8){
		$j=5;
	}else{
		$j=8;
	}
	for($pieza=($i*10)+1;$pieza<=($i*10)+$j;$pieza++){
		$sql ="Select * from piezaOdontograma where idCli=$idCli and nroPieza=$pieza";
		//print $sql;
		$query = mysqli_query($link, $sql);
		$estadoPieza = $_POST['pieza'.$pieza];
		if($estadoPieza=="O"){
		 $estadoPieza = null;
		}
		$mesial = $_POST['pieza'.$pieza.'-mesial'];
		$oclusal = $_POST['pieza'.$pieza.'-oclusal'];
		$palatino = $_POST['pieza'.$pieza.'-palatino'];
		$lingual = $_POST['pieza'.$pieza.'-lingual'];
		$distal = $_POST['pieza'.$pieza.'-distal'];
		//print $pieza.' '.$estadoPieza.' '.$mesial.' '.$oclusal.' '.$palatino.' '.$lingual.' '.$distal.'<br>';
		//print $sql;
		$filas = mysqli_num_rows($query);
		if($filas!=0){
		$sql ="Update piezaOdontograma set estadoPieza='$estadoPieza', mesial='$mesial', oclusal='$oclusal', palatino='$palatino', lingual='$lingual', distal='$distal' where idCli=$idCli and nroPieza=$pieza";
		//print $sql;
		mysqli_query($link, $sql);
		//Print '<script>alert("Odontograma Guardado");</script>'; // Prompts the user
			Print '<script>window.location.assign("historia.php?insupdelOdo=guardado");</script>';
		}
		
		else{
			if($estadoPieza==null && $mesial=="" && $oclusal=="" && $palatino=="" && $lingual=="" && $distal==""){
			
			}
			else{
			$sql ="Insert into piezaOdontograma (`idCli`, `nroPieza`, `estadoPieza`, `palatino`, `mesial`, `oclusal`, `distal`, `lingual`) values($idCli, $pieza, '$estadoPieza', '$palatino', '$mesial', '$oclusal', '$distal', '$lingual')";
			//print $sql;
			mysqli_query($link, $sql);
			//Print '<script>alert("Odontograma Guardado");</script>'; // Prompts the user
			Print '<script>window.location.assign("historia.php?insupdelOdo=guardado");</script>';
			}
		}
	}
}
}

?>