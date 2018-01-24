<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
session_start();
extract($_REQUEST);
	include("../../logica/inc/globales.php");
			
	include_once('class.clienteSeguridadWeb.php');
		
	$client =new clienteSeguridadWeb($ruta);

	$resultado= $client->cerrarSesion($_SESSION['usuario'],$aplicacion);
			
		//echo "<script>parent.parent.document.location.href ='index.php'; <//script>";  	
	$pag= "index.php";
	header("Location: ".$pag);

?>
