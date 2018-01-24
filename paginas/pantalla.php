<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Gestión Soluciones del Negocio-AIT Region Centro,Miranda Oeste
//Periodo................: 2011
//---------------------------------------------------------------------------------------
?>
<html>
<!--Para mostrar el mensaje de cargando ... antes de calcular la resolucion de la pantalla -->
<script language=Javascript>
var ancho=screen.width;
var alto=screen.height;
</script>
<!--Para mostrar la imagen de cargando.... antes de construir la pagina. -->
<div align="center" ID="DivCargando" style="position:absolute;left:500;top:400; visibility:hidden">
	<table height="80%" cellspacing="0" border="0" align="center" >
		<td class="Campo_destacado" align="center">
		<img  id="loading" src="presentacion/imagenes/ajax-loading.gif">
        <br />
         <span class="Campo_destacado"><?php echo "Cargando contenido de ".$_SERVER['REQUEST_URI'].". Por favor espere..."; ?></span>
		  <br />
		</td>
	</table>
</div>
<SCRIPT  language="javascript">
var DHTML = (document.getElementById || document.all || document.layers);
function ap_getObj(name) {
if (document.getElementById)
{ return document.getElementById(name).style; }
else if (document.all)
{ return document.all[name].style; }
else if (document.layers)
{ return document.layers[name]; }
}

function ap_showWaitMessage(div,flag) {
if (!DHTML) return;
var x = ap_getObj(div); x.visibility = (flag) ? 'visible':'hidden'
if(! document.getElementById) if(document.layers) x.left=380/2; return true; } ap_showWaitMessage('DivCargando', 3);
</SCRIPT>
<!--Fin para mostrar la imagen de cargando.... antes de construir la pagina. -->

<!--Para optener la resolución de la pantalla.... antes de construir la pagina. -->
<?php
if (empty($_POST['PantallaAlto']))
{
echo "<form name=formulario method=POST action=".$PHP_SELF.">";
echo "<input type=hidden name=PantallaAncho>";
echo "<input type=hidden name=PantallaAlto>";
echo "<input type=hidden name=URI value=".$_SERVER['REQUEST_URI'].">";
echo "</form>";
echo "<script language=Javascript> document.formulario.PantallaAncho.value=ancho; document.formulario.PantallaAlto.value=alto;";
echo "document.formulario.submit() ";
echo "</script>";
}
else
{
$_SESSION['PantallaAlto'] = $_POST['PantallaAlto'];
$_SESSION['PantallaAncho'] = $_POST['PantallaAncho'];
}
?>
<!--Fin de operaciones para construir la pagina. -->
</html>
<!--Para ocultar la imagen de cargando.... luego de construir la pagina. -->
<SCRIPT language="javascript" type="text/javascript">
	ap_showWaitMessage('DivCargando', 0);
</SCRIPT>
