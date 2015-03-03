<?php
include_once 'config.php';

class cbase
{
private $link;
private $result;
  
	function __construct() {
	}
	
	function conectaDB() {
		//    Conecta a la base 
//		$hostdb = HOSTDB;   //  host
//		$userdb = USERDB;    //  usuario
//		$passdb = PASSDB;    // password
//		$namedb = NAMEDB;   // database
                $hostdb = 'localhost';   //  host
                $userdb = 'root';    //  usuario
                $passdb = 'ruldin';    // password
                $namedb = 'tse';   // database


		$this->link = mysql_connect($hostdb, $userdb, $passdb);
//              $this->link = mysql_connect("localhost","root","ruldin");

		if (!$this->link) {
			// Si existe un error de conexion
			die('Error de conexion a la base de datos ') ;

		}

		$db_selected = mysql_select_db($namedb);
		if (!$db_selected) {
			die ('Error de conexi&oacute;n a la base de datos');
		}
	}
 
	function consulta($strSQL) {
            //    echo $strSQL;
//              $strSQL="select * from tresultado where dep=0 and mun=0 and tipoeleccion=1";
		$this->result = mysql_query($strSQL);
		if ($this->result)
		$ors = mysql_fetch_array($this->result); 
		else 
		die('No hay datos del lugar en la base de datos: ') ;
		return $ors;
	}

	function N(){
		return mysql_num_rows($this->result);
	}

	function siguiente() {
		return  $ors = mysql_fetch_array($this->result); 
	}

	function __destruct() {
		mysql_close($this->link);
	}
}
?>
