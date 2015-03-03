<?php
include_once('../../include/conexion.php');
include_once('../../include/config.php');

class cls_tabla {
private $maxPartidos=MAX_PARTIDOS;
private $proceso=PROCESO;
private $ors;
	
	function __construct($dep,$mun,$tipoeleccion) {
		$cdb = new cbase;
		$cdb->conectaDB();
	if(version_compare(phpversion(),"4.3.0", ">")){
		$dep=mysql_escape_string($dep);
                $mun=mysql_escape_string($mun);
                $tipoeleccion=mysql_escape_string($tipoeleccion);
                $this->proceso=mysql_escape_string($this->proceso);

	}else{
		$dep=mysql_real_escape_string($dep);
                $mun=mysql_real_escape_string($mun);
                $tipoeleccion=mysql_real_escape_string($tipoeleccion);
                $this->proceso=mysql_real_escape_string($this->proceso);
	}
	
		$this->ors= $cdb->consulta("SELECT * FROM tresultado WHERE DEP=".$dep." and MUN=" .$mun." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso);
		if ($cdb->N()==0)
		{
			$html='No hay datos.';
		}
		else
		{
			$html='<table class="tabla">';
			$i=0;
			$html.='<thead><tr><th class="header1">Partido</th><th class="header2">Votos</th><th class="header3">%</th></tr></thead><tbody>';
			while ( $i< $this->maxPartidos && $this->ors[11 +($i*5)]<>'' ) {
			   if(($i/2-round($i/2,0))==0) $tclass='';
			   else $tclass ='class="odd"';
			   $html.='<tr '.$tclass.'><td>'.$this->ors[11+($i*5)].'</td><td>'.number_format($this->ors[13+($i*5)],0).'</td><td>'.number_format($this->ors[14+($i*5)],2).'</td></tr>';
			   $i++;
			}
			$html.='</tbody></table><br/>';

			// COLUMNAS DE TABLA PARA TOTALES
			$html.='<table class="tabla2"><caption>Totales</caption><tbody>';
			$html.='<tr class="totpar"><td class="c1">Votos V&aacute;lidos:</td><td class="c2">'.number_format($this->ors['VOTOSVALIDOS'],0).'</td><td class="c3"></td></tr>';
			$html.='<tr class="totimpar"><td class="c1">Votos Nulos:</td><td class="c2">'.number_format($this->ors['NULOS'],0).'</td><td class="c3">'.number_format($this->ors['PNULOS'],2).'</td></tr>';
			$html.='<tr class="totpar"><td class="c1">Votos Blancos:</td><td class="c2">'.number_format($this->ors['BLANCOS'],0).'</td><td class="c3">'.number_format($this->ors['PBLANCOS'],2).'</td></tr>';
			$html.='<tr class="totimpar"><td class="c1">Votos Emitidos:</td><td class="c2">'.number_format($this->ors['TOTALVOTOS'],0).'</td><td class="c3"></td></tr>';
			$html.='<tr class="totpar"><td class="c1">Votantes Inscritos:</td><td class="c2">'.number_format($this->ors['CNTVOTANTES'],0).'</td><td class="c3"></td></tr>';
			$html.='<tr class="totimpar"><td title="Juntas Receptoras de Votos Totalizadas" class="c1">JRV Totalizadas:</td><td class="c2">'.number_format($this->ors['MESASPRO'],0).'</td><td class="c3">'.number_format($this->ors['PMESASPRO'],2).'</td></tr>';
			$html.='<tr class="totpar"><td title="Total Juntas Receptoras de Votos" class="c1">Total JRV:</td><td class="c2">'.number_format($this->ors['CNTMESAS'],0).'</td><td class="c3"></td></tr>';
			$html.='</tbody></table>';
		}
		echo $html;
	}
}
?>
