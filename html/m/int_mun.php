<?php
session_start();
include 'class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['MUNICIPIO']=$_POST['int_mun'];
$posicion=stripos($_SESSION['TITULO'],'Municipio');
if($posicion==0) $_SESSION['TITULO']=$_SESSION['TITULO'].' Municipio: </b>'.$_POST['int_titulo'];
else {
   $_SESSION['TITULO']=substr($_SESSION['TITULO'],0,$posicion-1);
   if($_POST['int_mun']!=0) $_SESSION['TITULO']= $_SESSION['TITULO'].' Municipio: </b>'.$_POST['int_titulo'];
}
?>

