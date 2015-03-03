<?php
class cls_titulo {
private $vec= array ( 1 => 'Presidente y Vicepresidente - Segunda Elecci&oacute;n Presidencial', 2 => 'Diputados por Lista Nacional', 
                      3 => 'Diputados por Distrito', 4 => 'Corporaci&oacute;n Municipal', 
                      5 => 'Diputados al Parlamento Centroamericano' );
   
	function __construct($te,$depmun,$departamento) {
		if ($te==4)
		{
			switch($departamento)
			{
				case 6:
				{
					$_SESSION['MUNICIPIO']=13;
					$_SESSION['NOMDEP']='Santa Rosa';
					$_SESSION['NOMMUN']='Pueblo Nuevo Vi&ntilde;as';
					$titulo='Corporaci&oacute;n Municipal';
					break;
				}
				case 13:
				{
					$_SESSION['MUNICIPIO']=21;
					$_SESSION['NOMDEP']='Huehuetenango';
					$_SESSION['NOMMUN']='Tectit&aacute;n';
					$titulo='Alcalde y S&iacute;ndicos';
					break;
				}
				case 14:
				{
					$_SESSION['MUNICIPIO']=3;
					$_SESSION['NOMDEP']='Quich&eacute;';
					$_SESSION['NOMMUN']='Chinique';
					$titulo='Corporaci&oacute;n Municipal';
					break;
				}
				case 17:
				{
					$_SESSION['MUNICIPIO']=2;
					$_SESSION['NOMDEP']='Pet&eacute;n';
					$_SESSION['NOMMUN']='San Jos&eacute;';
					$_SESSION['TITULO']='<b>Departamento: </b>Pet&eacute;n&nbsp;&nbsp;<b>Municipio: </b>San Jos&eacute;';
					$titulo='Corporaci&oacute;n Municipal';
					break;
				}
				case 18:
				{
					$_SESSION['MUNICIPIO']=3;
					$_SESSION['NOMDEP']='Izabal';
					$_SESSION['NOMMUN']='El Estor';
					$titulo='Corporaci&oacute;n Municipal';
					break;
				}
			}
			$depmun='<b>Departamento: </b>'.$_SESSION['NOMDEP'].'&nbsp;&nbsp;<b>Municipio: </b>'.$_SESSION['NOMMUN'];

		}
		else
		$titulo=$this->vec[$te];

		date_default_timezone_set('America/Guatemala');
		$html='<table><tr><td class="t1">'.$titulo.'</td></tr>';
		$html.='<tr><td class="t2">'.$depmun.'</td></tr>';
		$html.='<tr><td class="t3">Resultados preliminares&nbsp;&nbsp;&nbsp;'.date("d/m/Y").'&nbsp;&nbsp;'.date("H:i:s").'</td></tr></table>';
		echo $html;
	} 
	
	function __desctruct() {
	}
}
?>