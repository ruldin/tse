<?php 
session_start();
include '../include/tabla.php'; 
include '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['DEPARTAMENTO']=$_POST['tdepto'];
$_SESSION['MUNICIPIO']   =$_POST['tmuni'];
$_SESSION['ELECCION']    =$_POST['tele'];

$depto= $_POST['tdepto'];
$muni=  $_POST['tmuni'];
$te=    $_POST['tele'];

$tab = new ctabla();
$tab->construyeTabla($depto,$muni,$te,''); 
?>
