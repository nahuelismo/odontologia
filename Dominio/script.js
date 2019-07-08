
function llenar(){
$("#dia").prop( "disabled", true);
var años = $("#año");
var año ="";
var currentTime = new Date()
var year = currentTime.getFullYear()
for(var i = year; i>=1900; i--){
	año = i;
	años.append("<option value=\""+año+"\">"+año+"</option>");
}
	
}

function llenarAñosFiltro(){
$("#diaFiltro").prop( "disabled", true);
var años = $("#añoFiltro");
var año ="";
var currentTime = new Date()
var year = currentTime.getFullYear()
for(var i = year; i>=1900; i--){
	año = i;
	años.append("<option value=\""+año+"\">"+año+"</option>");
}
	
}

function llenarCita(){
	llenarAñosFiltro()
$("#dia").prop( "disabled", true);
$("#mes").prop( "disabled", true);
var años = $("#año");
var año ="";
var currentTime = new Date()
var year = currentTime.getFullYear()
años.append("<option value=\""+year+"\">"+year+"</option>");
años.append("<option value=\""+(year+1)+"\">"+(year+1)+"</option>");
llenarMeses();
}

function llenarDias(){
var diasSelect = $("#dia");

	$("#dia").prop( "disabled", false);
	var mes = $("#mes").val();
	var year =$("#año").val();
	if(mes=="02"){
		if(year%4!=0){
		
		dias=28;
		}
		else{ 
		dias=29;
		}
	}
	else if(mes=="01" ||mes=="03" ||mes=="05" ||mes=="07" ||mes=="08" ||mes=="10" || mes=="12"){
		dias=31;
		}
	else{
		dias=30;
	}
document.getElementById("dia").options.length = 0;
for(var i = 1; i<=dias; i++){
diasSelect.append("<option value=\""+i+"\">"+i+"</option>");	
}
}


function llenarDiasFiltro(){
var diasSelect = $("#diaFiltro");

	$("#diaFiltro").prop( "disabled", false);
	var mes = $("#mesFiltro").val();
	var year =$("#añoFiltro").val();
	if(mes=="02"){
		if(year%4!=0){
		
		dias=28;
		}
		else{ 
		dias=29;
		}
	}
	else if(mes=="01" ||mes=="03" ||mes=="05" ||mes=="07" ||mes=="08" ||mes=="10" || mes=="12"){
		dias=31;
		}
	else{
		dias=30;
	}
document.getElementById("diaFiltro").options.length = 0;
for(var i = 1; i<=dias; i++){
diasSelect.append("<option value=\""+i+"\">"+i+"</option>");	
}
}

function llenarDiasCita(){
var diasSelect = $("#dia");

	$("#dia").prop( "disabled", false);
	var mes = $("#mes").val();
	var year =$("#año").val();
	if(mes=="02"){
		if(year%4!=0){
		
		dias=28;
		}
		else{ 
		dias=29;
		}
	}
	else if(mes=="01" ||mes=="03" ||mes=="05" ||mes=="07" ||mes=="08" ||mes=="10" || mes=="12"){
		dias=31;
		}
	else{
		dias=30;
	}
document.getElementById("dia").options.length = 0;
var currentTime = new Date()
var day = currentTime.getDate();
var n = 1;
if(parseInt(mes)==(currentTime.getMonth()+1)){
	n = day;
}
for(var i = n; i<=dias; i++){
diasSelect.append("<option value=\""+i+"\">"+i+"</option>");	
}
}

function llenarMeses(){
var mesSelect = $("#mes");
var currentTime = new Date()
var month = currentTime.getMonth()+1;
var i = 1;
var year =$("#año").val();
if(currentTime.getFullYear()==year){
	i = month;
}
document.getElementById("mes").options.length = 0;
for(var n = i; n<=12; n++){
	var mes = "";
	switch(n){
		case 1: mes ="Enero";
		break;
		case 2: mes ="Febrero";
		break;
		case 3: mes ="Marzo";
		break;
		case 4: mes ="Abril";
		break;
		case 5: mes ="Mayo";
		break;
		case 6: mes ="Junio";
		break;
		case 7: mes ="Julio";
		break;
		case 8: mes ="Agosto";
		break;
		case 9: mes ="Septiembre";
		break;
		case 10: mes ="Octubre";
		break;
		case 11: mes ="Noviembre";
		break;
		case 12: mes ="Diciembre";
		break;
	}
	var num = n;
	if(num.length == 1){
		num = "0"+n;
	}
	mesSelect.append("<option value=\""+num+"\">"+mes+"</option>");
	}
	$("#mes").prop( "disabled", false);
	llenarDiasCita();
}





//\''.$nombre.'\',\''.$apellido.'\','.$ci.',\''.$cel.'\',\''.$tel.'\',\''.$dir.'\',\''.$sexo.'\',\''.$fecha.'\'
function llenarDatos(nombre,apellido,ci,cel,tel,mail,dir,sexo,fecha,id,poli,info){
	info = info.replace(/☻/g, '\r');
	$("#nombre").val(nombre);
	$("#apellido").val(apellido);
	if(ci==0)
	{
		ci=" ";
	}
	$("#ci").val(ci);
	$("#cel").val(cel);
	$("#tel").val(tel);
	$("#mail").val(mail);
	$("#dir").val(dir);
	$("#sexo").val(sexo);
	$("#idCliente").val(id);
	$("#poli").val(poli);
	$("#info").val(info);
	var _fecha = fecha.split('/');
	$("#dia").prop( "disabled", false);
	$("#mes").val(_fecha[1]);
	$("#año").val(_fecha[2]);
	llenarDias();
	$("#dia").val(_fecha[0]);
	$("#btnMod").show();
	$("#btnAlta").hide();
	
	
}

function selectFolder(e) {
    var theFiles = e.target.files;
    var relativePath = theFiles[0].webkitRelativePath;
    var folder = relativePath.split("/");
   alert(relativePath);
  
}


function FiltrarAgenda(){
//alert("<?php echo "asdasda";?>");
$("#tablaAgenda").empty();
var cli = $("#clientesFiltro").val();
$("#tablaAgenda").append("<tr><th>Cliente</th><th>Fecha</th><th>Hora</th><th>Hora Fin</th><th>Comentarios</th></tr>");

 $.post("filtrarAgenda.php", {option_value:cli},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tablaAgenda").append(data); //just to see what it returns
         }
     );
}
function FiltrarCitas(idCli){
//alert("<?php echo "asdasda";?>");
$("#citasCli").empty();
var cli = idCli;
//$("#citasCli").append("<tr><th>Cliente</th><th>Fecha</th><th>Hora</th><th>Hora Fin</th><th>Comentarios</th></tr>");

 $.post("FiltrarCitas.php", {option_value:cli},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#citasCli").append(data); //just to see what it returns
         }
     );
}

function tratPorTipo(){
//alert("<?php echo "asdasda";?>");
$("#tipoTrat").empty();
var cat = $("#catTrat").val();
//$("#citasCli").append("<tr><th>Cliente</th><th>Fecha</th><th>Hora</th><th>Hora Fin</th><th>Comentarios</th></tr>");

 $.post("filtrarTiposTrat.php", {option_value:cat},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tipoTrat").append(data); //just to see what it returns
         }
     );
}
 function histYodonto(verImg){
	 
	 seleccionarHistoria(verImg);
	 cargarFotos(verImg);
	 
	 verOdontograma();
	
 }



function FiltrarAgendaPorFecha(){
//alert("<?php echo "asdasda";?>");
$("#tablaAgenda").empty();
var fech = $("#diaFiltro").val()+"-"+$("#mesFiltro").val()+"-"+$("#añoFiltro").val();

$("#tablaAgenda").append("<tr><th>Cliente</th><th>Fecha</th><th>Hora</th><th>Hora Fin</th><th>Comentarios</th></tr>");

 $.post("filtrarAgenda.php", {fecha:fech},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tablaAgenda").append(data); //just to see what it returns
         }
     );
}

function costoTrat(){
	var value = $("#tipoTrat").val();
	var costo = value.split("-")[1];
	$("#costo").val(costo);
}

function seleccionarHistoria(verImg){
//alert("<?php echo "asdasda";?>");
$("#tablaCli").empty();
var img =""
if(verImg==true){
	img = "s";
}
else{
	img="n";
}
var cli = $("#clientes").val()+"&"+img;
if(cli!="-1"){
$.post("verHistoria.php", {cliente:cli},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tablaCli").append(data); //just to see what it returns
         }
     );
}


}

function VerTratamientosCli(){
//alert("<?php echo "asdasda";?>");
$("#tratsCli").empty();
var cli = $("#clientes").val();
if(cli!="-1"){
$.post("verTratsCli.php", {cliente:cli},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tratsCli").append(data); //just to see what it returns
         }
     );
}



 
}
function verOdontograma(){
//alert("<?php echo "asdasda";?>");
$("#tablaOdontograma").empty();
var cli = $("#clientes").val();
if(cli!="-1"){
$.post("odontogramaCliente.php", {cliente:cli},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tablaOdontograma").append(data); //just to see what it returns
         }
     );
}
$("#submitOdontograma").show();
$("#estadoPieza").show();
$("#infantes").show();
$("#infantesLabel").show();
 
}




function selectTrat(pTipo, id){
//alert("<?php echo "asdasda";?>");
$("#tdSelect").empty();
pTipo = pTipo+"@"+id;
$.post("selectTrats.php", {tipo:pTipo},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tdSelect").append(data); //just to see what it returns
         }
     );
} 

function selectTratsVacio(){
	$("#tdSelect").empty();
}
function selectTratsIni(id){
	 selectTrat("citaIni", id);
}
function selectTratsPend(id){
	 selectTrat("citaPend", id);
}




function verFotos(){
$("#tableHist").hide();
$("#tableDatos").hide();
$("#tableImg").show();/*
$("#tableImg").empty();
//$("#seeImg").hide();
var cli = $("#clientes").val();
$.post("verFotos.php", {cliente:cli},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tablaCli").append(data); //just to see what it returns
         }
     );*/
	
}
 function cargarFotos(verImg){
	 
 var img =""
if(verImg==true){
	img = "s";
}
else{
	img="n";
}
var cli = $("#clientes").val()+"&"+img;
$("#tableImg").empty();
//$("#seeImg").hide();
//var cli = $("#clientes").val();
$.post("verFotos.php", {cliente:cli},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tablaCli").append(data); //just to see what it returns
         }
     );

 }

function borrarCitaTrat(sesion, trat){
var citaYtrat = ""+sesion+"@"+trat;
if(confirm("Esta seguro que quiere eliminar la cita de este tratamiento (esto no eliminara la cita de la agenda, solo dejara de estar asignada al tratmiento seleccionado)")){
$.post("borrarCitaTrat.php", {vars:citaYtrat},
         function(data){ 
              location.reload();
         }
     );
	
}
}
function llamar(){
var d = new Date();
llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
llenarCita();

}
function ajaxAgenda(d){
var fecha = d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear();
$("#fechaSeleccionada").val(fecha);
var dataString = 'date='+ fecha;
  $.ajax({
    type: "POST",
    url: "llenarAgenda.php",
    data: dataString,
    success: function(data) {
	//alert(data);
    $('#tablaAgenda').html(data);
    }
  });
}

$(function() {
$("#antDia").click(function(){
//alert("clickeaste el boton xD");
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()-1);
ajaxAgenda(d);
//llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
  return false;
});
});

$(function() {
$("#antSemana").click(function(){
//alert("clickeaste el boton xD");
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()-7);
ajaxAgenda(d);
//llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
  return false;
});
});

$(function() {
$("#sigDia").click(function(){
//alert("clickeaste el boton xD");
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()+1);
ajaxAgenda(d);
//llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
  return false;
});
});

$(function() {
$("#sigSemana").click(function(){
//alert("clickeaste el boton xD");
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()+7);
ajaxAgenda(d);
//llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
  return false;
});
});


function FechaAgenda(){
llenarAgenda($("#diaFiltro").val()+'-'+$("#mesFiltro").val()+'-'+$("#añoFiltro").val());
}
function sigDia(){
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()+1);
llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
}

/*function sigSemana(){
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()+7);
llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
}

function antDia(){
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()-1);
llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
}
function antSemana(){
var tFecha = $("#fechaSeleccionada").val().split('-');
var fecha = new Date(tFecha[2], tFecha[1]-1, tFecha[0]);
var d = new Date(fecha);
d.setDate(d.getDate()-7);
llenarAgenda(d.getDate()  + '-' + (d.getMonth()+1) + '-' + d.getFullYear());
}*/




function llenarAgenda(fecha){
$("#fechaSeleccionada").val(fecha);
$("#tablaAgenda").empty();
$.post("llenarAgenda.php", {date:fecha},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
              $("#tablaAgenda").append(data); //just to see what it returns
         }
     );
	
}

function abrirPopup(idcli, idTrat, cli){
	url="verSesiones.php?cli='"+idCli+"'&trat='"+idTratamiento+"'&nCli='"+cli+"'";
	var left = (screen.width - 800) / 2;
    var top = (screen.height - 600) / 4;
    var myWindow = window.open(url,'popup','width=800, height=600, top=' + top + ', left=' + left);
	if (window.focus) {myWindow.focus()}
	return false;
		
}

function verHist(){
	
$("#tableHist").show();
$("#tableImg").hide();
$("#tableDatos").hide();
//$("#seeHist").remove();
//$("#seeImg").show();
}
function verDatos(){
	
$("#tableDatos").show();
$("#tableImg").hide();
$("#tableHist").hide();
//$("#seeHist").remove();
//$("#seeImg").show();
}

function addComment(idSesion, comentario){
var comentario = prompt("Ingrese comentarios", comentario);
var todo=comentario+"@"+idSesion;
$("#comentario"+idSesion).prop("disabled", true);
$.post("addComment.php", {todo:todo},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
			  alert("Comentario añadido");
              location.reload();
         }
     );
}

function borrarPlan(idPlan){
	$.post("eliminarPlan.php", {plan:idPlan},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
			  //alert("Descripcion Editada");
              window.location.assign("planificacion.php?insupddel=eliminado");
         }
     );
}

function comentarioImagen(idImg, desc){
	var num = idImg;
	idImg = "foto"+idImg;
	$("#"+idImg).empty();
	$("#"+idImg).append("<textarea rows=\"5\" cols=\"50\" placeholder=\"Descripción\" name=\"descImg2\" id=\"descImg2"+num+"\"></textarea>");
	$("#descImg2"+num).val(desc.replace(/☻/g, '\r'));
	$("#"+idImg).append("<br>");
	$("#"+idImg).append("<input type=\"button\" value=\"Editar\" onclick=\"editarComentarioImagen("+num+")\" >");
	
}
function editarComentarioImagen(idImg){
var comentario = $("#descImg2"+idImg).val();
var todo=comentario+"@"+idImg;
$.post("editCommentImg.php", {todo:todo},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              //$("#place_where_you_want_the_new_html").html(data);
			  //alert("Descripcion Editada");
              window.location.assign("historia.php?insupddelimg=editada");
         }
     );
}

function deselectClient(){
var coso="a";
	$.post("desClient.php", {coso:coso},
			function(data){
				location.reload();
			}
		);
}



function filtrarCli(){
	var nombre = $("#filtroCli").val().toUpperCase();
	$("#clientes option").each(function() {
		valor =this.text.toUpperCase();
		
		if(!valor.includes(nombre)){
		this.style.display = "none";
		}
		else if(nombre ==""){
			this.style.display="block";
		}
		
    
});
	$("#clientes").val( $("#clientes option:first-child").val() );
}




function cambiarColor(){
	var cara = document.querySelector('input[name="diente"]:checked').value;
	var estado = document.querySelector('input[name="estado"]:checked').value;
	var color ="";
	if(estado=="careado"){
	 color = "red";
	}
	if(estado=="amalgama"){
	 color = "black";
	}
	if(estado=="obturado"){
	 color = "blue";
	}
	if(estado=="sellante"){
	 color = "green";
	}
	if(estado=="sellanteIndicado"){
	 color = "yellow";
	}
	if(estado=="defecto"){
		color="";
		estado="";
	}
	
	$("#celda"+cara).css('background-color', color);
	
	$('[name=pieza'+cara+']').val(estado);
}
function extraccion(pieza){
	var extraido = $('#pieza-'+pieza).val();
	if(extraido=="extraido"){
	 $('[value^='+pieza+'-]').prop("disabled", false);
	 $('#pieza'+pieza).css('background-image','none');
	 $('#pieza-'+pieza).val("O");
	} else{
	 $('[value^='+pieza+'-]').prop("disabled", true);
	 $('[value^='+pieza+'-]').prop("selected", false);
	 $('#pieza'+pieza).css('background-image','url(Recursos/extraido.jpg)');
	 $('#pieza-'+pieza).val("extraido");
	}
	
		
}
function pieza(estado){
	var pieza = document.querySelector('input[name="pieza"]:checked').value;
	if(estado=="limpiar"){
	$('#pieza'+pieza).css('background-image','none');
	$('#pieza-'+pieza).val("O");
	$('[value^='+pieza+'-]').prop("disabled", false);
	}
	else{
	$('#pieza'+pieza).css('background-image','url(Recursos/'+estado+'.jpg)');
	$('#pieza-'+pieza).val(estado);
	if(estado=="protesis"){
	$('[value^='+pieza+'-]').prop("disabled", true);
	}
	else{
			$('[value^='+pieza+'-]').prop("disabled", false);
	}
	}
}

 function odontogramaInfantes(){
	  // Get the checkbox
  var checkBox = document.getElementById("infantes");
  // Get the output text
  

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    $('[name=inf]').show();
  } else {
      $('[name=inf]').hide();
  }
	 
 }
function tratamientoInfantes() {
  // Get the checkbox
  var checkBox = document.getElementById("infantes");
  // Get the output text
  

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
     $('[name=piezaInf]').show();
  } else {
      $('[name=piezaInf]').hide();
  }
}


function deudasFinalizado(){
	if(!$("#tblDeudaFin").is(":visible") ){
		$("#tblDeudaFin").show();
		$("#deudaFinTotal").show();
	}else if($("#tblDeudaFin").is(":visible")){
		$("#tblDeudaFin").hide();
		$("#deudaFinTotal").hide();
	}
}

function mesesCitas3(){
	if(!$("#tbl3meses").is(":visible") ){
		$("#tbl3meses").show();
		//$("#deudaFinTotal").show();
	}else if($("#tbl3meses").is(":visible")){
		$("#tbl3meses").hide();
		$("#tbl3meses").hide();
	}
}
function mesesCitas6(){
	if(!$("#tbl6meses").is(":visible") ){
		$("#tbl6meses").show();
		//$("#deudaFinTotal").show();
	}else if($("#tbl6meses").is(":visible")){
		$("#tbl6meses").hide();
		$("#tbl6meses").hide();
	}

}
function añoCitas1(){
	if(!$("#tbl1año").is(":visible") ){
		$("#tbl1año").show();
		//$("#deudaFinTotal").show();
	}else if($("#tbl1año").is(":visible")){
		$("#tbl1año").hide();
		$("#tbl1año").hide();
	}
}

function cambiarId(){
	var id= $("#clientes option[value='"+$('#lstClis').val() +"']").attr('data-id');
	$("#clienteId").val(id);
	//alert($("#clienteId").val());
}

function submitBackup(){
	var coso = confirm('¿Está seguro? Al restaurar un respaldo anterior perdera todos los datos ingresados luego de haberse realizado el mismo!');
	
		$("#subBack").hide();
		$("#label").append("<span>Espere por favo...r</span>");
		
		//document.write("Espere por favor...");
		return coso;
	
	
}

