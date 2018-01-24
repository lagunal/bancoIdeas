<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
include("../../logica/inc/globales.php");
	
if ( (isset($_SESSION['indicador']))&&(!empty($_SESSION['indicador'])) )
	{		//Valida que  exista una sesion activa	
		include_once('class.clienteSeguridadWeb.php');	
		$client =new clienteSeguridadWeb($ruta);	
		$valresultado 	=	 $client->validarTiempoSesion($_SESSION["indicador"],$aplicacion);
	
		if($valresultado->codigoMensaje == 03)
			{ //Si el mensaje indica que no existe la session
				$pag= "pag_fin_sesion.php";
				header("Location: ".$pag);				
			}
	}else{	//Si no see observa algun valor en el indicador 		
			$pag= "pag_fin_sesion.php";
			header("Location: ".$pag);				 
	}
?>


