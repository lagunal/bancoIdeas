<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

require('../inc/fpdf.php');
include("../../logica/inc/globales.php");
include("../../persistencia/clsPostgre.php");
include("../../persistencia/funcion_bd.php");
extract($_REQUEST);
//print_r($_REQUEST);
switch ($postu){
   case 1:
      $xtitulo = 'REPORTE DE POSTULADOS';
	  break;
   case 2:
      $xtitulo = 'REPORTE DE POSTULADOS - ACEPTADOS';
	  break;
   case 3:
      $xtitulo = 'REPORTE DE POSTULADOS - RECHAZADOS';
	  break;
   case 4:
      $xtitulo = 'REPORTE DE POSTULADOS - TODOS';
	  break;
}

//$xtitulo .= 'Reporte de postulados: '.$titulo;
/*$ini=substr($fechaini,7,4)."-".substr($fechaini,4,2)."-".substr($fechaini,1,2)."\n";
$fin=substr($fechafin,7,4)."-".substr($fechafin,4,2)."-".substr($fechafin,1,2)."\n";
$mes_ini=substr($fechaini,4,2);
echo ' ini='.$ini.' fin='.$fin.' mes_ini='.$mes_ini;*/
$ini = $fechaini;
$fin = $fechafin;
//echo ' ini='.$ini.' fin='.$fin ;
$fechaini = substr($_REQUEST[fechaini],6,4).'-'.substr($_REQUEST[fechaini],3,2).'-'.substr($_REQUEST[fechaini],0,2);
$fechafin = substr($_REQUEST[fechafin],6,4).'-'.substr($_REQUEST[fechafin],3,2).'-'.substr($_REQUEST[fechafin],0,2);


class PDF extends FPDF
{
  var $DisplayPreferences='';
  function DisplayPreferences($preferences) {
    $this->DisplayPreferences.=$preferences;
	}

	function _putcatalog()
	// Esta funcion habilita o inhibe algunas funcalidades del Adobe PDF
	{
    parent::_putcatalog();
    if(is_int(strpos($this->DisplayPreferences,'FullScreen')))
        $this->_out('/PageMode /FullScreen');
    if($this->DisplayPreferences) {
        $this->_out('/ViewerPreferences<<');
        if(is_int(strpos($this->DisplayPreferences,'HideMenubar')))
            $this->_out('/HideMenubar true');
        if(is_int(strpos($this->DisplayPreferences,'HideToolbar')))
            $this->_out('/HideToolbar true');
        if(is_int(strpos($this->DisplayPreferences,'HideWindowUI')))
            $this->_out('/HideWindowUI true');
        if(is_int(strpos($this->DisplayPreferences,'DisplayDocTitle')))
            $this->_out('/DisplayDocTitle true');
        if(is_int(strpos($this->DisplayPreferences,'CenterWindow')))
            $this->_out('/CenterWindow true');
        if(is_int(strpos($this->DisplayPreferences,'FitWindow')))
            $this->_out('/FitWindow true');
        $this->_out('>>');
    							}
	}
	// Fin de la funcion para habilita o inhibe algunas funcalidades del Adobe PDF

	function Header()
	{	
	global $fechaini,$fechafin, $xtitulo, $ini, $fin;
    //echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";

	//Detalles de la Cabecera
	//$this->Image('../imagenes/logorojo_intevep_peq.jpg',10,10,40,10); 
	$this->Image('../imagenes/logorojo.jpg',10,10,60,20); 
	$this->Image('../imagenes/logo_ceenpet00.jpg',230,10,30,30); 

	$this->SetFont('Arial','I',10);
	//$this->Cell(50);
	//$this->Cell(200,10,$dia.' '.$dia2.' de '.$mes.' de '.$ano .date(' g:i a'),0,0,'R');	
	//$this->Cell(180,10,'Fecha: '.date('d/m/y. g:i a'),5,20,'R');
//	$this->Image('../imagenes/logo_GASINT.PNG',220,10,40,10); 
//	$this->SetFont('Arial','I',10);
	$this->Cell(50);
	$this->SetFont('Arial','B',12);
//	$titulo = 
	$this->Cell(150,10,$xtitulo,5,5,'C');
	$this->Cell(150,10,'Desde el '.$ini. ' hasta el '.$fin,5,5,'C');

	$this->Cell(110);
	$this->Ln(15);
	$this->SetFont('Arial','B',14);

	
}
	
function Footer()
	{
		//Funcion para codificar la fecha del reporte a nivel de titulo
			$dia=date("l");
			if ($dia=="Monday") $dia="Lunes";
			if ($dia=="Tuesday") $dia="Martes";
			if ($dia=="Wednesday") $dia="Miércoles";
			if ($dia=="Thursday") $dia="Jueves";
			if ($dia=="Friday") $dia="Viernes";
			if ($dia=="Saturday") $dia="Sabado";
			if ($dia=="Sunday") $dia="Domingo";
			
			// Obtenemos el número del día
			$dia2=date("d");
			
			// Obtenemos y traducimos el nombre del mes
			$mes=date("F");
			if ($mes=="January") $mes="Enero";
			if ($mes=="February") $mes="Febrero";
			if ($mes=="March") $mes="Marzo";
			if ($mes=="April") $mes="Abril";
			if ($mes=="May") $mes="Mayo";
			if ($mes=="June") $mes="Junio";
			if ($mes=="July") $mes="Julio";
			if ($mes=="August") $mes="Agosto";
			if ($mes=="September") $mes="Setiembre";
			if ($mes=="October") $mes="Octubre";
			if ($mes=="November") $mes="Noviembre";
			if ($mes=="December") $mes="Diciembre";	
			$ano=date("Y");
	// Fin Codificacion de fecha para el titulo
	session_start();
	$this->SetY(-15);
	$this->SetFont('Arial','I',8);
	$this->Cell(0,10,'IMPRESO POR: '.$_SESSION["nombre-apellido"].'  '.utf8_decode($dia).' '.utf8_decode($dia2).' de '.utf8_decode($mes).' de '.$ano .date(' g:i a'),0,0,'L');	
	$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' /{nb} ',0,0,'C');
	}
}

	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',9);
	$n = 1;
	$pdf->SetFillColor(192,200,200);
	$pdf->SetFont('Arial','B',9);
//	$pdf->Cell(245,5,'Desde el '.$fechaini. ' hasta el '.$fechafin,5,5,'C');



//	$encabezado = 'Parametro Evaluado                                          ';
	$encabezado = utf8_decode('Cédula');//               Nombre y Apellido                     Grado                           Estudio                       Gerencia                         Fecha                      Estatus   ';
    $pdf->Cell(20,10,$encabezado,0,0,'L',1);
	$pdf->Cell(40,10,'Nombre y Apellidos',0,0,'L',1);
	$pdf->Cell(30,10,'Gerencia',0,0,'L',1);
	$pdf->Cell(40,10,'Grado',0,0,'L',1);
	$pdf->Cell(80,10,'Estudio',0,0,'L',1);
	$pdf->Cell(20,10,'Fecha',0,0,'L',1);
	$pdf->Cell(20,10,'Estatus',0,0,'L',1);
	$pdf->Cell(0,10,'',0,1,'L',1);

	$pdf->SetFont('Arial','UB',10);
	$pdf->Cell(35,5,$titulo,0,1,'J');   
	$pdf->SetFont('Arial','B',9);
$sql=new postgresql();
$query = phf_query(27);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'];
if($postu < 4){$query .= $datos['tx_condicion'];}
if($opcion > 0){$query .= " and f.co_opcion = $opcion "; }
if($co_detalle > 0){$query .= " and a.co_det_opcion = $co_detalle "; }
if($gerencia > 0) {$query .= " and b.co_gerencia = $gerencia"; }
$query .= $datos['tx_ordenado'];
eval("\$query=\"$query\";");
//echo $query;
$filas=$sql->ejecutarsql($query);
$ld_reg = $sql->consulta($query);
$cont = 0;
	while($datos=$ld_reg->fetch(PDO::FETCH_BOTH)){
	      $cont++;
	      $pdf->Cell(20,5,$datos["nu_cedula"],0,0,'J');
	      $pdf->Cell(40,5,$datos["nb_nombre_apellido"],0,0,'J');
	      $pdf->Cell(30,5,$datos["nb_gerencia"],0,0,'J');
	      $pdf->Cell(40,5,$datos["nb_opcion"],0,0,'J');
		  
	      $pdf->Cell(80,5,substr($datos["nb_det_opcion"],0,40),0,0,'J');
//	      $pdf->Cell(20,5,$datos["fe_postulacion"],0,1,'J');
		  
	      $pdf->Cell(20,5,substr($datos[fe_postulacion],8,2)."-".substr($datos[fe_postulacion],5,2)."-".substr($datos[fe_postulacion],0,4),0,0,'J');
	      $pdf->Cell(20,5,$datos["nb_estatus"],0,1,'J');
    }
	      $pdf->Cell(80,5,'TOTAL REGISTROS: '.$cont,0,1,'J');
	
	$pdf->Output();	
?>