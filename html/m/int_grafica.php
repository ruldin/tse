<?php 
session_start();
include 'mnu_grafica.php';
$cfig = new cfiguramovil($_SESSION['TOTPARTIDO'],$_SESSION['MAXPARTIDO'],$_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],$_SESSION['TIPOELECCION']); 
echo $cfig->darcadena(); 
?>
