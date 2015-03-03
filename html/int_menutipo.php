<?php
session_start();
include '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$_SESSION['ELECCION']=$_POST['te'];
?>

