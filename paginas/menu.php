<?php

include_once "../../persistencia/clad.php";
$clad = new clad();

$recursos = array();
if(isset($_SESSION["indicador"])) $recursos = $clad->buscarRecursosUsuario($_SESSION["indicador"]);

$opciones  = $clad->obtenerMenu();

$c = count($opciones);
$fin = 99;
if(isset($_GET["n"]) &&  ($_GET["n"]!='')) $nivel = $_GET["n"];
for($i=0; $i<$c; $i++){
	$mostrar = false;
	
	if(isset($opciones[$i]['nb_recurso']) && $opciones[$i]['nb_recurso']!=""){
		$res = array_search($opciones[$i]['nb_recurso'], $recursos);
		
		if($nivel==$opciones[$i]['co_padre'] && ($res!==false)) $mostrar = true;
	}

	if($mostrar){
		if($opciones[$i]['lo_subnivel']==0){$subnivel = $opciones[$i]['co_menu'];
		}else{	$subnivel = $opciones[$i]['co_padre'];}

		echo "<a href=\"" . $opciones[$i]['nb_url'] . "?n=" . $subnivel. "\" class=\"Contenedor-Texto-Menu\">" . "<span class=\"Text-menu\">" . $opciones[$i]['nb_menu'] . "</span>" . "</a>";
       		echo "<span class=\"PuntoHo_Cortico\"></span>";
     	}
	if ($opciones[$i]['co_padre']=='0') $fin = $i;	

}
if ($fin!=99){
	echo "<a href=\"" . $opciones[$fin]['nb_url'] . "\" class=\"Contenedor-Texto-Menu\">" . "<span class=\"Text-menu\">" . $opciones[$fin]['nb_menu'] . "</span>" . "</a>";
	echo "<span class=\"PuntoHo_Cortico\"></span>";
}
?>
