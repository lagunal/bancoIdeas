<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

	include("../../logica/inc/globales.php");
	include ("../../persistencia/funcion_bd.php");
	include ("../../persistencia/clsPostgre.php");

?>
<script type="text/javascript" src="../js/utilidades.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">

/***********************************************
* Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll=2000 //Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
var marqueespeed=2 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var actualheight=''

function scrollmarquee(){
if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8)) //if scroller hasn't reached the end of its height
cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px" //move scroller upwards
else //else, reset to original position
cross_marquee.style.top=parseInt(marqueeheight)+8+"px"
}

function initializemarquee(){
cross_marquee=document.getElementById("vmarquee")
cross_marquee.style.top=0
marqueeheight=document.getElementById("marqueecontainer").offsetHeight
actualheight=cross_marquee.offsetHeight //height of marquee content (much of which is hidden from view)
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee.style.height=marqueeheight+"px"
cross_marquee.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee()",30)', delayb4scroll)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee)
else if (document.getElementById)
window.onload=initializemarquee


</script>

<table width="508" >
  <tr>
  <td >&nbsp;</td>
    <td  align="center"><!--<img src="../imagenes/banner_encuestas_peq.png"/> --></td>
    <td >&nbsp;</td>
    <!--<td ><input width="198" height="170" name="" type="image" src="../imagenes/ceenpet_cursoscortos2_on.png" /></td>
    <td ><input width="198" height="170" name="" type="image" src="../imagenes/ceenpet_especializaciones2_on.png" /></td>
    <td ><input width="198" height="170" name="" type="image" src="../imagenes/ceenpet_opcioneseducativas_on.png" /></td> -->
  </tr>
</table>

<div id="marqueecontainer" onmouseover="copyspeed=pausespeed" onmouseout="copyspeed=marqueespeed"  style="border:0">
  <div id="vmarquee" style="position: absolute; width:90%;">
    <?php
$sql=new postgresql();
$query = phf_query(20);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) {
   echo "<h1 class='Campo_destacado'>$datos[nb_titulo]  ".substr($datos[fe_publicacion],8,2)."/".substr($datos[fe_publicacion],5,2)."/".substr($datos[fe_publicacion],0,4)."</h1>";
   echo "<h1 class='Campo_destacado'>$datos[nb_subtitulo]</h1>";
   echo "<h4 class='Cuerpo'>$datos[tx_contenido]</h4>";
	}
?>
  </div>
</div>
