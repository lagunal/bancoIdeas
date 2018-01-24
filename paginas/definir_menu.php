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

	$check=true;
	if(isset($_POST["btnGuardar"]) && $_POST["btnGuardar"]!=""){

		if ($_POST['txtNombre'] == ''){$txtNombre="";}else{$txtNombre = $_POST['txtNombre'];}
		if ($_POST['txtUrl'] == ''){$txtUrl="";}else{$txtUrl = $_POST['txtUrl'];}
		if ($_POST['cmbPadre'] == ''){$cmbPadre=1;}else{$cmbPadre = $_POST['cmbPadre'];} 		 		 		 		
		if ($_POST['cmbRecurso'] == ''){$cmbRecurso=0;}else{$cmbRecurso = $_POST['cmbRecurso'];}
		if ($_POST['txtOrden'] == ''){$txtOrden="";}else{$txtOrden = $_POST['txtOrden'];}	
		if ($_POST['visible'] == ''){$visible="off";}else{$visible = $_POST['visible'];}
		if ($_POST['txtCodigo'] == ''){$codigo="";}else{$codigo = $_POST['txtCodigo'];}		
		if ($cmbPadre==0) $cmbPadre=1;

		$pasar = true;

		if ($cmbRecurso==0) {$pasar = false; $error = "Debe definir el recurso de la pagina";}
		if ($txtUrl=="") {$pasar = false; $error = "Debe definir el nombre del archivo php";}
		if ($txtNombre=="") {$pasar = false; $error = "Debe definir el nombre del menu";}
		if ($visible=='on'){$visible=0;}else{$visible=1;} 
		if($pasar){
			$clad->actualizarMenu($txtNombre, $txtUrl, $cmbPadre, $cmbRecurso, $txtOrden, $visible, $codigo);
			$txtNombre=""; $cmbPadre=0; $cmbRecurso=0; $txtOrden=""; $codigo=0; $txtUrl=""; $check = false;
		}
	}
	
	if(isset($_POST["txtAccion"])){ 
		if($_POST["txtAccion"]=="e" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!=""){	
			$clad->bloquearMenu($_POST["txtCodigo"],1);
			$codigo=0;
		}
		
		if($_POST["txtAccion"]=="b" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!=""){
			$clad->bloquearMenu($_POST["txtCodigo"],0);
			$codigo=0;
		}
	}
	
	//$datosUsuarios = $clad->obtenerUsuariosRoles($cmbRoles);
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
//Periodo................: 2010
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
//if(tipoalert=='U'){Sexy.info('<?php //echo "InformacionSe modifico el registro exitosamente" ?>');}
if(tipoalert=='E'){Sexy.error('<h1>Error</h1><br/><p>Error en la operación, por favor verifique si esta intentando guardar dos veces la misma opciòn de lo contrario puede existir problema en la conexiòn de base de datos</p>');}
if(tipoalert=='W'){Sexy.alert('<h1>Advertencia</h1><br/><p>Los campos marcados con asterisco son obligatorios</p>');}
if(tipoalert=='C'){Sexy.info('<h1>Información</h1><br/><p>Se envio el correo exitosamente.</p>');}
if(tipoalert=='D'){Sexy.alert('<h1>Advertencia</h1><br/><p>La fecha hasta no puede ser menor que la fecha de inicio</p>');}
if(tipoalert=='A'){Sexy.info('<h1>Advertencia</h1><br/><p>Si modifica el registro, deberá cargar el archivo nuevamente... De lo contrario se perderá el vínculo</p>');}

}

		function orden(boton){
			padre = document.getElementById("cmbPadre").value;
			numero= document.getElementById("txtOrden").value;
			codigo= document.getElementById("txtCodigo").value;
			if (padre==0) padre=1;
			if (boton.id=='up'){
				numero++;
				xajax_fijarOrden(padre, numero, codigo, 1);
				
			}else{
				numero--;
				xajax_fijarOrden(padre, numero, codigo, 0);
			}
			document.getElementById("txtOrden").value = numero;
		}

		function mouseup(mouse)
		{
	
			if(mouse.src.indexOf('over')>=0){
				mouse.src = '../imagenes/aplicacion/up.gif';
			}else{
				mouse.src = '../imagenes/aplicacion/up_over.gif';
			}
		}

		function cargarValor(nombre, padre, recurso, url, orden, visible, nivel, codigo){
			document.getElementById("txtUrl").value=url;
			document.getElementById("txtOrden").value=orden;
			document.getElementById("cmbPadre").value = padre;
			document.getElementById("cmbRecurso").value = recurso;
			document.getElementById("txtCodigo").value = codigo;
			if(padre==1)document.getElementById("cmbPadre").value = 0;
			for(i=1;i<nivel;i++){
				longitud=nombre.length;
				nombre=nombre.substring(2,longitud);
			}
			document.getElementById("txtNombre").value = nombre;
			if(visible==1) document.getElementById("visible").checked=false;
			if(visible==0) document.getElementById("visible").checked=true;
			document.getElementById("txtNombre").select();
			
		}

		function mousedown(mouse)
		{
	
			if(mouse.src.indexOf('over')>=0){
				mouse.src = '../imagenes/aplicacion/down.gif';
			}else{
				mouse.src = '../imagenes/aplicacion/down_over.gif';
			}
		}

		function bloquear(id){
			establecerValor('txtCodigo', id);
			doPostBackValor('form1', 'txtAccion', 'e');
		}

		function desbloquear(id){
			establecerValor('txtCodigo', id);
			doPostBackValor('form1', 'txtAccion', 'b');
		}


</script>

<script type="text/javascript">	var GB_ROOT_DIR = "../js/greybox/";</script>
<script type="text/javascript" src="../js/greybox/AJS.js" language="javascript" ></script>
<script type="text/javascript" src="../js/greybox/AJS_fx.js" language="javascript" ></script>
<script type="text/javascript" src="../js/greybox/gb_scripts.js" language="javascript"></script>
<script language="JavaScript" type="text/javascript" src="../js/doPostBack.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/validaciones.js"></script>
<link href="../js/greybox/gb_styles.css" rel="stylesheet" type="text/css" />

</head>
<HTML>
<body>


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
      						<?php echo $pres->crearSeparador("Definir menus"); ?>
						</td>
					</tr>
					<tr>
						<td>
		                    <table cellpadding="0" cellspacing="0" border="0">
					<tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
					<tr>
					    <td class="Detalle" width="60px">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Nombre:
		                            </td>
		                            <td colspan="3" width="200px">
		                            	<input id="txtNombre" name="txtNombre" type="text" value="<?php echo $txtNombre; ?>" style="width:150" maxlength="20"  onfocus="select();" />
		                            </td>
						<td class="Detalle" width="55">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Url:
		                            </td>
					    <td width="200px">
		                            	<input id="txtUrl" name="txtUrl" type="text" value="<?php echo $txtUrl; ?>" style="width:150" maxlength="30"  onfocus="select();" />
		                            </td>
						
					</tr>
		                        <tr>
		                            <td height="6px"></td>
		                        </tr>
					<tr>
					    <td class="Detalle" width="60px">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Padre:
		                            </td>
		                            <td colspan="3" width="200px">
		                            	<select id="cmbPadre" name="cmbPadre" class="Detalle" style="WIDTH: 150px" onChange="seleccionandoComboModulo(this)">
		                                <?php
		                                    $datos = $clad->obtenerMenus();
						    $combo = $datos;
		                                    $filas = count($datos);
						    $cont=0;
						    for($i = 0; $i < $filas; $i++){
							$fila = $datos[$i];
							if($cont<$filas) $combo[$cont]= $datos[$i];
							for($j = 1; $j < $filas; $j++){
							   
							   if($fila['co_menu']==$datos[$j]['co_padre']){
								$cont++;
								$combo[$cont]= $datos[$j];
								for($k=1;$k<=$fila['nu_nivel'];$k++)  $combo[$cont]['nb_menu'] = "--" . $combo[$cont]['nb_menu'];
							   }
							}
							$cont++;
						     }
		                                    echo $pres->crearCombo($combo, "co_menu", "nb_menu",$cmbPadre);
		                                ?>
		                            	</select>
		                            </td>
						<td class="Detalle" width="55">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Recurso:
		                            </td>
					    <td width="200px">
		                            	<select id="cmbRecurso" name="cmbRecurso" class="Detalle" style="WIDTH: 150px" ">
		                                <?php
		                                    $datos = $clad->obtenerRecursos();
		                                    echo $pres->crearCombo($datos, "co_recurso", "nb_recurso",$cmbRecurso);
		                                ?>
		                            	</select>
		                            </td>
						
					</tr>
					<tr>
		                            <td height="6px"></td>
		                        </tr>
					<tr>
					    <td class="Detalle" width="60px">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Orden:
		                            </td>

		                            <td width="28px">
		                            	<input id="txtOrden" name="txtOrden" type="text" value="<?php echo $txtOrden; ?>" style="width:25" maxlength="5" onfocus="select();" />
		                            </td>
						<td width="200px" colspan="2">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td>
				                    			<img id="up" src="../imagenes/aplicacion/up.gif" onmouseover="mouseup(this)" onmouseout="mouseup(this)" onClick="orden(this)">
					                    	</td>
							</tr>
							<tr>
								<td >
				                    			<img id="down" src="../imagenes/aplicacion/down.gif" onmouseover="mousedown(this)" onmouseout="mousedown(this)" onClick="orden(this)">
				                    		</td>
							</tr>
						</table>
						</td>
						<td class="Detalle" width="55">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Visible:
		                            </td>
					    <td width="200px">
						<?php if ($check==true) $check = "checked"; ?>
		                            	<input id="visible" name="visible" <?php echo $check; ?> type="checkbox" >
		                            </td>
						
					</tr>
					<tr>
		                            <td height="10px"></td>
		                        </tr>
					</table> 
					<table cellpadding="0" cellspacing="0" border="0">
		                        <tr>
						<td width="60px"> 
		                        	</td>
		                        	<td>
							<?php echo $pres->crearBoton("btnGuardar", "Guardar", "submit", ""); ?>
						</td>
		                        </tr>
	                        
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
		                    </table>
						</td>
					</tr>
					<tr>
						<td class="error">
							<?php echo $error; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $pres->crearSeparador("Menus"); ?>
						</td>
					</tr>
					<tr>
						<td>
		                    <table cellspacing="0" cellpadding="0" border="0">
		                    	<tr>
		                    		<td width="15px">
		                    		</td>
		                    		<td class="Titulo" width="200px">
		                    			Nombre
		                    		</td>
		                    		<td class="Titulo" width="350px">
		                    			
		                    		</td>
		                    	</tr>
					<tr>
						<td colspan="3">
						<div id="tabla_detalle" style="OVERFLOW: auto; WIDTH: 450px; HEIGHT:650px"> 
							<?php
				                		echo $pres->crearTablaMenu($combo, "Lista-Fondo1", "Lista-Fondo2");
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
/*function controldepag(pagina, co_modulo, tabla, condicion)
	{
	    document.getElementById('co_modulo').value=co_modulo;
		document.getElementById('tabla_formulario').value=tabla;
		document.getElementById('condicion').value=condicion;
		document.getElementById('form1').target="catalogo";
	    document.getElementById('form1').action=pagina;
	    document.getElementById('form1').submit();
	}*/
</script>
<script type="text/javascript">
        google_ad_client = "pub-6896919298908258";
        google_ad_slot = "4399429285";
        google_ad_width = 728;
        google_ad_height = 90;
</script>
