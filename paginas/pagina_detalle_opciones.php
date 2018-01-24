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
<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />
</head>

<body>
<select name="detalle1" class="Campo_consultado"  style="width:250;height:20; margin-left:auto; font-size:10px" onChange="refrescadetalle(this.value)" >
<?php 
    $nu_opcion = $_REQUEST[opcion];
	$sql=new postgresql();
	$query = phf_query(23);
	$filas=$sql->ejecutarsql($query);
	$ld_query = $sql->consulta($query);
	$datos=$ld_query->fetch(PDO::FETCH_BOTH);
	$query = $datos['tx_query'].$datos['tx_condicion'];
	eval("\$query=\"$query\";");
	$filas=$sql->ejecutarsql($query);
	$ld_reg = $sql->consulta($query);
	echo"<OPTION value=''>Estudios...</option>";
	while($datos=$ld_reg->fetch(PDO::FETCH_BOTH)){
		echo"<OPTION class='Campo_consultado' style='font-size:10px' value=$datos[co_det_opcion]>$datos[nb_det_opcion]";
		}
?>
</select>
</body>
</html>

<script>
function refrescadetalle(campo)
{
	    window.parent.document.getElementById('co_detalle').value=campo;
}
</script>

