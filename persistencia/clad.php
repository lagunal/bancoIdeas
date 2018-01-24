<?php
/**
 * Gestiona el acceso a la base de datos<br>
 *
 * @package    Aplicacion
 * @author     Ludwing Laguna
 * @version    1.0
 * @see clad.php
 */
/**
* Archivos incluidos
*/

include "postgresqlHelper.php";
include_once "config.php";
  
class clad{
	private $pgHelper;

	private $ruta;
	
	function clad($conString=""){
		$this->ruta = "http://www.intevep.pdv.com/";
		
        if($conString==""){
            $conf = new config();
            $conString = $conf->queryString;
        }
        
        $this->pgHelper = new postgresqlHelper($conString);
    }

    public function setConectionString($conString){
        $this->conectionString=$conString;
    }

//BUSCADOR
	private function crearAND($patron, $datos, $and=false){
		$cadena = "";
		
		$datos = strtolower($datos);
		$trozos = explode(" ", $datos);

		foreach($trozos as $llave=>$valor){
			if($valor!=""){
				if($and) $cadena .= " AND ";

				$cadena .= str_replace("$", $valor, $patron);
			
				$and = true;
			}
		}
		
		return $cadena;
	}
	


//PÃGINA PRINCIPAL

/**
   * funcion que permite agregar el error de alguna de las aplicaciones al archivo log<br>
   * @param string $num_err numero de error originado
   * @param string $cadena_err descripcion del error
   * @param string $linea_err lugar donde se origina el error
   * @param string $errorcontext contexto donde se origina el error
   */
    public function agregarError($num_err, $cadena_err, $archivo_err, $linea_err, $errcontext){
        return $this->pgHelper->actualizarDatos("SELECT func_insert_error($1, $2, $3, $4, $5);", array($num_err, $cadena_err, $archivo_err, $linea_err, $errcontext));
    }

    public function buscarCatalogo($cmbCatalogo, $txtNombre){
    	$query = "SELECT co_descripcion FROM bancoideas.t08_catalogo WHERE co_tabla = $cmbCatalogo and nb_descripcion='$txtNombre'";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }
	
    public function obtenerRecursos(){
        $query = "select * from bancoideas.t05_recursos re where re.lo_status = 0  ";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerMenus(){
        $query = "select * from bancoideas.t01_menu where co_padre !=0 order by  co_padre, nu_orden";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerCatalogos(){
        $query = "select * from bancoideas.t07_tablas_catalogo order by nb_tabla";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerDescripcionCatalogos($tabla){
        $query = "select * from bancoideas.t08_catalogo where co_tabla = $tabla and lo_status=0 order by nb_descripcion";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerideas($codigo){
        $query = "select * from bancoideas.t20_ideas ideas, bancoideas.t21_autores autor where autor.co_idea=ideas.co_idea and ideas.co_idea=$codigo";

        return $this->pgHelper->obtenerDatos($query);
    }
   

    public function obtenerCodigos($id){
        $query = "select autor.co_idea, ideas.id_idea, autor.co_rol from bancoideas.t20_ideas ideas, bancoideas.t21_autores autor where autor.co_idea=ideas.co_idea and autor.id_usuario = '$id' order by ideas.co_idea";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function bloquearCatalogo($codigo, $opcion, $cmbCatalogo){
    	$query = "update bancoideas.t08_catalogo set lo_status = $opcion WHERE co_descripcion=$codigo and co_tabla=$cmbCatalogo";
    	
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function bloquearMenu($codigo, $opcion){
    	$query = "update bancoideas.t01_menu set lo_visible = $opcion WHERE co_menu=$codigo;";
    	
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function bloquearUsuario($id, $opcion){
    	$query = "update bancoideas.t02_usuarios set lo_bloqueado = $opcion WHERE id_usuario='$id';";
    	
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function obtenerCatalogoDescripcion($codigo){
        $query = "SELECT * from bancoideas.t08_catalogo t07, bancoideas.t07_tablas_catalogo t06 where t07.co_tabla=t06.co_tabla and t07.co_tabla=$codigo order by t07.nb_descripcion";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerAutores($codigo, $concurso){
        $query = "select * from bancoideas.t21_autores where co_idea = $codigo and co_concurso=$concurso order by co_rol";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function ActualizarOrden($padre, $numero, $tipo, $codigo){
    	
	if($tipo==1) {$valor=$numero - 1;}else{ $valor=$numero + 1;}
	if($codigo==0){
		$query = "update bancoideas.t01_menu set nu_orden = $valor where co_padre=$padre and nu_orden=$numero";
        }else{ 
		$query = "update bancoideas.t01_menu set nu_orden = $numero where co_menu=$codigo";
	}

	return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function actualizarConcurso($txtNombre, $desde, $hasta, $codigo){
    	
    	$query = "";
    	$maximo = $this->buscarConcursoMaximo();
	$maximo++;
	if($codigo==0)
		$query = "INSERT INTO bancoideas.t24_concurso (co_concurso, nb_concurso, fe_inicio, fe_fin, lo_status) VALUES ($maximo, '$txtNombre', '$desde', '$hasta', 0)";
	else
		$query = "update bancoideas.t24_concurso set nb_concurso = '$txtNombre', fe_inicio='$desde', fe_fin='$hasta' where co_concurso=$codigo";
        
	return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function buscarConcursoMaximo(){
    	$query = "SELECT max(co_concurso) FROM bancoideas.t24_concurso";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function buscarIdeaMaximo($concurso){
    	$query = "SELECT max(co_idea) FROM bancoideas.t20_ideas where co_concurso=$concurso";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function actualizarAutor($maximo, $concurso, $indicador, $idSupervisor, $nbSupervisor, $txtAporte, $codigo, $rol, $cmbEmpleado){
    	
    	$query = "";
	if($codigo==0){
		$query = "INSERT INTO bancoideas.t21_autores (co_idea, co_concurso, id_usuario, co_tipo_empleado, id_supervisor, nb_supervisor, tx_aporte, co_rol, lo_status) VALUES ($maximo, $concurso, '$indicador', $cmbEmpleado, '$idSupervisor', '$nbSupervisor', '$txtAporte', $rol, 0)";
	}else{
		$query = "update bancoideas.t21_autores set id_supervisor='$idSupervisor', nb_supervisor='$nbSupervisor', tx_aporte='$txtAporte' where co_idea=$codigo and id_usuario='$indicador'";
	}
	return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function actualizarIdea($concurso, $cmbCodigo, $txtTitulo, $txtResumen, $cmbCategoria, $cmbPropiedad, $cmbArea, $fecha, $cuadernos, $arte, $informes, $modelo, $prototipo, $otros, $indicador, $idSupervisor, $nbSupervisor, $txtAporte, $codigo){
    	
    	$query = "";
    	$maximo = $this->buscarIdeaMaximo($concurso);
	$maximo++;
	$this->actualizarAutor($maximo, $concurso, $indicador, $idSupervisor, $nbSupervisor, $txtAporte, $codigo, 2, 1);
	if($codigo==0){
		list($anio,$mes,$dia)=explode("-",$fecha);
		$id_idea = "BOR" . "-" . $maximo . "-" . $anio;
		if($this->buscarRolUsuarios($indicador, 2)==0) $this->insertarRol($indicador,2);
		$query = "INSERT INTO bancoideas.t20_ideas (co_idea, co_concurso, id_idea, nb_idea, nb_resumen, co_categoria, co_propiedad, co_area, fe_idea, tx_observacion, lo_cuadernos_lab, lo_arte_previo, lo_informe_notas, lo_modelo, lo_prototipo, lo_otros, lo_aceptacion) VALUES ($maximo, $concurso, '$id_idea', '$txtTitulo', '$txtResumen', $cmbCategoria, $cmbPropiedad,  $cmbArea, '$fecha', '', $cuadernos, $arte, $informes, $modelo, $prototipo, $otros, 0)";
	}else{
		$query = "update bancoideas.t20_ideas set nb_idea='$txtTitulo', nb_resumen='$txtResumen',co_categoria=$cmbCategoria, co_propiedad=$cmbPropiedad, co_area=$cmbArea, lo_cuadernos_lab=$cuadernos, lo_arte_previo=$arte, lo_informe_notas=$informes, lo_modelo=$modelo, lo_prototipo=$prototipo, lo_otros=$otros   where co_idea=$codigo";
	}
        
	return $this->pgHelper->actualizarDatos($query,array(),$id);
    }


    public function actualizarCatalogo($txtNombre, $cmbCatalogo, $codigo){
    	
    	$query = "";
    	$maximo = $this->buscarCatatogoMaximo($cmbCatalogo);
	$maximo++;
	if($codigo==0)
		$query = "INSERT INTO bancoideas.t08_catalogo (co_tabla, co_descripcion, nb_descripcion, lo_status) VALUES ($cmbCatalogo, $maximo, '$txtNombre',0)";
	else
		$query = "update bancoideas.t08_catalogo set nb_descripcion = '$txtNombre' where co_descripcion=$codigo and co_tabla=$cmbCatalogo";
        
	return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function actualizarMenu($txtNombre, $txtUrl, $cmbPadre, $cmbRecurso, $txtOrden, $visible, $codigo){
    	
    	$query = "";
	$datos = $this->buscarNivelMenu($cmbPadre);
    	$maximo = $this->buscarMenuMaximo();
	$nivel=$datos[0]['nu_nivel'];
	$maximo++;$nivel++;
	if($datos[0]['lo_subnivel']==1 && $codigo==0) {$this->actualizarPadre($cmbPadre);}
	if($codigo==0)
		$query = "INSERT INTO bancoideas.t01_menu (co_menu, co_recurso, nb_menu, nb_url, co_padre, nu_nivel, nu_orden, lo_subnivel, lo_visible) VALUES ($maximo, $cmbRecurso, '$txtNombre', '$txtUrl', $cmbPadre, $nivel, $txtOrden, 1, $visible)";
	else
		$query = "update bancoideas.t01_menu set nb_menu = '$txtNombre', nb_url='$txtUrl', co_padre=$cmbPadre, nu_orden=$txtOrden, co_recurso=$cmbRecurso, nu_nivel=$nivel, lo_visible=$visible  where co_menu=$codigo";
        
	return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function actualizarPadre($padre){
    	$query = "update bancoideas.t01_menu set lo_subnivel=0 where co_menu = $padre";
    	
    	return $this->pgHelper->obtenerDatos($query);
    }

    public function buscarNivelMenu($padre){
    	$query = "SELECT nu_nivel, lo_subnivel FROM bancoideas.t01_menu where co_menu = $padre";
    	
    	return $this->pgHelper->obtenerDatos($query);
    }

    public function buscarMenuMaximo(){
    	$query = "SELECT max(co_menu) FROM bancoideas.t01_menu";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function buscarCatatogoMaximo($cmbCatalogo){
    	$query = "SELECT max(co_descripcion) FROM bancoideas.t08_catalogo where co_tabla=$cmbCatalogo";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function obtenerRol($id){
        $query = "SELECT ro.co_rol FROM bancoideas.t02_usuarios us, bancoideas.t03_roles ro, bancoideas.t04_usuario_rol ur where us.id_usuario=ur.id_usuario and ro.co_rol=ur.co_rol and us.id_usuario='$id'";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function consultarBloqueoUsuario($id){
        $query = "SELECT lo_bloqueado FROM bancoideas.t02_usuarios where id_usuario='$id'";

        return $this->pgHelper->obtenerEscalar($query);
    }

  /**
   * funcion que obtiene los roles<br>
   * @return $res un arreglo con las descripciones de los roles
   */
    public function obtenerRoles(){
        $query = "SELECT * FROM bancoideas.t03_roles order by co_rol";

        return $this->pgHelper->obtenerDatos($query);
    }

	private function obtenerArreglo($datos){
		$res = array();
		
		foreach($datos as $llave=>$valor){
			foreach($valor as $llave2=>$valor2){
				$res[]= $valor2;
			}
		}
		
		return $res;
	}

  /**
   * funcion que obtiene la cantidad de usuarios con rol administrador<br>
   * @return int un numero que indica la cantidad de usuarios con rol admininstrador
   */
    public function buscarUsuariosAdministradores(){
    	$query = "SELECT count(us.id_usuario) FROM bancoideas.t02_usuarios us, bancoideas.t03_roles ro, bancoideas.t04_usuario_rol ur where us.id_usuario=ur.id_usuario and ro.co_rol=ur.co_rol and ro.co_rol = 1 and us.lo_bloqueado=0";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function buscarConcursoActivo(){
    	$query = "select count(*) from bancoideas.t24_concurso where lo_status=0";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function buscarRolUsuarios($id, $rol){
    	$query = "select count(id_usuario) from bancoideas.t04_usuario_rol WHERE id_usuario='$id' and co_rol=$rol";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function buscarRecursosUsuario($id){
	
	if($this->buscarUsuario($id)==0){
		$this->insertarUsuario($id);
		$this->insertarRol($id,6);
	}

    	$query = "select re.nb_recurso from bancoideas.t02_usuarios us, bancoideas.t03_roles ro, bancoideas.t04_usuario_rol ur, bancoideas.t05_recursos re, bancoideas.t06_rol_recurso rr where us.id_usuario=ur.id_usuario and ro.co_rol=ur.co_rol and rr.co_recurso=re.co_recurso and ro.co_rol = rr.co_rol and us.id_usuario=lower('$id')";
    	
    	return $this->obtenerArreglo($this->pgHelper->obtenerDatos($query));
    }

    public function insertarRol($id, $rol){
    	$id = strtolower($id);
    	$query = "";
	$query = "INSERT INTO bancoideas.t04_usuario_rol (id_usuario, co_rol) VALUES ('$id',$rol);";

        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function insertarUsuario($id){
    	$id = strtolower($id);
    	$query = "";
	$query = "INSERT INTO bancoideas.t02_usuarios (id_usuario, lo_bloqueado) VALUES ('$id',0);";

        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function obtenerConcursos(){
        $query = "select * from bancoideas.t24_concurso";
	
        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerConcursoActivo(){
        $query = "select co_concurso from bancoideas.t24_concurso where lo_status=0";
	
        return $this->pgHelper->obtenerEscalar($query);
    }

    public function bloquearConcurso($fecha, $tipo){
    	$query = "";
	if($tipo==1) $query = "update bancoideas.t24_concurso set lo_status=1 where fe_fin<'$fecha'";
	if($tipo==0) $query = "update bancoideas.t24_concurso set lo_status=0 where fe_fin>'$fecha'";
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

  /**
   * funcion para obtener los roles de los usuarios<br>
   * @return string un arreglo con los nombres de los roles
   */
    public function obtenerUsuariosRoles($rol){
        $query = "select * from bancoideas.t02_usuarios us, bancoideas.t03_roles ro, bancoideas.t04_usuario_rol ur WHERE us.id_usuario=ur.id_usuario and ro.co_rol=ur.co_rol and ro.co_rol=$rol order by us.id_usuario";

        return $this->pgHelper->obtenerDatos($query);
    }

  /**
   * funcion para conocer si esta autorizado a entrar al sistema <br>
   * @param int $id indicador del usuario
   * @return int entero que indica si se encuentra autorizado: 0 no 1 si
   */
    public function buscarUsuario($id){
    	$query = "SELECT count(id_usuario) FROM bancoideas.t02_usuarios WHERE id_usuario=LOWER('$id');";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function obtenerMenu(){
        $query = "select me.nb_menu, me.nb_url, me.co_menu, me.co_padre, re.nb_recurso, me.lo_subnivel from bancoideas.t01_menu me, bancoideas.t05_recursos re where me.co_recurso = re.co_recurso and me.lo_visible = 0 order by  me.nu_orden";

        return $this->pgHelper->obtenerDatos($query);
    }



  /**
   * funcion para eliminar un usuario del sistema<br>
   * @param string $id indicador del usuario
   */
    public function eliminarUsuarioRol($id){
    	$query = "DELETE FROM t_usuarios WHERE id=LOWER('$id');";
    	
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }


  /**
   * funcion para actualizar el rol del usuario<br>
   * @param string $id indicador del usuario
   * @param int $rol codigo rol
   */	
    public function actualizarUsuarioRol($id, $rol, $codigo){
    	$id = strtolower($id);

    	$query = "";
    	
    	if($codigo==0){
		if($this->buscarUsuario($id)==0){$this->insertarUsuario($id);}
    		$query = "INSERT INTO bancoideas.t04_usuario_rol (id_usuario, co_rol) VALUES ('$id', $rol);";
    	}else{
    		$query = "update bancoideas.t04_usuario_rol SET co_rol=$rol WHERE id_usuario='$id' and co_rol=$codigo";
    	}
    	 
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

}
?>
