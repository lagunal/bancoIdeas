<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
extract($_REQUEST);
include ("../../logica/inc/globales.php");
//include("../../persistencia/funcion_bd.php");
//$query = "INSERT INTO tr009_errores(id_error, nb_error, nu_cedula_consumidor) VALUES ($error[0], $error[2], $cedula)";
if (isset($cedula)&&($cedula!='')) {
	$identific = $cedula;
}else if (isset($_REQUEST['txt_usuario'])&&($_REQUEST['txt_usuario']!='')) {
	$identific = $_REQUEST['txt_usuario'];
}
?>
<!-- Se construye el cuerpo de la pagina -->
<table border="0" cellpadding="0" cellspacing="0" align="center">
 <tr>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td>
	<table>
	  <tr>
		<td>
		  <table width="360">
			<tr>
			 <td class="Boton" >NOTIFICACION 
			 <?php
			 if (($error[0]==42883)||($error[0]==22021)) {
			 	reg_error($identific,$error[0],$error[1],str_replace(chr(10),chr(32),$error[2]),date('Y-m-d H:i:s'),getIP());
			}else {
				reg_error($identific,$error[0],$error[1],str_replace(chr(10).chr(9),chr(32),$error[2]),date('Y-m-d H:i:s'),getIP());
			}
			  ?></td>
			</tr>
			<tr>
			 <td>&nbsp;</td>
		    </tr>
			<tr>
			 <td class="Campo_destacado">Se ha recibido un error al consultar nuestra base de datos en <?php echo $titulo_sistema ?> y  el mismo se identifica como:</td>
			</tr>
			<tr>
			 <td height="60" class="Titulo-Aplicacion" ><?php echo "<BR> ID N&ordm; $error[0] <BR> <BR> <BR>".strtoupper($error[2]).' '; ?>			 </td>
			 </tr>
			<tr>
			 <td height="40">&nbsp;</td>
		    </tr>
	      </table>		</td>
		<td width="74"><img src="../imagenes/error.jpg" width="100" height="102">	  </tr>
    </table>
	<tr>
	 <td>
	  <span class="Separador_Modulo"></span>	 </td>
	</tr>
	<tr>
	</tr> 
   </td>
  </tr>
</table>		


