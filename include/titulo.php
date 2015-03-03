<?php
class ctitulo {
private $html;
private $p_ate= array (
1 => 'Segunda Elecci&oacute;n Presidencial',
2 => 'Diputados por Lista Nacional',
3 => 'Diputados por Distrito',
4 => 'Corporaci&oacute;n Municipal',
5 => 'Diputados al Parlamento Centroamericano' );
   
function __construct($te,$titulo) {
	date_default_timezone_set('America/Guatemala');
	if ($te == 4 && $_SESSION['DEPARTAMENTO'] == 13){
		$this->html='<table><tr><td class="t1">Alcalde y Sindicos</td></tr>';
	} else {
		$this->html='<table><tr><td class="t1">'.$this->p_ate[$te].'</td></tr>';
	}
	$this->html.='<tr><td class="t2">'.$titulo.'</td></tr>';
	$this->html.='<tr><td class="t3">Resultados preliminares&nbsp;&nbsp;&nbsp;&nbsp;'.date("d/m/Y").'&nbsp;&nbsp;&nbsp;'.date("H:i:s").'</td></tr></table>';
}
function datitulo() {
 return $this->html;
}

}
?>