<?php 
//--------------------------------------------------------------------------------------
//-- INFORMACION TECNICA 
//--------------------------------------------------------------------------------------
//Filial de PDVSA .......: INTEVEP
//Grupo Tecnico..........: Soluciones del Negocio - AIT Region Centro, Miranda Oeste
//Periodo................: 2010
//---------------------------------------------------------------------------------------

/******************************************PAREDESH***********************************************/
extract($_REQUEST);
	class ObjLdap
	{
	var $conexion;
	var $busqueda;
	var $item;
	var $idusuario;
	var $usuario;
	var $clave;
	var $Cedula;
	
		function ObjLdap($usuario,$clave,$dominio=dominio_ldap,$servidor=servidor_ldap)//Constructora
		{
			$this->idusuario=$usuario;
			$this->clave=$clave;
			$this->usuario= ($usuario.="@".$dominio);
			$this->conexion=@ldap_connect($servidor);
			
		}
		
		function Autenticacion()
		{
				if (@ldap_bind($this->conexion,$this->usuario,$this->clave) or die($this->erroredirect(__LINE__,urlencode(__FILE__),urlencode(__FUNCTION__),__CLASS__))):
					$this->datos();
					return true;
				else:
					return false;
				endif;
			
			 
		}

		function datos()
		{
			$this->busqueda=@ldap_search($this->conexion,"OU=Usuarios, DC=pdvsa, DC=com", "sAMAccountName=".$this->idusuario) or die($this->erroredirect(__LINE__,urlencode(__FILE__),urlencode(__FUNCTION__),__CLASS__));
			$this->item=ldap_get_entries($this->conexion,$this->busqueda);
		}
		
		function filtrocedula()
		{
			settype($this->Cedula,'double');
			$this->busqueda=@ldap_search($this->conexion,"OU=Usuarios, DC=pdvsa, DC=com", "pdvsacom-ad-cedula=".$this->Cedula) or die($this->erroredirect(__LINE__,urlencode(__FILE__),urlencode(__FUNCTION__),__CLASS__));
			$this->item=@ldap_get_entries($this->conexion,$this->busqueda);
			
		}
		function cedula()
		{
			if(isset($this->item[0]["pdvsacom-ad-cedula"][0]))
			return $this->item[0]["pdvsacom-ad-cedula"][0];
		}
		
		function PNombre()
		{
			if(isset($this->item[0]["givenname"][0]))
			return $this->item[0]["givenname"][0];
		
		}
		
		function PApellido()
		{
			if(isset($this->item[0]["sn"][0]))
			return $this->item[0]["sn"][0];
		
		}
		
		function Gerencia()
		{
			if(isset($this->item[0]["pdvsacom-ad-organization"][0]))
			return $this->item[0]["pdvsacom-ad-organization"][0];
		
		}
		
		function IdRed()
		{
			if(isset($this->item[0]["uid"][0]))
			return $this->item[0]["uid"][0];
		
		}
		
		function Extension()
		{
			if(isset($this->item[0]["ipphone"][0]))
			return $this->item[0]["ipphone"][0];
		
		}
		function Localidad()
		{
			if(isset($this->item[0]["pdvsacom-ad-buildingname"][0]))
			return $this->item[0]["pdvsacom-ad-buildingname"][0];
		
		}
		function Celular()
		{
			if(isset($this->item[0]["mobile"][0]))
			return $this->item[0]["mobile"][0];
		
		}
		function Edificio()
		{
			if(isset($this->item[0]["street"][0]))
			return $this->item[0]["street"][0];
		
		}
		function Empleado()
		{
			if(isset($this->item[0]["employeetype"][0]))
			return $this->item[0]["employeetype"][0];
		
		}
		function idsupervisor()
		{
			if(isset($this->item[0]["pdvsacom-ad-functionalsupervisor"][0]))
			return $this->item[0]["pdvsacom-ad-functionalsupervisor"][0];
		
		}
		function Cargo()
		{
			if(isset($this->item[0]["title"][0]))
			return $this->item[0]["title"][0];
		
		}
		
		function Filial()
		{
			
			if(strpos($this->item[0]["pdvsacom-ad-buildingname"][0],'INTEVEP')!==false)
			{
				return true;
			}
			else
			{
				return false;
			}
		
		}
		
		function erroredirect($linea,$url,$funcion,$clase)
		{	
			if(ldap_errno($this->conexion)!=49)
			{
			echo "<script language=\"javascript\" type=\"text/javascript\">\n";
			echo "window.parent.parent.document.location.href=\"../paginas/pagina_ldap.php?mensaje=".urlencode(ldap_error($this->conexion))."&clase=".urlencode($clase)."&script=".urlencode($funcion)."&numerror=".urlencode(ldap_errno($this->conexion))."&linea=$linea&url=$url&pagina=".urlencode($_SERVER['SCRIPT_NAME'])."\";\n";
			echo "</script>\n";
			}
			elseif(ldap_errno($this->conexion)==49)
			{
				echo "<html>";
				echo "<body>";
				echo "<form name='form1' method='post' id='form1' action='../../'>";
				echo "<input type='hidden' name='mensaje' value='1'>";
				echo "</form>";
				echo "</body>";
				echo "</html>";
				echo "<script language='javascript' type='text/javascript'>";
				echo "document.getElementById('form1').submit();";
				echo "</script>";
				session_destroy();
			}
			$this->desconectar();
		}
		
		function desconectar()
			{
			ldap_close($this->conexion);
			return true;
			}

	}

?>


