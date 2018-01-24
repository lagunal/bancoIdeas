<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<script language="javascript" type="text/javascript" src="../js/Utilidades.js" ></script>-->
<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />


<title>Documento sin t&iacute;tulo</title>
<script type="text/javascript" src="../js/utilidades.js"></script>

</head>
<body>
<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
session_start();
  include ("../../logica/inc/globales.php");
  include ("../../persistencia/funcion_bd.php");
  include ("../../persistencia/clsPostgre.php");
  include ("pagina_obtener_usuario.php");
?>
<form id="form1" name="form1"  action="" method="post">
<table width="574" border="0">
  <tr>
    <TD width="37"><span class="Campo_destacado">Tabla</span></TD>
    <th scope="col" width="107">
	<select name="tx_tabla" id="tx_tabla" class="Campo_consultado" style="font-size:10px"  onChange="refrescagridtabla(tx_tabla.value)">
    <option value="" class="Campo_consultado" style="font-size:10px" ></option>
	<?php
	
	if ($administrador == "MAP") {$consulta = 19 ; } elseif ($administrador == "FUNCIONAL") {$consulta = 3; }
	$sql=new postgresql();
    $query = phf_query($consulta);
    $filas=$sql->ejecutarsql($query);
    $ld_query = $sql->consulta($query);
    $datos=$ld_query->fetch(PDO::FETCH_BOTH);
    $query = $datos['tx_query'].$datos['tx_condicion'];

    eval("\$query=\"$query\";");
    $filas=$sql->ejecutarsql($query);
    $ld_reg = $sql->consulta($query);
    while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) {	
	$val = $datos["tabla"];
	$caption = $datos["tabla"];
	$selstr = '';

	$xquery = "select obj_description('".$caption."'::regclass,'pg_class')"; 
    eval("\$query=\"$query\";");
    $xfilas=$sql->ejecutarsql($xquery);
    $xld_reg = $sql->consulta($xquery);
    $label=$xld_reg->fetch(PDO::FETCH_BOTH);
    if ($label[obj_description] > '')
	{
	$caption = substr($label[obj_description],0,87);
	}
 
	?>
    <option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo $caption ?></option>
	<?php }
    ?>
	</select>	</th>
	
    <TD width="227" id="agregar" style="visibility:hidden"  >
      <a href="javascript:agregaregistro()" ><img src="../imagenes/ico_agregar_on.png"><span class="Campo_destacado">Agregar registro</span></a></TD>
  </tr>
  <tr>
    <th scope="col" align="right" id="imgnuevo"></th>
    <TD><span style="visibility:hidden">
      <input type="hidden" name="seletabla" id="seletabla"  style="visibility:hidden" />
      <input type="hidden" name="seletabla2" id="seletabla2" style="visibility:hidden" />
      <input type="hidden" name="seletabla3" id="seletabla3" style="visibility:hidden">
      <input type="hidden" name="tiposql" id="tiposql" style="visibility:hidden" />
      <input id= "ruta" name= "ruta"   type="hidden" style="visibility:hidden">
    </span> </TD>
  </tr>
</table>
<span class="Separador_Modulo"></span>
<iframe id="grid" name="grid" frameborder="0" src="" width="600" height="500"> </iframe>
</form>
</body>
</html>

<script>
function refrescagridtabla(tabla)
{
  if (tabla != "tg004_auditoria") {
  document.getElementById("agregar").style.visibility = "visible";
  } else {
   document.getElementById("agregar").style.visibility = "hidden";
  }
  document.getElementById("seletabla").value=tabla;
  document.getElementById('form1').target="grid";
  document.getElementById('form1').action="pagina_grid.php";
  document.getElementById('form1').submit();
 
}

function agregaregistro()
{
document.getElementById('form1').target="grid";
document.getElementById('form1').action="pagina_agregaregistro.php";
document.getElementById('form1').submit();

}
</script>
