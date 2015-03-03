<?php
session_start();
include '../include/class.inputfilter_clean.php';
$xss = new InputFilter();
$_POST = $xss->process($_POST);
	
switch ($_POST['objeto'])
{
	case 0:	//tipoproceso
	{
		$_SESSION['DETALLE']=$_POST['td'];
		$_SESSION['DEPARTAMENTO']=0;
		$_SESSION['MUNICIPIO']=0;
		$_SESSION['ELECCION']=0;
		switch($_SESSION['DETALLE'])
		{
			case 1:
			{
				$_SESSION['TITULO']='Actas por Municipio';
				break;
			}
			case 2:
			{
				$_SESSION['TITULO']='Escrutinio Municipal';
				break;
			}
			case 3:
			{
				$_SESSION['TITULO']='Resultados por Mesa';
				break;
			}
		}
		break;
	}
	case 1:	//tipoeleccion
	{
		$_SESSION['ELECCION']=$_POST['te'];
		$_SESSION['DEPARTAMENTO']=0;
		$_SESSION['MUNICIPIO']=0;
		switch($_SESSION['DETALLE'])
		{
			case 1:
			{
				$te='Presidente y Vicepresidente';
				break;
			}
			case 4:
			{
				$te='Corporaci&oacute;n Municipal';
				break;
			}
		}
		break;
	}
	case 2: //departamento
	{
		$_SESSION['DEPARTAMENTO']=$_POST['tdepto'];
		if ($_SESSION['ELECCION']==1)
		{
			$_SESSION['MUNICIPIO']=0;
		}
		elseif ($_SESSION['ELECCION']==4)
		{
			switch($_SESSION['DEPARTAMENTO'])
			{
				case 6:
				{
					$_SESSION['MUNICIPIO']=13;
					break;
				}
				case 13:
				{
					$_SESSION['MUNICIPIO']=21;
					break;
				}
				case 14:
				{
					$_SESSION['MUNICIPIO']=3;
					break;
				}
				case 17:
				{
					$_SESSION['MUNICIPIO']=2;
					break;
				}
				case 18:
				{
					$_SESSION['MUNICIPIO']=3;
					break;
				}
			}
		}
		break;
	}
	case 3:	//municipio
	{
		$_SESSION['MUNICIPIO']= $_POST['tmuni'];
		break;
	}
}

//actualizar titulo
?>