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

	
	
	
	include_once "../../persistencia/cargarLog.php";
	$log = new Log();

	include_once "../../persistencia/clad.php";
	$clad = new clad();

	$error = "";
	require("ajax.common.php");
	$xajax->printJavascript('../xajax/');

	$indicador = $_SESSION["indicador"];
	
	$borrador="";
	if($codigo==0){
		$archivo="disabled";
		$coautor="disabled";
	}
	$postular="disabled";
	if($datosConcurso = $clad->obtenerConcursoActivo()==0){
		$borrador="disabled";
		$archivo="disabled";
		$coautor="disabled";
		$error_1="No es posible definir ideas, no existe concurso abierto...";
	}



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

</script>

<script type="text/javascript">	var GB_ROOT_DIR = "../js/greybox/";</script>
<script type="text/javascript" src="../js/greybox/AJS.js" language="javascript" ></script>
<script type="text/javascript" src="../js/greybox/AJS_fx.js" language="javascript" ></script>
<script type="text/javascript" src="../js/greybox/gb_scripts.js" language="javascript"></script>
<script language="JavaScript" type="text/javascript" src="../js/doPostBack.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/validaciones.js"></script>
<link href="../js/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript">
		function cargarValor(codigo, indicador, cmbEmpleado, idSupervisor, aporte){
			document.getElementById('idSupervisor2').value = idSupervisor;
			document.getElementById('idcoautor').value = indicador;
			document.getElementById('txtAporte2').value = aporte;
			document.getElementById('cmbEmpleado').value = cmbEmpleado;
			document.getElementById('txtAccion').value = codigo;
			document.getElementById('idcoautor').disabled=true;
			document.getElementById('cmbEmpleado').disabled=true;
			xajax_validar_id(idSupervisor,2);
		
		}
		
		function tipoEmpleado(cmb){
			if(cmb.value!=1) 
				document.getElementById('indicador').innerHTML='<strong style="color:#FF0000; font-size:14px">* </strong>Nombre:';
			else
				document.getElementById('indicador').innerHTML='<strong style="color:#FF0000; font-size:14px">* </strong>Indicador:';
			document.getElementById('idcoautor').value='';
			document.getElementById('idcoautor').select();
		}

		function borrador(){
			txtTitulo = document.getElementById('txtTitulo').value;
			idSupervisor = document.getElementById('idSupervisor').value;
			nbSupervisor = document.getElementById('nbSupervisor').value;
			txtAporte = document.getElementById('txtAporte').value;
			txtResumen = document.getElementById('txtResumen').value;
			txtId = document.getElementById('txtId').value;

			cmbCodigo = document.getElementById('cmbCodigo').value;
			cmbCategoria = document.getElementById('cmbCategoria').value;
			cmbPropiedad = document.getElementById('cmbPropiedad').value;
			cmbArea = document.getElementById('cmbArea').value;

			cuadernos = document.getElementById('cuadernos').checked;
			arte = document.getElementById('arte').checked;
			informes = document.getElementById('informes').checked;
			otros = document.getElementById('otros').checked;
			prototipo = document.getElementById('prototipo').checked;
			modelo = document.getElementById('modelo').checked;
			
			if (cuadernos==true)cuadernos=1; else cuadernos=0;
			if (arte==true)arte=1;else arte=0; 
			if (informes==true)informes=1; else arte=0;
			if (modelo==true)modelo=1; else modelo=0;
			if (prototipo==true)prototipo=1; else prototipo=0;
			if (otros==true)otros=1; else otros=0; 
			
			pasar = true;
			
			if (txtResumen==""){pasar = false; focus='txtResumen'; error_1 = "Debe describir un resumen de la idea";}
			if (txtAporte==""){pasar = false; focus='txtAporte'; error_1 = "Debe definir su aporte a la idea";}
			if (nbSupervisor==""){pasar = false; focus='idSupervisor'; error_1 = "Debe definir el indicador de su supervisor";}
			if (cmbArea==0){pasar = false; focus=''; error_1 = "Debe definir el &aacute;rea de aplicaci&oacute;n";}
			if (cmbPropiedad==0){pasar = false; focus=''; error_1 = "Debe definir una propiedad intelectual";}
			if (cmbCategoria==0){pasar = false; focus=''; error_1 = "Debe definir una categoria";}
			if (txtTitulo==""){pasar = false; focus='txtTitulo'; error_1 = "Debe definir un titulo de idea";}

			if(pasar){
				document.getElementById('error_1').innerHTML='';
				xajax_borrador(cmbCodigo, txtTitulo, txtResumen, cmbCategoria, cmbPropiedad, cmbArea, cuadernos, arte, informes, modelo, prototipo, otros, idSupervisor, nbSupervisor, txtAporte, cmbCodigo, txtId);
				xajax_cmbCodigos(txtId);
				

				
			}else{
				document.getElementById('error_1').innerHTML = error_1;
				document.getElementById('error_2').innerHTML = '';
				if(focus!="") document.getElementById(focus).select(); 
				
	
			}
		}

		function coautor(){
			nbSupervisor = document.getElementById('nbSupervisor2').value;
			idSupervisor = document.getElementById('idSupervisor2').value;
			idcoautor = document.getElementById('idcoautor').value;
			txtAporte = document.getElementById('txtAporte2').value;
			cmbEmpleado = document.getElementById('cmbEmpleado').value;
			codigo = document.getElementById('cmbCodigo').value;
			valor = document.getElementById('txtAccion').value;
			pasar = true;
			
			if (txtAporte==""){pasar = false; focus='txtAporte2'; error_2 = "Debe definir el aporte del coautor";}
			if (nbSupervisor==""){pasar = false; focus='idSupervisor2'; error_2 = "Debe definir el indicador del supervisor";}
			if (idcoautor==""){pasar = false; focus='idcoautor'; error_2 = "Debe definir el indicador del coautor";}
			if (cmbEmpleado==0){pasar = false; focus=''; error_2 = "Debe definir el tipo de empleado";}
			if(pasar){
				document.getElementById('error_2').innerHTML='';
				xajax_coautor(codigo, nbSupervisor, idSupervisor, idcoautor, txtAporte,  cmbEmpleado, valor);
			}else{
				document.getElementById('error_2').innerHTML = error_2;
				document.getElementById('error_1').innerHTML = '';
				if(focus!="") document.getElementById(focus).select(); 
	
			}
		}

		function buscarDescripcionIdea(cmb){
		
			document.getElementById('txtCodigo').value = cmb.options[cmb.selectedIndex].value;	
			if (cmb.options[cmb.selectedIndex].value != 0){
				xajax_buscarIdea(cmb.options[cmb.selectedIndex].value);
				document.getElementById('fileUpload').disabled=false;
				document.getElementById('btnCoautor').disabled=false;
				document.getElementById('boton_subir').disabled=false;
				document.getElementById('fileUpload').title="Buscar archivo...";
				document.getElementById('btnCoautor').title="Cargar Coautor...";
			}else{
				document.getElementById('nbSupervisor').value = "";
				document.getElementById('idSupervisor').value = "";
				document.getElementById('txtTitulo').value = "";
				document.getElementById('txtAporte').value = "";
				document.getElementById('cmbCategoria').value = 0;
				document.getElementById('cmbArea').value = 0;		
				document.getElementById('cmbPropiedad').value = 0;
				document.getElementById('txtResumen').value = "";
				document.getElementById('modelo').checked=false;
				document.getElementById('arte').checked=false;
				document.getElementById('informes').checked=false;
				document.getElementById('otros').checked=false;
				document.getElementById('cuadernos').checked=false;
				document.getElementById('prototipo').checked=false;
				document.getElementById('txtCodigo').value=0;
				document.getElementById('fileUpload').disabled=true;
				document.getElementById('btnCoautor').disabled=true;
				document.getElementById('boton_subir').disabled=true;
				
			}

			xajax_limpiarCoautor();
			document.getElementById('idcoautor').disabled=false;
			document.getElementById('cmbEmpleado').disabled=false;
			document.getElementById('error_2').innerHTML = '';
			document.getElementById('error_1').innerHTML = '';
			document.getElementById('txtTitulo').select();
		}

		function validarID(id, num){
			if(num==3) tipo = document.getElementById('cmbEmpleado').value;	
			if(num==1) document.getElementById('nbSupervisor').value = "";
			if(num==2) document.getElementById('nbSupervisor2').value = "";
			//txtId =document.getElementById('idCoautor').value;
			if (id.value!="" && num!=3)xajax_validar_id(id.value,num);
			if(num==3 && tipo==1 && txtId!='') {xajax_validar_id(id.value,num);}
		}
	</script>
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
							<input type="hidden" id="txtId" name="txtId" value="<?php  echo $indicador; ?>"/>
						</td>
					</tr>
					<tr>
						<td>
      						<?php echo $pres->crearSeparador("Ideas Postuladas"); ?>
							
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
		                            <td class="Detalle" width="70">
		                            	Código:
		                            </td>
		                            <td colspan="3" width="250px">
		                            	<select id="cmbCodigo" name="cmbCodigo" class="Detalle" style="width: 150px" onChange="buscarDescripcionIdea(this)">
		                                <?php
		                                    $datos = $clad->obtenerCodigos($indicador);
		                                    
		                                    echo $pres->crearCombo($datos, "co_idea", "id_idea", $cmbCodigo);
		                                ?>
		                            	</select>
		                            </td>
		                        	<td colspan="3">
		                         	</td>
									<td>
										
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
						<td>
      						<?php echo $pres->crearSeparador("Datos de la Idea"); ?>
							
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
					    </td>
					    <td class="Detalle" style="width:70px">
		                            	T&iacute;tulo:
		                            </td>
					    <td colspan="3">
		                            	<input id="txtTitulo" name="txtTitulo" type="text" value="<?php echo $txtTitulo; ?>" style="width: 445" readonly="true" onfocus="select();" />
		                            </td>
					</tr>
					<tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
					    <td class="Detalle">
		                            	C&oacute;digo:
		                            </td>
		                            <td  style="width:100px" >
		                            	<input id="txtCodigo" name="txtCodigo" type="text" value="<?php echo $txtCodigo; ?>" style="width: 150" readonly="true"/>
		                                
		                            	
		                            </td>
						<td class="Detalle" style="width:60px">
		                            	Categor&iacute;a:
		                            </td>
					    <td width="200px">
		                            	<input id="txtCategoria" name="txtCategoria" type="text" value="<?php echo $txtCategoria; ?>" style="width: 150" readonly="true"/>
		                            </td>
						
					</tr>
					<tr>
					   <td height="6px">
					   </td>
					</tr>
					<tr>
					    <td class="Detalle" width="65px">
		                            Propiedad:
		                            </td>
					   <td width="160px">
		                            	<input id="txtPropiedad" name="txtPropiedad" type="text" value="<?php echo $txtPropiedad; ?>" style="width: 150" readonly="true"/>
		                            </td>
					    <td class="Detalle" >
		                            	&Aacute;rea:
		                            </td>
					   <td width="200px">
		                            	<input id="txtArea" name="txtArea" type="text" value="<?php echo $txtArea; ?>" style="width: 150" readonly="true"/>
		                            </td>
					    
					</tr>
					<tr>
   					   <td height="6px">
					   </td>
					</tr>
	<!--			<tr>
					    <td class="Detalle" >
		                            	Supervisor:
		                            </td>
		                            <td width="110px">
		                            	<input id="idSupervisor" name="idSupervisor" type="text" value="<?php echo $idSupervisor; ?>"  style="width:150" readonly="true"/>
		                            </td>
					    <td class="Detalle">
		                            	Nombre:
		                            </td>
		                            <td>
		                            	<input id="nbSupervisor" name="nstyle="cursor:pointer"bSupervisor" type="text" value="<?php echo $nbSupervisor; ?>" readonly="true" style="width:220" />
		                            </td>
					</tr>
   -->					
					<tr>
   					   <td height="6px">
					   </td>
					</tr>

					<td colspan="8">
						<table cellpadding="0" cellspacing="0" border="0">

		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
					<tr>
					  	 <td class="Detalle"  colspan="5">
							Respaldo de la Propuesta:
					  	 </td>
					</tr>
					<tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
					<tr><td style="width:65px"></td>
						<td >
						<?php if ($cuadernos==1) $cuadernos = "checked"; else $cuadernos = ""; ?>
		                            		<input id="cuadernos" name="cuadernos" <?php echo $cuadernos; ?> type="checkbox" onclick="this.checked=!this.checked">
		                            	</td>
						<td class="Detalle" style="width:180px">Cuadernos de Laboratorios.
					  	</td>
						<td >
						<?php if ($arte==1) $arte = "checked"; else $arte = ""; ?>
		                            		<input id="arte" name="arte" <?php echo $arte; ?> type="checkbox" onclick="this.checked=!this.checked">
		                            	</td>
						<td class="Detalle" style="width:70px">Arte Previo.
					  	</td>
						<td>
						<?php if ($informes==1) $informes = "checked"; else $informes = ""; ?>
		                            		<input id="informes" name="informes" <?php echo $informes; ?> type="checkbox" onclick="this.checked=!this.checked">
		                            	</td>
						<td class="Detalle" style="width:140px" >Informes / Notas tecnicas.
					  	</td>
						<td>
					</tr>
		                        
					<tr><td></td>
						<td>
						<?php if ($modelo==1) $modelo = "checked"; else $modelo = ""; ?>
		                            		<input id="modelo" name="modelo" <?php echo $modelo; ?> type="checkbox" onclick="this.checked=!this.checked">
		                            	</td>
						<td class="Detalle">Modelo, Mapa, Dibujo, Esquema, Etc.
					  	</td>
						<td>
						<?php if ($prototipo==1) $prototipo = "checked"; else $prototipo = ""; ?>
		                            		<input id="prototipo" name="prototipo" <?php echo $prototipo; ?> type="checkbox" onclick="this.checked=!this.checked">
		                            	</td>
						<td class="Detalle">Prototipo.
					  	</td>
						<td>
						<?php if ($otros==1) $otros = "checked"; else $otros = ""; ?>
		                            		<input id="otros" name="otros" <?php echo $otros; ?> type="checkbox" onclick="this.checked=!this.checked" >
		                            	</td>
						<td class="Detalle">Otros.
					  	</td>
					</tr>

					</td></table>


					<tr>
					  <td height="6px">
					  </td>
					</tr>

					<tr>
					   <td class="Detalle" >
						Resumen:
					   </td>
					</tr>
					<tr>
					   <td></td>
					   <td colspan="4">
						<textarea id="txtResumen" name="txtResumen" rows="5" cols="70" style="width:450px" readonly="true" maxlength="1500"></textarea>
					   </td>
					</tr>
					
		                        <tr>
		                            <td height="10px">
		                            </td>
		                        </tr>
								
					<tr>
					  	 <td class="Detalle" style="width:75px" >
							Archivo
					  	 </td>
					  	 
						<td >
							<img src="../imagenes/icon_pdf.gif" id="boton_subir" name="boton_subir" <?php echo $archivo ?> width='20' height='20'  border='0' id='boton_subir' style="cursor:pointer" title="Descargar archivo...">
						</td>
					</tr>
					<tr>
		                            <td height="10px">
		                            </td>
		            </tr>
					<tr>
		                            <td height="10px">
		                            </td>
		            </tr>

					


		                       </table>
						</td>
					<tr><td>
					<tr>
						<td id="error_1" class="error">
							<?php echo $error_1; ?>
						</td>
					</tr>

					<td>
						<table cellpadding="0" cellspacing="0" border="0">
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>

						
					</tr>

					</td></table>




						</td>
					</tr>
	
		            <tr><td>
					<table cellpadding="0" cellspacing="0" border="0" align="center">
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
								<tr>
												
									
									<td style="width:180">
										<?php $borrador =  "onclick='borrador();'" ;echo $pres->crearBoton("btnAprobar", "Aceptar", "button", $borrador); ?>
									</td>
									<td >
										<?php echo $pres->crearBoton("btnREchazar", "Rechazar", "submit", $postular); ?>
									</td>	
								</tr>
											<tr>
												<td height="6px"></td>
											</tr>					
				
					</table>
					</td></tr>
		            <tr><td>
					<table cellpadding="0" cellspacing="0" border="0" align="left">
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
								<tr>
												
									
									<td class="Detalle"  >
										Observaciones
									</td>
									<td >
										<textarea id="txtObservaciones" name="txtObservaciones" rows="1" cols="70" style="width:450px"  maxlength="1500"></textarea>
									</td>	
								</tr>
											<tr>
												<td height="6px"></td>
											</tr>					
				
					</table>
					</td></tr>
					<tr>
					   <td heght="10px"> </td>
					</tr>
						<tr>
					   <td>
      						<?php echo $pres->crearSeparador("Coautores"); ?>
					   </td>
					</tr><td>
					</td>				
					<tr></td>
						<td>
		                    <table cellspacing="0" cellpadding="0" border="0">

		                    	<tr>
		                    		<td width="15px">
		                    		</td>
		                    		<td class="Titulo" width="130px">
		                    			Nombre
		                    		</td>
		                    		<td class="Titulo" width="350px">
		                    			Supervisor
		                    		</td>
		                    	</tr>
					<tr>
						<td colspan="3">
						<div id="tabla_detalle" style="OVERFLOW: auto; WIDTH: 450px; HEIGHT:120px"> 
							<?php
				                		echo $pres->crearTablaAutores($datosUsuarios, "Lista-Fondo1", "Lista-Fondo2");
					                ?>
						</div>
						</td>
					</tr>
			                    
		                    </table>					
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
