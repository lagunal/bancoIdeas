<?php
include "class.ConfigMagik.php";

class config{
    public $queryString;
    public $temperaturaAmbiente;
    public $temperaturaReferencia;
    public $humedadRelativa;
    public $costoCombustibleGas;
    public $costoCombustibleLiquido;    
    public $paridadCambiaria;
    public $Cpaire;
    public $densidadAire;
    public $densidadAgua;
    public $eficienciaRadiacionGas;
    public $eficienciaRadiacionLiquido;
    public $nombreAplicacion;
	public $ruta;
    public $rutaAccesos;
    public $rutaQuery;
    
    
     public function obtenerRefineria($codigo){
        $c = count($this->refinerias);
        
        for($i=0; $i<$c; $i++){
            if($this->refinerias[$i]["codigo"] == $codigo){
                return $this->refinerias[$i];
            }
        }
    }
    
    function config(){
    	$path = "../../logica/inc/configBancoIdeas.ini";
    	
		$Config = new ConfigMagik(true, true, $path);

	    $this->queryString = $Config->get('queryString', 'configuracion');
	    $this->temperaturaAmbiente = (float) $Config->get( 'temperaturaAmbiente', 'configuracion');
	    $this->temperaturaReferencia = (float) $Config->get( 'temperaturaReferencia', 'configuracion');
	    $this->humedadRelativa = (float) $Config->get( 'humedadRelativa', 'configuracion');
	    $this->costoCombustibleGas = (float) $Config->get( 'costoCombustibleGas', 'configuracion');
	    $this->costoCombustibleLiquido = (float) $Config->get( 'costoCombustibleLiquido', 'configuracion');
	    $this->paridadCambiaria = (float) $Config->get( 'paridadCambiaria', 'configuracion');
	    $this->Cpaire = (float) $Config->get( 'Cpaire', 'configuracion');
	    $this->densidadAire = (float) $Config->get( 'densidadAire', 'configuracion');
	    $this->densidadAgua = (float) $Config->get( 'densidadAgua', 'configuracion');
	    $this->eficienciaRadiacionGas = (float) $Config->get( 'eficienciaRadiacionGas', 'configuracion');
	    $this->eficienciaRadiacionLiquido = (float) $Config->get( 'eficienciaRadiacionLiquido', 'configuracion');
	    $this->nombreAplicacion = $Config->get( 'nombreAplicacion', 'configuracion');
		$this->idAplicacion = $Config->get( 'idAplicacion', 'configuracion');
 	    $this->rutaSeguridad = $Config->get( 'rutaSeguridad', 'configuracion');
		$this->ruta = $Config->get( 'ruta', 'configuracion');
	    $this->rutaAccesos = $Config->get( 'rutaAccesos', 'configuracion');
	    $this->rutaQuery = $Config->get( 'rutaQuery', 'configuracion');
	    $this->rutaError = $Config->get( 'rutaError', 'configuracion');
	}
}
?>
