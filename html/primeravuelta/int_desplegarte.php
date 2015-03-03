<?php
session_start();
include '../../include_primeravuelta/tabla.php'; 
include '../../include_primeravuelta/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['ELECCION']= $_POST['te'];
$te= $_POST['te'];

if(($_SESSION['DEPARTAMENTO']!=0) && ($_SESSION['MUNICIPIO']!=0)) {
  $depto= $_SESSION['DEPARTAMENTO'];
  $muni= $_SESSION['MUNICIPIO'];

  $tab = new ctabla();
  if($_SESSION['DETALLE']==1) $tab->construyeListado($depto,$muni,$te,''); 
  else $tab->construyeTabla($depto,$muni,$te,'');   
  
}


?>