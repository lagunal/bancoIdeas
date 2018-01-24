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
<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css">
<script src="../js/Utilidades.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
											$query = phf_query(14); 
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
												//echo "Nº: $error[0];<BR>".strtoupper($error[2]).' ';
											}
											while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) {
										?>
									  <table width="620" height="155"  cellspacing="0">
									  <tr>
										<td class="Titulo-D">&raquo; <?php echo  utf8_decode($datos['nb_nombre_apellido'])?> &laquo;</td>
									  </tr>
									  <tr>
										<td>										
										<table width="100%" height="91" border="0">
										  <tr>
											<td width="100%"><table width="100%" height="40" border="0">
											  <tr class="link_azul_9">
												<td width="149" height="14" class="Tabla-Elemento-Encabezado">Organizaci&oacute;n</td>
												<td width="99" class="Tabla-Elemento-Encabezado">Apoyo</td>
												<td width="118" class="Tabla-Elemento-Encabezado">Indicador</td>
												<td width="88" class="Tabla-Elemento-Encabezado">Extensi&oacute;n</td>
											  </tr>
											  <tr >
												<td align="center" class="Tabla-Elemento"><?php echo  utf8_decode(strtoupper ($datos['nb_organizacion']))?></td>
												<td align="center" class="Tabla-Elemento"><?php echo  utf8_decode(strtoupper ($datos['tx_cargo']))?></td>
												<td align="center" class="Tabla-Elemento"><a href="mailto:<?php echo  strtoupper ($datos['in_custodio'])?>@pdvsa.com"><?php echo  strtoupper ($datos['in_custodio'])?></a> <img src="../imagenes/icon_mail.gif"></td>
												<td align="center" class="Tabla-Elemento"><?php echo $datos['nu_extension']?></td>
											  </tr>
											</table></td>
											<td width="74">
					<?php 
					
					//$foto = @fopen("'".$datos['tx_ruta'].str_pad($datos['nu_cedula_administrador'], 9, "0", STR_PAD_LEFT).'.jpg'."'","r");
					$foto = $datos['tx_foto'].str_pad($datos['nu_cedula'], 9, "0", STR_PAD_LEFT).'.jpg';
					
					 //hacemos las comprobaciones
					//if ( is_readable($foto)) { 
					if ($foto) { 
					$foto=$datos['tx_foto'].str_pad($datos['nu_cedula'], 9, "0", STR_PAD_LEFT).'.jpg';
					} else {
					$foto="../imagenes/sin_foto.jpg";
					}
					?>
					<img src="<?php echo $foto ?>" width="74" height="76">
											</td>
										  </tr>
										</table></td>
									  </tr>
									</table>
										<?PHP } 
									
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
