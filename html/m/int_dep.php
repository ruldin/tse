<?php
session_start();
include_once 'mnu_depmun.php';
include_once 'class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['TITULO']='<b>Departamento:</b> '.$_POST['int_titulo'].'<b>';
$_SESSION['DEPARTAMENTO']=$_POST['int_dep'];
if ($_SESSION['TIPOELECCION']==1)
$_SESSION['MUNICIPIO']=0;
elseif ($_SESSION['TIPOELECCION']==4)
$_SESSION['MUNICIPIO']=13;
$tmp = new cls_depmun($_SESSION['TIPOELECCION'],$_POST['int_dep'],0,'ajx_mun',0);
?>

