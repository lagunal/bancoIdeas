<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--<script language="javascript" type="text/javascript" src="../js/Utilidades.js" ></script>-->
<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />
</head>
<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
extract($_REQUEST);
// print_r($_REQUEST);

//session_start();
  include ("../../logica/inc/globales.php");
  include ("../../persistencia/funcion_bd.php");
  include ("../../persistencia/clsPostgre.php");
//  include ("pagina_obtener_usuario.php");
  
  $sql=new postgresql();
  $xquery = "select obj_description('".$tabla_formulario."'::regclass,'pg_class')"; 
  eval("\$query=\"$query\";");
  $xfilas=$sql->ejecutarsql($xquery);
  $xld_reg = $sql->consulta($xquery);
  $label=$xld_reg->fetch(PDO::FETCH_BOTH);
  
?>

<body onload="refrescagridtabla('<?php echo $tabla_formulario; ?>');">
<form id="form1" name="form1"  action="" method="post" >
<table width="600" border="0" align="left">
  
  <tr>
    <th width="363" height="22" align="left" id="imgnuevo" scope="col">
       <span class="Campo_destacado"><?php echo $label[0]; ?></span>	</th>
    <TD width="124" ><a href="javascript:agregaregistro()" ><img src="../imagenes/ico_agregar_on.png"><span class="Campo_destacado">Agregar registro</span></a>    </TD>
	<td width="105"> 	  <input type="hidden" name="seletabla" id="seletabla"  style="visibility:hidden" />
      <input type="hidden" name="seletabla2" id="seletabla2" style="visibility:hidden" />
      <input type="hidden" name="seletabla3" id="seletabla3" style="visibility:hidden">
      <input type="hidden" name="tiposql" id="tiposql" style="visibility:hidden" />
      <input id= "ruta" name= "ruta"   type="hidden" style="visibility:hidden">
      <input id= "campoclave" name= "campoclave"   type="hidden" style="visibility:hidden" >
      <input id= "valorclave" name= "valorclave"   type="hidden" style="visibility:hidden" >
      <input id= "accion" name= "accion"   type="hidden" style="visibility:hidden" >
      <input id= "condicion" name= "condicion"   type="hidden" style="visibility:hidden" value="<?php echo $condicion?>" >


      <input id= "boton" name= "boton"   type="button" onclick="modificaregistro()" style="visibility:hidden" >
</td>
  </tr>
    <tr>
	<td colspan="3">
       <span class="Separador_Modulo"></span>
	</td>
	</tr>
<tr>
<td colspan="3">
<iframe id="grid" name="grid" frameborder="0" width="600" height="500"> </iframe>


</td>
</tr>

</table>

</form>
</body>
</html>

<script>
function refrescagridtabla(tabla)
{
  document.getElementById("seletabla").value=tabla;
  document.getElementById('form1').target="grid";
  document.getElementById('form1').action="pagina_grid_formulario.php";
  document.getElementById('form1').submit();
/*  document.getElementById('form1').target="add_edit";
  document.getElementById('form1').action="pagina_agregaregistro_formulario.php";
  document.getElementById('form1').submit();*/

}
function agregaregistro()
{
document.getElementById('accion').value = 'Nuevo Registro';
document.getElementById('form1').target="grid";
document.getElementById('form1').action="pagina_agregaregistro_formulario.php";
document.getElementById('form1').submit();
//location.href="#add_edit";
}
function modificaregistro()
{
//alert('modificaregistro');
document.getElementById('accion').value = 'Modificar Registro';
document.getElementById('form1').target="grid";
document.getElementById('form1').action="pagina_modificaregistro_formulario.php";
document.getElementById('form1').submit();
//location.href="#add_edit";
}

</script>
