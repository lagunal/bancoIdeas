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

	
	if ($_POST['cmbRoles'] == ''){$cmbRoles=0;}else{$cmbRoles = $_POST['cmbRoles'];}
	if(isset($_POST["btnGuardar"]) && $_POST["btnGuardar"]!=""){
		 		
		if ($_POST['txtID'] == ''){$txtID="";}else{$txtID = $_POST['txtID'];} 		
		if ($txtID!="") $datos = $da->obtenerUsuarioID($_POST["txtID"]);

		$pasar = true;

		if ($datos[0]=="") {$pasar = false; $error = "El indicador no es correcto";}
		if ($txtID==""){$pasar = false; $error = "Debe definir un usuario";}
		if ($cmbRoles==0){$pasar = false; $error = "Debe definir un rol";}
		
		if($pasar){
			$rol=$_POST["txtCodigo"];
			if($rol==1){
				if(intval($clad->buscarUsuariosAdministradores()) > 2 ){
					$clad->actualizarUsuarioRol($txtID, $cmbRoles);
					$txtID="";
				}else{
					$error = "Debe existir al menos 2 administradores";
				}
			}else{
					$clad->actualizarUsuarioRol($txtID, $cmbRoles);
					$txtID="";
			}
		}
	}
	
	if(isset($_POST["txtAccion"])){ 
		if($_POST["txtAccion"]=="e" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!=""){	
			$rol=$clad->obtenerRol($_POST['txtCodigo']);
			if($rol==1){
				if(intval($clad->buscarUsuariosAdministradores()) > 2 ){
					$clad->bloquearUsuario($_POST["txtCodigo"],1);
					$codigo=0;
				}else{
					$error = "no es posible bloquear un administrador cuando solo hay dos";
				}
			}else{
					$clad->bloquearUsuario($_POST["txtCodigo"],1);
					$codigo=0;
			}
		}
		
		if($_POST["txtAccion"]=="b" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!=""){
			$clad->bloquearUsuario($_POST["txtCodigo"],0);
			$codigo=0;
		}
	}
	
	$datosUsuarios = $clad->obtenerUsuariosRoles($cmbRoles);
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

<script type="text/javascript" src="../js/greybox/gb_scripts.js" language="javascript"></script>
<link href="../js/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript">
		function cargarValor(nombre, codigo){
			txtId = document.getElementById("txtID");
			document.getElementById("txtCodigo").value=codigo;
			txtId.value = nombre;
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
<body onload="document.getElementById('txtID').select()">


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
				<table cellpadding="0" cellspacing="0" border="0"  align="center" >
					<tr>
						<td style="display:none">
							<input id="txtCodigo" name="txtCodigo" type="hidden" value="<?php if(isset($_POST["txtCodigo"])) echo $_POST["txtCodigo"]; ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $pres->crearSeparador("Archivo de accesos"); ?>
						</td>
					</tr>
					<tr>
						<td valign="top">
							<table height="100%" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td class="Sub-Titulo" width="90px">
										Archivo:
									</td>
									<td>
										<select name="cmbResultado" id="cmbResultado" onChange="javascript:doPostBack('form1');" class="Detalle" style="width:100px">
										<?php
											$log = new Log();
											
											$datos = array(
														array("", "Seleccione"),
														array($log->logAccesos, "Accesos"),
														array($log->logQuery, "Querys"),
														array($log->logError, "Errores")
													);
											
											$def = "";
											
											if(isset($_POST["cmbResultado"]))
												$def = $_POST["cmbResultado"];
											
											echo $pres->crearComboArray2($datos, $def);
											
											
										?>
									</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="15px"></td>
					</tr>
					<tr>
						<td width="100%">
							<div style="overflow:auto; height:660px">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td width="580px" class="Sub-Titulo">Datos</td>
									</tr>
									<?php 
										if(isset($_POST["cmbResultado"]) && $_POST["cmbResultado"]!=""){
											$datos = $log->cargarLog($_POST["cmbResultado"]);
											
											echo $pres->crearTablaLog($datos, "Lista-Fondo1", "Lista-Fondo2", false, false);
										}
									?>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td height="100%"></td>
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
