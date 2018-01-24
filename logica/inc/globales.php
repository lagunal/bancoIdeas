<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
define("servidor_ldap","ldap://ccscam17");
define("dominio_ldap","pdvsa.com");

define("visitas","../../presentacion/paginas/visitas");
define("dir_destino","../../presentacion/paginas/");
$gs_esquema ='bancoideas';
$gs_acronimo ='CIT';
$gs_ruta ='http://ccschu14.pdvsa.com/PHOTOS/';
$gs_hostaddr = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$d =array();
$gs_data = array();
$gs_titulo = '';
$titulo_sistema="Concurso Anual a la Investigaci&oacute;n y Desarrollo Tecn&oacute;logico";
$titulo_piedepagina="Copyleft &copy; 2010 | ".$titulo_sistema." <br> Se ve mejor con Firefox 1024x768";
$logo_pdvsa_intevep="http://intranet.pdvsa.com/";
$aplicacion = "52e2357343ffa5806cdbc4d9f3b37d9b";

$ruta = "http://129.90.60.52/componentes/controlAcceso/class.ImplementSeguridadWeb.php?wsdl";

$rutaLog = "/home/sandovalrd/bancoideas/persistencia/Logs/";
$logAccesos = "logAccesos.txt";
$logQuery = "logQuery.txt";
$logError = "logError.txt";

?>
