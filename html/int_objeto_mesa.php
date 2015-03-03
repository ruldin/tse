<?php
session_start();
include_once '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

switch($_POST['objeto'])
{
	case 1: //tipoeleccion
	{
		include_once '../include/lugar.php';
		$lugar = new clugar($_SESSION['ELECCION'],$_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],4,'Cargar_detD',1);
		echo $lugar->datoslugar();		
		break;
	}
	case 2: //departamento
	{
		include_once '../include/lugar.php';
		$lugar = new clugar($_SESSION['ELECCION'],$_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],4,'Cargar_detM',1);
		echo $lugar->datoslugar();
		break;
	}
	case 3: //municipio
	{
		include_once '../include/tabla.php'; 
		$tab = new ctabla();
		if($_SESSION['DETALLE']==1) $tab->construyeListado($_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],$_SESSION['ELECCION'],''); 
		else $tab->construyeTabla($_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],$_SESSION['ELECCION'],''); 
		break;
	}
	case 4: //mesa
	{
		include_once '../include/tabla.php'; 
		$tab = new ctabla();
		$tab->construyeTablaMesa($_POST['tmesa'],$_SESSION['ELECCION'],$_SESSION['DETALLE']); 
		break;
	}
	case 5: //titulo1
	{
		date_default_timezone_set('America/Guatemala');
		$html='<table><tr><td class="t1">'.$_SESSION['TITULO'].'</td></tr>';
		$html.='<tr><td class="t2"></td></tr>';
		$html.='<tr><td class="t3"></td></tr></table>';
		echo $html;
		break;
	}
	case 6: //titulo2
	{
		date_default_timezone_set('America/Guatemala');
		$html='<table><tr><td class="t1">'.$_SESSION['TITULO'].'</td></tr>';
		$html.='<tr><td class="t2"></td></tr>';
		$html.='<tr><td class="t3">Resultados preliminares&nbsp;&nbsp;&nbsp;&nbsp;'.date("d/m/Y").'&nbsp;&nbsp;&nbsp;'.date("H:i:s").'</td></tr></table>';
		echo $html;
		break;
	}
}
?>