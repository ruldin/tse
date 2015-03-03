<?php
session_start();
include '../../include_primeravuelta/tabla.php'; 
include '../../include_primeravuelta/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['MUNICIPIO']= $_POST['tmuni'];
$muni= $_POST['tmuni'];
$depto= $_SESSION['DEPARTAMENTO'];
$te= $_SESSION['ELECCION'];

$tab = new ctabla();
if($_SESSION['DETALLE']==1) $tab->construyeListado($depto,$muni,$te,''); 
else $tab->construyeTabla($depto,$muni,$te,''); 
?>