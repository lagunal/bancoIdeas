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
include ("../../logica/inc/globales.php");
include ("../../persistencia/funcion_bd.php");
include ("../../persistencia/clsPostgre.php");
include ("pagina_valida_sesion.php");
if ($co_modulo==2) include ("pagina_usuario.php");
$sql=new postgresql();
$query = phf_query(18);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'].$datos['tx_agrupado'].$datos['tx_ordenado'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$dat=$ld_reg->fetchAll(PDO::FETCH_BOTH);
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script type="text/javascript" src="../js/utilidades.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/pdvsastyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css">
</head>
<body>
	<table width="80%" border="0" cellpadding="0" cellspacing="0">
		<tr><td></td></tr>
		<!--<tr>
			<td><h2 style="color:#CC0000"><?php //echo $titulo_sistema ?></h2>  </td>
		</tr> -->
		<?php foreach($dat as $contenido )  { ?>
		<tr>
		<?php switch ($contenido['co_tipo_contenido']){
			  /* Caso 1 - se refiere a la imagen de la pagina */
	          case 1; ?>
			  <td align=<?php echo '"'.$contenido['tx_ubicacion_img'].'"'?> width=<?php echo '"'.$contenido['tx_width'].'"'?> class=<?php echo '"'.$contenido['tx_class'].'"'?>  scope="col" ><img align=<?php echo '"'.$contenido['tx_ubicacion_img'].'"'?> src="<?php echo $contenido['tx_imagenes']?>"></td>
 		      <?php 
			  break;			  
			  /* Caso 2 - se refiere al Titulo de la pagina */
	          case 2; ?>
			  <td align=<?php echo '"'.$contenido['tx_ubicacion_img'].'"'?> width=<?php echo '"'.$contenido['tx_width'].'"'?> class=<?php echo '"'.$contenido['tx_class'].'"'?>  scope="col" > <?php echo utf8_decode(strtoupper  ($contenido[tx_contenido]))?></td>
			  <?php  
		 	  break;			  
			  /* Caso 3 - se refiere al Sub Titulo de la pagina */
	          case 3; ?>
			   <td align=<?php echo '"'.$contenido['tx_ubicacion_img'].'"'?> width=<?php echo '"'.$contenido['tx_width'].'"'?> class=<?php echo '"'.$contenido['tx_class'].'"'?>  scope="col" ><?php echo utf8_decode($contenido[tx_contenido])?></td>
			  <?php
 		      break;			  
			  /* Caso 4 - se refiere a la linea de separación antes del cuerpo de la pagina */
	          case 4; ?>
			  <tr><td>&nbsp;</td></tr>
			  <tr>
			  <td><span class="Separador_Modulo"></span></td>
			  </tr>
			  <tr><td>&nbsp;</td></tr>
			   <?php
			  break;			  
			  /* Caso 5 - se refiere a los diferentes contenidos del cuerpo de la pagina */
			 case 5; ?>
			  <td align=<?php echo '"'.$contenido['tx_ubicacion_img'].'"'?> width=<?php echo '"'.$contenido['tx_width'].'"'?> class=<?php echo '"'.$contenido['tx_class'].'"'?> style="color:#333333" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $contenido[tx_contenido]?></td>
 		     <?php 
			 break;
		      }
		      ?>
       </tr>
	  <?php
	 	} ?>
	</table>
</body>
</html>