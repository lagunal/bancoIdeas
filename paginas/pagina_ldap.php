<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
include("../../logica/inc/globales.php");
$mensaje = "» NOTIFICACION: Favor comuníquese con la Ext. 105 «";
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
<BODY  class="BODY_login" onLoad="document.form1.btn_cerrar.focus();"> 
<table align="center">
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
							<TD colspan="2"><p><span class="TD_login">Disculpe en estos momentos acaba de ocurrir un error con el servidor de directorio activo.<br>
       Notif&iacute;quelo al centro de servicio A.I.T. a trav&eacute;s del 105 o enviando un email a la direcci&oacute;n de correo centroait@pdvsa.com. </span></p></TD>
							<TD width="245" align="center"><img src="../imagenes/ceenpet_noautorizado.png" alt="mano" longdesc="img_denegar_acceso"  width="150" height="150"></TD>
						  </TR>
						  <TR>
							<TD width="162"  align="center"><BR></TD> 
					        <TD width="269"  align="center"><input title="Cerrar ventana"   id="btn_cerrar" class="boton_login" type=submit value=Cerrar name=btn_cerrar style="cursor:pointer" alt="Cerrar" onClick="window.close()"></TD>
					        <TD  align="center">&nbsp;</TD>
				      </TBODY>						
					</TABLE>					
				</FORM>
			</DIV>	  
		</td>
	 </tr>
</table>
</BODY>
</HTML>
<script language="javascript" type="text/javascript">
	function capaoculta()
	{
		document.getElementById("error").style.display="none";
	}
	function abrir()
	{

		resize();
		document.getElementById("error").style.display="inline";
		
	}
	function resize()
	{
		x=(document.body.clientWidth - 603)/2;
		y=(document.body.clientHeight - 253)/2;
		document.getElementById("error").style.left=x;
		document.getElementById("error").style.top=y;
	}
	function imgdown()
	{
		document.getElementById("imgx").src="../imagenes/x_down.gif";
	}
		function imgout()
	{
		document.getElementById("imgx").src="../imagenes/x.gif";
	}

</script>