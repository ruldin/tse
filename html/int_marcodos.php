<?php 
session_start();
include '../include/figura.php';
include '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$depto = $_SESSION['DEPARTAMENTO'];
$muni  = $_SESSION['MUNICIPIO'];
$te    = $_SESSION['ELECCION'];
if($_POST['tfig'] !=1 && $_POST['tfig'] !=2 ) $figura=1; 
else $figura= $_POST['tfig'];

$_SESSION['GRAFICA']=$_POST['tfig'];

//$figura= tfig;
//$depto= $_POST['tdepto'];
//$muni=  $_POST['tmuni'];
//$te=    $_POST['tele'];

$fig = new cfigura($_SESSION['TOTPARTIDO'],$_SESSION['MAXPARTIDO'],$depto,$muni,$te,'');
//$fig->barras(1,0,1,'PRESI');
echo $fig->darcadena($figura);
?>
