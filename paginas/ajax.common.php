<?php
	//incluimos la clase ajax
	require ('../xajax/xajax_core/xajax.inc.php');
	
	//instanciamos el objeto de la clase xajax
	$xajax = new xajax("ajax.funciones.php");

	
	//registrar las funciones ajax que se utilizan en el sistema

	$xajax->register(XAJAX_FUNCTION, 'catalogos');
	$xajax->register(XAJAX_FUNCTION, 'usuarios');
	$xajax->register(XAJAX_FUNCTION, 'fijarOrden');
	$xajax->register(XAJAX_FUNCTION, 'validar_id');
	$xajax->register(XAJAX_FUNCTION, 'buscarIdea');
	$xajax->register(XAJAX_FUNCTION, 'borrador');
	$xajax->register(XAJAX_FUNCTION, 'cmbCodigos');
	$xajax->register(XAJAX_FUNCTION, 'coautor');
	$xajax->register(XAJAX_FUNCTION, 'limpiarCoautor');
	
	
?>
