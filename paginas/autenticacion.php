<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
session_start();
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); 
extract($_REQUEST);
include("../../logica/inc/globales.php");
include_once "../../persistencia/cargarLog.php";
$mensaje = "&raquo; Autenticaci&oacute;n requerida &laquo;";
// captura el url de la pagina, para permitir agregarla  a favoritos 
$url= 'http://'.($_SERVER['HTTP_HOST']).($_SERVER['PHP_SELF']); 
$describeURL="( ".$gs_esquema." ) - ".$titulo_sistema;
$log = new Log();
include_once "../../persistencia/clad.php";
$clad = new clad();
include ("../clases/presentacion.php");
$pres = new presentacion();

// Aqui se ejecuta el control de acceso utilizando el WS, luego de pulsar el boton ingresar //
if (isset($_POST["btn_ingresar"]))
{		
	if($clad->consultarBloqueoUsuario($_POST['txt_usuario'])==0){
	// conexión al WS utilizando el indicador, contraseña, aplicación y modoconexion	   
	require_once("class.clienteSeguridadWeb.php");
	$client = new clienteSeguridadWeb($ruta);
	$indicador=$_POST["txt_usuario"];
	$_SESSION['indicador'] = $_POST["txt_usuario"];
	$usuario=$_POST["txt_usuario"];
	$_SESSION['usuario']=$_POST["txt_usuario"];
	$contrasena=$_POST["txt_clave"];
	$modoConexion = '0';
	$resultado=$client->iniciarSesion($indicador, $contrasena, $aplicacion, $modoConexion);
	$_SESSION['codigosesion']=$resultado->codigoMensaje;
	$fecha=$pres->obtenerFechaActual(); 
	$clad->bloquearConcurso($fecha, 1);
	$clad->bloquearConcurso($fecha, 0);

	
	if($resultado->codigoMensaje==99) 
	{
		$mensaje =  "» ERROR: No se ha podido establecer la conexión con el servicio web «";
		//echo "<script language=\"javascript\" type=\"text/javascript\">document.form1.__ac_name.focus();</script>"; 
	}elseif ($resultado->codigoMensaje==02) 
	{ 
		if(codificar($_POST["txt_clave"])==codificar(claveactual())) 
			{
			// conexión al WS solo con el indicador del usuario			   		
			include_once('class.clienteSeguridadWeb.php');
			$client = new clienteSeguridadWeb($ruta);
			$resultado=$client ->obtenerInfoUsuario($indicador);
			$_SESSION["nombre-apellido"] = 	$resultado->nombreApellido;
			$_SESSION["cedula"] = $resultado->ci;
			$_SESSION["localidad"] = $resultado->localidad;
			
			// if(strpos($this->item[0]["pdvsacom-ad-buildingname"][0],'INTEVEP')!==false)
			$gs_cedula = $resultado->ci;
			$gs_localidad = $resultado->localidad;
			//echo 'localidad = '.strtoupper($gs_localidad) ;
			if($gs_cedula=='')
			{
				$mensaje = "» ALERTA: Nombre de usuario o contraseña inválida «";
				//echo "<script language=\"javascript\" type=\"text/javascript\">document.form1.__ac_name.focus();</script>"; 
				$log->guardarLog($log->logAccesos, "LOGIN", $_POST['indicador'] . "NO");
				if (isset($denegar)) 
				{ 
				$denegar=$denegar + 1; 
				}else 
				{
				$denegar= 1;	
				}	
				// SE RESTRINGE EL ACCESO A PERSONAL DE INTEVEP	luego de la evalución de SL
			}
			elseif (strtoupper($gs_localidad) =='INTEVEP' || strtoupper($gs_localidad) =='LOS TEQUES' ) 
			{	
				$pag= "principal.php";
				$log->guardarLog($log->logAccesos, "LOGIN", "OK");
				header("Location: ".$pag);
			}else 
			
			{
				$mensaje = "» ALERTA: Disculpe el acceso esta limitado a personal de PDVSA Intevep «";
				//echo "<script language=\"javascript\" type=\"text/javascript\">document.form1.__ac_name.focus();</script>"; 
				$log->guardarLog($log->logAccesos, "LOGIN", $_POST['indicador'] . "NO");
				if (isset($denegar)) 
				{ 
					$denegar=$denegar + 1; 
				}else 
				{
					$denegar= 1;	
				}	
			
			} 
		}else 
		{
			$mensaje = "» ALERTA: Nombre de usuario o contraseña inválida «";
			//echo "<script language=\"javascript\" type=\"text/javascript\">document.form1.__ac_name.focus();</script>"; 
			$log->guardarLog($log->logAccesos, "LOGIN", $_POST['indicador'] . "NO");
			if (isset($denegar)) 
			{ 
				$denegar=$denegar + 1; 
			}else 
			{
				$denegar= 1;	
			}
		}
	}elseif ($resultado->codigoMensaje== 03) 
	{
		 //$mensaje = "&raquo; ALERTA: Usted ya se registr&oacute; a la red corporativa en otro equipo&laquo;";
		 $mensaje = "&raquo; ALERTA: Usted ya se registr&oacute; al $gs_acronimo en otro equipo de la red corporativa &laquo; ";	
		 //echo "<script language=\"javascript\" type=\"text/javascript\">document.form1.__ac_name.focus();</script>"; 
		$log->guardarLog($log->logAccesos, "LOGIN", $_POST['indicador'] . "NO");
		 if (isset($denegar)) 
		{ 
			$denegar=$denegar + 1; 
		}else 
		{
			$denegar= 1;	
		}	
	}else 
	{
		include_once('class.clienteSeguridadWeb.php');
		$client = new clienteSeguridadWeb($ruta);
		$resultado=$client ->obtenerInfoUsuario($indicador);
		$_SESSION["nombre-apellido"] = 	$resultado->nombreApellido;
		$_SESSION["cedula"] = $resultado->ci;
		$gs_cedula = $resultado->ci;

		$pag= "principal.php?n=1";
		$log->guardarLog($log->logAccesos, "LOGIN", "OK");
		header("Location: ".$pag);
	}
	}else{
		$mensaje = "» NOTIFICACION: Usuario bloqueado, contacte al administrador del sistema «";
		$log->guardarLog($log->logAccesos, "LOGIN", $_POST['txtID'] . " NO");
		
	}
}

function codificar($valor)
{
	$patron="0TH9E1QUICK2BROWNF3OXJUM4      PSOV5ERT6HELA7ZYD8OG";
	$retorno='';
		for($i=0;$i<strlen($valor);$i++)
		{
			$retorno.=chr(65+1+strpos($patron,strtoupper(substr($valor,$i,1))));
		}
	
  	return strtoupper($retorno);
}

function claveactual()
{
	$dia=array("D","L","M","M","J","V","S");
	$mes=array("X","E","F","M","A","M","J","J","A","S","O","N","D");
	$m=date("m");
	settype($m,"double");
	return  $mes[$m].$dia[date("N")].date("d");
}

?>
<HTML>
<HEAD>
<title>&nbsp;( <?php echo $gs_acronimo ?> ) - <?php echo $titulo_sistema?> </title> 
<title>
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------
</title> 
	<script language="javascript" type="text/javascript" src="../js/utilidades.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/main-aplicacion.css">
	<script type="text/javascript">	var GB_ROOT_DIR = "../js/greybox/";</script>
	<script type="text/javascript" src="../js/greybox/AJS.js"></script>
	<script type="text/javascript" src="../js/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="../js/greybox/gb_scripts.js"></script>
	<link href="../js/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" type="image/x-icon" href="../imagenes/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script LANGUAGE="javascript" type="text/javascript">
	function init() {
		/* Se requiere colocar el cursor en el 1er. campo  */
		document.form1.__ac_name.focus();
		}
		/* Para Mozilla */
		if (document.addEventListener) {
			document.addEventListener("DOMContentLoaded", init, false);
		}
	
		/* Para Safari */
		/*if (/WebKit/i.test(navigator.userAgent)) { // sniff
			var _timer = setInterval(function() {
				if (/loaded|complete/.test(document.readyState)) {
					init(); // call the onload handler
				}
			}, 10);
		}
		*/
		//window.onload = init;
	</script>
	
</HEAD> 
<BODY  class="BODY_login" > 
<?php 
	
	if ($denegar > 3) {
		$clad->bloquearUsuario($_POST['txt_usuario'], 1);
		echo "<script>open_ventana('denegar.php');</script>"; 
		$denegar= 0; 
	}
?>
<table height="80%" width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td align="center">
			<div id="contenedor" align="center"></div>
			<div >
			  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="705px" height="140px">
                <param name="movie" value="../flash/banner_login.swf">
                <param name="quality" value="high">
                <embed src="../flash/banner_login.swf" quality="high" bucle = "off" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="705px" height="140px"></embed>
		      </object>
			</div>
			<div id="formulario" class="formulario_login" align="center">			
				<div id="mensajes">
					<h3>					  
				    <?php echo $mensaje ?></h3>
			  </div>
				<form name="form1" method="POST">
					<table cellPadding="0" align="center" border="0">
					  <tbody>
						  <tr >
							<td class="TD_login" >Usuario:</td>
							<td><input class=edit_login id=__ac_name onkeyup=cleanUser(this) size=30 name="txt_usuario"><input name="denegar" id="denegar" type="hidden" value="<?php if (isset($denegar)) echo $denegar ;?>" style="display:none"> </td>							
						  </tr>
						  <tr>
							<td class="TD_login" >Contraseña:</td>
							<td><INPUT class=edit_login type=password size=30 name="txt_clave" maxlength="14"> </td>
						  </tr>
						  <tr>
							 <td></td>
							<td align="center" colspan="2"><BR>
			                     			<div class="Principio-Boton"></div>
			                     			<input title="Confirma la información ingresada. Si olvido estos datos, comuníquese con la Ext. 105" name="btn_ingresar" type="submit" value="Ingresar" class="Boton" style="cursor:pointer">
										    <div class="Final-Boton"></div>
			                            </td>
						  <TR>

					  </TBODY>						
					</TABLE>
										
				</FORM>
				<table cellpadding="0" align="center" border="0" width="100%">
				        <tr>
			                    	<td colspan="2" align="right" class="TD_login">
			                        	Si no conoce su usuario pulse
			                        	<a style="color: rgb(255, 0, 0);" href="http://activacion.pdvsa.com">aquí</a>&nbsp;&nbsp;
			                   	</td>
			        	</tr>
			        </table>
			</DIV>	
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="32%" align="left">
			      <h4 class="Texto-Identificador"><?php include("../../logica/componentes/contador_visitas.php");  
							$file= new clscontador;
							$file->showtotal();
						?></h4>					</td>
						  <script LANGUAGE="javascript" type="text/javascript">
						  		if ((navigator.appName=="Microsoft Internet Explorer") && (parseInt(navigator.appVersion)>=4)) 
								{ 	<?php $url_par = "'".$url."', '".$describeURL."'";?>
      							  	document.writeln("<td width=\"63%\">");
				  					document.writeln("<div align=\"right\">");									
									document.writeln("<a href=\"javascript:agregarurl(<?php echo $url_par ?>)\" class=\"pie\" onmouseover=\"window.status='Permite agregar  la dirección o URL actual a Favoritos';return true \" onmouseout=\"window.status='';return true\"> Agregar a Favoritos</a>");
								 	document.writeln("</div>");
									document.writeln("</td>"); 
								}						 
							</script>
				   <td width="443" align="right">
						
						 </td>
				</tr>
		   </table>  
		</td>
	 </tr>
	
</table>
</BODY>
</HTML>



