<?php 	
session_start();
header("max-age=3600, cache-control: must-revalidate");
$offset = 60 * 60 * 24 * 10;
$ExpStr = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($ExpStr);

include_once '../../../include_nebaj/config.php';
include_once 'include.grafica.php';
include_once 'include.tabla.php'; 

//$_SESSION['TIPOELECCION']=1;
$_SESSION['TIPOELECCION']=4;
$int_tipoeleccion=$_SESSION['TIPOELECCION'];

//$_SESSION['DEPARTAMENTO']=0; 
$_SESSION['DEPARTAMENTO']=14; 
$int_dep=$_SESSION['DEPARTAMENTO'];

//$_SESSION['MUNICIPIO']=0;
$_SESSION['MUNICIPIO']=13;
$int_mun=$_SESSION['MUNICIPIO'];

//$_SESSION['TITULO']='NIVEL NACIONAL';
$_SESSION['TITULO']='Repetici&oacute;n de la Elecci&oacute;n de Corporaci&oacute;n Municipal<br>Decreto 4-2013 TSE';
$int_titulo=$_SESSION['TITULO'];

$_SESSION['FECHAHORA']='';
$int_fec=$_SESSION['FECHAHORA'];

//$_SESSION['TOTPARTIDO']=6;
$_SESSION['TOTPARTIDO']=20;
$tp=$_SESSION['TOTPARTIDO'];

$_SESSION['MAXPARTIDO']=MAX_PARTIDOS;
$mp=$_SESSION['MAXPARTIDO'];

$_SESSION['PROCESO']=PROCESO;
?>
<?php
ini_set ('zlib.output_compression', 'On') ;
ini_set ('zlib.output_compression_level', '1') ;
?>
<!DOCTYPE html> 
<html> 
<head> 
	<title>Tribunal Supremo Electoral - Repetici&oacute;n de la Elecci&oacute;n Municipal de Nebaj, Quich&eacute;</title> 
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="HandheldFriendly" content="True" />
	<link rel="stylesheet" type="text/css" media="screen" href="m.style.css" />
</head>
<?php flush(); ?>
<body> 
<div id="container">
	<div id="header">
		<img alt="Tribunal Supremo Electoral Rep&uacute;blica de Guatemala - Repetici&oacute;n de la Elecci&oacute;n de Corporaci&oacute;n Municipal de Nebaj, Quich&eacute;" title="Tribunal Supremo Electoral Rep&uacute;blica de Guatemala - Repetici&oacute;n de la Elecci&oacute;n de Corporaci&oacute;n Municipal de Nebaj, Quich&eacute;" src="m.logotseelecciones2011.png" width="153" height="75">
	</div>
	<div id="body">
		<div id="title">
			<div id="dtitulo">
				<?php
					date_default_timezone_set('America/Guatemala');
					$html.='<table><tr><td class="t1">'.$int_titulo.'</td></tr>';
					$html.='<tr><td class="t2"><b>Departamento: </b>Quich&eacute;&nbsp;&nbsp;<b>Municipio: </b>Nebaj</td></tr>';
					$html.='<tr><td class="t3">Resultados preliminares&nbsp;&nbsp;&nbsp;'.date("d/m/Y").'&nbsp;&nbsp;'.date("H:i:s").'</td></tr></table>';
					echo $html;				?>
			</div>
		</div>				
		<div id="main">					
			<div id="fgrafica"><?php $cfig = new cfiguramovil($tp,$mp,$int_dep,$int_mun,$int_tipoeleccion); echo $cfig->darcadena();  ?></div>
			<div id="ftabla"><?php $tmp = new cls_tabla($int_dep,$int_mun,$int_tipoeleccion); ?></div>
		</div>
	</div>
	<div id="help">
		<a href="#top"><b>Top</b></a>
	</div>
	<div id="footer">
		<label>Tribunal Supremo Electoral<br/>
		Guatemala Centroam&eacute;rica<br/>
		&copy; 2011-2014</label>
		<br><br><a href="http://resultados2011.tse.org.gt/nebaj/?w=1">[Sitio web]</a><br>
		<div id="clear"></div>
	</div>				
</div> 
</body>
<script src="jquery-1.6.2.min.js"></script>
<script language="javascript"> $('a[href=#top]').click(function(){$('html, body').animate({scrollTop:0}, 'slow'); return false; });</script>
</html>