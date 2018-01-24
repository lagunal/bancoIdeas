<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

session_start();

$sql=new postgresql();
	$queryco = phf_query(31);
	$filas=$sql->ejecutarsql($queryco);
	$ld_query = $sql->consulta($queryco);
	$datos=$ld_query->fetch(PDO::FETCH_BOTH);
	$queryco = $datos['tx_query'].$datos['tx_condicion'];
	eval("\$queryco=\"$queryco\";");
	$filas=$sql->ejecutarsql($queryco);
	$ld_reg = $sql->consulta($queryco);
while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) 
{  
$rproceso = $datos['negocio'];
$rrhh = $datos['rrhh'];
$cedulap = $datos['nu_cedula'];
$nombrep = $datos['nb_nombre_apellido'];
$det_opcion = $datos['nb_det_opcion'];
}


$usuario ="torrealbaw"; //variables de acceso a los servidores
$password="torrealbaw"; //variable de accesos a los servidores
 require_once 'Mail.php';

	$sql=new postgresql();
	$query = phf_query(29);
	$filas=$sql->ejecutarsql($query);
	$ld_query = $sql->consulta($query);
	$datos=$ld_query->fetch(PDO::FETCH_BOTH);
	$query = $datos['tx_query'].$datos['tx_condicion'];
	eval("\$query=\"$query\";");
	$filas=$sql->ejecutarsql($query);
	$ld_reg = $sql->consulta($query);
    
    $host = "ccschucor05";
        
        
    
    
	while  ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)) 
	{  
	    
	$destino = $datos['nb_destinatario'];
	
	if ($destino== "POSTULADO"){$direccion = $_SESSION['usuario']."@pdvsa.com";
							   	$mensaje =  $datos['tx_mensaje']." ".$cedulap." ".$nombrep." ".$det_opcion;
							   }
		elseif ($destino== "SUPERVISOR") {$direccion = $_SESSION['idredsup']."@pdvsa.com";
										 $mensaje =  $datos['tx_mensaje']." ".$cedulap." ".$nombrep." ".$det_opcion;
										 }
			elseif ($destino== "RESPPROCESO") { $direccion = $rproceso."@pdvsa.com";
												$mensaje =  $datos['tx_mensaje']." ".$cedulap." ".$nombrep." ".$det_opcion;
											}
				elseif ($destino== "RESRRHH") { $direccion = $rrhh."@pdvsa.com";
												$mensaje =  $datos['tx_mensaje']." ".$cedulap." ".$nombrep." ".$det_opcion;
											}
											else {$direccion = "xxxxx@pdvsa.com";}	
											
											
											
	
	
	$correo =  $datos['tx_correo'];
    $titulo  = $datos['tx_titulo'];
	
	
	
	
$headers = array ('From' => $correo,      'To' => $direccion,    'Subject' => $titulo);
         $smtp = Mail::factory('smtp',    array ('host' => $host,           'auth' => true,         'username' => $usuario,        'password' => $password));

         $mail = $smtp->send($direccion, $headers, $mensaje);

    
 		 $correo = '';
         $titulo = '';
         $mensaje = '';	
		 $direccion = ''; 



	}
		
?>


	
