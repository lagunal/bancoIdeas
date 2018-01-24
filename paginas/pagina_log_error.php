<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
extract($_REQUEST);
//extract($_FILES);
include("../../persistencia/clsupload.php");
include("../../persistencia/clsficheros.php");
$archivo = "log_error.txt";
?>
<html>
<head>
<!-- //<link rel="stylesheet" type="text/css" href="../css/style.css"> -->
</head>
<body>
<?php
	$fichero = new clsfichero($archivo,NULL);
	$datos=$fichero->leer();
	$to_registros = count($datos);
	
	$i=0;
?>
		<table width="750">
		<?php //echo ' TOTAL DE REGISTROS='.$to_registros; 
		 while($i<=$to_registros) { 
			$columnas=explode(chr(9),$datos[$i]['texto']);
		?>
			<tr>
				<?php 
					for($n=0;$n<count($columnas);$n++)
						{
							if($columnas[$n]!='')
							{
								echo "<td href=\"#inicio\" align=\"left\" class=\"Tabla-Elemento\">$columnas[$n]</td>\n";
							}
							else
							{
								echo "<td href=\"#inicio\" align=\"left\"  class=\"Tabla-Elemento\"></td>\n";
							}
						}
				?>
			</tr>	
		<?php 
			$i++;
		} ?>
			<tr>
			  <td colspan="6" align="left"  class="Tabla-Elemento">Total Registros: <?php echo $to_registros;?></td>
			</tr>
		</table>
</body>
</html>