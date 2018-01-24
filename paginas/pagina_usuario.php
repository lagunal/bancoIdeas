<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
	extract($_REQUEST);
	//print_r ($_REQUEST);
	include("../../logica/inc/globales.php");
	include ("pagina_obtener_usuario.php");

	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/pdvsastyle.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css">
</head>
<body>
<!-- Se construye el cuerpo de la pagina -->
<table width="400" border="0" cellpadding="0" cellspacing="0">
  <tr>    
	<td colspan="4" >
		
			<span class="Titulo-Aplicacion">Datos Personales </span>
		<span class="Separador_Modulo"></span>	</td>
		  	<td >&nbsp;</td>
  </tr>

	  <tr>
		<td  ></td>
		<td >&nbsp;</td>
	  </tr>
	  <tr>
	        
		<td >&nbsp;</td>
		<td  class="Campo_destacado">C&eacute;dula de identidad:</td>
		<td  class="Campo_consultado"><?php echo   $resultado->ci; ?></td>
	
		<td  height="90" rowspan="4" class="fondofotos">
			<!--<div align="center"> -->
			  <?php 
				$archivo = $gs_ruta.str_pad($resultado->ci, 9, "0", STR_PAD_LEFT).'.jpg';
				 if (!$archivo) {
					$foto="../imagenes/sin_foto.jpg";											
				 }else{
					$foto= $gs_ruta.str_pad($resultado->ci, 9, "0", STR_PAD_LEFT).'.jpg'; }					
				?>
				<img src="<?php echo $foto ?>" width="74" height="76">
			<!--</div> -->
	    </td>
	 </tr>
	 
	 <tr>
		<td >&nbsp;</td>
		<td  class="Campo_destacado">Nombre y Apellido: </td>
		<td class="Campo_consultado"><?php echo substr ($resultado-> nombreApellido,0,30); ?></td>
		
	 </tr>
	 <tr>
	 <td >&nbsp;</td>
	 <td  class="Campo_destacado">Correo: </td>
	 <td  class="Campo_consultado"><?php echo strtoupper ($_SESSION['indicador'])."@PDVSA.COM";?></td>
	 </tr> 
	 <tr>
	 <td >&nbsp;</td>
	 <td class="Campo_destacado">Extensi&oacute;n: </td>
	 <td class="Campo_consultado"><?php echo  $resultado->telefono;?></td> 
	 </tr>
	 <tr>
	 <td >&nbsp;</td>
	 <td  class="Campo_destacado">Localidad:</td>
	 <td colspan="3" class="Campo_consultado"><?php echo  $resultado->localidad;?></td>
	 </tr>
	 <tr>
		<td height="20" colspan="6">&nbsp;</td>
	 </tr>
</table>
</body>
</html>
