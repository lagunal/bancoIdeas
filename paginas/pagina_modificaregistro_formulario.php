

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
        <script type="text/javascript" src="../js/utilidades.js"></script>

        <link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/epoch_classes.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/epoch_styles.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
extract ($_REQUEST);
include ("../../logica/inc/globales.php");
include ("../../persistencia/funcion_bd.php");
include ("../../persistencia/clsPostgre.php");
$sql=new postgresql();

$tiny = '';
if(($_REQUEST['seletabla'] == 'tg006_noticias') || ($_REQUEST['seletabla'] == 'tg005_contenido'))
  {
  $tiny = 'A';
  ?>	<script type='text/javascript' src='../js/tiny_mce/tiny_mce.js'></script>
<?php } ?>
<?php 
if(($_REQUEST['seletabla'] == 'tg006_noticias') || ($_REQUEST['seletabla'] == 'tg005_contenido'))
{
?>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<?php 
}
else 
{
?>
     <script type="text/javascript">
	        tinyMCE.init({
		    mode : "textareas",
		    theme : "simple"
	        });
        </script>
<?php
}
?>  
 
 
		<script type="text/javascript">
		/*You can also place this code in a separate file and link to it like epoch_classes.js*/
			var fe_cal1, fe_cal2, fe_cal3, fe_cal4, fe_cal5 ;      
		window.onload = function () {
			fe_cal1  = new Epoch('epoch_popup','popup',document.getElementById('txfecha1'));
			fe_cal2  = new Epoch('epoch_popup','popup',document.getElementById('txfecha2'));
			fe_cal3  = new Epoch('epoch_popup','popup',document.getElementById('txfecha3'));
			fe_cal4  = new Epoch('epoch_popup','popup',document.getElementById('txfecha4'));
			fe_cal5  = new Epoch('epoch_popup','popup',document.getElementById('txfecha5'));
		
		};
</script></script> 

	</head> 
	<body> 
<a href="pagina_grid_formulario.php?seletabla=<?php echo $_REQUEST[seletabla] ?>&condicion=<?php echo $condicion ?>"><img src="../imagenes/ico_atras_on.png"><span class="Campo_destacado">Regresar</span></a> 
<br><br>

<?php 
extract ($_REQUEST);
$objetos_pagina = '';
$objetos_obligatorios = '';
$cuantos_parametros = 0;
$campos_parametros = '';
$nucampo = 0;
$cuantas_fechas = 1;
$advierte_archivo = '';

//include ("../../logica/inc/globales.php");
//include ("../../persistencia/funcion_bd.php");
//include ("../../persistencia/clsPostgre.php");
////PARA ARMAR EL QUERY DE LA TABLA A MOSTRAR
$sql=new postgresql();
$_buscar = $_REQUEST[seletabla];
$query = phf_query(6);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
//$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$campos_valores = '';
while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) 
{  if($_REQUEST[campoclave] != $datos[column_name])
   {$campos_valores .= $datos[column_name].',';}
}

///CUANTOS CAMPOS TIENE LA TABLA
$tabla = $_REQUEST['seletabla'];
$_buscar = $_REQUEST['seletabla'];
$_buscar2 = $_REQUEST['seletabla'];
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



$query = 'SELECT '. substr($campos_valores,0,strlen($campos_valores)-1). ' FROM '.$_REQUEST[seletabla].' WHERE '.$_REQUEST[campoclave].' = '.$_REQUEST[valorclave];
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
////FIN PARA ARMAR EL QUERY DE LA TABLA A MOSTRAR

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
	
//////PARA ARMAR LOS TITULOS DE LOS CAMPOS//////////////
$query = phf_query(6);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$i = 0;
$j = 0;
echo "<form id='modificaregistro' action='pagina_grid_formulario.php' method='post' enctype='multipart/form-data' onsubmit='return guardarnuevo()' >";
echo "<span  style='visibility:hidden' >";
echo "<input type='hidden' name='tiposql' id='tiposql' value='UPDATE' style='visibility:hidden;display:none' />";
echo "<input type='hidden' name='seletabla'  id='seletabla'  value=$seletabla  style='visibility:hidden;display:none'/>";
echo "<input type='hidden' name='seletabla2' id='seletabla2' style='visibility:hidden;display:none'/>";
echo "<input type='hidden' name='seletabla3' id='seletabla3' style='visibility:hidden;display:none'/>";
echo "<input type='hidden' name='campoclave' id='campoclave' value='$campoclave' style='visibility:hidden;display:none'/>";
echo "<input type='hidden' name='valorclave' id='valorclave' value='$valorclave' style='visibility:hidden;display:none'/>";
echo "</span>";
//echo "<h2 class='Campo_destacado'>$accion</h2>";
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
	if(substr($label,0,1)=='*')
    $label = substr($label,1,strlen($label));
  }
  echo "<TD align='left' class='Tabla-Elemento-Encabezado'>".$label."</TD> ";
  echo "<TD align='left' class='Campo_destacado' width='1'>".$aste."</TD> ";
  $comboforaneo = '';
  
  if (substr($datos["column_name"],0,2)=="co")		
  { $comboforaneo = "SELECT ".$tablaforanea[1]." AS campof,".$tablaforanea[2]." AS nombref FROM ".$tablaforanea[0]." order by ".$tablaforanea[2]; 
  }
  if($tablaforanea[0] > '' && $tablaforanea[1] > '' && $tablaforanea[2] > '')
  {  $cuantos_parametros++;
//     echo $valores[$nucampo]."-";

     echo "<td> <select name=cmb".$datos[column_name]." id=cmb".$datos[column_name].">";
     $objetos_pagina .= $datos["data_type"]."~";
	 $objetos_pagina .= "document.getElementById('cmb".$datos[column_name]."').value"."~";
     if($aste=='*'){$objetos_obligatorios .= "document.getElementById('cmb".$datos[column_name]."').value".",";}
 	 echo "<option value=''></option>";

     $cmbquery = $comboforaneo;
     eval("\$cmbquery=\"$cmbquery\";");
     $filas=$sql->ejecutarsql($cmbquery);
     $cmbld_reg = $sql->consulta($cmbquery);
	 $selstr = '';
	 while  ($cmbdatos=$cmbld_reg->fetch(PDO::FETCH_BOTH)) 
	 { 	 
	    if($cmbdatos["campof"] == $valores[$nucampo])
		{ 
		  $selstr = ' selected ';
		}
		else
		{ $selstr = '';}
	    echo "<option value=".$cmbdatos["campof"].$selstr.">".$cmbdatos["nombref"]."</option>"; 
	 }
	 echo $aste."</td>";
     $tablaforanea[0] = '';
	 $tablaforanea[1] = '';
	 $tablaforanea[2] = '';
	 $nucampo++;
  }
  else
  {
  $cuantos_parametros++;

  $objetos_pagina .= $datos["data_type"]."~";
  if($aste=='*')  {
  if ($datos["data_type"] == 'date')
  {  $objetos_obligatorios .= "document.getElementById('txfecha".$cuantas_fechas."').value".","; }
  elseif($datos[anchocar] > 59 && $tiny == 'A' ) { $objetos_obligatorios .= "tinyMCE.get('tx".$datos[column_name]."').getContent()".","; } 
  else { $objetos_obligatorios .= "document.getElementById('tx".$datos[column_name]."').value".","; } 
   }
  $xvalor = $valores[$nucampo];
  //$advierte_archivo = '';
//tinyMCE.get('elm1').getContent()
  switch ($datos["data_type"]){
	 case "character varying";
		if($datos[column_name] == 'tx_ruta')
		{  $objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";
 	       echo "<td ><input type='file' name=tx".$datos[column_name]." id=tx".$datos[column_name]." value =".$xvalor."></td> ";
		   $advierte_archivo = 'S';
        }
		else
		{
		   if(($datos[anchocar] > 59) && ($datos[column_name] != 'tx_imagenes'))

//		   if($datos[anchocar] > 59) 
		   {
		      if($tiny == 'A') 
		      {   $objetos_pagina .= "tinyMCE.get('tx".$datos[column_name]."').getContent()"."~";
			  }
		      else
		      {   $objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";
			  }
	              echo "<td ><textarea rows='1' cols='50' name=tx".$datos[column_name]." id=tx".$datos[column_name].">$xvalor</textarea></td> ";
		   }else
		   {
	             $ancho = $datos[anchocar] * 20;
                 $objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";
 	             echo "<td ><input type='text' value = '$xvalor' name=tx".$datos[column_name]." id=tx".$datos[column_name]." value = ".$xvalor."></td> ";
		   }
		}
		$nucampo++;
		break;
	 case "character";
		//if($datos[anchocar] > 59) 
		if(($datos[anchocar] > 59) && ($datos[column_name] != 'tx_imagenes'))
		{
		if($tiny == 'A')
		{$objetos_pagina .= "tinyMCE.get('tx".$datos[column_name]."').getContent()"."~";}
		else
		{$objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";}
	    echo "<td ><textarea rows='1' cols='50' name=tx".$datos[column_name]." id=tx".$datos[column_name].">$xvalor</textarea></td> ";
		}else{
	    $ancho = $datos[anchocar] * 10;
        $objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";
 	    echo "<td ><input type='text' value = '$xvalor' name=tx".$datos[column_name]." id=tx".$datos[column_name]." value = ".$xvalor."></td> ";
		}
		$nucampo++;
		break;
     case "integer";
		$objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";
	    echo "<td ><input type='text' value = '$xvalor' name=tx".$datos[column_name]." id=tx".$datos[column_name]." value = ".$xvalor."></td> ";
		$nucampo++;
		break;
	 case "numeric";
		$objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";
	    echo "<td ><input type='text' value = '$xvalor' name=tx".$datos[column_name]." id=tx".$datos[column_name]." value = ".$xvalor."></td> ";
		$nucampo++;
		break;
	 case "date";
	 	$objetos_pagina .= "document.getElementById('txfecha".$cuantas_fechas."').value"."~";
		echo "<td ><input type='text' value = '$xvalor' name=txfecha".$cuantas_fechas." id=txfecha".$cuantas_fechas."></td> ";
		$cuantas_fechas++;

	 
//		$objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').value"."~";
//	    echo "<td ><input type='text' value = '$xvalor' name=tx".$datos[column_name]." id=tx".$datos[column_name]." value = ".$xvalor."></td> ";
		$nucampo++;
		break;
	 case "boolean";
	    $xchk = '';
	    if($xvalor == 1)
		{ $xchk = 'checked'; }
	    $objetos_pagina .= "document.getElementById('tx".$datos[column_name]."').checked"."~";
	    echo "<td ><input type='checkbox' $xchk name=tx".$datos[column_name]." id=tx".$datos[column_name]."></td> ";
		$nucampo++;
		break;
  }	
  }

  echo "</tr>";

}
}//FIN DEL WHILE/////
echo "<tr>";
echo "<td colspan='3'>";
echo "</td>";

echo "</tr>";


echo "<tr>";
echo "<td>";

//echo "<a href='javascript:guardarnuevo()'><img src='../imagenes/disk.png'><span class='Campo_destacado'>Guardar</span></a> ";
echo "<input name='enviar' id='enviar' type='submit' value='Guardar' class='boton_login' />";

echo "</td>";
echo "<td>";
echo "</td>";

echo "<td>";

echo "<span class='Campo_destacado'>(*) Campos obligatorios</span>";
echo "</td>";
echo "</tr>";
echo "</table>";
$objetos_pagina = substr($objetos_pagina,0,strlen($objetos_pagina)-1);
$objetos_obligatorios = substr($objetos_obligatorios,0,strlen($objetos_obligatorios)-1);
$campos_parametros = substr($campos_parametros,0,strlen($campos_parametros)-1);
echo "<script>parent.document.getElementById('seletabla3').value = '$campos_parametros'  </script>";
echo "<script>document.getElementById('seletabla3').value = '$campos_parametros'  </script>";
$comando = 'INSERT INTO '.$_REQUEST[seletabla].' ('.$campos_parametros.')'.' VALUES '.$objetos_pagina ;
$cierra=$sql->cierra_conexion();
if($advierte_archivo == 'S')
{
echo "<script>
  parent.parent.document.getElementById('alertas').value= 'A';
  parent.parent.document.getElementById('alertas').click();
</script>";
}

?>

	</body>
</html>
<script>
                                   

function guardarnuevo()
{
//alert(document.getElementById('txtx_mensaje').value);
<?php 
$values = split('[,]', $objetos_obligatorios );
$tamano = count($values);
?>
var tamano = <?php echo $tamano ?>;
var x = new Array();
var vacio = 0;
<?php 
for($i=0; $i < $tamano ; $i++)
{
  echo "\nx[$i] = $values[$i];"; 
}
echo "\n";
?>
for(var i = 0; i < tamano; i++)
{  
   if(x[i]=='')
   {
      vacio = vacio + 1;
   }
}
if(vacio > 0)
{parent.parent.parent.document.getElementById('alertas').value= 'W';
 parent.parent.parent.document.getElementById('alertas').click();
return ;
}
parent.document.getElementById('seletabla2').value = '';
<?php 
$insertar = 'UPDATE '.$_REQUEST[seletabla].' '.$campos_parametros.' VALUES ';
$values = split('[~]', $objetos_pagina);
$tamano = count($values);
$cadena = '';
$tipodato = '';          
for($i = 0; $i < $tamano; $i++)
{     
if($tipodato == 'character varying' || $tipodato == 'character' || $tipodato == 'boolean' || $tipodato == 'date')
{ 
?>
parent.document.getElementById('seletabla2').value = parent.document.getElementById('seletabla2').value + "'";
document.getElementById('seletabla2').value = document.getElementById('seletabla2').value + "'";
<?php
}
   if($i < $tamano - 1 && $i % 2 != 0)                    
   {$cadena = "'~ '";}
   else
   {$cadena = "''"  ;}

if ($i % 2 != 0)
{   
   ?>
   parent.document.getElementById('seletabla2').value = parent.document.getElementById('seletabla2').value + <?php echo $values[$i] ?>;
   document.getElementById('seletabla2').value = document.getElementById('seletabla2').value + <?php echo $values[$i] ?>;
   <?php 
   if($tipodato == 'character varying' || $tipodato == 'character' || $tipodato == 'boolean'  || $tipodato == 'date')
   { 
   ?>
   parent.document.getElementById('seletabla2').value = parent.document.getElementById('seletabla2').value + "'";
   document.getElementById('seletabla2').value = document.getElementById('seletabla2').value + "'";
   <?php
   $tipodato = '';
   }   
}
else
{
$tipodato = $values[$i];
}	  
   ?>
   parent.document.getElementById('seletabla2').value = parent.document.getElementById('seletabla2').value + <?php echo $cadena ?>;
   document.getElementById('seletabla2').value = document.getElementById('seletabla2').value + <?php echo $cadena ?>;
   <?php
   $cadena = "''"  ;
}

?>
//parent.document.getElementById('ruta').value = document.getElementById('tx_ruta').value;
parent.document.getElementById('tiposql').value = 'UPDATE';
/*parent.document.getElementById('form1').target="grid";
parent.document.getElementById('form1').action="pagina_grid.php?campoclave=<?php //echo $campoclave ?>&valorclave=<?php //echo $valorclave ?>";
parent.document.getElementById('form1').submit();*/
}
</script>