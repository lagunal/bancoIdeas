<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

class clienteSeguridadWeb{

	private $wsdl;
	private $resultadoLdap;
	
	 /**
	 *
	 * Constructor de la clase.<br>
	 * @param string $wsdl, url al archivo wsdl de descripcion del servicio web.
	 *
	*/
	public function __construct($wsdl){
	
		$this->wsdl	=	$wsdl;
	}
	
	
	/**
	* Metodo cliente requerido para iniciar la sesion de usuario.<br>
	* Verifica si el usuario esta validado correctamente en el directorio activo.<br>
	* Verifica si el usuario ya esta autenticado en la misma aplicacion desde otro equipo.<br>
	* Registra la sesion de usuario en la base de datos.<br> 
	* @param string $indicador indicador de intranet.
	* @param string $contrasena contrasena de intranet.
	* @param string $aplicacion hash(nombre de la aplicacion solicitante)
	* @param string $modoConexion modo de conexion ( '0' = 1 usuario se conecta desde 1 equipo , '1' = 1 usuario se conecta desde n equipo )
	* @return ObjectSoapClient stdClass  $object->codigoMensaje , $object->descripcion
	* <br><pre>Posibles valores de retorno:
	*  - modoConexion: '0'
	*    -- 'codigoMensaje'=>'01','descripcion'=>'Usuario validado satisfactoriamente.'
	*    -- 'codigoMensaje'=>'02','descripcion'=>'Usuario/clave de usuario invalida'
	*    -- 'codigoMensaje'=>'03','descripcion'=>'Usuario con doble autenticacion'
	*    -- 'codigoMensaje'=>'04','descripcion'=>'Usuario validado satisfactoriamente (Forzando Credenciales por Inactividad).'
	*    -- 'codigoMensaje'=>'05','descripcion'=>'Aplicacion no registrada'
	*  - modoConexion: '1'
	*    -- 'codigoMensaje'=>'01','descripcion'=>'Usuario validado satisfactoriamente.'
	*    -- 'codigoMensaje'=>'02','descripcion'=>'Usuario/clave de usuario invalida'
	*    -- 'codigoMensaje'=>'03','descripcion'=>'Usuario validado satisfactoriamente (Forzando Credenciales).'
	*    -- 'codigoMensaje'=>'05','descripcion'=>'Aplicacion no registrada'</pre>
	*/
	public function iniciarSesion($indicador, $contrasena, $aplicacion, $modoConexion){  
  
         
		     $ip	=	$this->getIp();   
		     $client	=	new SoapClient($this->wsdl);						
			  
			  
			  $parametros =  array(
		               "indicador" => $indicador,
		               "contrasena" => $contrasena,
		               "ip" => $ip,
		               "aplicacion" => $aplicacion,
		               "modo" => $modoConexion);
		           
				$resultado =	$client->__call("SeguridadWeb.iniciarSesion",$parametros);
						
				return $resultado;	
								
	
		
		
  }
  
  /**
	* Metodo requerido para cerrar la sesion de usuario.<br>
   * Elimina la sesion activa de usuario.<br>
	* @param string $indicador indicador de intranet	
	* @param string $aplicacion hash(nombre de la aplicacion solicitante)
	* @return ObjectSoapClient stdClass  $object->codigoMensaje , $object->descripcion
	* <br><pre>Posibles valores de retorno:
	*    -- 'codigoMensaje'=>'01','descripcion'=>'Sesion Finalizada'.
	*    -- 'codigoMensaje'=>'05','descripcion'=>'Aplicacion no registrada'</pre>
	*/
  public function cerrarSesion($indicador, $aplicacion)
  {
   
     $ip	=	$this->getIp();      
     $client	=	new SoapClient($this->wsdl);				
	  $parametros =  array(
               				 "indicador"	=> $indicador,               
              					 "ip" 			=> $ip,
              					 "aplicacion"	=>  $aplicacion);

		$resultado =	$client->__call("SeguridadWeb.cerrarSesion",$parametros);
		return $resultado;
		   
   
  }
  
  /**
	* Conocer el estado del usuario dentro del aplicativo ( activo, inactivo ).<br>
	* @param string $indicador indicador de intranet
	* @param string $aplicacion hash(nombre de la aplicacion solicitante)
	* @return ObjectSoapClient stdClass  $object->codigoMensaje , $object->descripcion  ( activo, inactivo )
	* <br><pre>  Posibles valores de retorno:
	*    -- 'codigoMensaje'=>'01','descripcion'=>'Sesion de Usuario Activa.'
	*    -- 'codigoMensaje'=>'02','descripcion'=>'Sesion de Usuario Inactiva.'
	*    -- 'codigoMensaje'=>'05','descripcion'=>'Aplicacion no registrada'</pre>
	*/
  public function validarSesionUsuario($indicador, $aplicacion)
  {
   
     $ip	=	$this->getIp();      
     $client	=	new SoapClient($this->wsdl);				
	  $parametros =  array(
               			    "indicador" 	=> $indicador,               
              					 "ip" 			=> $ip,
              					 "aplicacion"	=>  $aplicacion);

		$resultado =	$client->__call("SeguridadWeb.validarSesionUsuario",$parametros); 
		
		return $resultado;   
   
  }
  
	/**
	* Validar el tiempo de inactividad del usuario dentro del aplicativo ( sesion expirada, sesion actualizada, no existe la sesion de usuario ).<br>
	* @param string $indicador indicador de intranet
	* @param string $ip direccion ip del equipo solicitante
	* @param string $aplicacion hash(nombre de la aplicacion solicitante)
	* @return ObjectSoapClient stdClass  $object->codigoMensaje , $object->descripcion ( sesion expirada, sesion actualizada, no existe la sesion de usuario )
	* <br><pre> Posibles valores de retorno:
	*    -- 'codigoMensaje'=>'01','descripcion'=>'Sesion de Usuario Inactiva.'
	*    -- 'codigoMensaje'=>'02','descripcion'=>'Sesion de Usuario Actualizada.'
	*    -- 'codigoMensaje'=>'03','descripcion'=>"Sesion de Usuario Expirada.'
	*    -- 'codigoMensaje'=>'05','descripcion'=>'Aplicacion no registrada'</pre>
	*/
  public function validarTiempoSesion($indicador, $aplicacion)
  {
   
     $ip	=	$this->getIp();      
     $client	=	new SoapClient($this->wsdl);				
	  $parametros =  array(
               			    "indicador" 	=> $indicador,               
              					 "ip" 			=> $ip,
              					 "aplicacion"	=>  $aplicacion);

		$resultado =	$client->__call("SeguridadWeb.validarTiempoSesion",$parametros); 
		
		return $resultado;     
   
  }
  
  /**
	* Metodo para obtener los atributos de un usuario registrado en el directorio activo de PDVSA.<br>
   * Validacion directorio activo LDAP - PDVSA.<br>
	* @param string $indicador indicador de intranet
	* @return mixed array $usuario(indicador, nombre, apellido,correo, telefonos, grupos, etc)
	*/
  public function obtenerInfoUsuario($indicador)
  {   
          
     $client	=	new SoapClient($this->wsdl);				
	  $parametros =  array( "indicador" 	=> $indicador );

		$this->resultadoLdap =	$client->__call("SeguridadWeb.obtenerUsuarioLdap",$parametros); 	
		
		return $this->resultadoLdap;     
   
  }
  
	 /**
	 * Obtener la cedula de identidad del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string cedula de identidad
	 */
	public function getCedulaIdentidadUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->ci;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	 /**
	 * Obtener el nombre y apellido del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string nombreApellido
	 */
	public function getNombreApellidoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->nombreApellido;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener el correo electronico del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string mail
	 */
	public function getCorreoElectronicoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->mail;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener gerencia donde trabaja el usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string gerencia
	 */
	public function getGerenciaUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->gerencia;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener la fecha de ingreso a PDVSA del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string fechaIngreso
	 */
	public function getFechaIngresoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->fechaIngreso;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener la fecha de egreso de PDVSA del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string fechaEgreso
	 */
	public function getFechaEgresoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->fechaEgreso;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	
		
	
   /**
	 * Obtener el primer nombre del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string primerNombre
	 */
	public function getPrimerNombreUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->primerNombre;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener el segundo nombre del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string segundoNombre
	 */
	public function getSegundoNombreUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->segundoNombre;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	  
	/**
	 * Obtener el apellido del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string apellido
	 */
	public function getApellidoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->apellido;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	
	
	/**
	 * Obtener el nombre de red del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string nombreRed
	 */
	public function getNombreRedUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->nombreRed;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener el nombre del edificio donde trabaja el usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string edificio
	 */
	public function getNombreEdificioUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->edificio;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	  
	  
	/**
	 * Obtener el nombre de los grupo(s) a los cuales pertenece el usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string grupos
	 */
	public function getNombreGruposUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->grupos;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	  
	  
	 /**
	 * Obtener la nomina a la cual pertenece el usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string nomina
	 */
	public function getNominaUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->nomina;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	
	
	/**
	 * Obtener el area a la cual pertenece el usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string area
	 */
	public function getAreaUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->area;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	  
	  
	 /**
	 * Obtener el telefono del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string telefono
	 */
	public function getTelefonoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->telefono;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener la compania del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string compania
	 */
	public function getCompaniaUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->compania;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}
	
	/**
	 * Obtener la localidad del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string localidad
	 */
	public function getLocalidadUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->localidad;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	
	
	/**
	 * Obtener la oficina de trabajo del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string oficina
	 */
	public function getOficinaUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->oficina;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	 
	
	/**
	 * Obtener la supervisor del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string supervisor
	 */
	public function getSupervisorUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->supervisor;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	 
	
	/**
	 * Obtener el cargo del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string cargo
	 */
	public function getCargoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->cargo;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	 
	
	/**
	 * Obtener el telefono celular del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string celular
	 */
	public function getTelefonoCelularUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->celular;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	 
	
	/**
	 * Obtener la nacionalidad del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string nacionalidad
	 */
	public function getNacionalidadUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->nacionalidad;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	 
	
	/**
	 * Obtener el tipo de empleado del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string tipoEmpleado
	 */
	public function getTipoEmpleadoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->tipoEmpleado;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	 
	
	
	/**
	 * Obtener el numero de empleado del usuario consultado por el directorio activo
	 * Requerido utilizar previamente el metodo obtenerInfoUsuario()
	 * @return string numeroEmpleado
	 */
	public function getNumeroEmpleadoUsuarioLdap() {
	
		if(is_object($this->resultadoLdap))
			return $this->resultadoLdap->numeroEmpleado;
		else
			return 'Informacion No Disponible: Debe utilizar previamente el metodo obtenerInfoUsuario()';
	}	 
	
	  
	 /**
		* Metodo para obtener la direccion Ip de la maquina solicitante del servicio web.<br>
   	* Filtra Ip real del equipo, saltando proxy intermedios.<br>
		* @return string $client_ip direccion ip de la maquina solicitante del servicio web
		*/ 
	  private function getIp()
	  {
	   
	   if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ))
	   {
	      $client_ip =
	         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
	            $_SERVER['REMOTE_ADDR']
	            :
	            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
	               $_ENV['REMOTE_ADDR']
	               :
	               "unknown" );
	   
	      // los proxys van añadiendo al final de esta cabecera
	      // las direcciones ip que van "ocultando". Para localizar la ip real
	      // del usuario se comienza a mirar por el principio hasta encontrar
	      // una dirección ip que no sea del rango privado. En caso de no
	      // encontrarse ninguna se toma como valor el REMOTE_ADDR
	   
	      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
	   
	      reset($entries);
	      while (list(, $entry) = each($entries))
	      {
	         $entry = trim($entry);
	         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
	         {
	            // http://www.faqs.org/rfcs/rfc1918.html
	            $private_ip = array(
	                  '/^0\./',
	                  '/^127\.0\.0\.1/',
	                  '/^192\.168\..*/',
	                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
	                  '/^10\..*/');
	   
	            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
	   
	            if ($client_ip != $found_ip)
	            {
	               $client_ip = $found_ip;
	               break;
	            }
	         }
	      }
	   }
	   else
	   {
	      $client_ip =
	         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
	            $_SERVER['REMOTE_ADDR']
	            :
	            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
	               $_ENV['REMOTE_ADDR']
	               :
	               "unknown" );
	   }
	   
	   return $client_ip;
	   
	}


}
?>

