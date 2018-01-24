<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

class upload
{
	public $nombre,$tipo,$tmp_ubicacion, $error,$peso,$destino;
	public function  __construct($origen,$destino=dir_destino)
	{
		$this->nombre=$_FILES[$origen]['name'];
		$this->tipo=$_FILES[$origen]['type'];
		$this->tmp_ubicacion=$_FILES[$origen]['tmp_name'];
		$this->error=$_FILES[$origen]['error'];
		$this->peso=$_FILES[$origen]['size'];
		$this->destino=$destino;
	}
	
	public function copiar()
	{
		if(is_uploaded_file($this->tmp_ubicacion))
		{
			try
			{
				$r=@copy($this->tmp_ubicacion,$this->destino.$this->nombre);
				if($r!==true)
				{
					throw new Exception("Disculpe a ocurrido un error al intentar copiar el archivo en el servidor. Consulte al administrador del sistema",23);
				}
			}
			catch(Exception $error)
			{
				$this->errores($error->getMessage());
				$this->__destruct();
				exit;
			}
		}
	}
	public function errores($mensage)
	{
			echo "<table width=\"350\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n
			  <tr>\n
        		<td align=\"center\"><a href=\"{$_SERVER['HTTP_REFERER']}\" class=\"Vea_Mas_Informa\">&laquo;&nbsp;Volver</a></td>\n
      		  </tr>\n
		      <tr>\n
        	  	<td><label class=\"Cuerpo\">Error:&nbsp;$mensage</label></td>\n
      		  </tr>\n
			  <tr>\n
        		<td align=\"center\"><a href=\"{$_SERVER['HTTP_REFERER']}\" class=\"Vea_Mas_Informa\">&laquo;&nbsp;Volver</a></td>\n
      		  </tr>\n
    		 </table>\n";
	
	}
	public function __destruct()
	{
		unset($this->nombre);
		unset($this->tipo);
		unset($this->tmp_ubicacion);
		unset($this->error);
		unset($this->peso);
		unset($this->destino);
	}

}


?>