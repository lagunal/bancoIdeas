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
		if ($_POST['txtCodigo'] == ''){$codigo="";}else{$codigo = $_POST['txtCodigo'];}		
		if ($txtID!="") $datos = $da->obtenerUsuarioID($_POST["txtID"]);
		

		$pasar = true;

		if ($datos[0]=="") {$pasar = false; $error = "El indicador no es correcto";}
		if ($txtID==""){$pasar = false; $error = "Debe definir un usuario";}
		if ($cmbRoles==0){$pasar = false; $error = "Debe definir un rol";}

		if($clad->buscarRolUsuarios($txtID, $cmbRoles)!=0){$pasar = false; $error = "Ya existe este usuario con ese rol";}
		
		if($pasar){
			if($codigo!=0){
				$rol=$clad->obtenerRol($txtID);
				$c = count($rol);
				for($i=0; $i<$c; $i++)
					if($rol[$i]['co_rol']==1) $res=1;
			}
			if($res==1 && $codigo==1){
				if(intval($clad->buscarUsuariosAdministradores()) > 2 ){
					$clad->actualizarUsuarioRol($txtID, $cmbRoles, $codigo);
				}else{
					$error = "Debe existir al menos 2 administradores";
				}
				$txtID="";$codigo="";
			}else{
				$clad->actualizarUsuarioRol($txtID, $cmbRoles, $codigo);
				$txtID="";$codigo="";
			}
		}
	}
	
	if(isset($_POST["txtAccion"])){ 
		if($_POST["txtAccion"]=="e" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!=""){	
			$rol=$clad->obtenerRol($_POST['txtCodigo']);
			$c = count($rol);$res=false;
			for($i=0; $i<$c; $i++)
				if($rol[$i]['co_rol']==1) $res=true;
			if($res){
				if(intval($clad->buscarUsuariosAdministradores()) > 2 ){
					$clad->bloquearUsuario($_POST["txtCodigo"],1);
					$codigo=0;
				}else{
					$error = "Debe existir al menos 2 administradores";
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
var tipoalert;$rol=$clad->obtenerRol($_POST['txtCodigo']);
			$c = count($rol);$res=false;
			for($i=0; $i<$c; $i++)
				if($rol[$i]['co_rol']==1) $res=true;
			if($res){
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
      						<?php echo $pres->crearSeparador("Definir Usuarios"); ?>
						</td>
					</tr>
					<tr>
						<td>
		                    <table cellpadding="0" cellspacing="0" border="0">
					<tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
					    <td class="Detalle" width="50">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Roles:
		                            </td>
		                            <td colspan="3" width="180px">
		                            	<select id="cmbRoles" name="cmbRoles" class="Detalle" style="width: 150px" onChange="seleccionandoCombo(this)">
		                                <?php
		                                    $datos = $clad->obtenerRoles();
		                                    
		                                    echo $pres->crearCombo($datos, "co_rol", "nb_rol",$cmbRoles);
		                                ?>
		                            	</select>
		                            </td>
		                            <td class="Detalle" width="60px">
		                            	<strong style="color:#FF0000; font-size:14px">* </strong>Indicador:
		                            </td>
		                            <td width="200px">
		                            	<input id="txtID" name="txtID" type="text" value="<?php echo $txtID; ?>" style="width:200" maxlength="40" onKeyUp="ValidarLetra(this, event)" onfocus="select();" />
		                            </td>
		                            
		                        </tr>
		                        <tr>
		                        	<td height="10px"></td>
		                        </tr>
		                        <tr>
		                        	<td colspan="3">
		                        	</td>
		                        	<td>
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
		                    		<td class="Titulo" width="200px">
		                    			Indicador
		                    		</td>
		                    		<td class="Titulo" width="250px">
		                    			Rol
		                    		</td>
		                    	</tr>
					<tr>
						<td colspan="3">
						<div id="tabla_detalle" style="OVERFLOW: auto; WIDTH: 450px; HEIGHT:620px"> 
							<?php
				                		echo $pres->crearTablaRoles($datosUsuarios, "Lista-Fondo1", "Lista-Fondo2");
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
