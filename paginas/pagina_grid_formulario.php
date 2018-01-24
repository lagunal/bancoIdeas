<HEAD>
<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="../js/utilidades.js"></script>

</HEAD>

<form id="form1" name="form1" >

<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

extract($_REQUEST);
//print_r($_REQUEST);
//$seletabla2 = 'tg005_contenido';//$_REQUEST[seletabla2];
include ("../../logica/inc/globales.php");
include ("../../persistencia/funcion_bd.php");
include ("../../persistencia/clsPostgre.php");
$sql=new postgresql();
  
  
  if ($_REQUEST[tiposql] == 'INSERT') //PARA INSERTAR EL REGISTRO
  {  
	  if($_REQUEST[seletabla] == 'tg008_administradores')
	  {  
	     $seletabla2 = obtener_clave($_REQUEST[seletabla2]);
	  }
      $status = "";
          $tamano = $_FILES["txtx_ruta"]['size'];
          if($tamano > 0) {
          $tipo = $_FILES["txtx_ruta"]['type'];
          $archivo = $_FILES["txtx_ruta"]['name'];
          $prefijo = substr(md5(uniqid(rand())),0,6);
          if ($archivo != "") {
              $destino =  "../archivos/".$archivo;
			  if(($_REQUEST[seletabla] == 'tg006_noticias') || ($_REQUEST[seletabla] == 'tg014_emergencias'))
			  {$destino =  "../imagenes/".$archivo;}
			  if($_REQUEST[seletabla] == 'tg013_galeria')
			  {$destino =  "../galeria/".$archivo;}
              if (copy($_FILES['txtx_ruta']['tmp_name'],$destino)) {
                  $status = "Archivo subido: <b>".$archivo."</b>";
              } else {
                  $status = "Error al subir el archivo1";
              }
          } else {
              $status = "Error al subir archivo2";
          }
      }
      ////FIN PARA SUBIR LOS ARCHIVOS///
 
	 $query = 'INSERT INTO '.$_REQUEST[seletabla]. ' ('.$_REQUEST[seletabla3].') '.' VALUES ('.$seletabla2.')';
     $query = stripslashes($query);
	 $xquery = str_replace("'", "''", $query);
	 $audi = agregaauditoria(getIP(), $_SESSION['usuario'], $xquery, 'I', $_REQUEST[seletabla], $gs_hostaddr);
	 $filas=$sql->ejecutarsql($query);
	 if($filas > 0)
	 { ?>
	 <script>
	 parent.parent.parent.document.getElementById('alertas').value= 'I';
	 parent.parent.parent.document.getElementById('alertas').click();</script>
	 <?PHP
     }else
	 {?> 
	<script>
	 parent.parent.parent.document.getElementById('alertas').value= 'E';
	 parent.parent.parent.document.getElementById('alertas').click();</script>
	<?PHP } 
	 echo "<script> parent.document.getElementById('tiposql').value = '' </script>";
	 echo "<script> parent.document.getElementById('seletabla2').value = '' </script>";
	 echo "<script> parent.document.getElementById('seletabla3').value = '' </script>";
  }
  
  
 if ($_REQUEST[tiposql] == 'UPDATE') //PARA MODIFICAR EL REGISTRO
  {  
      ////PARA SUBIR LOS ARCHIVOS////
	  	  if($_REQUEST[seletabla] == 'tg008_administradores')
	  {  
	     $seletabla2 = obtener_clave($_REQUEST[seletabla2]);
	  }

      $status = "";
          $tamano = $_FILES["txtx_ruta"]['size'];
          if($tamano > 0) {
          $tipo = $_FILES["txtx_ruta"]['type'];
          $archivo = $_FILES["txtx_ruta"]['name'];
          $prefijo = substr(md5(uniqid(rand())),0,6);
          if ($archivo != "") {
              $destino =  "../archivos/".$archivo;
			  if(($_REQUEST[seletabla] == 'tg006_noticias') || ($_REQUEST[seletabla] == 'tg014_emergencias'))
			  {$destino =  "../imagenes/".$archivo;}
			  if($_REQUEST[seletabla] == 'tg013_galeria')
			  {$destino =  "../galeria/".$archivo;}
              if (copy($_FILES['txtx_ruta']['tmp_name'],$destino)) {
                  $status = "Archivo subido: <b>".$archivo."</b>";
              } else {
                  $status = "Error al subir el archivo1";
              }
          } else {
              $status = "Error al subir archivo2";
          }
      }
      ////FIN PARA SUBIR LOS ARCHIVOS///

	 $xcampos = split('[,]', $seletabla3);
	 $xvalues = split('[~]', $seletabla2);
	 $cantcampos = count($xcampos);
	 $i = 0;
	 $query = 'UPDATE '.$seletabla.' SET ';
	 $setes = '';
	 for($i = 0; $i < $cantcampos; $i++)
	 { $setes .= $xcampos[$i].' = '.$xvalues[$i].',';  }
	 $setes = substr($setes,0,strlen($setes)-1);
	 $query .= $setes.' WHERE '.$campoclave.' = '.$valorclave;
	 $xquery = str_replace("'", "''", $query);
	 //echo $xquery;
	 
 	 $audi = agregaauditoria(getIP(), $_SESSION['usuario'], $xquery, 'U', $_REQUEST[seletabla], $gs_hostaddr);

	 $filas=$sql->ejecutarsql($query);
	 if($filas > 0)
	 { ?> 
	 <script>

	 parent.parent.parent.document.getElementById('alertas').value= 'U';
	 parent.parent.parent.document.getElementById('alertas').click();</script>
	
	<?PHP 
	}
     else
	 {?> 
 	 <script>
	 parent.parent.parent.document.getElementById('alertas').value= 'E';
	 parent.parent.parent.document.getElementById('alertas').click();</script>
	
     <?PHP	 
}
	 echo "<script> parent.document.getElementById('tiposql').value = '' </script>";
	 echo "<script> parent.document.getElementById('seletabla2').value = '' </script>";
	 echo "<script> parent.document.getElementById('seletabla3').value = '' </script>";

}


if (isset($_GET["order"])) $order = @$_GET["order"];
if (isset($_GET["type"])) $ordtype = @$_GET["type"];
if (isset($_GET["ordtype"])) $ordtype = @$_GET["ordtype"];
if (isset($_POST["filter"])) $filter = @$_POST["filter"];
if (isset($_POST["filter_field"])) $filterfield = @$_POST["filter_field"];
if (!isset($order) && isset($_SESSION["order"])) $order = $_SESSION["order"];
if ($ordtype == "asc") { $ordtype = "desc"; } else { $ordtype = "asc"; }

$page = @$_GET["page"];
if (!isset($page)) $page = 1;
$pagerange = 10;


?>
<?php
////PARA SABER CUANTOS CAMPOS TIENE LA TABLA/////////
$tabla = $_REQUEST['seletabla'];
$_buscar = $tabla;
$_buscar2 = $tabla;
$sql=new postgresql();

$query = phf_query(9);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
//echo $query;
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$datos=$ld_reg->fetch(PDO::FETCH_BOTH);
$cuantas = $datos["valor"]-1;
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

echo "<form action='pagina_grid_formulario.php' method='post'>";
$loj = '';
$campos = 'SELECT t1.'.$campoclave.', ';
$campoactual = '';
$t = 2;
$h = 0;
$w = 0;//para contar el ciclo
$columnorder = 0;
while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) 
{ 
if($datos["column_name"] != $campoclave)
{
  $campoactual = 't1.'.$datos["column_name"];
  if($campoactual == $_REQUEST[order]) $columnorder = $w; //para saber el numero de la columna ordenada...
  $w++;
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
  $labelorig[$h] = $campoactual;
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
	$head[$h] = $label;
	$h++;
  }
}
}//FIN DEL WHILE/////

$campos = substr($campos,0,strlen($campos)-2);
$campos .= " FROM ".$tabla." AS t1 ".$loj;
$sql=new postgresql();

$query = $campos;
if(isset($_REQUEST[order]) && $_REQUEST[order] > '')
{$query .= ' order by '.$_REQUEST[order]." ".$_REQUEST[ordtype];}
if(isset($_REQUEST[condicion]) && $_REQUEST[condicion] > '')
{$query .= $_REQUEST[condicion];}
//echo $query;
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);

$count = $ld_reg->rowCount();
$showrecs = 5;
  if ($count % $showrecs != 0) {
    $pagecount = intval($count / $showrecs) + 1;
  }
  else {
    $pagecount = intval($count / $showrecs);
  }

  $startrec = $showrecs * ($page - 1);
  if ($startrec < $count)
  {
  for($r = 0; $r < $startrec ;$r++)
     {
      $datos=$ld_reg->fetch(PDO::FETCH_BOTH);
     }
  }
  $reccount = min($showrecs * $page, $count);

showpagenav($page, $pagecount); 

echo "<table border='0' cellspacing='1' cellpadding='5' >";
/*echo "<tr>";
echo "<td>";
echo "<select name=cmb_filtro id=cmb_filtro>";
echo "<option value=''></option>";   
$cuancampos = count($head);
$f = 0;
while  ($f < $cuancampos) 
{ 
  $cabe = $head[$f];
  if(substr($head[$f],0,1)=='*')
  {
  $cabe = substr($cabe,1,strlen($cabe));
  }
  echo "<option value=".$cabe.">".$cabe."</option>"; 
  $f++;
}

echo "<td/>";
echo "</tr>";*/
echo "<tr>";
echo "<td align='center' class='Tabla-Elemento-Encabezado-Icono' ></td>";

for($h=0; $h < count($head); $h++)
{ 
  $cabe = $head[$h];
  if(substr($head[$h],0,1)=='*')
  {
  $cabe = substr($cabe,1,strlen($cabe));
  $grid[$h+1]=1;
  echo "<TH align='center' class='Tabla-Elemento-Encabezado'><a href=pagina_grid_formulario.php?order=".$labelorig[$h]."&seletabla=".$_REQUEST[seletabla]."&ordtype=".$ordtype.">".$cabe."</a></TH> ";
  }
  else
  {
  $grid[$h+1]=0;
  }
}
echo "</tr>";

$i = 0;
$j = 0;
$r = 0;
for($rr = $startrec; $rr < $reccount; $rr++)
{   $datos=$ld_reg->fetch(PDO::FETCH_BOTH);
    $style = "Tabla-Elemento-Claro-Icono";
    if ($r % 2 != 0) { $style = "Tabla-Elemento-Oscuro-Icono";  }
	$r++; 
    $i = 0;
    echo "<tr>";
    $valorclave = '$datos['.$campoclave.']';
    eval("\$valorclave=\"$valorclave\";");
    ?>
    <td class=<?php echo $style ?> ><img src="../imagenes/ico_actualizar_on.png" name="boton_actualizar" width="15" height="16" border="0" id="boton_actualizar" style="cursor:pointer" title="Permite actualizar el registro seleccionado" onClick="javascript:modificaregistro(parent.document.getElementById('seletabla').value,<?php echo "'".$campoclave."'" ?>,<?php echo "'".$valorclave."'" ?>)"  value="Actualizar"></a></td>
<?php
?>	
    <?php 
     $styleaux = '';
	 $i = 0;
     while ($i <= $cuantas) 
     {
	   if (($i == $columnorder+1) && ($order > ''))  { $styleaux = $style; $style = "Tabla-Elemento-Orden";  }
	   if(($i > 0) && ($grid[$i] == 1))
	   { echo "<td class=".$style.">".$datos[$i]."</td> "; }
	   if($styleaux > '') { $style = $styleaux; $styleaux = '';  }
       $i++;
     }
    echo "</tr>";
}
    echo "</table>";
	
$cierra=$sql->cierra_conexion();
?>
<?php //showpagenav($page, $pagecount); ?>
</body>
</form>

<?php function showpagenav($page, $pagecount)
{ 
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<?php if ($page > 1) { ?>
<td><a href="pagina_grid_formulario.php?page=<?php echo $page - 1 ?>&seletabla=<?php echo $_REQUEST[seletabla]?>&ordtype=<?php echo $_REQUEST[ordtype]?>&order=<?php echo $_REQUEST[order]?>"><img src='../imagenes/ico_atras_on.png'></a></td>
<?php } ?>
<?php
  global $pagerange;

  if ($pagecount > 1) {

  if ($pagecount % $pagerange != 0) {
    $rangecount = intval($pagecount / $pagerange) + 1;
  }
  else {
    $rangecount = intval($pagecount / $pagerange);
  }
  for ($i = 1; $i < $rangecount + 1; $i++) {
    $startpage = (($i - 1) * $pagerange) + 1;
    $count = min($i * $pagerange, $pagecount);

    if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
      for ($j = $startpage; $j < $count + 1; $j++) {
         if ($j == $page) {
?>
<td><b><?php echo $j ?></b></td>
<?php } else { ?>
<td><a href="pagina_grid_formulario.php?page=<?php echo $j ?>&seletabla=<?php echo $_REQUEST[seletabla]?>&ordtype=<?php echo $_REQUEST[ordtype]?>&order=<?php echo $_REQUEST[order]?>"><?php echo nupagina($j).' ' ?></a></td>
<?php } } } else { ?>
<td><a href="pagina_grid_formulario.php?page=<?php echo $startpage ?>&seletabla=<?php echo $_REQUEST[seletabla]?>&ordtype=<?php echo $_REQUEST[ordtype]?>&order=<?php echo $_REQUEST[order]?>"><?php echo nupagina($startpage) ."..." .nupagina($count) ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="pagina_grid_formulario.php?page=<?php echo $page + 1 ?>&seletabla=<?php echo $_REQUEST[seletabla]?>&ordtype=<?php echo $_REQUEST[ordtype]?>&order=<?php echo $_REQUEST[order]?>"><img src='../imagenes/ico_adelante_on.png'></a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>


<?php 
function nupagina($pagina){
   $paginax = "<img src='../imagenes/".substr($pagina,0,1).".gif'".">";
   if ($pagina > 9) $paginax .= "<img src='../imagenes/".substr($pagina,1,1).".gif'".">";
   return $paginax;
}
?>

<script>
function refrescaedit(tabla)
{
//  document.getElementById("seletabla").value=tabla;
  document.getElementById('form1').target="grid";
  document.getElementById('form1').action="pagina_grid_formulario.php";
  document.getElementById('form1').submit();
}

function modificaregistro(tabla, campoclave, valorclave)
{
/*alert('modificaregistro');
alert(tabla);
alert(campoclave);
alert(valorclave);
document.getElementById('form1').target="add_edit";
document.getElementById('form1').action="pagina_agregaregistro_formulario.php";
document.getElementById('form1').submit();*/
//location.href="#add_edit";
parent.document.getElementById('campoclave').value = campoclave;
parent.document.getElementById('valorclave').value = valorclave;
parent.document.getElementById('boton').click();
}
</script>