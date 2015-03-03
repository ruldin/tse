<?php 
session_start();
include '../../include_primeravuelta/tabla.php'; 
include '../../include_primeravuelta/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$depto= $_SESSION['DEPARTAMENTO'];
$muni=  $_SESSION['MUNICIPIO'];
$te=    $_SESSION['ELECCION'];

$tab = new ctabla();
$tab->construyeTabla($depto,$muni,$te,''); 
?>
