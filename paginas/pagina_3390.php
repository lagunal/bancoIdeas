<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

session_start();
extract($_REQUEST);
include("../../logica/inc/globales.php");
include("../../persistencia/funcion_bd.php");
include("../../persistencia/clsPostgre.php");
include_once("pagina_valida_sesion.php");
?>
<html>
<head>
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
<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css"/>
<script type="text/javascript" src="../js/utilidades.js" language="javascript"></script>
</head>
<body topmargin="0" class="Tabla-Izquierda" onLoad="setTimeout('cerrar()',20*1000)">

<!-- Tabla principal --> 
<table width="310" height="350"  border="0" align="left" cellpadding="0" cellspacing="0">
	<!-- Cuerpo -->
	<td>
		<table width="280" height="330" cellspacing="0"  valign="top">
			<tr>
				<td >
					<table width="100%" height="100%" border="0" align="left" cellpadding="0" cellspacing="0">
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
								<table width="650px%" cellspacing="0">
								  <tr>						
									<td><div style="overflow:auto; width:640px; height:280px">
									  <?php 
											$sql=new postgresql();
											//$query = phf_consultar_contactos('');
											$query = phf_query(24); 
											$filas=$sql->ejecutarsql($query);											
											$ld_reg = $sql->consulta($query);
											$datos=$ld_reg->fetch(PDO::FETCH_BOTH);
											$query = $datos['tx_query'].$datos['tx_condicion'].$datos['tx_agrupado'].$datos['tx_ordenado'];
											eval("\$query=\"$query\";");
											//echo ' query '.$query.' ';
											$filas=$sql->ejecutarsql($query);
											$ld_reg = $sql->consulta($query);
											//$datos=$ld_reg->fetch(PDO::FETCH_BOTH);
											$error=$sql->l_error;
											if(isset($filas)&&$filas>0)
											{
												//echo ' filas '.$filas.' ';
											}
											elseif(isset($filas)&&$filas==''&&count($error)>1)
											{
												echo "Nº: $error[0];<BR>".strtoupper($error[2]).' ';
											}
											while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) {
										?>
									  <table width="620" height="155"  cellspacing="0">
									  <tr>
										<td class="Titulo-D"><?php echo strtoupper($datos['nb_titulo']) ?></td>
									  </tr>
									  <!--<tr>
									    <td>&nbsp; </td>
									    </tr> -->
									  <tr>
									     <td class="Titulo-D"><span class="Sub-Titulo-Texto"><?php echo   ($datos['tx_contenido'])?></span></td>
									    </tr>
									 <!-- <tr>
									    <td class="Titulo-D">&nbsp;</td>
									    </tr> -->
									  <tr>
									    <td class="Titulo-D"><span class="Sub-Titulo-Texto"><?php echo   ($datos['nb_subtitulo'])?></span></td>
									    </tr>
									  <tr>
										<td>										</td>
									  </tr>
									</table>
										<?PHP 
										
										 } 
									
									?>
								</div></td>
								  </tr>
							</table>
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
