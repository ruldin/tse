<?php
session_start();
include_once '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

switch($_POST['objeto'])
{
	case 1: //titulo
	{
		include_once '../include/titulo.php';
		$otit = new ctitulo($_SESSION['ELECCION'],$_SESSION['TITULO'],'');
		echo $otit->datitulo();
		break;
	}
	case 2: //mapa
	{
		include_once '../include/mapa.php';
		$miMapa = new mapa(); echo $miMapa->show($_SESSION['DEPARTAMENTO'],$_SESSION['ELECCION']);
		break;
	}
	case 3: //radio
	{
		$check_barra='';
		$check_pastel='';
		if($_SESSION['GRAFICA']==1) $check_barra='checked';
		else  $check_barra='checked';

		$html='<form name=fradio>';
		$html.='  <input type="Radio" name="sradio" onClick="cargar_grafica(1,0)" '.$check_barra.'>Barras&nbsp;';
		$html.='  <input type="Radio" name="sradio" onClick="cargar_grafica(2,0)" '.$check_pastel.'>Pastel';
		$html.='</form>';
		echo $html;		
		break;
	}
	case 4: //tabla
	{
		include_once '../include/tabla.php'; 
		$tab = new ctabla();
		$tab->construyeTabla($_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],$_SESSION['ELECCION'],''); 
		break;
	}
	case 5: //grafica
	{
		include_once '../include/figura.php';
		if($_POST['tfig'] !=1 && $_POST['tfig'] !=2 ) $figura=1; 
		else $figura= $_POST['tfig'];
		$_SESSION['GRAFICA']=$figura;
		$fig = new cfigura($_SESSION['TOTPARTIDO'],$_SESSION['MAXPARTIDO'],$_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],$_SESSION['ELECCION'],'');
		echo $fig->darcadena($_SESSION['GRAFICA']);
		break;
	}
}
?>