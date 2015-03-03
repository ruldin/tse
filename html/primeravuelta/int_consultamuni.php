<?php
session_start();
include '../../include_primeravuelta/lugar.php';
include '../../include_primeravuelta/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$depto=$_POST['tdepto'];
$te=$_SESSION['ELECCION'];
$muni=0;
$tfor=4;

$_SESSION['DEPARTAMENTO']=$_POST['tdepto'];
$_SESSION['MUNICIPIO']=0;

$lugar = new clugar($te,$depto,$muni,$tfor,'Cargar_detM',1);
$alugar = $lugar->datoslugar();
echo $alugar;
?>

