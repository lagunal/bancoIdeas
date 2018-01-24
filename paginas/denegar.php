<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
include("../../logica/inc/globales.php");
$mensaje = "» NOTIFICACION: Usuario bloqueado, contacte al administrador del sistema «";
?>
<HTML>
<HEAD>
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
	<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css">
	<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</HEAD> 
<BODY  class="BODY_login" onLoad="document.form1.btn_cerrar.focus(); setTimeout('cerrar()',20*1000)"> 
<table height="90%" align="center">
	<tr> 
		<td>
			<DIV id=contenedor  class="contenedor_login"></DIV>
			<DIV id="banner_login">
			  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="700" height="140">
                <param name="movie" value="../flash/banner_login.swf">
                <param name="quality" value="high">
                <embed src="../flash/banner_login.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="700" height="140"></embed>
              </object>
			</DIV>
			<DIV id=formulario class="formulario_login">			
				<div id="mensajes">
					<h3><?php echo $mensaje ?></h3>
			    </div>
				<FORM name="form1" method="POST">
					<TABLE cellPadding=2 align=center>
					  <TBODY>
						  <TR>
							<TD colspan="2"><p><span class="TD_login">Debido a que no hemos logrado verificar su identificaci&oacute;n y  basados en el numero de intentos fallidos observados durante el proceso de autenticaci&oacute;n a la aplicación, se le informa que su acceso será bloqueado temporalmente.</span></p></TD>
							<TD width="245" align="center"><img src="../imagenes/entrada_no_autorizada.JPG" alt="mano" longdesc="img_denegar_acceso"  width="150" height="150"></TD>
						  </TR>
						  
<TR>
							 <td></td>
							<TD width="162"  align="center"><BR>
			                     			<div class="Principio-Boton"></div>
			                     			<input title="Confirmado"  name="btn_cerrar" type="submit" value="Aceptar" class="Boton" onClick="window.close()" style="cursor:pointer">
										    <div class="Final-Boton"></div>
			                            </td>
						  <TR>
				      </TBODY>						
					</TABLE>					
				</FORM>
			</DIV>	  
		</td>
	 </tr>
</table>
</BODY>
</HTML>
