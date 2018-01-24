<?php
/**
 * Gestiona el acceso a datos mediante funciones ajax<br>
 *
 * @package    Aplicacion
 * @author     Ludwing Laguna
 * @version    1.0
 * @see ajax.funciones.php
 */
/**
* Archivos incluidos
*/

	include ("../clases/presentacion.php");
	include ("../clases/directorioActivo.php");
  	include("../../persistencia/clad.php");

	function limpiarCoautor(){
		$pres = new presentacion();
		$objResponse = new xajaxResponse();
		$tabla = $pres->crearTablaAutores($autores, "Lista-Fondo1", "Lista-Fondo2");
		$objResponse->script("document.getElementById('cmbEmpleado').value ='" . "0"  . "'" );
		$objResponse->script("document.getElementById('idcoautor').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('idSupervisor2').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('nbSupervisor2').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('txtAporte2').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('txtAccion').value ='" . "" . "'" );	
		$objResponse->assign("tabla_detalle","innerHTML",$tabla);


		return $objResponse;
	}

	function coautor($codigo, $nbSupervisor, $idSupervisor, $idcoautor, $txtAporte,  $cmbEmpleado, $valor){
		$clad = new clad();
		$objResponse = new xajaxResponse(); 
		$pres = new presentacion();
		$concurso = $clad->obtenerConcursoActivo();

		$clad->actualizarAutor($codigo, $concurso, $idcoautor, $idSupervisor, $nbSupervisor, $txtAporte, $valor, 3, $cmbEmpleado);
		$objResponse->script("document.getElementById('cmbEmpleado').value ='" . "0"  . "'" );
		$objResponse->script("document.getElementById('idcoautor').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('idSupervisor2').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('nbSupervisor2').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('txtAporte2').value ='" . "" . "'" );
		$autores=$clad->obtenerAutores($codigo, $concurso);
		$tabla = $pres->crearTablaAutores($autores, "Lista-Fondo1", "Lista-Fondo2");
		$objResponse->assign("tabla_detalle","innerHTML",$tabla);	

		return $objResponse;
	}


	function borrador($cmbCodigo, $txtTitulo, $txtResumen, $cmbCategoria, $cmbPropiedad, $cmbArea, $cuadernos, $arte, $informes, $modelo, $prototipo, $otros, $idSupervisor, $nbSupervisor, $txtAporte, $codigo, $indicador){
		$clad = new clad();
		$pres = new presentacion();
		$objResponse = new xajaxResponse(); 
		
		$txtTitulo=strtoupper($txtTitulo);
		$txtAporte=strtoupper($txtAporte);
		$fecha = $pres->obtenerFechaActual();
		$concurso = $clad->obtenerConcursoActivo();
		$clad->actualizarIdea($concurso, $cmbCodigo, $txtTitulo, $txtResumen, $cmbCategoria, $cmbPropiedad, $cmbArea, $fecha, $cuadernos, $arte, $informes, $modelo, $prototipo, $otros, $indicador, $idSupervisor, $nbSupervisor, $txtAporte, $codigo);

		$objResponse->script("document.getElementById('txtTitulo').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('idSupervisor').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('nbSupervisor').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('txtAporte').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('cmbCategoria').value ='" . "0"  . "'" );
		$objResponse->script("document.getElementById('cmbPropiedad').value ='" . "0"  . "'" );
		$objResponse->script("document.getElementById('cmbArea').value ='" . "0"  . "'" );
		$objResponse->script("document.getElementById('txtResumen').value='" . ""  . "'" );
		$objResponse->script("document.getElementById('modelo').checked='" . false  . "'" );
		$objResponse->script("document.getElementById('arte').checked='" . false  . "'" );
		$objResponse->script("document.getElementById('informes').checked='" . false  . "'" );
		$objResponse->script("document.getElementById('otros').checked='" . false  . "'" );
		$objResponse->script("document.getElementById('cuadernos').checked='" . false  . "'" );
		$objResponse->script("document.getElementById('prototipo').checked='" . false  . "'" );

		$objResponse->script("document.getElementById('cmbEmpleado').value ='" . "0"  . "'" );
		$objResponse->script("document.getElementById('idcoautor').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('idSupervisor2').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('nbSupervisor2').value ='" . "" . "'" );
		$objResponse->script("document.getElementById('txtAporte2').value ='" . "" . "'" );	
		$tabla = $pres->crearTablaAutores($autores, "Lista-Fondo1", "Lista-Fondo2");
		$objResponse->assign("tabla_detalle","innerHTML",$tabla);


		return $objResponse;
	}

	function buscarIdea($codigo){
		$clad = new clad();
		$pres = new presentacion();
		$objResponse = new xajaxResponse(); 

		$datos=$clad->obtenerideas($codigo);

		if($datos[0]['lo_modelo']==1) $modelo = true ;
		if($datos[0]['lo_informe_notas']==1) $informe = true ;
		if($datos[0]['lo_arte_previo']==1) $arte = true ;
		if($datos[0]['lo_cuadernos_lab']==1) $cuadernos = true ;
		if($datos[0]['lo_prototipo']==1) $prototipo = true ;
		if($datos[0]['lo_otros']==1) $otros = true ;
		
		$objResponse->script("document.getElementById('txtTitulo').value ='" . $datos[0]['nb_idea'] . "'" );
		$objResponse->script("document.getElementById('idSupervisor').value ='" . $datos[0]['id_supervisor'] . "'" );
		$objResponse->script("document.getElementById('nbSupervisor').value ='" . $datos[0]['nb_supervisor'] . "'" );
		$objResponse->script("document.getElementById('txtAporte').value ='" . $datos[0]['tx_aporte'] . "'" );
		$objResponse->script("document.getElementById('cmbCategoria').value ='" . $datos[0]['co_categoria']  . "'" );
		$objResponse->script("document.getElementById('cmbPropiedad').value ='" . $datos[0]['co_propiedad']  . "'" );
		$objResponse->script("document.getElementById('cmbArea').value ='" . $datos[0]['co_area']  . "'" );
		$objResponse->script("document.getElementById('txtResumen').value='" . $datos[0]['nb_resumen']  . "'" );
		$objResponse->script("document.getElementById('modelo').checked='" . $modelo  . "'" );
		$objResponse->script("document.getElementById('arte').checked='" . $arte  . "'" );
		$objResponse->script("document.getElementById('informes').checked='" . $informe  . "'" );
		$objResponse->script("document.getElementById('otros').checked='" . $otros  . "'" );
		$objResponse->script("document.getElementById('cuadernos').checked='" . $cuadernos  . "'" );
		$objResponse->script("document.getElementById('prototipo').checked='" . $prototipo  . "'" );
		$objResponse->assign("error_1","innerHTML", "");
		$objResponse->assign("error_2","innerHTML", "");
		$concurso = $clad->obtenerConcursoActivo();
		$autores=$clad->obtenerAutores($codigo, $concurso);
		$tabla = $pres->crearTablaAutores($autores, "Lista-Fondo1", "Lista-Fondo2");
		$objResponse->assign("tabla_detalle","innerHTML",$tabla);



		return $objResponse;
	}

	function validar_id($id, $num){
	
		$da = new directorioActivo();
 		$objResponse = new xajaxResponse();  
		$datos = $da->obtenerUsuarioID($id);
		if(isset($datos[0]) && $datos[0]!=""){	// el id es valido
			$data= $da->obtenerValor($id, array($da->cedula, $da->nombre));
			$cadena = str_replace("'", " ",$data[1]);
			if($num==1){
				$objResponse->script("document.getElementById('nbSupervisor').value ='" .  $cadena . "'" );
				$objResponse->assign("error_1","innerHTML", ""); 
			}elseif($num==2){ 
				$objResponse->script("document.getElementById('nbSupervisor2').value ='" .  $cadena . "'" );
				$objResponse->assign("error_2","innerHTML", "");
			}else{
				$objResponse->assign("error_2","innerHTML", "");	
			}
			
			
		}
		else{ // el id no es correcto
			if($num==1){ 
				$objResponse->assign("error_1","innerHTML", "El indicador del supervisor no es correcto"); 
			}elseif($num==2){ 
				$objResponse->assign("error_2","innerHTML", "El indicador del supervisor no es correcto");
			}else{
				$objResponse->assign("error_2","innerHTML", "El indicador del coautor no es correcto");
				$objResponse->script("document.getElementById('idcoautor').select()");	
			} 
		}
		return $objResponse;
	}

	function fijarOrden($padre, $numero, $codigo, $tipo){
		$clad = new clad();
		$pres = new presentacion();
		$objResponse = new xajaxResponse();

		$clad->ActualizarOrden($padre, $numero, $tipo, 0);
		$clad->ActualizarOrden($padre, $numero, $tipo, $codigo);
		$datos = $clad->obtenerMenus();
			$combo = $datos;
		        $filas = count($datos);
			$cont=0;
			for($i = 0; $i < $filas; $i++){
				$fila = $datos[$i];
				if($cont<$filas) $combo[$cont]= $datos[$i];
					for($j = 1; $j < $filas; $j++){
							   
						if($fila['co_menu']==$datos[$j]['co_padre']){
							$cont++;
							$combo[$cont]= $datos[$j];
							for($k=1;$k<=$fila['nu_nivel'];$k++)  $combo[$cont]['nb_menu'] = "--" . $combo[$cont]['nb_menu'];
					}
				}
				$cont++;
			}
			$tabla = $pres->crearTablaMenu($combo, "Lista-Fondo1", "Lista-Fondo2");
			$objResponse->assign("tabla_detalle","innerHTML",$tabla);
		return $objResponse;
	}

	function catalogos($tabla){

		$clad = new clad();
		$pres = new presentacion();
		$objResponse = new xajaxResponse();

		$datos = $clad->obtenerCatalogoDescripcion($tabla);
		$tabla=$pres->crearTablaCatalogos($datos, "Lista-Fondo1", "Lista-Fondo2");

		$objResponse->script("document.getElementById('txtNombre').select()");
		$objResponse->assign("tabla_detalle","innerHTML",$tabla);

		return $objResponse;

	}

	function usuarios($rol){

		$clad = new clad();
		$pres = new presentacion();
		$objResponse = new xajaxResponse();

		$datos = $clad->obtenerUsuariosRoles($rol);
		$tabla=$pres->crearTablaRoles($datos, "Lista-Fondo1", "Lista-Fondo2");

		$objResponse->script("document.getElementById('txtID').select()");
		$objResponse->assign("error","innerHTML", "");
		$objResponse->assign("tabla_detalle","innerHTML",$tabla);

		return $objResponse;

	}

	function cmbCodigos($indicador){

		$clad = new clad();
 		$objResponse = new xajaxResponse();  
		$datos = $clad->obtenerCodigos($indicador);

		$sel="";
		$primero = "";
		$combo = "";
        	$fila = "";
 		$id = "cmbCodigo";$td = "td_combo1";

		$nivel++;
		$combo ="<select id=".$id. " name=" .$id. " class='Detalle' style='WIDTH: 140px' onChange='buscarDescripcionIdea(this)'>";
        	if(isset($primero)) $combo .= "<option value='".$primero."'></option>";
        
        		$filas = count($datos);
		
        		for($i = 0; $i < $filas; $i++){
            			$fila = $datos[$i];
            			
				if($fila['co_idea']==$colValor)
                			$combo .= "<option selected ";
            			else
                			$combo .= "<option ";
				$combo .= "value=\"" . $fila['co_idea'] . "\">" . $fila['id_idea'] . "</option>\n";
				
			}
		$combo.="</select>";

		$objResponse->assign($td,"innerHTML",$combo);
		
		
		return $objResponse;

	}

	require("ajax.common.php");
	$xajax->processRequest();
?>
