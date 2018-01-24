<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

	session_start();
	extract($_REQUEST);
	include("../../logica/inc/globales.php");
	include ("../../persistencia/funcion_bd.php");
	include ("../../persistencia/clsPostgre.php");
	include ("pagina_valida_sesion.php");
?>
<html>
<head>
<title>// <?php echo $titulo_sistema?> //</title> 
	<link rel="stylesheet" type="text/css" href="../css/administracion.css">
	<script type="text/javascript" src="../js/ajax.js"></script>
	<script type="text/javascript" src="../js/tab-view.js"></script>
    <link href="../css/tab-view.css"        rel="stylesheet" type="text/css" media="screen">
	<script language="javascript" type="text/javascript" src="../js/calendarDateInput.js"></script>	
	<script language="javascript" type="text/javascript" src="../js/objajax.js"></script>
	<script language="javascript" type="text/javascript" src="../js/calendarios.js"></script>
	<script language="javascript" type="text/javascript" src="../js/Utilidades.js"></script>
	<link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../css/calendario.css">
	<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
 <?php 	
	if(!isset($fechaini)||$fechaini =='')
		$fechaini="01".date("\-m\-Y");
		
	if (!isset($fechafin)||$fechafin =='')
		$fechafin=date("t\-m\-Y");
		
	if (isset($_GET["fechaini"])){ 
		 $fechaini= $_GET["fechaini"];
								 }
	if (isset($_GET["fechafin"])) {
		 $fechafin= $_GET["fechafin"];	
	}	
//	echo 'FFFFFFF'.$fechaini;
 ?>  
<body topmargin="0">
<form id="form1" name="form1"  action="" method="post">
					<table width="599" height="560" border="0" align="lefth" cellpadding="0" cellspacing="0">
						<!-- area de desarrollo -->
						<tr>
						  <td width="599" height="560" colspan="2" valign="top">
						  <TABLE BORDER="0" width="100%" align="lefth">
                            <TR>
                              <TD colspan="3"><fieldset>
                                <legend align="left" class="Campo_destacado">Per&iacute;odos l&iacute;mites</legend>
                                <TABLE width="561">
                                  <TR>
                                    <TD width="86" align="right" class="Campo_destacado"  id="t_1">Desde</TD>
                                    <TD width="157" style="width:154" ><?php 
				echo "<script>DateInput('fechaini', false, 'DD-MM-YYYY', '$fechaini')</script>";
			  ?>      
 									  
                                    <td width="78" align="right" class="Campo_destacado"  id="t_2">Hasta</TD>
                                    <TD width="220"><?php 
				echo "<script>DateInput('fechafin', false, 'DD-MM-YYYY', '$fechafin')</script>";
			  ?>                                    </TD>
                                  </TR>
                              </TABLE>
							  <input name="cedula" id="cedula" type="hidden" style="visibility:hidden"/>
<input name="nopcion" id="nopcion" type="hidden" style="visibility:hidden"/>
<input name="operacion" id="operacion" type="hidden" style="visibility:hidden"/>

                              </fieldset></TD>
                            </TR>
							
                            <TR>
                              <TD colspan="3" valign="top"><fieldset >
                                <legend align="left" class="Campo_destacado" >Opciones para crear reportes din&aacute;micos</legend>
                                <table width="88%">
                                    <tr>
                                      <td width="30%" rowspan="3" class="Campo_destacado">
                                        <p>
                                          <label>
                                            <input type="radio" name="tipopostu" id="tipopostu1" value="1" onClick="document.getElementById('postu').value = 1">
                                            Postulados</label>
                                          <br>
                                          <label>
                                            <input type="radio" name="tipopostu" id="tipopostu2" value="2" onClick="document.getElementById('postu').value = 2">
                                            Aprobados</label>
                                          <br>
                                      </p></td>
                                      <td width="35%" rowspan="3" class="Campo_destacado">
                                        <p>
                                          <label>
                                          <input type="radio" name="tipopostu" id="tipopostu3" value="3" onClick="document.getElementById('postu').value = 3">									      
                                           Rechazados</label>
                                          <br>
                                          <label>
                                            <input type="radio" name="tipopostu" id="tipopostu4" value="4" onClick="document.getElementById('postu').value = 4">
                                            Todos</label>
                                          <br>
                                      </p></td>
                                      <td><?php 
									$sql=new postgresql();
									$query = phf_query(20);
									$filas=$sql->ejecutarsql($query);
									$ld_query = $sql->consulta($query);
									$datos=$ld_query->fetch(PDO::FETCH_BOTH);
									$query = $datos['tx_query'].$datos['tx_condicion'];
									eval("\$query=\"$query\";");
									$filas=$sql->ejecutarsql($query);
									$ld_reg = $sql->consulta($query);
							        echo"<SELECT type='text' class='Campo_consultado' style='font-size:10px'   style='width:150;height:20;' name='gerencia' id='gerencia'  onchange='refresca_gerencia(this.value)'>";
									echo"<OPTION value=''class='Campo_consultado' style='font-size:10px'>Gerencia...</option>";
									while($datos=$ld_reg->fetch(PDO::FETCH_BOTH)){
										echo"<OPTION value=$datos[co_gerencia] class='Campo_consultado' style='font-size:10px' >$datos[nb_gerencia]";
										}
									echo"</select>"; 
									?></td>
                                      <td colspan="2">&nbsp;</td>
                                  <tr>
                                    <td width="3%"><?php 
									$sql=new postgresql();
									$query = phf_query(22);
									$filas=$sql->ejecutarsql($query);
									$ld_query = $sql->consulta($query);
									$datos=$ld_query->fetch(PDO::FETCH_BOTH);
									$query = $datos['tx_query'].$datos['tx_condicion'];
									eval("\$query=\"$query\";");
									$filas=$sql->ejecutarsql($query);
									$ld_reg = $sql->consulta($query);
							        echo"<SELECT type='text' class='Campo_consultado' style='font-size:10px'  style='width:150;height:20;' name='opcion' id='opcion'  onchange='refresca_detalle_opcion()'>";
									echo"<OPTION value='' class='Campo_consultado' style='font-size:10px'>Grados...</option>";
									while($datos=$ld_reg->fetch(PDO::FETCH_BOTH)){
										echo"<OPTION value=$datos[co_opcion] class='Campo_consultado' style='font-size:10px' >$datos[nb_opcion]";
										}
									echo"</select>"; 
									?>									</td>
                                    <td width="19%"><input name="Actualizar" id="Actualizar" type="button" value="Consultar" onClick="Actualiza(fechaini.value, fechafin.value)" style="width:100" class="boton_login" title="Muestra Reporte Según Parametros Seleccionado">									</td>
                                    <td><img src="../imagenes/icon_pdf.gif" alt="Mostrar en formato PDF" border="0" title="Mostrar en formato PDF" onClick=
"popupcentmaxmin('pagina_reporte_postulados_pdf.php?fechaini='+document.getElementById('xfechaini').value+'&fechafin='+document.getElementById('xfechafin').value+'&postu='+document.getElementById('postu').value+'&opcion='+document.getElementById('opcion').value+'&co_detalle='+document.getElementById('co_detalle').value+'&gerencia='+document.getElementById('gerencia').value,'Reporte','1024','724')" style="cursor:pointer"></td>
                                    <input type="hidden" style="visibility:hidden" id="postu" width="100" name="postu">									
                                  <script language="javascript" type="text/javascript"> 
						          function refresca_detalle_opcion()
						          {
						   		      document.getElementById('form1').target="detalle";
								      document.getElementById('form1').action="pagina_detalle_opciones.php";
								      document.getElementById('form1').submit();
						          }
						          function refresca_gerencia(ger)
								  {
								  document.getElementById('xgerencia').value=ger;
								  
								  
								  }
						   		</script>
                                  <tr>
                                    <td colspan="3"><iframe name="detalle" id="detalle" width="260" height="30" marginheight="0" marginwidth="0"  scrolling="no" frameborder="0" src="pagina_detalle_opciones.php"></iframe></td>
                                  <tr>
                                    <td colspan="5"><iframe name="reporte" id="reporte"  width="560" height="400" marginheight="0" marginwidth="0" align="left" scrolling="si" frameborder="0" src=""></iframe></td>
                                  </tr>
                              </table>
                                <script language="javascript" type="text/javascript"> 
						          function Actualiza(fecha, fecha2)
						          {   var desde, hasta;
								      desde = fecha.substr(6,4)+fecha.substr(3,2)+fecha.substr(0,2);
									  hasta = fecha2.substr(6,4)+fecha2.substr(3,2)+fecha2.substr(0,2);
								  
								      if(hasta < desde)
								      { //alert('Fecha Hasta no debe ser menor a fecha Desde, favor revisar...');
									  
										 parent.parent.document.getElementById('alertas').value= 'D';
										 parent.parent.document.getElementById('alertas').click();   
										return;
									  }
									  
							          document.getElementById('xfechaini').value=fecha;
								      document.getElementById('xfechafin').value=fecha2;
						   		      document.getElementById('form1').target="reporte";
								      document.getElementById('form1').action="pagina_detalle_reporte_postulaciones.php";
								      document.getElementById('form1').submit();
				                  }
						   		</script>
                              </fieldset></TD>
                            </TR>
                          </TABLE>
						 </td>
						</tr>
						<!-- fin area de desarrollo -->
  </table>
	  <!-- linea roja del fondo -->
	  <!-- fin liena roja del fondo -->
</form>
</body>
</html>
<script>
function popupcentmaxmin(url,id,ancho,alto)
	{ 
			var x,y;
			x=(screen.width-ancho)/2;
			y=(screen.height-alto)/2;
			ventana=window.open(url,id,'status=0,resizable=1,width='+ancho+',Height='+alto+',top='+y+',left='+x);
			ventana.focus();
	}
	
function estatusalerta(valor)
    {      //alert(valor);
//	       document.getElementById('soloalerta').value='';
//	       document.getElementByid('chksoloalerta').checked=false;
//	       if(valor == true)
//		   {
		   document.getElementById('alerta').value=valor;
/*		   if(window.document.getElementById('alerta').value=='a')
		   {
		   alert('CON ALERTAS');
		   }
		   else
		   {
		   alert('SIN ALERTAS');
		   }*/
//		   }
		   
//		   if(valor == false)
//		   {document.getElementById('alerta').value=valor}
    }
function estatussoloalerta(valor)
    {   //   document.getElementById('alerta').value='';
	    //   document.getElementByid('chkalerta').checked=true;
	       if(valor == true)
		   {document.getElementById('soloalerta').value=valor}
		   
		   if(valor == false)
		   {document.getElementById('soloalerta').value=valor}
    }

</script>
<input type="hidden" style="visibility:hidden" id="xfechaini" width="100" name="xfechaini">
<input type="hidden" style="visibility:hidden" id="xfechafin" width="100" name="xfechafin">
<input type="hidden" style="visibility:hidden" id="co_detalle" width="100" name="co_detalle">
<input type="hidden" style="visibility:hidden" id="xgerencia" width="100" name="xgerencia">
