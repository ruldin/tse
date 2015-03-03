<?php
session_start();
include '../include/lugar.php';
include '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['DEPARTAMENTO']=0;
$_SESSION['MUNICIPIO']=0;

$_SESSION['DETALLE']=$_POST['td'];

$te=$_SESSION['ELECCION'];
$depto=$_SESSION['DEPARTAMENTO'];
$muni=$_SESSION['MUNICIPIO'];
$tfor=4;

$lugar = new clugar($te,$depto,$muni,$tfor,'Cargar_detD',1);
$alugar = $lugar->datoslugar();
echo $alugar;
?>

