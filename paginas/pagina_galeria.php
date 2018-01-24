<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<?php
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

include ("../../logica/inc/globales.php");
include ("../../persistencia/funcion_bd.php");
include ("../../persistencia/clsPostgre.php");

?>
<head>
    <script type="text/javascript" src="../js/utilidades.js"></script>

	<link rel="stylesheet" href="../css/lightbox.css" type="text/css" media="screen" />
	<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	
	<script src="../js/prototype.js" type="text/javascript"></script>
	<script src="../js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="../js/lightbox.js" type="text/javascript"></script>

<!--	<style type="text/css">
		body{ color: #333; font: 13px 'Lucida Grande', Verdana, sans-serif;	}
	</style> -->

</head>
<body>
<table>
<tr>
<td colspan="6"><span class="Titulo-Aplicacion" >GALERIA</span></td>
</tr>
<tr>
<td colspan="6"><span class="Separador_Modulo"></span></td>
</tr>
</table>
<?php 
									$sql=new postgresql();
									$query = phf_query(23);
									$filas=$sql->ejecutarsql($query);
									$ld_query = $sql->consulta($query);
									$datos=$ld_query->fetch(PDO::FETCH_BOTH);
									$query = $datos['tx_query'].$datos['tx_condicion'];
									eval("\$query=\"$query\";");
									$filas=$sql->ejecutarsql($query);
									$ld_reg = $sql->consulta($query);
									while($datos=$ld_reg->fetch(PDO::FETCH_BOTH)){
									echo '<a href="../galeria/'.$datos[tx_ruta].'" rel="lightbox" title="'.$datos[tx_descripcion].'"><img src="../galeria/'.$datos[tx_ruta].'" width="100" height="100" alt="" /></a>
';	
										}
									
									?>



<h2>&nbsp;</h2>
</body>
</html>
