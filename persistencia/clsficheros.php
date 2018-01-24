<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

class clsfichero
{
	public $fichero,$archivo;
	public function __construct($archivo,$directorio=dir_destino)
	{
		$this->archivo=$archivo;
		if(is_null($directorio))
			$this->ubicacion=$archivo;
		else
			$this->ubicacion=dir_destino.$archivo;
			
		//echo ' archivo '.$this->ubicacion;
	}
	
	public function leer()
	{
		$this->abrir("r");
		$linea=0;
		$indice=0;
		while(!feof($this->fichero))
		{
			$texto=fgets($this->fichero);

			$campos[$indice]['texto']=$texto;
			$indice++;
				
		}
		return $campos;
	}
	
	public function abrir($modo)
	{
		$this->fichero=fopen($this->ubicacion,$modo);
	}
	
	public function __destruct()
	{
		fclose($this->fichero);
		unset($this->archivo);
		unset($this->fichero);
	}


}



?>