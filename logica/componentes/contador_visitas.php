<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

class clscontador
{
	var $fichero,$archivo,$linea,$ano,$mes,$visano,$vismes,$vistotano,$vistotal,$lectura;
	var $numeros=array("../../presentacion/imagenes/0.gif","../../presentacion/imagenes/1.gif",
					   "../../presentacion/imagenes/2.gif","../../presentacion/imagenes/3.gif",
					   "../../presentacion/imagenes/4.gif","../../presentacion/imagenes/5.gif",
					   "../../presentacion/imagenes/6.gif","../../presentacion/imagenes/7.gif",
					   "../../presentacion/imagenes/8.gif","../../presentacion/imagenes/9.gif",);
	function __construct($archivo=visitas)
	{
		$this->$archivo=$archivo;
		$this->fichero=fopen($archivo,"a+");
		$this->lectura=fscanf($this->fichero,"%d\t%s\t%d\t%d\t%d\t%d\n",$this->ano,$this->mes,$this->visano,$this->vismes,$this->vistotano,$this->vistotal);
		$this->cierra_archivo();
		$this->escribe();
	}
	
	function openescribe($archivo=visitas)
	{
		$this->$archivo=$archivo;
		$this->fichero=fopen($archivo,"r+");
	}
	
	function escribe()
	{
		if($this->lectura==null)
			{
				$this->openescribe();
				$this->ano = date("Y");
				$this->mes = date("m");
				$this->visano=1;
				$this->vismes=1;
				$this->vistotano=1;
				$this->vistotal=1;

			}
			elseif($this->ano!= date("Y"))
			{
				$this->openescribe();
				$this->ano=date("Y");
				$this->mes=date("m");
				$this->visano=1;
				$this->vismes=1;
				$this->vistotano=1;
				$this->vistotal=$this->vistotal+1;
			}
			elseif($this->ano==date("Y")&&$this->mes!=date("m"))
			{
				$this->openescribe();
				$this->mes=date("m");
				$this->visano=$this->visano+1;
				$this->vismes=1;
				$this->vistotano=$this->vistotano+1;
				$this->vistotal=$this->vistotal+1;
			}
			elseif($this->ano==date("Y")&&$this->mes==date("m"))
			{
				$this->openescribe();
				$this->visano=$this->visano+1;
				$this->vismes=$this->vismes+1;
				$this->vistotano=$this->vistotano+1;
				$this->vistotal=$this->vistotal+1;
			}
			fwrite($this->fichero,"$this->ano\t$this->mes\t$this->visano\t$this->vismes\t$this->vistotano\t$this->vistotal\r\n");
			$this->cierra_archivo();
			
	}
	function showtotal()
	{
		$cadena=sprintf("%'04d",$this->vistotal);
		echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
		echo "\t\t<tr>\n";
		echo "\t\t<td class=\"link_azul_bold\">Visita N&deg;</td>\n";
		for($i=0;$i<strlen($cadena);$i++)
		{
			echo "\t\t<td><img src=\"".$this->numeros[substr($cadena,$i,1)]."\"></td>\n";
		}
		echo "\t\t</tr>\n";
		echo "\t</table>\n";
	}
	function cierra_archivo()
	{
		if(isset($this->fichero))
		{
		fclose($this->fichero);
	}
	}
}
?>