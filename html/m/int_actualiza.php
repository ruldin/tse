<?php
session_start();
include '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);

$deptos = array	(	0 => 'Nacional',
		            1 => 'Guatemala', 2 => 'Sacatep&eacute;quez', 3 => 'Chimaltenango', 4 => 'El Progreso', 5 => 'Escuintla', 
	                6 => 'Santa Rosa', 7 => 'Solol&aacute;', 8 => 'Totonicap&aacute;n',  9 => 'Quetzaltenango', 10 => 'Suchitep&eacute;quez', 
			 		11 => 'Retalhuleu', 12 => 'San Marcos', 13 => 'Huehuetenango', 14 => 'Quich&eacute;', 15 => 'Baja Verapaz', 
					16 => 'Alta Verapaz', 17 => 'Pet&eacute;n', 18 => 'Izabal', 19 => 'Zacapa', 20 => 'Chiquimula', 
     				21 => 'Jalapa', 22 => 'Jutiapa'
				);
	
switch ($_POST['objeto'])
{
	case 0:	//tipoEleccion
	{
		$_SESSION['ELECCION']=$_POST['te'];
		$_SESSION['DEPARTAMENTO']=$_POST['dep'];
		$_SESSION['MUNICIPIO']=$_POST['mun'];
		if ($_SESSION['ELECCION']==4)
		{
			include_once '../include/lugar.php';
			$lugar = new clugar($_SESSION['ELECCION'],$_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],3,'Cargar_selectM',0);
			echo $lugar->datoslugar();
		}
		break;
	}
	case 1:	//departamento cero
	{
		$_SESSION['ELECCION']=$_POST['te'];
		if ($_SESSION['ELECCION']==1)
		{
			$_SESSION['DEPARTAMENTO']=0;
			$_SESSION['MUNICIPIO']=0;
		}
		break;
	}
	case 2: //departamento otros
	{
		$_SESSION['ELECCION']=$_POST['te'];
		$_SESSION['DEPARTAMENTO']=$_POST['dep'];
		$_SESSION['MUNICIPIO']=0;
		//$_SESSION['NOMDEP']=$_POST['nomdep'];
			$_SESSION['NOMDEP']=$deptos[$_SESSION['DEPARTAMENTO']];
		//if ($_SESSION['ELECCION']==1)
		//{
			include_once '../include/lugar.php';
			$lugar = new clugar($_SESSION['ELECCION'],$_SESSION['DEPARTAMENTO'],$_SESSION['MUNICIPIO'],3,'Cargar_selectM',0);
			echo $lugar->datoslugar();
		//}
		break;
	}
	case 3:	//municipio
	{
		$_SESSION['MUNICIPIO']=$_POST['mun'];
		$_SESSION['NOMMUN']=$_POST['nommun'];
		break;
	}
}

//actualizar titulo
if ($_SESSION['ELECCION']==1)
{
	if ($_SESSION['DEPARTAMENTO']==0)
	$_SESSION['TITULO']='NIVEL NACIONAL';
	else
	{
		if ($_SESSION['MUNICIPIO']==0)
		$_SESSION['TITULO']='<b>Departamento: </b>'.$_SESSION['NOMDEP'];
		else
		$_SESSION['TITULO']='<b>Departamento: </b>'.$_SESSION['NOMDEP'].'&nbsp;&nbsp;<b>Municipio: </b>'.$_SESSION['NOMMUN'];
	}
}
elseif ($_SESSION['ELECCION']==4)
{
	switch($_SESSION['DEPARTAMENTO'])
	{
		case 6:
		{
			$_SESSION['MUNICIPIO']=13;
			$_SESSION['NOMDEP']='Santa Rosa';
			$_SESSION['NOMMUN']='Pueblo Nuevo Vi&ntilde;as';
			break;
		}
		case 13:
		{
			$_SESSION['MUNICIPIO']=21;
			$_SESSION['NOMDEP']='Huehuetenango';
			$_SESSION['NOMMUN']='Tectit&aacute;n';
			break;
		}
		case 14:
		{
			$_SESSION['MUNICIPIO']=3;
			$_SESSION['NOMDEP']='Quich&eacute;';
			$_SESSION['NOMMUN']='Chinique';
			break;
		}
		case 17:
		{
			$_SESSION['MUNICIPIO']=2;
			$_SESSION['NOMDEP']='Pet&eacute;n';
			$_SESSION['NOMMUN']='San Jos&eacute;';
			$_SESSION['TITULO']='<b>Departamento: </b>Pet&eacute;n&nbsp;&nbsp;<b>Municipio: </b>San Jos&eacute;';
			break;
		}
		case 18:
		{
			$_SESSION['MUNICIPIO']=3;
			$_SESSION['NOMDEP']='Izabal';
			$_SESSION['NOMMUN']='El Estor';
			break;
		}
	}
	$_SESSION['TITULO']='<b>Departamento: </b>'.$_SESSION['NOMDEP'].'&nbsp;&nbsp;<b>Municipio: </b>'.$_SESSION['NOMMUN'];
}
?>
