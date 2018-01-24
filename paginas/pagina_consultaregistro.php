

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript" src="../js/utilidades.js"></script>

<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head> 
<body> 

<a href="pagina_grid.php?seletabla=<?php echo $_REQUEST[seletabla] ?>"><img src="../imagenes/ico_atras_on.png"><span class="Campo_destacado">Regresar</span></a> 
<br><br>
<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
extract ($_REQUEST);
$objetos_pagina = '';
$cuantos_parametros = 0;
$campos_parametros = '';
$nucampo = 0;
$tabla = $_REQUEST['seletabla'];

include ("../../logica/inc/globales.php");
include ("../../persistencia/funcion_bd.php");
include ("../../persistencia/clsPostgre.php");
////PARA ARMAR EL QUERY DE LA TABLA A MOSTRAR
$_buscar = $_REQUEST[seletabla];
$sql=new postgresql();
$query = phf_query(6);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$campos_valores = '';
$campos_valores2 = '';
$t = 2;
while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) 
{  if($_REQUEST[campoclave] != $datos[column_name])
   {
      if (substr($datos["column_name"],0,2)=="co")	
	  { 
		 $tablaforanea = buscartablaforanea($tabla, $datos["column_name"]); 
		 if($tablaforanea[0] > '' && $tablaforanea[1] > '' && $tablaforanea[2] > '')
		 {  $tb = 't'.$t;
			$t++;
			$loj .= " LEFT OUTER JOIN ". $tablaforanea[0] ." AS ".$tb." ON t1.".$datos["column_name"] ." = ". $tb.".".$tablaforanea[1];
			$campoactual = $tb.".".$tablaforanea[2];
			$numencabezado = numerocolumna($tablaforanea[0], $tablaforanea[2]);
		    $campos_valores .= $tb.'.'.$tablaforanea[2].',';
		 }else{
		 $campos_valores .= 't1.'.$datos[column_name].',';
		 }
	  }
	  else
	  {
	     $campos_valores .= 't1.'.$datos[column_name].',';
      }
   }
}
$campos_valores = substr($campos_valores,0,strlen($campos_valores));


///CUANTOS CAMPOS TIENE LA TABLA
$tabla = $_REQUEST['seletabla'];
$_buscar = $_REQUEST['seletabla'];
$_buscar2 = $_REQUEST['seletabla'];
$query = '';
$query = phf_query(9);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$datos=$ld_reg->fetch(PDO::FETCH_BOTH);
$cuantas = $datos["valor"]-1;
///FIN CUANTOS CAMPOS TIENE LA TABLA

$query = 'SELECT '. substr($campos_valores,0,strlen($campos_valores)-1). ' FROM '.$_REQUEST[seletabla].' as t1 '.$loj.' WHERE '.$_REQUEST[campoclave].' = '.$_REQUEST[valorclave];
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$i = 0;
while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) 
{    $i = 0;
     while ($i <= $cuantas)
     {		
	   if($i >= 0)
       { $valores[$i] = $datos[$i];  }
       $i++;
     }
}

////PARA SABER EL CAMPO CLAVE DE LA TABLA////
$query = phf_query(10);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$datos=$ld_reg->fetch(PDO::FETCH_BOTH);
$campoclave=$datos[campo];
	
////PARA ARMAR EL ENCABEZADO DE LA TABLA//////////////
$query = phf_query(6);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$ld_reg = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$i = 0;
$j = 0;
echo "<form action='pagina_agregarrtegistro.php' method='post'>";
echo "<table border='0' cellspacing='1' cellpadding='5'width='100%'>";
echo "<tr>";
$loj = '';
$campos = 'SELECT ';
$campoactual = '';
$t = 2;
while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) 
{ 
if ($datos[is_nullable]=='NO')
{ $aste = "*"; }
else
{ $aste = ""; }
if($datos["column_name"] != $campoclave)
{ $campos_parametros .= $datos["column_name"].",";
  $campoactual = 't1.'.$datos["column_name"];
  $emcabezado = '';
  $numencabezado = 0;
  if (substr($datos["column_name"],0,2)=="co")		
  { 
     $tablaforanea = buscartablaforanea($tabla, $datos["column_name"]); 
	 if($tablaforanea[0] > '' && $tablaforanea[1] > '' && $tablaforanea[2] > '')
	 {  $tb = 't'.$t;
	    $t++;
	    $loj .= " LEFT OUTER JOIN ". $tablaforanea[0] ." AS ".$tb." ON t1.".$datos["column_name"] ." = ". $tb.".".$tablaforanea[1];
		$campoactual = $tb.".".$tablaforanea[2];
		$numencabezado = numerocolumna($tablaforanea[0], $tablaforanea[2]);
	 }
  }
  $campos .= $campoactual.", ";
  $label = $datos["column_name"];
  $labelorig = $campoactual;
  $xquery = "select col_description('".$tabla."'::regclass,".$datos[registro].")"; 
  if ($numencabezado > 0)
  { $xquery = "select col_description('".$tablaforanea[0]."'::regclass,".$numencabezado.")";  }
  eval("\$xquery=\"$xquery\";");
  $xfilas=$sql->ejecutarsql($xquery);
  $xld_reg = $sql->consulta($xquery);
  $xlabel=$xld_reg->fetch(PDO::FETCH_BOTH);
  if ($xlabel[col_description] > '')
  {
	$label = $xlabel[col_description];
  }
  echo "<TD align='left' class='Tabla-Elemento-Encabezado'>".$label."</TD> ";
  $comboforaneo = '';
  $cuantos_parametros++;

  $objetos_pagina .= $datos["data_type"].",";
  $xvalor = $valores[$nucampo];
  
  echo "<td><label class='Campo_consultado'>".$xvalor."</label></td>";
  $nucampo++;
  echo "</tr>";

}
}//FIN DEL WHILE/////

echo "</table>";
$cierra=$sql->cierra_conexion();

?>


	</body>
</html>
