<?php
session_start();
include_once '../../include_primeravuelta/titulo.php';

$tit=$_SESSION['TITULO'];
$te=$_SESSION['ELECCION'];
//$fec=$_SESSION['FECHAHORA'];
$fec='';

$otit = new ctitulo($te,$tit,$fec);
echo $otit->datitulo();

?>