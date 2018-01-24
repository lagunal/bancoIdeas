	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />

<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

extract($_REQUEST);
//print_r($_REQUEST);
include ("../../logica/inc/globales.php");
include ("../../persistencia/funcion_bd.php");
include ("../../persistencia/clsPostgre.php");
$xfechaini = substr($_REQUEST[fechaini],6,4).'-'.substr($_REQUEST[fechaini],3,2).'-'.substr($_REQUEST[fechaini],0,2);
$xfechafin = substr($_REQUEST[fechafin],6,4).'-'.substr($_REQUEST[fechafin],3,2).'-'.substr($_REQUEST[fechafin],0,2);
$fechaini = substr($_REQUEST[fechaini],6,4).'-'.substr($_REQUEST[fechaini],3,2).'-'.substr($_REQUEST[fechaini],0,2);
$fechafin = substr($_REQUEST[fechafin],6,4).'-'.substr($_REQUEST[fechafin],3,2).'-'.substr($_REQUEST[fechafin],0,2);

//echo $fechaini;
//print_r($_REQUEST);
//echo $cedula;
//echo $opcion;

if($operacion == 'APROBAR')
{
$sql=new postgresql();
$nestatus = 2;
$query = phf_query(32);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
//echo $query;
$filas=$sql->ejecutarsql($query);
	 if($filas > 0)
	 { include("pagina_correo_admin.php");?> 
	 <script>
	 parent.parent.document.getElementById('alertas').value= 'U';
	 parent.parent.document.getElementById('alertas').click();</script>
	
	<?PHP 
	}
     else
	 {?> 
 	 <script>
	 parent.parent.document.getElementById('alertas').value= 'E';
	 parent.parent.document.getElementById('alertas').click();</script>
	
     <?PHP	  
}
	 echo "<script> parent.document.getElementById('operacion').value = '' </script>";
	 echo "<script> parent.document.getElementById('nopcion').value = '' </script>";
	 echo "<script> parent.document.getElementById('cedula').value = '' </script>";
}
if($operacion == 'RECHAZAR')
{
$sql=new postgresql();
$nestatus = 3;
$query = phf_query(32);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'].$datos['tx_condicion'];
eval("\$query=\"$query\";");
//echo $query;
$filas=$sql->ejecutarsql($query);
	 if($filas > 0)
	 { include("pagina_correo_admin.php");?> 
	 <script>
	 parent.parent.document.getElementById('alertas').value= 'U';
	 parent.parent.document.getElementById('alertas').click();</script>
	
	<?PHP 
	}
     else
	 {?> 
 	 <script>
	 parent.parent.document.getElementById('alertas').value= 'E';
	 parent.parent.document.getElementById('alertas').click();</script>
	
     <?PHP	  
}
	 echo "<script> parent.document.getElementById('operacion').value = '' </script>";
	 echo "<script> parent.document.getElementById('nopcion').value = '' </script>";
	 echo "<script> parent.document.getElementById('cedula').value = '' </script>";
}
switch ($postu) {
case 1;
   $xwhere = ' fe_postulacion >= '.$fechaini.' and fe_postulacion <= '.$fechafin.' and co_estatus = '.$postu;
   break;
case 2;
   $xwhere = ' fe_postulacion >= $fechaini and fe_postulacion <= $fechafin and co_estatus = $postu ';
   break;
case 3;
   $xwhere = ' fe_postulacion >= $fechaini and fe_postulacion <= $fechafin and co_estatus = $postu ';
   break;
case 4;
   $xwhere = ' fe_postulacion >= $fechaini and fe_postulacion <= $fechafin and co_estatus = $postu ';
   break;
   
}
$sql=new postgresql();

$query = phf_query(27);
$filas=$sql->ejecutarsql($query);
$ld_query = $sql->consulta($query);
$datos=$ld_query->fetch(PDO::FETCH_BOTH);
$query = $datos['tx_query'];
if($postu < 4){$query .= $datos['tx_condicion'];}
if($opcion > 0){$query .= " and f.co_opcion = $opcion "; }
if($co_detalle > 0){$query .= " and a.co_det_opcion = $co_detalle "; }
if($gerencia > 0) {$query .= " and b.co_gerencia = $gerencia "; }
$query .= $datos['tx_ordenado'];
eval("\$query=\"$query\";");
//echo $query;
$filas=$sql->ejecutarsql($query);
//if ($filas == 0){echo 'LA CONSULTA NO ARROJO RESULTADOS...'; return; }
$ld_reg = $sql->consulta($query);
?>
<table width="200" border="1">
  <tr>
    <th class='Tabla-Elemento-Encabezado'>Cédula</th>
    <th class='Tabla-Elemento-Encabezado'>Nombre y Apellido</th>
    <th class='Tabla-Elemento-Encabezado'>Opción</th>
    <th class='Tabla-Elemento-Encabezado'>Detalle Opción</th>
    <th class='Tabla-Elemento-Encabezado'>Fecha</th>
<!--    <th class='Tabla-Elemento-Encabezado'>Gerencia</th>
    <th class='Tabla-Elemento-Encabezado'>Estatus</th>-->
  
<?php 
if($postu ==1)
   {
   echo "<th class='Tabla-Elemento-Encabezado'></th>";
   echo "<th class='Tabla-Elemento-Encabezado'></th>";
   }
$style = '';
$i = 1;
$cuantos = 0;
echo "</tr>";
while ($datos=$ld_reg->fetch(PDO::FETCH_BOTH)){
   $style = "Tabla-Elemento-Claro";
   if ($i % 2 != 0) { $style = "Tabla-Elemento-Oscuro";  }
   $i++;
   $cuantos++;
   echo "<tr>";
   echo "<td class = $style>".$datos[nu_cedula]."</td>";
   echo "<td class = $style>".$datos[nb_nombre_apellido]."</td>";
   echo "<td class = $style>".$datos[nb_opcion]."</td>";
   echo "<td class = $style>".$datos[nb_det_opcion]."</td>";
   echo "<td class = $style>".substr($datos[fe_postulacion],8,2)."-".substr($datos[fe_postulacion],5,2)."-".substr($datos[fe_postulacion],0,4)."</td>";
//   echo "<td class = $style>".$datos[nb_gerencia]."</td>";
//   echo "<td class = $style>".substr($datos[nb_estatus],0,5)."</td>";
   if($postu ==1)
      {
      echo "<td class = $style><img src='../imagenes/dialog-error.png' name='boton_consultar' width='25' height='25' border='0' id='boton_consultar' style='cursor:pointer' title='Rechazar la postulación' onClick='rechazar($datos[nu_cedula], $datos[co_det_opcion] )' value='ver'>   </td>";
      echo "<td class = $style><img src='../imagenes/dialog-ok.png' name='boton_consultar' width='25' height='25' border='0' id='boton_consultar' style='cursor:pointer' title='Aprobar la postulación' onClick='aprobar($datos[nu_cedula], $datos[co_det_opcion] )' value='ver'>   </td>";
      }
   echo "</tr>";
};
echo "<tr><td class = 'Tabla-Elemento-Encabezado'>Total Registros</td><td class = 'Tabla-Elemento-Encabezado'>$cuantos</td></tr>";




?>
</table>
<script>
function rechazar(cedula, opcion, noper)
{
parent.document.getElementById('cedula').value = cedula;
parent.document.getElementById('nopcion').value = opcion;
parent.document.getElementById('operacion').value = 'RECHAZAR';
parent.document.getElementById('Actualizar').click();
}

function aprobar(cedula, opcion, noper)
{
parent.document.getElementById('cedula').value = cedula;
parent.document.getElementById('nopcion').value = opcion;
parent.document.getElementById('operacion').value = 'APROBAR';
parent.document.getElementById('Actualizar').click();
}

</script>