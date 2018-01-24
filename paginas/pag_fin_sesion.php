<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

include("../../logica/inc/globales.php");
?>
<html>
<head>

	<title>// &nbsp;( <?php echo $gs_esquema?> ) - Fin de Sesión //</title> 
	<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css">
	<script src="../js/Utilidades.js" type="text/javascript"></script>
</head>
<body class="BODY_login" topmargin="0">
<!-- Tabla principal2 --> 
<table width="180"  height="80%"  align="center" cellspacing="0"  valign="top" >
	<!-- Cuerpo width="280" height="330" align="center" cellspacing="0"  valign="top" -->
	<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td >
					<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                   		<tr>
                      		<td width="15" height="100%" background="../imagenes/sombrapaginaD.png"></td>
                      		<td colspan="2" bgcolor="#E6E6E6">
								<div id="Main-Identificador_usuario"></div>
							</td>
                      		<td  width="15" height="100%" background="../imagenes/sombrapaginaI.png"></td>
                    	</tr>
						<!-- area de desarrollo -->
                    	<tr>
						  <td rowspan="3"  height="100%" background="../imagenes/sombrapaginaD.png"><img src="../imagenes/transp.gif" width="15" height="100%" /></td>
						  <td width="290"  height="100%" bgcolor="#666666"><div align="left"><img src="../imagenes/esquinaizq1.gif" width="10" height="20" /></div></td>
						  <td width="540"  height="100%" bgcolor="#666666"><div align="right"><img src="../imagenes/esquinader1.gif" width="9" height="20" /></div></td>
						  <td rowspan="3"  height="100%" background="../imagenes/sombrapaginaI.png"><img src="../imagenes/transp.gif" width="10" height="1" /></td>
                    	</tr>
						<tr>
						  <td  valign="top"><div align="left"><img src="../imagenes/esquinaizq2.gif" width="10" height="7" /></div></td>
						  <td valign="top"><div align="right"><img src="../imagenes/esquinader2.gif" width="10" height="7" /></div></td>
						</tr>
						<tr>
						  <td height="100%" colspan="2" valign="top">
								<table width="100%" cellspacing="0">
								  <tr>						
									<td>
									 <div  align="center">
									  <form name="form1" method="post" action="">
										 <table width="440" border="0">
											  <tr>
												<td><a href="<?php echo $logo_pdvsa_intevep?>"><span class="Contenedor-con-Imagen" id="Main-Logo"></span></a></td>
												<td width="360" Align="center" class="Titulo-D">SESION  DECLINADA </td>
											  </tr>
											  <tr>
												<td align="center"><img src="../imagenes/reloj_rojo.jpeg"  align="middle"></td>
												<td class="Texto-Identificador" align="justify"> <br>
													Disculpe su sesi&oacute;n no est&aacute; autorizada, ya que se debio haber excedido el tiempo m&aacute;ximo 
													de <?php echo session_cache_expire()?> segundos preestablecido para la estabilizaci&oacute;n 
													de una sesi&oacute;n;  Est&aacute; tratando de ingresar al producto sin autenticar su nivel de acceso o  se percibe algun inconveniente t&eacute;cnico. <br>
													 <br>
													  <br>
													
												    Si desea volver a utilizar el sistema presione 
												    <a href="index.php" onMouseOver="window.status='Retorna a la pagina de inicio del sistema';return true" onMouseOut="window.status='';return true" class="link_azul_plain" onClick="hacerclick()" style="color:#003399">ir al inicio </a>
												    he introduzca   su usuario y contrase&ntilde;a.												</td>
											  </tr>
										</table>									
									  </form>									
								     </div>
									</td>
								  </tr>
							    </table>
					      </td>
						</tr>
						<!-- fin area de desarrollo -->
				 </table>			  </td>
			</tr> 
      </table>  
	  <!-- liena roja del fondo -->
	  <table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="2%"><img src="../imagenes//transp.gif" width="15" height="1" /></td>
			<td width="100%" bgcolor="#CC0000"><img src="../imagenes//transp.gif" width="1" height="1" /></td>
			<td width="2%"><img src="../imagenes//transp.gif" width="15" height="1" /></td>
		  </tr>
	  </table>      
	  <!-- fin liena roja del fondo -->
	</td>
	<!-- Fin Cuerpo -->
</table>   
<!-- Fin Tabla principal --> 
</body>
</html>
