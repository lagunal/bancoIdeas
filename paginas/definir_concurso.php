<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: DIS - AIT Region Centro, Miranda Oeste
//Periodo................: 2011
//---------------------------------------------------------------------------------------
session_cache_expire(16);
session_start();
extract($_REQUEST);
//echo  $_SESSION['usuario'];
//CREACION DE LA VARIABLE DE SESSION QUE CONTENDRA LAS CUENTAS DE CORREO ADMINISTRATIVAS
include("../../logica/inc/globales.php");
include ("pag_valida_sesion.php");
include ("../clases/presentacion.php");
//include ("pagina_obtener_usuario.php"); //ojo
$pres = new presentacion();

	
	
	include "../clases/directorioActivo.php";
	$da = new directorioActivo();

	include_once "../../persistencia/cargarLog.php";
	$log = new Log();

	include_once "../../persistencia/clad.php";
	$clad = new clad();

	$error = "";
	require("ajax.common.php");
	$xajax->printJavascript('../xajax/');


	if(isset($_POST["btnGuardar"]) && $_POST["btnGuardar"]!=""){
		 		
		if ($_POST['txtNombre'] == ''){$txtNombre="";}else{$txtNombre = $_POST['txtNombre'];} 
		if ($_POST['txtCodigo'] == ''){$codigo="";}else{$codigo = $_POST['txtCodigo'];}		
		if ($_POST['txtFechadesde'] == ''){$desde="";}else{$desde = $pres->cambiarFormatoFecha($_POST['txtFechadesde']);} 
		if ($_POST['txtFechahasta'] == ''){$hasta="";}else{$hasta = $pres->cambiarFormatoFecha($_POST['txtFechahasta']);} 
		
		$pasar = true;

		if ($clad->buscarConcursoActivo()>0 && $codigo==0){$pasar = false; $error = "Solo puede haber un solo concurso abierto";}
		if ($desde>$hasta){$pasar = false; $error = "La fecha desde no puede ser mayor";}
		if ($txtNombre=="") {$pasar = false; $error = "Debe definir un nombre";}
		if ($hasta=="") {$pasar = false; $error = "Debe definir la fecha hasta";}		
		if ($desde=="") {$pasar = false; $error = "Debe definir la fecha desde";}

		

		if($pasar){
			$clad->actualizarConcurso($txtNombre, $desde,$hasta, $codigo);
			$desde="";$hasta="";$txtNombre="";$codigo=0;
		}else{
			if($desde!="")$desde=$pres->cambiarFormatoFecha2($desde);
			if($hasta!="")$hasta=$pres->cambiarFormatoFecha2($hasta);
		}
	}
	

	$fecha=$pres->obtenerFechaActual();
	$clad->bloquearConcurso($fecha, 1);
	$clad->bloquearConcurso($fecha, 0);

	$Concurso = $clad->obtenerConcursos();
?>
<html>

<head>



<style type="text/css">


</style>
<title>&nbsp;( <?php echo $gs_acronimo ?> ) - <?php echo $titulo_sistema?> </title> 
<title>
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2011
//---------------------------------------------------------------------------------------
</title> 
<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css"/>
<link href="../css/auxi.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/tab-view.css"  media="screen" />
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/tab-view.js"></script>
<script language="javascript" type="text/javascript" src="../js/utilidades.js"></script>
<script type="text/javascript" src="../js/objajax.js"    language="javascript" ></script>
<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.1/mootools-yui-compressed.js"></script> -->
<script type="text/javascript" src="../js/mootools-yui-compressed.js"></script>
<script type="text/javascript" src="../js/sexyalertbox.v1.2.moo.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../css/sexyalertbox.css"/>
<meta http-equiv="refresh" content="<?php echo (session_cache_expire()*61)?>;URL=principal.php" >
<!--<link rel="stylesheet" type="text/css" href="../css/style.css"> -->
<!-- -->
	
<script>
function cargaralert(tipoalert)
{
var tipoalert;
alert("pagina principal...");
if(tipoalert=='I'){Sexy.info('<h1>Confirmación</h1><br/><p>Se agrego el registro exitosamente.</p>');}
if(tipoalert=='U'){Sexy.info('<h1>Información</h1><br/><p>Se modifico el registro exitosamente.</p>');}
if(tipoalert=='E'){Sexy.error('<h1>Error</h1><br/><p>Error en la operación, por favor verifique si esta intentando guardar dos veces la misma opciòn de lo contrario puede existir problema en la conexiòn de base de datos</p>');}
if(tipoalert=='W'){Sexy.alert('<h1>Advertencia</h1><br/><p>Los campos marcados con asterisco son obligatorios</p>');}
if(tipoalert=='C'){Sexy.info('<h1>Información</h1><br/><p>Se envio el correo exitosamente.</p>');}
if(tipoalert=='D'){Sexy.alert('<h1>Advertencia</h1><br/><p>La fecha hasta no puede ser menor que la fecha de inicio</p>');}
if(tipoalert=='A'){Sexy.info('<h1>Advertencia</h1><br/><p>Si modifica el registro, deberá cargar el archivo nuevamente... De lo contrario se perderá el vínculo</p>');}

}

</script>

<script type="text/javascript">	var GB_ROOT_DIR = "../js/greybox/";</script>
<script type="text/javascript" src="../js/greybox/AJS.js" language="javascript" ></script>
<script type="text/javascript" src="../js/greybox/AJS_fx.js" language="javascript" ></script>
<script language="JavaScript" type="text/javascript" src="../js/doPostBack.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/validaciones.js"></script>
<link type="text/css" rel="stylesheet" href="../css/calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../js/calendar.js?random=20060118"></script>
<script type="text/javascript" src="../js/greybox/gb_scripts.js" language="javascript"></script>
<link href="../js/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript">
		function cargarValor(codigo, nombre, inicio, fin){
			txtId = document.getElementById("txtNombre");
			document.getElementById("txtCodigo").value=codigo;
			txtId.value = nombre;
			document.getElementById("txtFechahasta").value = fin.substr(8,2) + "/" + fin.substr(5,2)+"/"+fin.substr(0,4);
			document.getElementById("txtFechadesde").value = inicio.substr(8,2) + "/" + inicio.substr(5,2)+"/"+inicio.substr(0,4);
			txtId.select();
			
		}
		
		function bloquear(id){
			establecerValor('txtCodigo', id);
			doPostBackValor('form1', 'txtAccion', 'e');
		}

		function desbloquear(id){
			establecerValor('txtCodigo', id);
			doPostBackValor('form1', 'txtAccion', 'b');
		}
		function seleccionandoCombo(cb1){
			if (cb1.options[cb1.selectedIndex].value != ""){
				xajax_usuarios(cb1.options[cb1.selectedIndex].value);
			}	
		}


	</script>
</head>
<HTML>
<body onload="document.getElementById('txtNombre').select()">


<!-- Tabla principal -->
<table width="760px" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
            <td><?php echo $pres->crearEncabezado($titulo_sistema); ?></td>
        </tr>
	<tr>
            <td><!-- session de usuario -->
		<?php 
			include_once('class.clienteSeguridadWeb.php');
			$client = new clienteSeguridadWeb($ruta);
			$resultado = $client->validarTiempoSesion($_SESSION["indicador"],$aplicacion);
																		
			if($resultado->codigoMensaje == 03){ //no existe la session
				$pag= "pag_fin_sesion.php";
				header("Location: ".$pag);
			}
			$titulo = "<a href='principal.php?n=1' class='link_blanco'>Inicio</a>";

			echo $titulo;
			echo $pres->crearVentanaInicio($titulo);
			include "menu.php";
			echo $pres->crearVentanaIntermedia();
		?>
		<form id="form1" method="post" style="margin:0px">
	    		<table cellpadding="0" cellspacing="0" border="0" width="590px">
					<tr>
						<td colspan="3" height="0px" style="display:none">
							<input type="hidden" id="txtAccion" name="txtAccion"/>
							<input type="hidden" id="txtCodigo" name="txtCodigo" value="<?php  echo $codigo; ?>"/>
							<input type="hidden" id="txtValores" name="txtValores" value=""/>
						</td>
					</tr>
					<tr>
						<td>
      						<?php echo $pres->crearSeparador("Definir Concurso"); ?>
						</td>
					</tr>
					<tr>
						<td>
		                    <table cellpadding="0" cellspacing="0" border="0">
					<tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
		                            
		                            <td class="Detalle" width="55px">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Nombre:
		                            </td>
		                            <td width="400px" colspan="5">
		                            	<input id="txtNombre" name="txtNombre" type="text" value="<?php echo $txtNombre; ?>" style="width:400" maxlength="150" onfocus="select();" />
		                            </td>
					</tr>
					<tr>
						<td height="6px">
						</td>
					</tr>
					<tr>
						<td  class="Detalle" width="40">
							<strong style="color:#FF0000; font-size:14px">* </strong>Desde:
						</td>
					  	<td  width="40">
					   		<input id="txtFechadesde" readonly name="txtFechadesde" type="text"  style="width:60" maxlength="10" value="<?php echo $desde; ?>"/>
					  	</td>
					  	<td width="46" >
					   		<input type="button"  width="10"  height="10" value="Cal" title="Calendario" onClick="displayCalendar(document.forms[0].txtFechadesde,'dd/mm/yyyy',this)" tabindex="70">
					   	</td>
				 	  	<td  class="Detalle" width="40"  >
					   		<strong style="color:#FF0000; font-size:14px">* </strong>Hasta:
					  	</td>
					  	<td  width="40">
					   		<input id="txtFechahasta" readonly name="txtFechahasta" type="text" style="width:60" maxlength="10" value="<?php echo $hasta; ?>" />
					  	</td>
					  	<td>
					   		<input type="button"  width="10"  height="10" value="Cal"  title="Calendario" onClick="displayCalendar(document.forms[0].txtFechahasta,'dd/mm/yyyy',this)" tabindex="70">
					   	</td>
		                            
		                        </tr>
		                        <tr>
		                        	<td height="10px"></td>
		                        </tr>
		                        <tr>
		                        	<td >
		                        	</td>
		                        	<td colspan="3">
							<?php echo $pres->crearBoton("btnGuardar", "Guardar", "submit", ""); ?>
						</td>
		                        </tr>
		                        <tr>
		                        	<td height="10px"></td>
		                        </tr>
		                        
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
		                    </table>
						</td>
					</tr>
					<tr>
						<td id="error" class="error">
							<?php echo $error; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $pres->crearSeparador("Usuarios"); ?>
						</td>
					</tr>
					<tr>
						<td>
		                    <table cellspacing="0" cellpadding="0" border="0">
		                    	<tr>
		                    		<td width="15px">
		                    		</td>
		                    		<td class="Titulo" width="500px">
		                    			Nombre
		                    		</td>
		                    		
		                    	</tr>
					<tr>
						<td colspan="3">
						<div id="tabla_detalle" style="OVERFLOW: auto; WIDTH: 500px; HEIGHT:600px"> 
							<?php
				                		echo $pres->crearTablaConcurso($Concurso, "Lista-Fondo1", "Lista-Fondo2");
					                ?>
						</div>
						</td>
					</tr>
			                    
		                    </table>
						</td>
					</tr>
				</table>
			</form>
	    </td>
        </tr>
	<tr>
            <td><?php echo $pres->crearVentanaFin(); ?></td>
        </tr>

	<tr>
            <td><?php echo $pres->crearPie(); ?></td>
        </tr>
</table> 
 
<!-- Fin Tabla para el pie de pagina --> 
<input type="hidden" name="tiposql" id="tiposql" style="visibility:hidden;display:none"/>
<input type="hidden" name="cursar" id="cursar" style="visibility:hidden;display:none" />
<input id="ubica"  name="ubica" type="hidden" style="visibility:hidden;display:none" />
<input id="tabla_formulario"  name="tabla_formulario" type="hidden" style="visibility:hidden;display:none" />
<input id="condicion"  name="condicion" type="hidden" style="visibility:hidden;display:none" />


</body>
</html>

<script language="javascript" type="text/javascript"> 

</script>
<script type="text/javascript">
        google_ad_client = "pub-6896919298908258";
        google_ad_slot = "4399429285";
        google_ad_width = 728;
        google_ad_height = 90;
</script>
