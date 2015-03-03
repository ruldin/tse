<?php
session_start();
include_once 'mnu_titulo.php';

$tmp = new cls_titulo($_SESSION['TIPOELECCION'],$_SESSION['TITULO'],$_SESSION['DEPARTAMENTO']);
?>