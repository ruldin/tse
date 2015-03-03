<?php
session_start();
include '../../include_primeravuelta/lugar.php';
include '../../include_primeravuelta/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$muni=$_POST['tmuni'];
$posicion=stripos($_SESSION['TITULO'],'Municipio');
if($posicion==0) $_SESSION['TITULO']=$_SESSION['TITULO'].' Municipio: </b>'.$_POST['ttitulo'];
else {
   $_SESSION['TITULO']=substr($_SESSION['TITULO'],0,$posicion-1);
   if($muni!=0) $_SESSION['TITULO']= $_SESSION['TITULO'].' Municipio: </b>'.$_POST['ttitulo'];
}

$te=$_SESSION['ELECCION'];
$depto=$_SESSION['DEPARTAMENTO'];
$tfor=$_SESSION['FORMA'];

$_SESSION['MUNICIPIO']=$_POST['tmuni'];
//echo $_SESSION['MUNI'];
?>

