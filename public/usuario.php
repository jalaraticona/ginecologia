<?php
require_once("conectar.php");
class usuario extends Conectar{
	private $db;
	public function __construct(){
		$this->db = parent::conectar();
		parent::setNames();
	}

	public function getDatosPaciente(){
		$sql = "SELECT * FROM paciente";
		$datos = $this->db->query($sql);
		$arreglo = array();
		while ($reg = $datos->fetch_object()) {
			$arreglo[] = $reg;
		}
		return $arreglo;
	}
	public function GetDatosSql($sql){
		$datos = $this->db->query($sql);
		$arreglo = array();
		while ($reg = $datos->fetch_object()) {
			$arreglo[] = $reg;
		}
		return $arreglo;
	}

	public function EjecutarSql($sql){
		$this->db->query($sql);
	}

	public function insertarPaciente(){
		$ci = $_POST["ci"];
		$nombre = $_POST["nombre"];
		$paterno = $_POST["paterno"];
		$materno = $_POST["materno"];
		$fec_nac = $_POST["fec_nac"];
		$sexo = $_POST["sexo"];
		$residencia = $_POST["residencia"];
		$antecedentes = $_POST["antecedentes"];
		$sql = "INSERT INTO pacientes VALUES (null,'".$nombre."','".$paterno."','".$materno."','".$ci."', '".$fec_nac."','".$residencia."','".$sexo."','".$antecedentes."',CURRENT_DATE())";
		$this->db->query($sql);
	}

	//funciones de ayuda
	public function encriptar($cadena){
        $key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
        //$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
        $enc = base64_encode($cadena);
        return $enc; //Devuelve el string encriptado
    }
     
    public function desencriptar($cadena){
        $key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
        //$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        $dec = base64_decode($cadena);
        return $dec;  //Devuelve el string desencriptado
    }
    public function edad($fecha){
		list($anyo,$mes,$dia) = explode("-",$fecha);
		$anyo_dif  = date("Y") - $anyo;
		$mes_dif = date("m") - $mes;
		$dia_dif   = date("d") - $dia;
		if ($dia_dif < 0 || $mes_dif < 0) $anyo_dif--;
		return $anyo_dif;
	}
	public function fecha($fecha)
    {
   	    $dia = date('d',strtotime($fecha));
		$mes = date('m',strtotime($fecha));
		$ani = date('y',strtotime($fecha));
      
        switch ($mes){
        	case '01':
        	$mes="Enero";
        	break;
        	case '02':
        	$mes="Febrero";
        	break;
        	case '03':
        	$mes="Marzo";
        	break;
        	case '04':
        	$mes="Abril";
        	break;
        	case '05':
        	$mes="Mayo";
        	break;
        	case '06':
        	$mes="Junio";
        	break;
        	case '07':
        	$mes="Julio";
        	break;
        	case '08':
        	$mes="Agosto";
        	break;
        	case '09':
        	$mes="Septiembre";
        	break;
        	case '10':
        	$mes="Octubre";
        	break;
        	case '11':
        	$mes="Noviembre";
        	break;
        	case '12':
        	$mes="Diciembre";
        	break;
        }
        $fecha=$dia." de ".$mes." de 20".$ani;
        return $fecha; 
    }

	public function soloLetras($palabra){
		if(preg_match('/^[a-zA-Z[:space:] áéíóúÁÉÍÓÚñÑ]+$/',$palabra)) return true;
		else return false;
	}

	public function soloNumero($num){
		if(preg_match('/^[0-9]+$/',$num)) return true;
		else return false;
	}

	public function validaFecha($fecha){
		date_default_timezone_set("America/Caracas");
		$actual = strtotime(date("Y-m-d"));
		$fec_dato = strtotime($fecha);
		if($actual > $fec_dato) return true;
		return false;
	}

	public function validaFechaM($fecha){
		date_default_timezone_set("America/Caracas");
		$actual = strtotime(date("Y-m-d"));
		$fec_dato = strtotime($fecha);
		if($actual < $fec_dato) return true;
		return false;
	}

	public function validaFechaInsumo($fecha){
		date_default_timezone_set("America/Caracas");
		$fec_dato = strtotime($fecha);
		$dosmenos = strtotime(date("Y-m-d", strtotime("-2 day", $fec_dato)));
		$actual = strtotime(date("Y-m-d"));
		if($fec_dato >= $dosmenos and $fec_dato <= $actual) return true;
		return false;
	}

	public function validaFechas2($fecha1, $fecha2){
		date_default_timezone_set("America/Caracas");
		$fecha1 = strtotime($fecha1);
		$fecha2 = strtotime($fecha2);
		if($fecha1 > $fecha2) return true;
		return false;
	}
}
?>