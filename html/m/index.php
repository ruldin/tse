<?php 	
session_start();
header("max-age=3600, cache-control: must-revalidate");
$offset = 60 * 60 * 24 * 10;
$ExpStr = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($ExpStr);
include_once 'mnu_tipoeleccion.php';
include_once 'mnu_depmun.php';
include_once 'mnu_titulo.php';
include_once 'mnu_tabla.php'; 
include_once 'mnu_grafica.php';
include_once '../../include/config.php';
$_SESSION['TIPOELECCION']=1;
$int_tipoeleccion=$_SESSION['TIPOELECCION'];
$_SESSION['DEPARTAMENTO']=0; 
$int_dep=$_SESSION['DEPARTAMENTO'];
$_SESSION['MUNICIPIO']=0;
$int_mun=$_SESSION['MUNICIPIO'];
$_SESSION['TITULO']='NIVEL NACIONAL';
$int_titulo=$_SESSION['TITULO'];
$_SESSION['FECHAHORA']='';
$int_fec=$_SESSION['FECHAHORA'];
$_SESSION['TOTPARTIDO']=6;
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
	<title>TSE - Resultados Segunda Elecci&oacute;n Presidencial 2011</title> 
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="HandheldFriendly" content="True" />
	<link rel="stylesheet" type="text/css" media="screen" href="m.style.css" />
</head>
<?php flush(); ?>
<body> 
<div id="container">
	<div id="header">
		<img alt="Tribunal Supremo Electoral Rep&uacute;blica de Guatemala - Segunda Elecci&oacute;n Presidencial 2011" title="Tribunal Supremo Electoral Rep&uacute;blica de Guatemala Segunda Elecci&oacute;n Presidencial 2011" src="logotseelecciones2011.png">
	</div>
	<div id="body">
		<div id="menu">
			<form name="formulario">
			<table>
			<tr>
				<td><div id="mtipo"><?php $tmp = new cls_tipoeleccion(); ?></div></td>
			</tr>
			<tr>
				<td><div id="mdepto"><?php $tmp = new cls_depmun($int_tipoeleccion,$int_dep,$int_mun,'ajx_dep',0); ?></div></td>
			</tr>
			<tr>
				<td><div id="mmuni" style="display:none;"></div></td>
			</tr>
			</form>
			</table>
		</div>
		<div id="title">
			<div id="dtitulo"><?php $tmp = new cls_titulo($int_tipoeleccion,$int_titulo,$int_fec); ?></div>
		</div>				
		<div id="main">					
			<div id="fgrafica"><?php $cfig = new cfiguramovil($tp,$mp,$int_dep,$int_mun,$int_tipoeleccion); echo $cfig->darcadena();  ?></div>
			<div id="ftabla"><?php $tmp = new cls_tabla($int_dep,$int_mun,$int_tipoeleccion); ?></div>
		</div>
	</div>
	<div id="help">
		<a href="#top"><b>Men&uacute;</b></a>
	</div>
	<div id="footer">
		<label>Tribunal Supremo Electoral<br/>
		Guatemala Centroam&eacute;rica<br/>
		&copy; 2011</label>
		<div id="clear"></div>
	</div>				
</div> 
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21711399-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
<script src="jquery-1.6.2.min.js"></script>
<script src="m.ajax.js"></script>			
<script language="javascript"> $('a[href=#top]').click(function(){$('html, body').animate({scrollTop:0}, 'slow'); return false; });</script>
</html>