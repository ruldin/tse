<?php
session_start();
include 'class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['TIPOELECCION']=$_POST['int_tipoeleccion'];
if ($_SESSION['TIPOELECCION']==1)
{
	$_SESSION['DEPARTAMENTO']=0;
	$_SESSION['MUNICIPIO']=0;
	$_SESSION['TITULO']='NIVEL NACIONAL';
}
elseif ($_SESSION['TIPOELECCION']==4)
{
	$_SESSION['DEPARTAMENTO']=6;
	$_SESSION['MUNICIPIO']=13;
	$_SESSION['TITULO']='<b>Departamento:</b> Santa Rosa';
}
?>