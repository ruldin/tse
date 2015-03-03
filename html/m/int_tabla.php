<?php
session_start();
include 'mnu_tabla.php';
$tmp = new cls_tabla($_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],$_SESSION['TIPOELECCION']);
?>