<?php 
session_start();
include '../../include_primeravuelta/mapa.php';
include '../../include_primeravuelta/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

//$_SESSION['DEPARTAMENTO']=$_POST['tdepto'];
$depto = $_SESSION['DEPARTAMENTO'];
/*echo '<script type="text/javascript" src="mapas/js/jquery.js"></script>';
echo '<script type="text/javascript" src="mapas/js/maphilight.js"></script>';
echo '<script type="text/javascript">$(function() {';
echo "$('.map').maphilight()";
echo '});</script>';
*/
$miMapa = new mapa(); echo $miMapa->show($depto);

?>
