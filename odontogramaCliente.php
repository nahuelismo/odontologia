<?php

	$selected_option=$_POST['cliente'];
	$idCli = explode("@", $selected_option)[1];
	
	for($i =1;$i<=8;$i++){
		$par = false;
		$n = $i;
		if($i%2!=0)
		{
			if($i==3 || $i==5){
			print "<tr name=\"inf\" style=\"display:none\">";
			}
			else{
			print "<tr>";
			}
			

			print "<td  style=\"border-style:hidden\">";
		}
		else{
			
			print "<td  style=\"border-style:hidden\">";
			
			$par =true;
		}
		
		print "<table style=\"border-style:hidden\"";
		if($i==3 || $i==5){
			print "align=\"right\">";
		}
		else if($i==4 || $i==6){
			print "align=\"left\">";
		}
		else{
		print ">";
		}
		if($i>=3 && $i<=6){
			$n =$i+2;
			if($n==7){
			$n=8;
		}
		else if($n==8){
			$n=7;
		}
		}else if($i==7 || $i==8){
			$n=$i-4;
		}
		if($n==4){
			$n=3;
		}
		else if($n==3){
			$n=4;
		}
		if(($n>=5 && $n<=8)){
			$j = ($n*10)+5;
		}
		else{
			$j = ($n*10)+8;
		}
		if(!$par){
	for($pieza=$j;$pieza>=($n*10)+1;$pieza--){
		piezas($pieza, $idCli);
		}
		}
		else{
		for($pieza=($n*10)+1;$pieza<=$j;$pieza++){
		piezas($pieza, $idCli);
		}
		}
		print "</tr>";
		print "</table>";
		if($i%2==0){
	   	print "</tr>";
		}
	}
	
		
		
		print '<tr style="border-style:hidden"><td style="border-style:hidden" colspan="2">';
		print "<center>";
		print "C P O S:";
		$C = 0;
		$P = 0;
		$O = 0;
		$S = 0;
		$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
		$sql ="Select * from cpos where idCli=$idCli";
		$query = mysqli_query($link, $sql);
		$filas = mysqli_num_rows($query);
		
		if($filas!=0){
		while($row = mysqli_fetch_array($query))
		{	
			$C = $row['C'];
			$P = $row['P'];
			$O = $row['O'];
			$S = $row['S'];
		}
		}
		print '<input type="number" name="C" id="C" style="width:2%" value="'.$C.'">';
		print '<input type="number" name="P" id="P"  style="width:2%" value="'.$P.'">';
		print '<input type="number" name="O" id="O"  style="width:2%" value="'.$O.'">';
		print '<input type="number" name="S" id="S"  style="width:2%" value="'.$S.'">';
		print "</center>";
		print '</td></tr></table>';
		
		
		
		function piezas($pieza, $idCli){
		$link = mysqli_connect("localhost", "root", "", "odontologo") or die (mysqli_error()); //Connect to server
		$sql ="Select * from piezaOdontograma where idCli=$idCli and nroPieza=$pieza";
		//print $sql;
		$query = mysqli_query($link, $sql);

		//print $sql;
		$filas = mysqli_num_rows($query);
		if($filas!=0){
			//creando la tabla para la pieza con tratamientos aplicados
			imprimirPieza($query, $pieza);
			}
		
		else{
			//tabla de pieza sin tratamiento ninguno, la tabla default
			imprimirPiezaVacia($pieza);
		}
		}
		function imprimirPiezaVacia($pieza){
		print "<td style=\"border-style:hidden; \">";
		print "<table border=\"1\" id=\"pieza".$pieza."\" style=\"background-color:#a4c5fc;-webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover; background-size: cover; border-radius:32px 32px 0px 0px; width:6rem\">";
		print "<input type=\"hidden\" id=\"pieza-".$pieza."\" name=\"pieza".$pieza."\" value=\"O\">";
		print "<tr>";
		print " <tr>";
		print " <td id=\"celda".$pieza."-mesial\" rowspan=\"3\" style=\"border-radius:30px 0px 0px 0px\">";
		print " <input type=\"radio\" value=\"".$pieza."-mesial\" name=\"diente\" checked />";
		print " <input type=\"hidden\" value=\"\" name=\"pieza".$pieza."-mesial\" checked />";
		print " </td>";
		print " <td id=\"celda".$pieza."-palatino\" >";
		print "<input type=\"radio\" value=\"".$pieza."-palatino\" name=\"diente\" checked />";
	    print " <input type=\"hidden\" value=\"\" name=\"pieza".$pieza."-palatino\" checked />";
		print "</td>";
		print "<td id=\"celda".$pieza."-distal\" rowspan=\"3\" style=\"border-radius:0px 30px 0px 0px\"";
		print "><input type=\"radio\" value=\"".$pieza."-distal\" name=\"diente\" checked />";
		print "<input type=\"hidden\" value=\"\" name=\"pieza".$pieza."-distal\" checked />";
		print "</td>";
		print "</tr>";
		print "<tr>";
		print "<td id=\"celda".$pieza."-oclusal\" >";
		print "<input type=\"radio\" value=\"".$pieza."-oclusal\" name=\"diente\" checked />";
	    print "<input type=\"hidden\" value=\"\" name=\"pieza".$pieza."-oclusal\" checked />";
		print "</td>";
		print "</tr>";
		print "<tr>";
		print "<td  id=\"celda".$pieza."-lingual\" >";
		print "<input type=\"radio\" value=\"".$pieza."-lingual\" name=\"diente\" checked />";
	    print "<input type=\"hidden\" value=\"\" name=\"pieza".$pieza."-lingual\" checked />";
		print "</td>";
		print "</tr>";
		print "<tr >";
		print "<th colspan=\"3\"><input type=\"radio\" value=\"".$pieza."\" name=\"pieza\" checked />".$pieza."";
		print "<input type=\"button\" value=\"X\" onclick=\"extraccion(".$pieza.")\"></th>";
		print "</tr>";
		print "</table>";
	   	print "</td>";	
		}
		
		function ponerColor($cara, $curvo){
			$color ="";
			if($cara=="careado"){
				$color = "red";
			}
			if($cara=="amalgama"){
				$color = "black";
			}
			if($cara=="obturado"){
			$color = "blue";
			}
			if($cara=="sellante"){
			$color = "green";
			}if($cara=="sellanteIndicado"){
			$color = "	yellow";
			}
			if($curvo=="no")
			print "style=\"background-color:$color\">";
		else if($curvo=="izq"){
		print "style=\"background-color:$color; border-radius:30px 0px 0px 0px\">"; 
		}
		else{
			print "style=\"background-color:$color; border-radius:0px 30px 0px 0px\">"; 
		}
		
		}
		
		function imprimirPieza($query, $pieza){
			while($row = mysqli_fetch_array($query))
			{	
				print "<td style=\"border-style:hidden\">";
			$estado = $row['estadoPieza'];
			print "<table border=\"1\" s id=\"pieza".$pieza."\" style=\"background-color:#a4c5fc;-webkit-background-size: cover;-moz-background-size: cover; -o-background-size: cover; background-size: cover; border-radius:32px 32px 0px 0px; width:6rem\"";
			if($estado==null){
			print ">";
			}
			else{
			print "background=\"Recursos\\$estado.jpg\">";
		}
		print "<input type=\"hidden\" id=\"pieza-".$pieza."\" name=\"pieza".$pieza."\" value=";
		if($estado==null){
			print "\"O\">";
		}
		else{
			print "\"$estado\">";
		}
		
		print "<tr>";
		print " <tr>";
		$mesial = $row['mesial'];
		print " <td id=\"celda".$pieza."-mesial\" rowspan=\"3\" ";
		if($mesial==null){
			print "style=\"border-radius:30px 0px 0px 0px\" >";
		}
		else{
			ponerColor($mesial, "izq");
		}
		
		print " <input type=\"radio\" value=\"".$pieza."-mesial\" name=\"diente\" checked />";
		
		print " <input type=\"hidden\" value="; 
		if($mesial==null){
			print "\"\" name=\"pieza".$pieza."-mesial\" checked/>";
		}
		else{
			print "\"$mesial\" name=\"pieza".$pieza."-mesial\" checked/>";
		}
		print " </td>";
		$palatino = $row['palatino'];
		print " <td id=\"celda".$pieza."-palatino\"";
		if($palatino==null){
			print ">";
		}
		else{
			ponerColor($palatino, "no");
		}
		print "<input type=\"radio\" value=\"".$pieza."-palatino\" name=\"diente\" checked />";
		
	    print " <input type=\"hidden\" value=";
		if($palatino!=null){
			print "\"$palatino\" name=\"pieza".$pieza."-palatino\" checked />";
		}
		else{
			print "\"\" name=\"pieza".$pieza."-palatino\" checked />";
		}
		print "</td>";
		
		$distal = $row['distal'];
		print "<td id=\"celda".$pieza."-distal\" rowspan=\"3\" ";
		if($distal == null){
			print "style=\"border-radius:0px 30px 0px 0px\" >";
		}
		else{
			ponerColor($distal, "der");
		}
		print "<input type=\"radio\" value=\"".$pieza."-distal\" name=\"diente\" checked />";
		
		print "<input type=\"hidden\" value=";
		if($distal==null){
			print "\"\" name=\"pieza".$pieza."-distal\" checked />";
		}
		else{
			print "\"$distal\" name=\"pieza".$pieza."-distal\" checked />";
		}
		print "</td>";
		print "</tr>";
		print "<tr>";
		$oclusal = $row['oclusal'];
		print "<td id=\"celda".$pieza."-oclusal\"";
		if($oclusal==null){
			print ">";
		}
		else{
			ponerColor($oclusal, "no");
		}
		print "<input type=\"radio\" value=\"".$pieza."-oclusal\" name=\"diente\" checked />";
	    print "<input type=\"hidden\" value=";
		if($oclusal==null){
		print "\"\" name=\"pieza".$pieza."-oclusal\" checked />";
		}
		else{
		print "\"$oclusal\" name=\"pieza".$pieza."-oclusal\" checked />";
		}
		print "</td>";
		print "</tr>";
		print "<tr>";
		$lingual = $row['lingual'];
		print "<td  id=\"celda".$pieza."-lingual\"";
		if($lingual ==null){
			print ">";
		}
		else{
			ponerColor($lingual, "no");
		}
		print "<input type=\"radio\" value=\"".$pieza."-lingual\" name=\"diente\" checked />";
	    print "<input type=\"hidden\" value=";
		if($lingual==null){
			print "\"\" name=\"pieza".$pieza."-lingual\" checked />";
		}
		else{
			print "\"$lingual\" name=\"pieza".$pieza."-lingual\" checked />";
		}
		print "</td>";
		print "</tr>";
		print "<tr >";
		print "<th colspan=\"3\"><input type=\"radio\" value=\"".$pieza."\" name=\"pieza\" checked />".$pieza."";
		print "<input type=\"button\" value=\"X\" onclick=\"extraccion(".$pieza.")\"></th>";
		print "</tr>";
		print "</table>";
	   	print "</td>";
		}
		}
		?>