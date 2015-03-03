<?php
session_start();
include '../../include_primeravuelta/lugar.php';
include '../../include_primeravuelta/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$depto=$_POST['tdepto'];
$_SESSION['TITULO']='Departamento:'.$_POST['ttitulo'];
$te=$_SESSION['ELECCION'];
$muni=0;
$tfor=$_SESSION['FORMA'];

$_SESSION['DEPARTAMENTO']=$_POST['tdepto'];
$_SESSION['MUNICIPIO']=0;

$lugar = new clugar($te,$depto,$muni,$tfor,'Cargar_selectM',0);
$alugar = $lugar->datoslugar();
echo $alugar;
?>

