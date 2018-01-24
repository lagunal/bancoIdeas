<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

include_once('class.clienteSeguridadWeb.php');

$client = new clienteSeguridadWeb($ruta);
$resultado=$client->obtenerInfoUsuario($_SESSION['indicador']);
$grupos = $resultado->grupos;
$grupos = explode(";",$grupos);
for( $i = 1; $i < count($grupos); $i ++)
    {
         if ($grupos[$i] == "gm-ait_Map_aplic-c")
		 	{
			  $administrador = "MAP";
			}
		elseif ($grupos[$i] == "gusr-SPCEENPET_admin") 
			{
			  $administrador = "FUNCIONAL";
			} 
        
    }


?> 
