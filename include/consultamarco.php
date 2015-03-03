<?php 
//session_start();
include 'lugar.php';
if(version_compare(phpversion(),"4.3.0", ">")){
  $te=mysql_escape_string($_SESSION['ELECCION']);
  $depto=mysql_escape_string($_SESSION['DEPARTAMENTO']);
  $muni=mysql_escape_string($_SESSION['MUNICIPIO']);
  $tfor=mysql_escape_string($_SESSION['FORMA']);
}else{
  $te=mysql_real_escape_string($_SESSION['ELECCION']);
  $depto=mysql_real_escape_string($_SESSION['DEPARTAMENTO']);
  $muni=mysql_real_escape_string($_SESSION['MUNICIPIO']);
  $tfor=mysql_real_escape_string($_SESSION['FORMA']);
}
$lugar = new clugar($te,$depto,$muni,$tfor,'Cargar_selectD',0);
$alugar = $lugar->datoslugar();
echo $alugar;
?>

